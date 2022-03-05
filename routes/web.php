<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestRemembermeController;

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

#Remember me functionality in Laravel
Route::get('/user-register',[TestRemembermeController::class,'registerform'])->name('user.register');
Route::post('/post-registration',[TestRemembermeController::class,'postRegistration'])->name('post.register');

Route::get('/login',[TestRemembermeController::class,'loginform'])->name('user.login');
Route::post('/check-login',[TestRemembermeController::class,'checklogin'])->name('post.login');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/',[TestRemembermeController::class,'dashboard'])->name('user.dashboard');
    Route::get('logout', [TestRemembermeController::class, 'logout'])->name('logout');

    Route::get('/presupuesto/registro',[TestRemembermeController::class,'presupuestoRegistro'])->name('presupuesto.registro');
    Route::get('/presupuesto/autorizacion',[TestRemembermeController::class,'presupuestoAutorizacion'])->name('presupuesto.autorizacion');
});
