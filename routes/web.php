<?php
use Illuminate\Support\Facades\Route;

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

//// Admin Panel (Blade)
//http://127.0.0.1:8000/admin-auth/form-login


//// Client Panel (Vue)
Route::prefix("/")->group(function (){

    Route::get("/{params?}" , function (){
       return view("vue.customer.index");
    })->name("customer.home")->where(['params' => '.*']);

});






