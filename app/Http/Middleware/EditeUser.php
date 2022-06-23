<?php

namespace App\Http\Middleware;

use App\Models\Middelware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditeUser
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
        $auth=Auth::user();
        $get=Middelware::where('user_id','like',$auth->id)->where('pagename','=','changeoderuser')->first();
            if($get){
                return $next($request);
            }
        return redirect()->back();
    }
}
