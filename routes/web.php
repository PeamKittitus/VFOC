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
Route::get('/registerMember', function () {
    return view('register/indexMember');
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
Route::get('/News', function () {
    return view('news/index');
});
Route::get('/addBookBank', '\App\Http\Controllers\AdminAccountBookbankController@addBookBank');
Route::get('/editbookbank/{id}', '\App\Http\Controllers\AdminAccountBookbankController@editBookBank');
Route::get('/editsubproject/{id}', '\App\Http\Controllers\AdminAccountBudgetController@editsubproject');
Route::get('/editproject/{id}', '\App\Http\Controllers\AdminAccountBudgetController@editproject');
Route::get('/editNews/{id}', '\App\Http\Controllers\AdminTransactionNewsController@editNews');
Route::get('/addNews', '\App\Http\Controllers\AdminTransactionNewsController@addNews');
Route::get('/viewNews/{id}', '\App\Http\Controllers\AdminTransactionNewsController@viewNews');
Route::get('/addVilage', '\App\Http\Controllers\AdminTransactionReqVillageController@addVilage');
Route::get('/editVillage/{id}', '\App\Http\Controllers\AdminTransactionReqVillageController@editVillage');
Route::get('/addBookBankVillage', '\App\Http\Controllers\AdminTransactionReqVillageController@addBookBankVillage');
Route::get('/approveVillage/{id}', '\App\Http\Controllers\AdminTransactionVillageController@approveVillage');
Route::get('/approveMemberVillage/{id}', '\App\Http\Controllers\AdminMemberVillageController@approveMemberVillage');
Route::get('/detailMemberVillage/{id}', '\App\Http\Controllers\AdminMemberVillageController@detailMemberVillage');
Route::get('/editMemberVillage/{id}', '\App\Http\Controllers\AdminMemberVillageController@editMemberVillage');
Route::get('/approveEditDetail/{id}', '\App\Http\Controllers\AdminVillageNewController@approveEditDetail');
Route::get('/addProjectBudget', '\App\Http\Controllers\AdminProjectBudgetController@addProjectBudget');
Route::get('/detailProject/{id}', '\App\Http\Controllers\AdminProjectBudgetController@detailProject');
Route::get('/approveDetailProject/{id}', '\App\Http\Controllers\AdminApproveProjectBudgetController@approveDetailProject');
Route::get('/addtransectionBudget', '\App\Http\Controllers\AdminTransacionAccountBudgetController@addtransectionBudget');
Route::get('/updateProjectActivity/{id}', '\App\Http\Controllers\AdminProjectBudgetController@updateProjectActivity');
Route::get('/updateProjectActivityDetail/{id}', '\App\Http\Controllers\AdminProjectBudgetController@updateProjectActivityDetail');
Route::get('/approveActivityProject/{id}', '\App\Http\Controllers\AdminApproveProjectBudgetController@approveActivityProject');
Route::get('/addAccountBudgetCenter', '\App\Http\Controllers\AdminAccountBudgetCenterController@addAccountBudgetCenter');
Route::get('/editAccountBudgetCenter/{id}', '\App\Http\Controllers\AdminAccountBudgetCenterController@editAccountBudgetCenter');
Route::get('/addAccountBudgetSubCenter', '\App\Http\Controllers\AdminAccountBudgetCenterController@addAccountBudgetSubCenter');
Route::get('/editAccountBudgetCenterSub/{id}', '\App\Http\Controllers\AdminAccountBudgetCenterController@editAccountBudgetCenterSub');
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
Route::post('/editNews', '\App\Http\Controllers\ApiNewsController@editNews');
Route::post('/delNews', '\App\Http\Controllers\ApiNewsController@delNews');
Route::post('/approveNews', '\App\Http\Controllers\ApiNewsController@approveNews');
Route::get('/getMenus', '\App\Http\Controllers\FunctionController@getMenus');
Route::post('/RedirectToOutSite', '\App\Http\Controllers\FunctionController@RedirectToOutSite');
Route::post('/saveRegisterVillage', '\App\Http\Controllers\ApiRegisterVillageController@saveRegisterVillage');
Route::post('/saveMemberVillage', '\App\Http\Controllers\ApiRegisterVillageController@saveMemberVillage');
Route::post('/deleteMemberInVallage', '\App\Http\Controllers\ApiRegisterVillageController@deleteMemberInVallage');
Route::post('/editRegisterVillage', '\App\Http\Controllers\ApiRegisterVillageController@editRegisterVillage');
Route::post('/editMemberVillage', '\App\Http\Controllers\ApiRegisterVillageController@editMemberVillage');
Route::post('/getAmphuresById', '\App\Http\Controllers\FunctionController@getAmphuresById');
Route::post('/getTambonsById', '\App\Http\Controllers\FunctionController@getTambonsById');
Route::post('/getZipCodeById', '\App\Http\Controllers\FunctionController@getZipCodeById');
Route::get('/getAccountBankMasterApi', '\App\Http\Controllers\ApiRegisterController@getAccountBankMasterApi');
Route::get('/getGenderApi', '\App\Http\Controllers\ApiRegisterVillageController@getGenderApi');
Route::get('/getOccupationApi', '\App\Http\Controllers\ApiRegisterVillageController@getOccupationApi');
Route::get('/getMemberPositionApi', '\App\Http\Controllers\ApiRegisterVillageController@getMemberPositionApi');
Route::get('/getMemberStatusApi', '\App\Http\Controllers\ApiRegisterVillageController@getMemberStatusApi');
Route::post('/saveRegisterVillageAll', '\App\Http\Controllers\ApiRegisterVillageController@saveRegisterVillageAll');
Route::get('/getProvince', '\App\Http\Controllers\FunctionController@getProvince');
Route::post('/approveVillage', '\App\Http\Controllers\ApiRegisterVillageController@approveVillage');
Route::post('/getVillageByIdProvince', '\App\Http\Controllers\FunctionController@getVillageByIdProvince');
Route::post('/saveRegisterVillageMember', '\App\Http\Controllers\ApiRegisterVillageController@saveRegisterVillageMember');
Route::post('/approveMemberVillage', '\App\Http\Controllers\ApiRegisterVillageController@approveMemberVillage');
Route::post('/editDataVillage', '\App\Http\Controllers\AdminMemberVillageController@editDataVillage');
Route::post('/approveEditVillage', '\App\Http\Controllers\AdminVillageNewController@approveEditVillage');
Route::get('/getAccountBudgetSubApi', '\App\Http\Controllers\AdminProjectBudgetController@getAccountBudgetSubApi');
Route::post('/getAccountBudgetSubPeriodDetailApi', '\App\Http\Controllers\AdminProjectBudgetController@getAccountBudgetSubPeriodDetailApi');
Route::post('/getAccountBudgetDetailSubApi', '\App\Http\Controllers\AdminProjectBudgetController@getAccountBudgetDetailSubApi');
Route::post('/getAccountBudgetFileApi', '\App\Http\Controllers\AdminProjectBudgetController@getAccountBudgetFileApi');
Route::post('/saveEditProjectBudget', '\App\Http\Controllers\AdminVillageNewController@saveEditProjectBudget');
Route::post('/delProjectBudget', '\App\Http\Controllers\AdminVillageNewController@delProjectBudget');
Route::post('/addProjectBudgetApi', '\App\Http\Controllers\AdminVillageNewController@addProjectBudget');
Route::post('/saveTransectionBudgetApi', '\App\Http\Controllers\AdminTransacionAccountBudgetController@saveTransectionBudget');
Route::post('/approveBudget', '\App\Http\Controllers\AdminApproveProjectBudgetController@approveProjectBudget');
Route::post('/updatedProjectActivity', '\App\Http\Controllers\AdminApproveProjectBudgetController@updatedProjectActivity');
Route::get('/getBookBankAdminApi', '\App\Http\Controllers\FunctionController@getBookBankAdminApi');
Route::get('/getVillageApi', '\App\Http\Controllers\FunctionController@getVillageApi');
Route::get('/getVillageBookBankApi/{id}', '\App\Http\Controllers\FunctionController@getVillageBookBankApi');
Route::post('/addAccountBudgetCenterApi', '\App\Http\Controllers\AdminAccountBudgetCenterController@addAccountBudgetCenterApi');
Route::post('/editAccountBudgetCenterApi', '\App\Http\Controllers\AdminAccountBudgetCenterController@editAccountBudgetCenterApi');
Route::post('/delAccountBudgetCenter', '\App\Http\Controllers\AdminAccountBudgetCenterController@delAccountBudgetCenter');
Route::post('/addAccountBudgetSubCenterApi', '\App\Http\Controllers\AdminAccountBudgetCenterController@addAccountBudgetSubCenterApi');
Route::post('/delSubAccountBudgetCenter', '\App\Http\Controllers\AdminAccountBudgetCenterController@delSubAccountBudgetCenter');
Route::post('/editAccountBudgetCenterSubApi', '\App\Http\Controllers\AdminAccountBudgetCenterController@editAccountBudgetCenterSubApi');
//========================================================================================== API

//========================================================================================== Report
Route::post('/getTransactionNewsReportCreatorMostNewsBy', '\App\Http\Controllers\ApiNewsController@getTransactionNewsReportCreatorMostNewsBy');
Route::post('/getTransactionNewsReportTypeNewsByMonth', '\App\Http\Controllers\ApiNewsController@getTransactionNewsReportTypeNewsByMonth');
Route::post('/getTransactionNewsReportApproveNewsByMonth', '\App\Http\Controllers\ApiNewsController@getTransactionNewsReportApproveNewsByMonth');
//========================================================================================== Report








//======================================================== All Approve
Route::get('/admin/approveall','\App\Http\Controllers\AdminApproveController@Index');
Route::post('/approveActivity', '\App\Http\Controllers\AdminApproveController@approveProjectActivity');


