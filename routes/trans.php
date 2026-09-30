<?php
use Illuminate\Support\Facades\Route;

Route::resource('/trans/loans', 'App\Http\Controllers\Trans\__Loan__');
Route::get('/trans/loans/fesie7032ftch/rows', 'App\Http\Controllers\Trans\__Loan__@__all')->name('loans.fetch');
Route::get('/trans/loans/filla9054ge/{id}', 'App\Http\Controllers\Trans\__Loan__@__village')->name('loans.fetch.village');
Route::get('/trans/loans/fetctmpcl/rows', 'App\Http\Controllers\Trans\__Loan__@__tmpdata')->name('loans.fetch.tmp');
Route::post('/trans/loans/clin76543/Display/state', 'App\Http\Controllers\Trans\__Loan__@__createTmp_cus')->name('create.client.tmp.loan');
Route::get('/trans/loans/joint76543/dis/data', 'App\Http\Controllers\Trans\__TempRow__@__rows')->name('get.loan.client.join');
Route::get('/trans/loans/joint7653/d/data/gg', 'App\Http\Controllers\Trans\__TempRow__@__rows_gg')->name('get.loan.client.gg');
Route::post('/trans/ajax/save/loan/des', 'App\Http\Controllers\Trans\__TempRow__@__ajaxSave')->name('save.loan.client.join');
Route::post('/trans/ajaj/sa/lo/gu', 'App\Http\Controllers\Trans\__TempRow__@__ajaxSaveGuaran')->name('save.loan.client.guaran');
Route::post('/trans/jaja/save/dsa', 'App\Http\Controllers\Trans\__TempRow__@__createTmp_cus')->name('safe.loan.o.cli');
Route::post('/trans/jaja/save/dsa/res', 'App\Http\Controllers\Trans\__TempRow__@__createTmp_Jon')->name('safe.loan.o.guaran');

Route::get('/trans/java/de/234e/php/vuejs/json/c/{val}', 'App\Http\Controllers\Trans\__TempRow__@__deleteCusLoan')->name('sa5dw.delv.row.ssd');

Route::get('/trans/e/vuejs/json/c/{val}', 'App\Http\Controllers\Trans\__TempRow__@__deleteCollecteralTmp')->name('collec.delv.row.ssd');


//Fixed
Route::get('/trans/loans/create/collecteral', "App\Http\Controllers\Trans\__TempRow__@formSaveOrNewCollec")->name('fix.coll.formCreate');
Route::post('/trans/loans/create/collecteral/store.frm', "App\Http\Controllers\Trans\__TempRow__@saveOrNewCollec")->name('fix.coll.saveOrNewCollec');
Route::get('/trans/loans/create/collecteral/{val}/delete.frm', "App\Http\Controllers\Trans\__TempRow__@deleteCollsFix")->name('fix.coll.deleteCollsFix');
//collecterall
Route::get('/secure/and/writing/to', 'App\Http\Controllers\Trans\__TempRow__@FunctionNameCol')->name('col.tm.Secure.Digital');

Route::post('/icons/styles/services/and/awesome', 'App\Http\Controllers\Trans\__TempRow__@FunctionNameSave')->name('co.tmp.save');

Route::post('/icons/styles/services/and/awesome/edit/{val}', 'App\Http\Controllers\Trans\__TempRow__@FunctionNameEdit')->name('co.tmp.edit');

Route::get('/icons/styles/services/and/awesome/sed/{val}', 'App\Http\Controllers\Trans\__TempRow__@getCollae')->name('co.tmp.sed');


Route::get('/trans/loan/services/payments/{val}/print', 'App\Http\Controllers\Trans\__Loan__@__schedule')->name('loans.schedule');
Route::put('/trans/loan/services/loan/{val}/client/modify', 'App\Http\Controllers\Trans\__Loan__@updateClient')->name('loans.updateClient');
Route::put('/trans/loan/services/loan/{val}/join/modify', 'App\Http\Controllers\Trans\__Loan__@updateJoin')->name('loans.updateJoin');


