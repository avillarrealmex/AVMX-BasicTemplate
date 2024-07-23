<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\UsersController;
use App\Http\Controllers\HumanCapital\DressCodeController;
use App\Http\Controllers\HumanCapital\NonWageBenefitsController;
use App\Http\Controllers\HumanCapital\CodeOfCoexistenceController;
use App\Http\Controllers\HumanCapital\OrganigramController;
use App\Http\Controllers\HumanCapital\SmoRoomScheduleController;
use App\Http\Controllers\Login\LoginController;

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
    
    Route::group(['prefix'=>'humanCapital'], function() {
        Route::group(['prefix'=>'dressCode'], function() {
            Route::match(['get','post'], '/index',[DressCodeController::class,'viewIndex'])->name('humanCapital.dressCode.index');
        });
        Route::group(['prefix'=>'codeOfCoexistence'], function() {
            Route::match(['get','post'], '/index',[CodeOfCoexistenceController::class,'viewIndex'])->name('humanCapital.codeOfCoexistence.index');
        });
        Route::group(['prefix'=>'nonWageBenefits'], function() {
            Route::match(['get','post'], '/index',[NonWageBenefitsController::class,'viewIndex'])->name('humanCapital.nonWageBenefits.index');
        });
        Route::group(['prefix'=>'organigram'], function() {
            Route::match(['get','post'], '/index',[OrganigramController::class,'viewIndex'])->name('humanCapital.organigram.index');
        });
        Route::group(['prefix'=>'smoRoomSchedule'], function() {
            Route::match(['get','post'], '/index',[SmoRoomScheduleController::class,'viewIndex'])->name('humanCapital.smoRoomSchedule.index');
        });
    });
});
