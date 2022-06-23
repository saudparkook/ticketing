<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Middelware;
use App\Models\QueueSMS;
use App\Models\Setting;
use App\Models\Subject;
use App\Models\SubjectsOrder;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use SoapClient;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=array();
        if(Auth::guest()){
            $role=UserAccess::where('status','like','on')->select('id','homepage')->first();
            $role=$role->id;
            $user['name']='';
            $user['phone']='';
            $user['username']='';

        }else{
            $user=Auth::user();
            $role=$user->access;
        }
        $suborder=Setting::where('title','>',0)->where('accesses_id','=',$role)->select('title')->get();

        return view('newMessage',compact('suborder','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if(!isset(HomeController::$setting[$request['suborder']])){
            return redirect()->back()->with("error-dialog","لطفا از دستکاری فرم بپرهیزید");
        }

        $messages=[
            "name.required"=>"فیلد نام و نام خانوادگی نباید خالی باشد.",
            "text.required"=>"فیلد  متن پیام نباید خالی باشد.",
            "suborder.required"=>"یک موضوع انتخاب کنید",
            "suborder.exists"=>"موضوع رو دستکاری نکن",
            "phone.required"=>"شماره تلفن ضروری است",
            "phone.between"=>" شماره موبایل 10 رقمی همراه بدون صفر است",
            "username.required"=>"کد ملی را وارد کنید",
            "username.between"=>"کد ملی 10 رقمی است",
        ];
        $vlaidat_array=[
            'name' => 'required|max:255',
            'phone' => 'required|between:10,10',
            'suborder' => 'required|exists:subjects_orders,id',
            'username' => 'required|between:10,10',
            'text' => 'required',


        ];

        if(Auth::guest()){
            $vlaidat_array=array_merge($vlaidat_array,['g-recaptcha-response' => 'required|captcha']);

        }

        $validatedData = $request->validate($vlaidat_array,$messages);
        if(Auth::guest()){
            $user=User::where('meli_code','like',$request->username)->orwhere('username','like',$request->username)->first();
        }else{
            $user=Auth::user();
        }
        $appendmessage='';
        $successmessage='';
        if(empty($user)){
            $role=UserAccess::where('status','like','on')->select('id','homepage')->first();
            $user=new User([
                'username'=>$request->username,
                'meli_code'=>$request->username,
                'name'=>$request->name,
                'password'=>Hash::make($request->username),
                'access'=>$role->id,
                'phone'=>'0'.$request->phone,
            ]);
            $user->save();
            $appendmessage='username:'.$request->username.'/pass:'.$request->username;
        }


        if($user->active==1){

            $code= time().$user->id;
            $successmessage="اطلاعات درخواست به شماره ".$user->phone." ارسال گشت";
            $successmessage.="<br> . کد پیگیری شما ". $code;
            $subject=new Subject([
                'title'=>$request->suborder,
                'order'=>$request->suborder,
                'user_id'=>$user->id,
                'code'=>$code
            ]);
            $subject->save();
            $message=new Message([
                'text'=>nl2br ($request->text),
                'file'=>$request->filepath,
                'audio'=>$request->audiopath,
                'user_id'=>$user->id,
                'sub_id'=>$subject->id
            ]);
            $message->save();
            //start send for user
            $input_data = array(
                "name" => $user->name.'  '.$appendmessage,
                "verification-code" => $subject->code,
                "ticketlink" => url('showticket')."/".$code,
                // "admin" => Auth::user()->name,
                // "link" => url('showticket')."/".$code,
            );
            $sms_list=array();
            array_push($sms_list,array('title'=>'customer',
            'to_number'=>$user->phone,
            'message_id'=>$message->id,
            'status'=>0,
            'data'=>json_encode($input_data)));

            //end send for user
// =====================================
            //start send for admin

            $useraccess=$subject->getuseraccess;
            $userForSend=User::where(function($query) use($useraccess){
                foreach($useraccess as $access){
                    $query->orwhere('access','like',$access->user_access);
                }
            })->where('phone','<>','')->where('sms','=','1')->get();

            foreach($userForSend as $userfs){
                $input_data = array(
                    "type" => $subject->getorder->name,
                    "name" => $user->name,
                    "phone" =>  $user->phone,
                );
                array_push($sms_list,array( 'title'=>'admin',
                'to_number'=>$userfs->phone,
                'message_id'=>$message->id,
                'status'=>0,
                'data'=>json_encode($input_data)));
            }

            QueueSMS::insert($sms_list);


            //end send for admin

            // with('new code', $code)->
            return redirect()->route('tickets')->with("success-dialog",$successmessage);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMessageRequest  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    public function answer($subject,Request $request){

        $title="success-dialog";$message="پاسخ شما با موفقیت ثبت شد";
        $tickets=Subject::where('code','like',$subject)->where('status','>',-1);
        if($tickets->count()>0){
            $tickets=$tickets->first();
            if(
                (array_search($tickets->order,HomeController::$middware)&&array_search('answerforalluser',HomeController::$middware)&&array_search('answer',HomeController::$middware))
                ||
                (Auth::user()->id==$tickets->user_id&&array_search('answer',HomeController::$middware))
              ){
                if(trim($request->text)!=""){

                    // $string = preg_replace("/[\n\r]/","<br />", $request->text);
                    // $string = str_replace('<br /><br />','<br />', $string);
                    $message=new Message([
                        'text'=>nl2br ($request->text),
                        'file'=>$request->filepath,
                        'audio'=>$request->audiopath,
                        'user_id'=>Auth::user()->id,
                        'sub_id'=>$tickets->id
                    ]);
                    $message->save();
                    $messageID=$message->id;
                    $sms_list=array();

                    $title="success-dialog";$message="پاسخ با موفقیت درج گشت";
                    if(Auth::user()->id == $tickets->user_id){
                        $tickets->status='0';
                        $tickets->save();
                        $useraccess=$tickets->getuseraccess;
                        $userForSend=User::where('id','<>',Auth::user()->id)->where(function($query) use($useraccess){
                            foreach($useraccess as $access){
                                $query->orwhere('access','like',$access->user_access);
                            }
                        })->where('phone','<>','')->where('sms','=','1')->get();


                        foreach($userForSend as $user){
                            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
                        $input_data = array(
                            "name" => $tickets->getuser->name,
                            "type" => $tickets->code,
                            "phone" =>  $tickets->getuser->phone,
                        );
                        array_push($sms_list,array( 'title'=>'answeradmin',
                        'to_number'=>$user->phone,
                        'message_id'=>$messageID,
                        'status'=>0,
                        'data'=>json_encode($input_data)));
                        }

                    }else{
                        $tickets->status='2';
                        $tickets->save();

                        $input_data = array(
                        "name" => $tickets->getuser->name,
                        "type" => $tickets->code,
                        "admin" => Auth::user()->name,
                        "link" => url('showticket')."/".$tickets->code,
                    );
                        array_push($sms_list,array( 'title'=>'answeruser',
                        'to_number'=>($tickets->getuser->phone),
                        'message_id'=>$messageID,
                        'status'=>0,
                        'data'=>json_encode($input_data)));


                }

                    QueueSMS::insert($sms_list);

                }else{
                    $title="error-dialog";$message="پاسخی بنویسید";
                }
            }else{
                $title="error-dialog";$message="شما مجاز به پاسخگویی نمیباشید";
            }
        }else{
            $title="error-dialog";$message="درخواست پیدا نشد";
        }
        return redirect()->back()->with($title,$message)->withInput();
    }

    public function uploadfile(Request $request)
    {
        if(isset($request['myfile'])){
            $validator = Validator::make($request->all(), [
                'myfile' => 'required|max:10800|mimes:pdf,png,jpg,jpeg,ogg,aar,aac,webm,mp3,mp4,m4v,wav,mov'
            ]);
            if ($validator->passes()) {
                $file = $request->file('myfile');
                $extension = $file->getClientOriginalExtension();//Getting extension
                // $originalname = $image->getClientOriginalName();//Getting original name
                $filename=time().'';
                $path = $file->move('files/'.$request->folder.'/' ,$filename.".".$extension);
                return response()->json(['success'=>'upload success.','filename'=>$filename,'type'=>$extension,
                'path'=>'files/'.$request->folder.'/' .$filename.".".$extension,
                'deletelink'=>route('deletefile',$filename)]);
            }
            }
            return response()->json(['error'=>'سایز فایل نباید بیشتر از 10 مگا بایت باشد  <br> فقط فرمت های pdf,png,jpg قابل آپلود هستند .']);
        // $validator = Validator::make($request->all(), [
        //     'stateCode' => 'required|unique:states,code',
        // ],Lang::get('public.message' ));

        // if ($validator->passes()) {

        //     return response()->json(['success'=>'Added new records.']);
        // }

        // return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function deletefile($name,Request $request)
    {
        $path=public_path('files/'.$request->folder.'/'.$name.'.'.$request->type);
        $time=(time())-$name;
        if(file_exists($path)&&$time<300){
            File::delete($path);
            return response()->json(['success'=>'موفقیت آمیز بود']);
        }
        return response()->json(['error'=>'شما قادر به حذف این فایل نیستید']);
    }
}
