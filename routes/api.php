<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:api'])->group(function () {
    Route::post('/apply-loan', 'LoanController@create')->name('apply_loan');
    Route::post('/approve-loan', 'LoanController@approve')->name('approve_loan');
    Route::post('/repay-loan', 'LoanController@repay')->name('repay_loan');
});