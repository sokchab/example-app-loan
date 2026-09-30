<?php
use Illuminate\Support\Facades\Route;

Route::prefix('v2')->namespace('App\Http\Controllers\V2\Additional')->group(function(){
    Route::get('others/index', 'TmpCLoanCus@index')->name('v2.another.index');
    Route::get('others/json', 'TmpCLoanCus@fetch')->name('v2.another.fetch');
    Route::post('others/create', 'TmpCLoanCus@create')->name('v2.another.create');
    Route::get('others/create', 'TmpCLoanCus@createForm')->name('v2.another.createForm');
    Route::get('others/{id}/edit', 'TmpCLoanCus@editForm')->name('v2.another.editForm');
});

Route::prefix('others/loans')->namespace('App\Http\Controllers\V2\Others')->group(function(){
    Route::get('/index', 'Loans@index')->name('v2.others.loan.index');
    Route::get('/index/lists', 'Loans@fetch')->name('v2.others.loan.fetch');
    Route::get('/create', 'Loans@create')->name('v2.others.loan.createForm');
    Route::post('/create', 'Loans@save')->name('v2.others.loan.create');
    Route::get('/{id}/edit', 'Loans@edit')->name('v2.others.loan.edit');
    Route::get('/{id}/show', 'Loans@show')->name('v2.others.loan.show');
    //
    Route::get('/{id}/payments', 'Loans@paymentForm')->name('v2.others.loan.paymentForm');
    Route::post('/{id}/payments', 'Loans@payment')->name('v2.others.loan.payment');
    //
    Route::get('/clients', 'Loans@clients')->name('v2.others.loan.clients');
    //
    Route::get('{div}/create', 'Loans@createByClient')->name('v2.others.loan.createByClient');
});
