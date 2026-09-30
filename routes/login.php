<?php

use Illuminate\Support\Facades\Route;


Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::prefix("backup")->middleware('can:auth.admin')->group(function(){
    Route::get("/index.bug", "App\Http\Controllers\Bup\BackUpController@index")->name("backup.index");
    //
    Route::post("/create.bug", "App\Http\Controllers\Bup\BackUpController@create")->name("backup.create");
    //
    Route::get("/{val}/download.bug", "App\Http\Controllers\Bup\BackUpController@download")->name("backup.download");

    Route::get("/{val}/delete.bug", "App\Http\Controllers\Bup\BackUpController@delete")->name("backup.delete");
});