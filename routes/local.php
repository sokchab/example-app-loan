<?php
use Illuminate\Support\Facades\Route;

//
Route::resource('/local/provinces', 'App\Http\Controllers\Local\CoProvince');
Route::get('/local/fetch/provinces', 'App\Http\Controllers\Local\CoProvince@fetch')->name('provinces.fetch');
//
Route::resource('/local/districts', 'App\Http\Controllers\Local\CoDistrict');
Route::get('/local/fetch/districts/{id}', 'App\Http\Controllers\Local\CoDistrict@fetch')->name('districts.fetch');
//
Route::resource('/local/communes', 'App\Http\Controllers\Local\LnCommune');
Route::get('/local/fetch/communes/{id}', 'App\Http\Controllers\Local\LnCommune@fetch')->name('communes.fetch');
Route::get('/local/fetch/distr/__by__/{id}', 'App\Http\Controllers\Local\LnCommune@fetchDistrict')->name('communes.fetch.district');


Route::resource('/local/villages', 'App\Http\Controllers\Local\Villages');
Route::get('/local/fetch/villages/{id}', 'App\Http\Controllers\Local\Villages@fetch')->name('villages.fetch');
Route::get('/local/fetch/comm/__by__/{id}', 'App\Http\Controllers\Local\Villages@fetchCommune')->name('villages.fetch.commune');
