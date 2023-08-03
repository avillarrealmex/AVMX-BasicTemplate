<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\LicensesRequestController;
use App\Http\Controllers\Management\SAPLicensesController;
use App\Http\Controllers\Management\UsersController;
use App\Http\Controllers\Management\TypeOfLicensesController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Reports\ReportsController;

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
/* LOGINLINKS */

Route::group(['prefix'=>'/'], function() {
    Route::get('login',[LoginController::class,'viewLoginForm'])->name('user.login');
    Route::post('login',[LoginController::class,'checklogin'])->name('post.login');
    Route::match(['get','post'], 'autologin/{keyToken}',[LoginController::class,'autologin'])->name('user.autologin');
    Route::get('/clear',[LoginController::class,'clearCache']);
});


//secureLinks
Route::group(['middleware' => 'authMysql'], function () {
    #secureLoginLinks
    Route::get('/',[LoginController::class,'viewDashboard'])->name('login.dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    #Links de gestión
    Route::group(['prefix'=>'users'], function() {
        Route::match(['get','post'], '/index',[UsersController::class,'viewIndex'])->name('users.index');
        Route::match(['get','post'], '/management',[UsersController::class,'viewManagement'])->name('users.management');
        Route::match(['post'], '/updateStatus',[UsersController::class,'updateStatus'])->name('users.updateStatus');
    });
});
