<?php

namespace App\Http\Controllers;

use App\CustomCl\RollConfig;
use App\Models\Subject;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $search=trim($request->search);
        $typestatus=trim($request->typestatus);
        if(empty($typestatus))
            $typestatus="0";


        $typestatus=RollConfig::typestatus[$typestatus];
        if(Auth::guest()){
            return view('tickets');
        }

        $tickets=new Subject();
        if(!array_search('allmessages',HomeController::$middware)){
            $tickets=$tickets->where('user_id','like',Auth::user()->id);
        }else{
            $middware=HomeController::$middware;
            $tickets=$tickets->orWhere(function($query) use($middware) {
                foreach($middware as $m){
                    $query->orWhere('order','like',$m);
                }
                $query->orWhere('user_id','like',Auth::user()->id);
            });

        }

        $users=User::Where('name','like','%'.$search.'%')->select('id');
        if($users->count()>0){
            $users=$users->get();
            $tickets=$tickets->where(function($query) use($users){
                foreach($users as $id){
                    $query->orWhere('user_id','=',$id->id);
                }
            })->
            where('status','like',$typestatus)->orderby('id','desc')->paginate(20);
        }else{
            $tickets=array();
        }


        return view('tickets',compact('tickets','search','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show($subject)
    {
        //

        $tickets=Subject::where('code','like',$subject);
        if($tickets->count()>0){
            $tickets=$tickets->first();


            if(array_search($tickets->order,HomeController::$middware)&&Auth::user()->id!=$tickets->user_id){
                    if($tickets->status==0){
                        $tickets->status=1;
                        $tickets->save();
                    }
            }
            return view('showticket',compact('tickets'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectRequest  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
        $subject->status=-1;
        $subject->save();
        return redirect()->back();

    }
}
