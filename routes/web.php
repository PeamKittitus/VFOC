<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/register', function () {
    return view('register/index');
});
Route::get('/home', function () {
    return view('home/index');
});
//========================================================================================== API
Route::get('/getOrgStructure', '\App\Http\Controllers\ApiRegisterController@getOrgStructure');
Route::post('/getOrgStructureProvince', '\App\Http\Controllers\ApiRegisterController@getOrgStructureProvince');
Route::post('/saveRegister', '\App\Http\Controllers\ApiRegisterController@saveRegister');
Route::get('/getAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@getAccountBudget');
Route::post('/saveAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@saveAccountBudget');
Route::post('/delAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@delAccountBudget');
Route::post('/saveAccountBudgetSub', '\App\Http\Controllers\ApiAccountBudgetController@saveAccountBudgetSub');
//========================================================================================== API