Route::put('/trans/loan/services/loan/{val}/guaran/modify', 'App\Http\Controllers\Trans\__Loan__@updateGuaran')->name('loans.updateGuaran');

Route::put('/trans/loan/services/loan/{val}/guaran/modify/joint', 'App\Http\Controllers\Trans\__Loan__@updateGuaranJoined')->name('loans.updateGuaranJoined');


Route::put('/trans/loan/services/loan/{val}/updateCollateral/modify', 'App\Http\Controllers\Trans\__Loan__@updateCollateral')->name('loans.updateCollateral');
Route::get('/trans/loan/services/loan/{val}/join/edit', 'App\Http\Controllers\Trans\__Loan__@editJoin')->name('loans.editJoin');
Route::get('/trans/loan/services/loan/{val}/guaranteed/edit', 'App\Http\Controllers\Trans\__Loan__@editGuaran')->name('loans.editGuaran');
Route::get('/trans/loan/services/loan/{val}/collateral/edit', 'App\Http\Controllers\Trans\__Loan__@editCollat')->name('loans.editCollat');

Route::get('/trans/loan/services/loan/{val}/guaranteed/join', 'App\Http\Controllers\Trans\__Loan__@editGuaranJoined')->name('loans.editGuaranJoin');


Route::delete('/trans/loan/services/loan/{val}/collateral/{loan}/delete', 'App\Http\Controllers\Trans\__Loan__@destroy_collateral')->name('loans.destroy_collateral');
Route::get('/trans/loan/services/loan/collateral/{loan}/news', 'App\Http\Controllers\Trans\__Loan__@new_collateral')->name('loans.new_collateral');
Route::post('/trans/loan/services/loan/collateral/{loan}/new/create', 'App\Http\Controllers\Trans\__Loan__@addCollateral')->name('loans.addCollateral');

///
Route::prefix('trans/collections')->namespace('App\Http\Controllers\Trans')->group(function (){
   Route::get('/', '__Collections__@index')->name('collection.index')->middleware('agg');
   Route::get('/overdue', '__Collections__@overdue')->name('collection.overdue')->middleware('agg');
   Route::get('/payment', '__Collections__@__search')->name('collection.return');
   //Route::get('/flexible', '__Collections__@__search')->name('collection.return.search');
   Route::get('/{val}/payment', '__Collections__@__search_ref')->name('collection.return.search.ref')->middleware('agg');
   Route::get('/{val}/loan/payment', '__Collections__@__payment')->name('collection.return.search.__payment');
   Route::post('/{val}/loan/payment/create', '__Collections__@__submit_payment')->name('collection.create.__payment');

   Route::get('/{val}/finish/loan', '__Collections__@__finishLoan')->name('collection.finish.loan');
   Route::post('/{val}/finish/payment', '__Collections__@__finishLoanPay')->name('collection.finish.payment');
});


//អ្នករួមធានា
Route::prefix('trans/dara/kok')->group(function(){
   Route::get('/', 'App\Http\Controllers\DaraKokController@getRow')->name('kok.get.rows');
   Route::post('/', 'App\Http\Controllers\DaraKokController@saveRow')->name('kok.save.rows');
   Route::get('/table/save', 'App\Http\Controllers\DaraKokController@FunctionSaveBy')->name('kok.save.table'); 
});


//បន្ថែមអ្នកចូលរួមខ្ចី
Route::prefix('trans/loan')->group(function(){
   Route::get('/{val}/modify/join', 'App\Http\Controllers\Trans\__Loan__@__add_join_form')->name('add.join.on.loan');
   Route::get('/{val}/modify/guaranteed', 'App\Http\Controllers\Trans\__Loan__@__add_guara_form')->name('add.guar.on.loan');
   Route::get('/{val}/modify/another', 'App\Http\Controllers\Trans\__Loan__@__add_another_form')->name('add.another.on.loan');
});