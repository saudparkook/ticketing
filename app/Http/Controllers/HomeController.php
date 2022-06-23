<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use SoapClient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editprofile(){

    }

    public function show(){



        $client = new SoapClient("http://ippanel.com/class/sms/wsdlservice/server.php?wsdl");
        $user = "";
        $pass = "";
        $fromNum = "";
        $toNum = array('','');
        $pattern_code = "";
        $input_data = array(
       [ "name" => 'dd',
        "type" => 'dd',
        "admin" => 'ds',
        "link" => 'dds',],[ "name" => 'dd',
        "type" => 'dd',
        "admin" => 'ds',
        "link" => 'dds',]
    );
        echo $client->sendPatternSms($fromNum,$toNum,$user,$pass,$pattern_code,$input_data);


        return 'salam';




        return Http::get('http://ippanel.com:8080/',
        ['apikey'=>'MQEbl2_oYA6jbE_t_Useil3hPwBJVquPBGkAQRxU9wk=',
        'pid'=>'4nsrm3kfw9','fnum'=>'+983000505','tnum'=>['09393368665','09355502840'],
        'p1'=>'verification-code','p2'=>'name','v1'=>'ddvv','v2'=>'segv']
    );

    }

    public static $middware=null;
    public static $setting=null;
    public static function middware($midware,$stting)
    {
        $rollconfig=array();
        $getsetting=array();
        foreach($midware as $r){
            array_push($rollconfig,$r->pagename);
        }
        foreach($stting as $s){
            $getsetting[$s->title]=$s->value;
                }



        self::$setting = $getsetting;
        self::$middware = $rollconfig;

        View::share('setting', $getsetting);
        View::share('rollconfig', $rollconfig);
    }
}
