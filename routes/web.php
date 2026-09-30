<?php

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Route;
use App\Opts\Customer;
use App\Trans\Loan;
use App\Helpers\Amortization;
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
Route::get('/test', function () {

    // $data = Loan::latest()->value('id');
    //     $len = strlen($data) <= 5 ? 5 : strlen($data) + 1;
    //     return '9'. str_pad( $data + 25, $len, '0', STR_PAD_LEFT);
    $var = new Amortization();
    $var->Amount(1000);
    $var->Rate(1.9);
    $var->Term(12);
    $var->StartDate(now());

    return $var->schedules();
});


//login
require __DIR__.'/login.php';

require __DIR__.'/banks.php';
require __DIR__.'/clients.php';
require __DIR__.'/local.php';
require __DIR__.'/trans.php';
require __DIR__.'/v2.php';



Route::prefix("history")->group(function(){
    Route::get("/finish", "App\Http\Controllers\FinishLoanHistoryController@index")->name("history.finish");
    Route::get("/late", "App\Http\Controllers\LateLoanHistoryController@index")->name("history.late");
});



Route::get('/', 'App\Http\Controllers\CoDashboard@__index')->name('root');

//Auth::routes();
Route::get('/dashboard', 'App\Http\Controllers\CoDashboard@__index')->name('dashboard');
Route::get('/profile', 'App\Http\Controllers\CoDashboard@__profile')->name('profile');
Route::put('/profile/update', 'App\Http\Controllers\CoDashboard@__profile_update')->name('profile.update');

//Plan
Route::post('/plan/create', 'App\Http\Controllers\CoDashboard@__savePlan')->name('plan.create');
Route::get('/plan/get', 'App\Http\Controllers\CoDashboard@__getPlan')->name('plan.get');
Route::post('/plan/finish/{val}', 'App\Http\Controllers\CoDashboard@__finishPlan')->name('plan.finish');
Route::post('/plan/edit/{val}', 'App\Http\Controllers\CoDashboard@__editPlan')->name('plan.edit');
Route::post('/plan/delete/{val}', 'App\Http\Controllers\CoDashboard@__deletePlan')->name('plan.delete');

//Holiday
Route::prefix('holiday')->group(function(){
    Route::get('/', 'App\Http\Controllers\HolidayController@index')->name('holiday.index');
    Route::get('/create', 'App\Http\Controllers\HolidayController@create')->name('holiday.create');
    Route::post('/store', 'App\Http\Controllers\HolidayController@store')->name('holiday.store');
    Route::get('/{val}/show', 'App\Http\Controllers\HolidayController@show')->name('holiday.show');
    Route::put('/{val}/edit', 'App\Http\Controllers\HolidayController@edit')->name('holiday.edit');
    Route::delete('/{val}/delete', 'App\Http\Controllers\HolidayController@delete')->name('holiday.delete');
});

//Recreate
Route::get('/trans/loans/re/{val}/create', 'App\Http\Controllers\Trans\__Collections__@__reCreate')->name('re.create');
Route::post('/trans/loans/re/{val}/store', 'App\Http\Controllers\Trans\__Collections__@__reStore')->name('re.store');
Route::get('/trans/loans/{val}/invoice', 'App\Http\Controllers\Trans\__Collections__@__Invoice')->name('loans.invoice');

//receive
// Route::get('/trans_loans_receive', function () {
//     return dd($_REQUEST);
// })->name('receive');
Route::get('/trans_loans_re', 'App\Http\Controllers\DaraKokController@receive')->name('receive');
// Route::get('/trans/loans/re', 'App\Http\Controllers\DaraKokController@test_v2')->name('receive');


Route::prefix('users')->middleware('can:auth.admin')->group(function(){
    Route::get('/', 'App\Http\Controllers\Auth\UserController@index')->name("auth.index");
    Route::get('/create', 'App\Http\Controllers\Auth\UserController@create')->name("auth.create");
    Route::get('/{val}/edit', 'App\Http\Controllers\Auth\UserController@edit')->name("auth.edit");
    Route::post('/register', 'App\Http\Controllers\Auth\UserController@register')->name('auth.register');
    Route::put('/{val}/update', 'App\Http\Controllers\Auth\UserController@update')->name('auth.update');
});


Route::prefix("trans/loans/create")->group(function(){
    Route::get("/choose/client", "App\Http\Controllers\FixPersonController@clientList")->name("fix.loan.client.list12");
   // Route::get("/choose/client/{id}", "FixPersonController@chooseClientFix")->name("fix.loan.client.chooseClientFix");
    Route::get("/choose/client/fetch.xml", "App\Http\Controllers\FixPersonController@fetchWithRequestClient")->name("fix.loan.client.fetchWithRequestClient12");
    Route::get("/choose/client/{val}/sub.xml", "App\Http\Controllers\FixPersonController@chooseClientFix")->name('fix.loan.choose.client');
    //
    //
    Route::get("/choose/tmp/{id}/delete.xml", "App\Http\Controllers\FixPersonController@removeTmpIst")->name("fix.loan.delete.tmp.row");
    //
    //join
    Route::get('/choose/join', "App\Http\Controllers\FixPersonController@joinLists")->name("fix.loan.join.list12");
    Route::get('/choose/join/add.form', "App\Http\Controllers\FixPersonController@joinNewAdd")->name("fix.loan.join.joinNewAdd");
    Route::get("/choose/join/fetch.xml", "App\Http\Controllers\FixPersonController@fetchWithRequestJoin")->name("fix.loan.join.fetchWithRequestJoin");
    Route::get("/choose/join/{val}/sub.xml", "App\Http\Controllers\FixPersonController@chooseJoinFix")->name("fix.loan.join.chooseJoinFix");
    Route::post("/choose/join/store.form", "App\Http\Controllers\FixPersonController@joinNewStore")->name("fix.loan.join.joinNewStore");
    //guarantee
    Route::get("/choose/guarantee", "App\Http\Controllers\FixPersonController@CustGuaranNewReque")->name("fix.loan.CustGuaranNewReque");
    Route::get("/choose/guarantee/add.form", "App\Http\Controllers\FixPersonController@CustGuaranNewAdd")->name("fix.loan.CustGuaranNewAdd");
    Route::get("/choose/guarantee/fetch.xml", "App\Http\Controllers\FixPersonController@fetchWithRequestCustGuaran")->name("fix.loan.fetchWithRequestCustGuaran");
    Route::get("/choose/guarantee/{val}/sub.xml", "App\Http\Controllers\FixPersonController@chooseCustGuaranFix")->name("fix.loan.chooseCustGuaranFix");
    Route::post("/choose/guarantee/store.form", "App\Http\Controllers\FixPersonController@CustGuaranNewStore")->name("fix.loan.CustGuaranNewStore");
    //

    Route::get("/choose/guarantee/join", "App\Http\Controllers\FixPersonController@KOKList")->name("fix.loan.KOKList");
    Route::get("/choose/guarantee/join/fetch.xml", "App\Http\Controllers\FixPersonController@fetchGuaranteeJoinFix")->name("fix.loan.fetchGuaranteeJoinFix");
    Route::get("/choose/guarantee/join/{val}/sub.xml", "App\Http\Controllers\FixPersonController@KOKChoose")->name("fix.loan.KOKChoose");
    Route::get("/choose/guarantee/join/add.form", "App\Http\Controllers\FixPersonController@KOKFormNew")->name("fix.loan.KOKFormNew");
    Route::post("/choose/guarantee/join/store.form", "App\Http\Controllers\FixPersonController@KOKSubmitDataFix")->name("fix.loan.KOKSubmitDataFix");
});