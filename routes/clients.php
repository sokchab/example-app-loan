<?php
use Illuminate\Support\Facades\Route;

Route::resource('/clients', 'App\Http\Controllers\__Clients__');
Route::get('/clients/fesieftch/rows', 'App\Http\Controllers\__Clients__@fetchAll')->name('clients.fetch');
Route::get('/fetch72o3e/fillage/{id}', 'App\Http\Controllers\__Clients__@fetchVillage')->name('clients.fetch.village');
Route::get("/clients/fetch/ro/detail", "App\Http\Controllers\__Clients__@fetchRows")->name('clients.fetch.rows');
Route::post('/clients/ajax/create/data', 'App\Http\Controllers\__Clients__@ajaxSave')->name('clients.ajax.save');
