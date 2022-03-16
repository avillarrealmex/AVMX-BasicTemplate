<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Management\CustomerController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Management\ProviderController;
use App\Http\Controllers\Management\UserController;
use App\Http\Controllers\QrCode\QrCodeController;

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

#loginLinks
Route::get('/user-register',[LoginController::class,'viewRegisterForm'])->name('user.register');
Route::get('/login',[LoginController::class,'viewLoginForm'])->name('user.login');
Route::post('/post-registration',[LoginController::class,'postRegistration'])->name('post.register');
Route::post('/check-login',[LoginController::class,'checklogin'])->name('post.login');
Route::post('/management/user/listAll',[UserController::class,'listAll']);
#Links QrCode
Route::group(['prefix'=>'qrCode'], function() {
    Route::get('/index',[QrCodeController::class,'viewGenerateQrCode'])->name('qrCode.generate');
    Route::get('/scan',[QrCodeController::class,'viewScanQrCode'])->name('qrCode.scan');
});

//secureLinks
Route::group(['middleware' => 'auth'], function () {
    #secureLoginLinks
    Route::get('/',[LoginController::class,'viewDashboard'])->name('user.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    #Links de gestión
    Route::group(['prefix'=>'management/user'], function() {
        Route::get('/index',[UserController::class,'viewUserTable'])->name('user.table');
        Route::get('/create',[UserController::class,'viewUserFormCreate'])->name('user.formCreate');
        Route::post('/create',[UserController::class,'create'])->name('user.create');
    });

    Route::group(['prefix'=>'management/provider'], function() {
        Route::get('/index',[ProviderController::class,'viewProviderTable'])->name('provider.table');
    });

    Route::group(['prefix'=>'management/customer'], function() {
        Route::get('/index',[CustomerController::class,'viewCustomerTable'])->name('customer.table');
    });

    Route::group(['prefix'=>'management/product'], function() {
        Route::get('/index',[ProductController::class,'viewProductTable'])->name('product.table');
    });
});
