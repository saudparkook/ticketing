<?php

namespace App\Http\Controllers;

use App\Models\Middelware;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $useraccess=UserAccess::get();
        $search=trim($request->search);
        $ua=trim($request->useraccess);
            if($ua<1)
                $ua="%%";


        $users=User::where(function($query) use($search){
            $query=$query->orWhere('name','like','%'.$search.'%');
            $query=$query->orWhere('username','like','%'.$search.'%');
        })->where('access','like',$ua)->paginate(10);
        // return $users;
            return view('users',compact('users','request','useraccess'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $userAccess=UserAccess::where('id','<>','1')->where('id','<>','2')->get();
        return view('adduser',compact('userAccess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $messages=[
            "username.unique"=>"نام کاربری تکراری است",
            "username.required"=>"فیلد نام کاربری نباید خالی باشد.",
            "meli_code.unique"=>"کد ملی تکراری است",
            "meli_code.required"=>"فیلد کد ملی نباید خالی باشد.",
            "meli_code.between"=>" کد ملی ده رقمی باشد  .",
            "password.required"=>"فیلد رمز نباید خالی باشد.",
            "name.required"=>"نام نباید خالی باشد.",
            "password.confirmed"=>"تکرار رمز صحیح نیست.",
            "password.min"=>"رمز باید بیشتر از 8 رقم باشد.",
            "phone.required"=>"شماره تلفن را وارد کنید",
            "role.required"=>"نوع کاربر را مشخص نکرده اید",
            "role.in"=>"نوع کاربر را مشخص نکرده اید",
        ];

        $validatedData = $request->validate([
            'username' => 'required|max:255|unique:users',
            'meli_code' => 'required|between:10,10|unique:users',
            'password' => 'required|confirmed|min:8',
            'role' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ],$messages);

        //start role check
        $useraccess=UserAccess::where('id','<>','1')->where('id','<>','2')->find($request->role);
        if(!$useraccess){
             return redirect()->back()->with("error-dialog","خطا در تعیین سطح دسترسی");
        }
        //end role check
        $homepage=$useraccess->homepage;

        if($request->sms!='')
            $sms='1';
        else
            $sms='0';

        $user=new User([
            'username'=>$request->username,
            'name'=>$request->name,
            'meli_code'=>$request->meli_code,
            'password'=>Hash::make($request->password),
            'access'=>$request->role,
            'phone'=>$request->phone,
            'sms'=>$sms,
        ]);

        // $2y$10$o15nkZNq1btpAiSpSNJJhOuvK8hBew5cUiHcmJ14KF6xxGB6SwkcK

        $user->save();

            return redirect(route('users'))->with("success-dialog","کاربر ".$request->username." با موفقیت ثبت شد.");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        //
        $userAccess=Auth::user()->userAccess;
        if(array_search('changeoderuser',HomeController::$middware) || $user==Auth::user()->id){
            $userAccess=UserAccess::get();
        if($user= User::find($user)){
            return view('edituser',compact('user','userAccess'));
        }
        }
        return redirect()->back();


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user){

        // $userAccess=Auth::user()->userAccess;
        // $rollconfig=Middelware::where('user_access','like',$userAccess->id)->where('pagename','=','changeoderuser')->select('pagename')->get();

        if(array_search('changeoderuser',HomeController::$middware) || $user==Auth::user()->id){
        $user= User::find($user);

        $page=redirect()->back();

        if($request->sms!='')
            $user->sms='1';
        else
            $user->sms='0';


        $messages = [
            "meli_code.unique"=>"کد ملیس تکراری است",
            "meli_code.required"=>"فیلد کد ملی نباید خالی باشد.",
            "meli_code.between"=>" کد ملی ده رقمی باشد  .",
            "name.required" => "نام و نام خانوادگی نباید خالی باشد.",
            "phone.required" => "شماره تلفن نباید خالی باشد.",
            "password.confirmed" => "تکرار رمز صحیح نیست.",
            "password.min" => "رمز باید بیشتر از 8 رقم باشد.",
            "profile.max"=>"حجم عکس نباید بیشتر از  2 مگابایت باشد",
            "profile.mimes"=>"این پسوند مجاز به آپلود نمی باشد",
        ];
        $validate=[
            'name' => 'required',
            'phone' => 'required',
            'meli_code' => 'required|between:10,10',
        ];


        if($request->meli_code!=$user->meli_code&&User::where('meli_code','like',$request->meli_code)->count()>0){
            return redirect()->back()->with("error-dialog","کد ملی تکراریست.");
        }


        if (trim($request->password) != "") {
            $validate = array_merge( $validate, array(
                'password' => 'confirmed|min:8'));
                $user->password = Hash::make($request->password);
            }

            if(isset($request->role)){

                $validate = array_merge( $validate, array(
                    'role' => 'required'));
                    $useraccess=UserAccess::find($request->role);
                    if(!$useraccess){
                        return redirect()->back()->with("error-dialog","خطا در تعیین سطح دسترسی");;
                    }
            }

        $validatedData = $request->validate($validate, $messages);
        //start role check

        //end role check



        if(isset($request->role)&& array_search('changeoderuser',HomeController::$middware)){
            if($user->access!=$request->role){
                    $user->access=$request->role;
            }
        }


        $user->name = trim($request->name);
        $user->phone = trim($request->phone);
        $user->meli_code = trim($request->meli_code);
        $user->save();

        return $page->with('success-dialog','ویرایش موفقیت آمیز بود');
    }
    return redirect()->back();

    }

    public function activeuser($user){

        $user=User::find($user);
           if($user->active==0){
               $user->active=1;
           }else{
               $user->active=0;
           }

           $user->save();
           return redirect()->back()->with("success-dialog","وضعیت کاربر با موفقیت تغییر کرد");

       }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
