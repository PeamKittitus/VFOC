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
//==========================================================================================Route
Route::get('/', function () {
    return redirect('/admin');
});
Route::get('/register', function () {
    return view('register/index');
});
Route::get('/home', function () {
    return view('home/index');
});
Route::get('/project', function () {
    return view('project/index');
});
Route::get('/addproject', function () {
    return view('project/addproject');
});
Route::get('/addsubproject', function () {
    return view('project/addsubproject');
});
Route::get('/addNews', function () {
    return view('news/addNews');
});
Route::get('/editNews', function () {
    return view('news/editNews');
});
Route::get('/addBookBank', '\App\Http\Controllers\AdminAccountBookbankController@addBookBank');
Route::get('/editbookbank/{id}', '\App\Http\Controllers\AdminAccountBookbankController@editBookBank');
Route::get('/editsubproject/{id}', '\App\Http\Controllers\AdminAccountBudgetController@editsubproject');
Route::get('/editproject/{id}', '\App\Http\Controllers\AdminAccountBudgetController@editproject');
//==========================================================================================Route


//========================================================================================== API
Route::get('/getOrgStructure', '\App\Http\Controllers\ApiRegisterController@getOrgStructure');
Route::post('/getOrgStructureProvince', '\App\Http\Controllers\ApiRegisterController@getOrgStructureProvince');
Route::post('/saveRegister', '\App\Http\Controllers\ApiRegisterController@saveRegister');
Route::get('/getAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@getAccountBudget');
Route::get('/getAccountBudgetSub', '\App\Http\Controllers\ApiAccountBudgetController@getAccountBudgetSub');
Route::post('/saveAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@saveAccountBudget');
Route::post('/subStatusAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@subStatusAccountBudget');
Route::post('/subStatusSubAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@subStatusSubAccountBudget');
Route::post('/saveAccountBudgetSub', '\App\Http\Controllers\ApiAccountBudgetController@saveAccountBudgetSub');
Route::get('/getCurrentBudgetYear', '\App\Http\Controllers\FunctionController@getCurrentBudgetYear');
Route::post('/saveBookbank', '\App\Http\Controllers\ApiBookbankController@saveBookbank');
Route::post('/editBookbank', '\App\Http\Controllers\ApiBookbankController@editBookbank');
Route::post('/delBookBank', '\App\Http\Controllers\ApiBookbankController@delBookBank');
Route::post('/editProfile', '\App\Http\Controllers\ApiUserController@editProfile');
Route::post('/getAccountBudgetandSubAPI', '\App\Http\Controllers\ApiAccountBudgetController@getAccountBudgetandSubAPI');
Route::post('/delSubAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@delSubAccountBudget');
Route::post('/delAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@delAccountBudget');
Route::post('/editAccountBudget', '\App\Http\Controllers\ApiAccountBudgetController@editAccountBudget');
Route::post('/editAccountBudgetSub', '\App\Http\Controllers\ApiAccountBudgetController@editAccountBudgetSub');
Route::post('/saveNews', '\App\Http\Controllers\ApiNewsController@saveNews');
Route::get('/getTypeNews', '\App\Http\Controllers\ApiNewsController@getTypeNews');
//========================================================================================== API
