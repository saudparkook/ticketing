<?php

namespace App\Http\Controllers;

use App\CustomCl\RollConfig;
use App\Models\UserAccess;
use App\Models\Middelware;
use App\Models\Setting;
use App\Models\SubjectsOrder;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  //
        $get=UserAccess::get();
        return view('useraccess',compact('get'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suborder=SubjectsOrder::get();
        return view('add_user_access',compact('suborder'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserAccessRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $suborder=SubjectsOrder::select('id')->get();
        $order=array();
        foreach($suborder as $sub)
            array_push($order,$sub->id);



        $messages=[
            "title.unique"=>"نام تایتل تکراری است",
            "title.required"=>"فیلد  تایتل نباید خالی باشد.",
            "homepage.required"=>"صفحه اصلی را انتخاب کنید",

        ];

        $validatedData = $request->validate([
            'title' => 'required|max:255|unique:user_accesses',
            'homepage' => 'required',

        ],$messages);

        $data_middelware=[];
        $data_setting=[];
        $UserAccess=new UserAccess([
            'title'=>trim($request['title']),
            'homepage'=>trim($request['homepage']),
            'status'=>trim($request['publicuser']),
        ]);
        if($UserAccess->save()){
            unset($request['title']);
            unset($request['homepage']);
            unset($request['publicuser']);

            foreach($request->all() as $k=>$value){
                $index=array_search($k,$order);
                if(array_key_exists($k,__('message.allpage'))){
                    array_push($data_middelware,[
                        "user_access"=>"$UserAccess->id",
                        'pagename'=>$k,
                        'status'=>$k
                        ]);

                }else if($index!=''&&$index>=0){
                    array_push($data_middelware,[
                        "user_access"=>"$UserAccess->id",
                        'pagename'=>$k,
                        'status'=>$k,
                        ]);
                }else if(array_key_exists($k,RollConfig::colors)){
                    array_push($data_setting,[
                        "accesses_id"=>"$UserAccess->id",
                        'title'=>$k,
                        'value'=>$value
                        ]);

                }else if(strpos($k,"select")==0){
                    array_push($data_setting,[
                        "accesses_id"=>"$UserAccess->id",
                        'title'=>str_replace('select','',$k),
                        'value'=>'1'
                        ]);
                }

            }




            Middelware::insert($data_middelware);
            Setting::insert($data_setting);

        }



        return redirect(route('useraccess'))->with("success-dialog","سطح دسترسی جدید ایجاد گشت ");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function show(UserAccess $userAccess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function edit($userAccess)
    {
        $suborder=SubjectsOrder::get();
        $userAccess=UserAccess::find($userAccess);
        $setting=Setting::where('accesses_id','=',$userAccess->id)->select('title','value')->get();
        $midlware=$userAccess->middelware($userAccess->id);
        $settingAccess=array();
        foreach($midlware as $mid){
            $userAccess[$mid->pagename]=$mid->status;
        }
        foreach($setting as $set){
            $settingAccess[$set->title]=$set->value;
        }

        return view('edit_user_access',compact('userAccess','settingAccess','suborder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAccessRequest  $request
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAccess $userAccess)
    {
        $suborder=SubjectsOrder::select('id')->get();
        $order=array();
        foreach($suborder as $sub)
            array_push($order,$sub->id);

        $messages=[
            "title.unique"=>"نام تایتل تکراری است",
            "title.required"=>"فیلد  تایتل نباید خالی باشد.",
            "homepage.required"=>"صفحه اصلی را انتخاب کنید",

        ];
        $validate=[];

        if(trim($request->title)!=trim($userAccess->title)){
            $validate=array_merge( $validate,['title' => 'required|max:255|unique:user_accesses']);
        }
        $validate=array_merge( $validate,['homepage' => 'required']);
        $validatedData = $request->validate($validate,$messages);

            $userAccess->title=trim($request['title']);
            $userAccess->homepage=trim($request['homepage']);
            $userAccess->status=trim($request['publicuser']);

        if($userAccess->save()){
            unset($request['title']);
            unset($request['homepage']);
            unset($request['publicuser']);


            $data_middelware=[];
        $data_setting=[];
            foreach($request->all() as $k=>$value){
                $index=array_search($k,$order);
                //add middelware for user access
                if(array_key_exists($k,__('message.allpage'))){
                    array_push($data_middelware,[
                        "user_access"=>"$userAccess->id",
                        'pagename'=>$k,
                        'status'=>$k
                        ]);

                }else if($index!=''&&$index>=0){
                    array_push($data_middelware,[
                        "user_access"=>"$userAccess->id",
                        'pagename'=>$k,
                        'status'=>$k,
                        ]);
                }
                //add setting for user access
                else if(array_key_exists($k,RollConfig::colors)){
                    array_push($data_setting,[
                        "accesses_id"=>"$userAccess->id",
                        'title'=>$k,
                        'value'=>$value
                        ]);

                }else if(strpos($k,"select")==0){
                    array_push($data_setting,[
                        "accesses_id"=>"$userAccess->id",
                        'title'=>str_replace('select','',$k),
                        'value'=>'1'
                        ]);
                }

            }


            Middelware::where('user_access','=',$userAccess->id)->delete();
            Setting::where('accesses_id','=',$userAccess->id)->delete();
            Middelware::insert($data_middelware);
            Setting::insert($data_setting);
        }


         return redirect()->back()->with("success-dialog","سطح دسترسی جدید ویرایش گشت ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccess $userAccess)
    {
        //
    }
}
