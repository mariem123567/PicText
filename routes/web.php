<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;



Route::middleware(['auth.admin'])->group(function () {
    Route::view('/adminDashboard','admins.adminDashboard')->name('adminDashboard');
});


Route::middleware('auth.general')->group(function() {

    Route::redirect('/','posts');

    Route::resource('posts',PostController::class);

    Route::get('/{user}/posts',[DashboardController::class,'userPosts'])->name('posts.user');

    Route::get('/search', [UserController::class, 'search'])->name('user.search');

    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

});


Route::middleware('auth.user')->group(function() {

   
     Route::get('/dashboard',[DashboardController::class,'show'])->middleware('verified')->name('dashboard');

    //  The Email Verification Notice
    Route::get('/email/verify',[AuthController::class,'verifyNotice'])->name('verification.notice');

    // email verification handler rout

    Route::get('/email/verify/{id}/{hash}',[AuthController::class,'verifyEmail'])->middleware('signed')->name('verification.verify');

    // Resending the Verification Email
    Route::post('/email/verification-notification', [AuthController::class,'verifyHandler'])->middleware('throttle:6,1')->name('verification.send'); //throttle to avoid submitting the form so many times

});



//or Route::group(['middleware'=>'guest.general'],function() 
Route::middleware('guest.general')->group(function(){

    Route::view('/register','auth.register')->name('register');
    Route::post('/register',[AuthController::class,'register']);
    
    Route::view('/login','auth.login')->name('login');
    Route::post('/login',[AuthController::class,'login']);


    Route::view('/forgot-password','auth.forgot-password')->name('password.request');
    Route::post('/forgot-password',[ResetPasswordController::class,'passwordEmail']);


    Route::get('/reset-password/{token}',[ResetPasswordController::class,'passwordReset'] )->name('password.reset');
    Route::post('/reset-password',[ResetPasswordController::class,'passwordUpdate'] )->name('password.update');

    

});





