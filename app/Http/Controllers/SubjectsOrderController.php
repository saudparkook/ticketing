<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\SubjectsOrder;
use Illuminate\Http\Request;

class SubjectsOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $get=SubjectsOrder::get();
        return view('subjects',compact('get'));
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
     * @param  \App\Http\Requests\StoreSubjectsOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages=[
            "name.unique"=>"نام موضوع تکراری است",
            "name.required"=>"  نام موضوع نباید خالی باشد.",
        ];
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:subjects_orders',
        ],$messages);
        $subOrder=new SubjectsOrder(['name'=>$request->name]);
        $subOrder->save();
        return redirect()->back()->with("success-dialog"," موضوع جدید ایجاد گشت ");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubjectsOrder  $subjectsOrder
     * @return \Illuminate\Http\Response
     */
    public function show(SubjectsOrder $subjectsOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubjectsOrder  $subjectsOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectsOrder $subjectsOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectsOrderRequest  $request
     * @param  \App\Models\SubjectsOrder  $subjectsOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubjectsOrder $subjectsOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubjectsOrder  $subjectsOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubjectsOrder $subjectsOrder)
    {
        //
        $sub=Subject::where('order','=',$subjectsOrder->id)->count();
        if($sub>0){
            return redirect()->back()->with("error-dialog","این دسته از موضوعات در  تیکتی استفاده شده و قابل حذف نمی باشد");
        }
        $subjectsOrder->delete();
        return redirect()->back()->with("success-dialog"," موضوع با موفقیت حذف گردید ");
    }
}
