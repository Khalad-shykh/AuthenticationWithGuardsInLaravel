<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Frontend\UserController;

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

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
Route::get('login',[UserController::class , 'show'])->middleware('guest');
Route::get('register',[UserController::class , 'show_r'])->middleware('guest');
Route::post('register',[UserController::class , 'register'])->name('register')->middleware('guest');
Route::post('login',[UserController::class , 'login'])->name('login')->middleware('guest');
Route::post('logout',[UserController::class , 'logout'])->name('logout')->middleware('auth');

// Admin Routes

Route::prefix('admin')->name('admin.')->group(function(){
    Route::group(['middleware' => 'admins.guest'], function(){
        Route::get('/login',[AdminController::class,'show'])->name('login');
        Route::post('login',[AdminController::class,'login'])->name('login');
    });

Route::group(['middleware' => 'admins.auth'] , function(){
    Route::get('/',[AdminController::class,'index'])->name('index');
    Route::post('/logout',[AdminController::class , 'logout'])->name('logout');
});

});