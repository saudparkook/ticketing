<?php

namespace App\Http\Middleware;

use App\CustomCl\RollConfig;
use App\Http\Controllers\HomeController;
use App\Models\Middelware;
use App\Models\Setting;
use App\Models\UserAccess;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MyMiddelware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $roll=array();
        $stting=array();

$pagename=Route::currentRouteName();

        if(Auth::guest()){
            $get =false;
            $userAccess=UserAccess::where('status','like','on')->select('id','homepage')->first();

        }else{

            $userAccess=Auth::user()->userAccess;

        }
        $roll=Middelware::where('user_access','like',$userAccess->id)->select('pagename')->get();
        $stting=Setting::where('accesses_id','like',$userAccess->id)->select('title','value')->get();
        // $get=Middelware::where('user_access','like',$userAccess->id)->where('pagename','=',$pagename)->first();

        HomeController::middware($roll,$stting);
                if(array_search($pagename,HomeController::$middware) || isset(__('message.publicpage')[$pagename])){
                    return $next($request);
                }
            return redirect()->back()->with("error-dialog",'شما مجوز دسترسی به این صفحه را ندارید');
    }
}
