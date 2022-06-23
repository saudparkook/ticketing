<?php

use App\CustomCl\RollConfig;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\QueueSMSController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectsOrderController;
use App\Http\Controllers\UserAccessController;
use App\Http\Controllers\UserController;
use App\Models\Middelware;
use App\Models\QueueSMS;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth Route
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);
  Route::get('/cronjob', function () {
    // $s= Storage::disk('local')->get('example.txt', '0');
    // Storage::disk('local')->put('example.txt', $s+1);
$queuesms=new QueueSMSController();
        $queuesms->index();

      return "";
})->name('cronjob');

  Route::get('/', function () {
    //   $pagename=app('router')->getRoutes()->match(app('request')->create(url()->current()))->getName();
    //   return Route::currentRouteName();

      return redirect(route('dashbord'));
})->name('home');

  Route::middleware(['myroute'])->group(function () {

Route::get('/dashbord', function () {
    // return HomeController::$setting;
    return view('home');
})->name('dashbord');

// user rout
Route::get('users', [UserController::class,'index'])->name('users');
Route::get('adduser', [UserController::class,'create'])->name('adduser');
Route::post('adduser', [UserController::class,'store'])->name('adduser');
Route::get('/editprofile/{user}', [UserController::class,'edit'])->name('editprofile');
Route::put('/editprofile/{user}', [UserController::class,'update'])->name('editprofile');
Route::get('/activeuser/{user}', [UserController::class,'activeuser'])->name('activeuser');


// User Access
Route::any('useraccess', [UserAccessController::class,'index'])->name('useraccess');
Route::get('adduseraccess',[UserAccessController::class,'create'])->name('adduseraccess');
Route::post('adduseraccess',[UserAccessController::class,'store'])->name('adduseraccess');
Route::get('edituseraccess/{userAccess}',[UserAccessController::class,'edit'])->name('edituseraccess');
Route::post('edituseraccess/{userAccess}',[UserAccessController::class,'update'])->name('edituseraccess');

// Subject order
Route::any('subjectorders', [SubjectsOrderController::class,'index'])->name('subjectorders');
Route::get('addsubjectorder',[SubjectsOrderController::class,'create'])->name('addsubjectorder');
Route::post('addsubjectorder',[SubjectsOrderController::class,'store'])->name('addsubjectorder');
Route::delete('deletesuborder/{subjectsOrder}',[SubjectsOrderController::class,'destroy'])->name('deletesuborder');
Route::get('deletesuborder/{subjectsOrder}',[SubjectsOrderController::class,'create'])->name('deletesuborder');

// Messages
Route::get('tickets',[SubjectController::class,'index'])->name('tickets');
Route::get('showticket/{subject}',[SubjectController::class,'show'])->name('showticket');

Route::post('answer/{subject}',[MessageController::class,'answer'])->name('answer');
Route::get('answer/{subject}',function(){
    return ;})->name('answer');

Route::get('addticket',[MessageController::class,'create'])->name('addticket');
Route::post('addticket',[MessageController::class,'store'])->name('addticket');
Route::post('uploadfile',[MessageController::class,'uploadfile'])->name('uploadfile');
Route::get('uploadfile',function(){
    return ;})->name('uploadfile');
Route::post('deletefile/{name}',[MessageController::class,'deletefile'])->name('deletefile');
Route::get('deletefile/{name}',function(){return;})->name('deletefile');

//cancel message
Route::get('cancelMessage/{subject}',[SubjectController::class,'destroy'])->name('cancelMessage');

//QueueSMS
Route::get('QueueSMS', [QueueSMSController::class,'index'])->name('QueueSMS');

});
