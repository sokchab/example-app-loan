<?php
use Illuminate\Support\Facades\Route;


Route::prefix('financial')->namespace('App\Http\Controllers\Bank')->group(function (){
    Route::get('/', 'CashInBank@index')->name('bank.index');
    Route::get('/install', 'CashInBank@install')->name('bank.install');
    Route::post('/install/store', 'CashInBank@submit')->name('bank.install.submit');

    Route::get('/reports/cash', 'CashInBank@flows')->name('bank.report.flows');
    Route::get('/reports/cash/by', 'CashInBank@flows_by')->name('bank.report.flows_by');
    Route::get('/reports/cash/by/day', 'CashInBank@flows_by_day')->name('bank.report.flows_by_day');
    Route::get('/reports/cash/by/month', 'CashInBank@flows_by_month')->name('bank.report.flows_by_month');


    //Export
    Route::get('/reports/cash/export', 'Exports@cashFlowToday')->name('bank.exports.today');
    Route::get('/reports/cash/{val}/export', 'Exports@cashFlowByDay')->name('bank.exports.by.day');
    Route::get('/reports/cash/{val}/{to}/export', 'Exports@cashFlowByMonth')->name('bank.exports.by.month');
});
