<?php

use Illuminate\Support\Facades\Route;



Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/', 'Forntendcontroller@index')->name('forntend');
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){

Route::match(['get','post'],'/', 'Admincontroller@login')->name('admin.login');
Route::group(['middleware' => ['auth']],function(){
        Route::get('/dashboard', 'Admincontroller@index')->name('admin.dashboard');
        Route::get('/logout', 'Admincontroller@logout')->name('admin.logout');

        //profile
        Route::match(['get','post'],'/profile/update','AdminController@profile')->name('admin.profile');
  

    });
});



