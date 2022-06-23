<?php

namespace App\Http\Controllers;

use App\Models\QueueSMS;
use App\Http\Requests\StoreQueueSMSRequest;
use App\Http\Requests\UpdateQueueSMSRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SoapClient;

class QueueSMSController extends Controller
{

    private $patterncode=[
        'customer'=>'4nsrm3kfw9',
        'admin'=>'ekv9155sdy',
        'answeruser'=>'ptzq55bg21',
        'answeradmin'=>'w3zslueqyx',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $s= Storage::disk('local')->get('example.txt', '0');
        // Storage::disk('local')->put('example.txt', $s+1);
        // DB::listen(function ($event) {
        //     dump($event->sql);
        //     dump($event->bindings);
        //     });
            $today= strtotime(date("Y-m-d H:i:s",time()));
            $yesterday= date("Y-m-d H:i:s",strtotime('-3 day', $today));
            echo $yesterday."<br>";
            $sub=Subject::where('status','>',-1)->where('updated_at','<',$yesterday)->update(['status'=>'-1']);


        if(count($list_sms= QueueSMS::where('status','<',1)->limit(10)->get())>0){
            foreach($list_sms as $sms){
                $this->sendSms($sms,json_decode($sms->data),$this->patterncode[$sms->title]);
                // echo $this->patterncode[$sms->title];
                echo"<br>..................................................<br>";

            }
        }
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
     * @param  \App\Http\Requests\StoreQueueSMSRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQueueSMSRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QueueSMS  $queueSMS
     * @return \Illuminate\Http\Response
     */
    public function show(QueueSMS $queueSMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QueueSMS  $queueSMS
     * @return \Illuminate\Http\Response
     */
    public function edit(QueueSMS $queueSMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQueueSMSRequest  $request
     * @param  \App\Models\QueueSMS  $queueSMS
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQueueSMSRequest $request, QueueSMS $queueSMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QueueSMS  $queueSMS
     * @return \Illuminate\Http\Response
     */
    public function destroy(QueueSMS $queueSMS)
    {
        //
    }

    private function sendSms($sms,$input_data,$pattern){
            $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
            $userpanel = "";
            $pass = "";
            $fromNum = "";
            $toNum = array($sms->to_number);
            $get= $client->sendPatternSms($fromNum,$toNum,$userpanel,$pass,$pattern,$input_data);
            echo $get;
            if(is_numeric($get)&&$get>0){
                $sms->status=1;
                $sms->save();
            }
    }

}
