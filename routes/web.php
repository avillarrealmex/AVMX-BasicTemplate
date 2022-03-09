<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Management\CustomerController;
use App\Http\Controllers\Management\ProductController;
use App\Http\Controllers\Management\ProviderController;
use App\Http\Controllers\Management\UserController;

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

//secureLinks
Route::group(['middleware' => 'auth'], function () {
    #secureLoginLinks
    Route::get('/',[LoginController::class,'viewDashboard'])->name('user.dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    #Links de gestión
    Route::group(['prefix'=>'management'], function() {
        Route::get('/user',[UserController::class,'viewUserTable'])->name('user.table');
        Route::get('/provider',[ProviderController::class,'viewProviderTable'])->name('provider.table');
        Route::get('/customer',[CustomerController::class,'viewCustomerTable'])->name('customer.table');
        Route::get('/customer/create',[CustomerController::class,'viewCreateUser'])->name('customer.create');
        Route::get('/product',[ProductController::class,'viewProductTable'])->name('product.table');

    });
});
