<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiBookbankController extends Controller
{
    function getAccountBankMaster()
    {
        $AccountBankMaster = DB::table('accountBankMaster')
            ->select(
                'accountBankMaster.id',
                'accountBankMaster.BankCode',
                'accountBankMaster.BankName',
                'accountBankMaster.BankShortName',
            )
            ->get();
        return $AccountBankMaster;
    }
    function getAccountBookByOrgId()
    {
        $dataAccBudget = DB::table('accountBookBank')
            ->leftjoin('transactionFileBookbank', 'transactionFileBookbank.bookbank_id', 'accountBookBank.id')
            ->leftjoin('accountBankMaster', 'accountBankMaster.id', 'accountBookBank.BankMasterId')
            ->select(
                'accountBookBank.id',
                'accountBookBank.BookBankNumber',
                'accountBookBank.BookBankName',
                'accountBookBank.WithdrawName',
                'accountBookBank.WithdrawName2',
                'accountBookBank.WithdrawName3',
                'accountBookBank.WithdrawName4',
                'accountBookBank.WithdrawName5',
                'accountBookBank.is_active',
                'transactionFileBookbank.FileName',
                'transactionFileBookbank.FilePath',
                'accountBankMaster.BankName',
                'accountBankMaster.BankShortName'
            )
            ->where('accountBookBank.created_by', CRUDBooster::myId())
            ->where('accountBookBank.is_active', 1)
            ->get();
        return $dataAccBudget;
    }
    function getAccountBookById($id)
    {
        $dataAccBudget = DB::table('accountBookBank')
            ->select(
                'accountBookBank.id',
                'accountBookBank.BankMasterId',
                'accountBookBank.BookBankNumber',
                'accountBookBank.BookBankName',
                'accountBookBank.WithdrawName',
                'accountBookBank.WithdrawName2',
                'accountBookBank.WithdrawName3',
                'accountBookBank.WithdrawName4',
                'accountBookBank.WithdrawName5',
            )
            ->where('accountBookBank.id', $id)
            ->where('accountBookBank.is_active', 1)
            ->first();
        return $dataAccBudget;
    }
    function saveBookbank(Request $request)
    {
        $BankMasterId = $request['BankMasterId'];
        $BookBankName = $request['BookBankName'];
        $BookBankNumber = $request['BookBankNumber'];
        $WithdrawName = $request['WithdrawName'];
        $WithdrawName2 = $request['WithdrawName2'];
        $WithdrawName3 = $request['WithdrawName3'];
        $WithdrawName4 = $request['WithdrawName4'];
        $WithdrawName5 = $request['WithdrawName5'];
        $file = $request['file'];
        $array_file = [];
        $getCmsUser = DB::table('cms_users')->where('id', CRUDBooster::myId())->first();
        $orgId = $getCmsUser->orgId;
        $BudgetYear = date("Y") + 543;
        DB::beginTransaction();
        try {

            $dataInsert = [];
            $dataInsert['OrgId'] = $orgId;
            $dataInsert['BookBankNumber'] = $BookBankNumber;
            $dataInsert['BookBankName'] = $BookBankName;
            $dataInsert['BankMasterId'] = $BankMasterId;
            $dataInsert['WithdrawName'] = $WithdrawName;
            $dataInsert['WithdrawName2'] = $WithdrawName2;
            $dataInsert['WithdrawName3'] = $WithdrawName3;
            $dataInsert['WithdrawName4'] = $WithdrawName4;
            $dataInsert['WithdrawName5'] = $WithdrawName5;
            $dataInsert['is_active'] = 1;
            $dataInsert['created_at'] = date('Y-m-d H:i:s');
            $dataInsert['created_by'] = CRUDBooster::myId();

            $accountBookBankId = DB::table('accountBookBank')->insertGetId($dataInsert);
            if ($accountBookBankId) {
                $dataInsertFile = [];
                $dataInsertFile['bookbank_id'] = $accountBookBankId;
                $dataInsertFile['TransactionYear'] = $BudgetYear;
                foreach ($file as $index => $val) {
                    $dataInsertFile['FileName'] = $val->getClientOriginalName();
                    $dataInsertFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                }
                $transactionFileId = DB::table('transactionFileBookbank')->insertGetId($dataInsertFile);
                if ($transactionFileId) {
                    DB::commit();
                    $data['api_status'] = 1;
                    $data['api_message'] = 'Success';
                    $data['id'] = $transactionFileId;
                    Storage::putFileAs('uploads/', $val, $val->getClientOriginalName());
                    array_push($array_file, $val->getClientOriginalName() . '.' . $val->getClientOriginalExtension());
                    return response()->json($data, 200)
                        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                } else {
                    DB::rollback();
                    $data['api_status'] = 0;
                    $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                    return response()->json($data, 200);
                }
            } else {
                DB::rollback();
                $data['api_status'] = 0;
                $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
            $data['api_data'] = $e;
        }
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
    function editBookbank(Request $request)
    {
        $AccountBookBankId = $request['AccountBookBankId'];
        $BankMasterId = $request['BankMasterId'];
        $BookBankName = $request['BookBankName'];
        $BookBankNumber = $request['BookBankNumber'];
        $WithdrawName = $request['WithdrawName'];
        $WithdrawName2 = $request['WithdrawName2'];
        $WithdrawName3 = $request['WithdrawName3'];
        $WithdrawName4 = $request['WithdrawName4'];
        $WithdrawName5 = $request['WithdrawName5'];
        $totalfiles = $request['totalfiles'];
        $file = $request['file'];
        $array_file = [];
        $getCmsUser = DB::table('cms_users')->where('id', CRUDBooster::myId())->first();
        $orgId = $getCmsUser->orgId;
        $BudgetYear = date("Y") + 543;
        DB::beginTransaction();
        try {
            if ($totalfiles == 0) {
                $dataUpdate = [];
                $dataUpdate['OrgId'] = $orgId;
                $dataUpdate['BookBankNumber'] = $BookBankNumber;
                $dataUpdate['BookBankName'] = $BookBankName;
                $dataUpdate['BankMasterId'] = $BankMasterId;
                $dataUpdate['WithdrawName'] = $WithdrawName;
                $dataUpdate['WithdrawName2'] = $WithdrawName2;
                $dataUpdate['WithdrawName3'] = $WithdrawName3;
                $dataUpdate['WithdrawName4'] = $WithdrawName4;
                $dataUpdate['WithdrawName5'] = $WithdrawName5;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $accountBookBankId = DB::table('accountBookBank')->where('id', $AccountBookBankId)->update($dataUpdate);
                if ($accountBookBankId) {
            
                    DB::commit();
                    $data['api_status'] = 1;
                    $data['api_message'] = 'Success';
                    $data['id'] = $accountBookBankId;
                    return response()->json($data, 200)
                    ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                    ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                } else {
                    DB::rollback();
                    $data['api_status'] = 0;
                    $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                    return response()->json($data, 200);
                }
            }else{
               
                $dataUpdate = [];
                $dataUpdate['OrgId'] = $orgId;
                $dataUpdate['BookBankNumber'] = $BookBankNumber;
                $dataUpdate['BookBankName'] = $BookBankName;
                $dataUpdate['BankMasterId'] = $BankMasterId;
                $dataUpdate['WithdrawName'] = $WithdrawName;
                $dataUpdate['WithdrawName2'] = $WithdrawName2;
                $dataUpdate['WithdrawName3'] = $WithdrawName3;
                $dataUpdate['WithdrawName4'] = $WithdrawName4;
                $dataUpdate['WithdrawName5'] = $WithdrawName5;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $accountBookBankId = DB::table('accountBookBank')->where('id', $AccountBookBankId)->update($dataUpdate);
                if ($accountBookBankId) {
                    $dataUpdateFile = [];
                    foreach ($file as $index => $val) {
                        $dataUpdateFile['FileName'] = $val->getClientOriginalName();
                        $dataUpdateFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                    }
                    $dataUpdateFile['TransactionYear'] = $BudgetYear;
                    $dataUpdateFile['updated_at'] = date('Y-m-d H:i:s');
                    $dataUpdateFile['updated_by'] = CRUDBooster::myId();
                    $transactionFileId = DB::table('transactionFileBookbank')->where('bookbank_id', $AccountBookBankId)->update($dataUpdateFile);
                    if($transactionFileId){
                        DB::commit();
                        $data['api_status'] = 1;
                        $data['api_message'] = 'Success';
                        $data['id'] = $transactionFileId;
                        return response()->json($data, 200)
                        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                    }else{
                        DB::rollback();
                        $data['api_status'] = 0;
                        $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                        return response()->json($data, 200);
                    }
                    
                } else {
                    DB::rollback();
                    $data['api_status'] = 0;
                    $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                    return response()->json($data, 200);
                }
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
            $data['api_data'] = $e;
        }
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
    function delBookBank(Request $request)
    {
        $AccountBookBankId = $request['AccountBookBankId'];

        DB::beginTransaction();
        try {
            $dataUpdate['is_active'] = 0;
            $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['updated_by'] = CRUDBooster::myId();
            $UpdateIsActive = DB::table('accountBookBank')->where('id', $AccountBookBankId)->update($dataUpdate);
            if ($UpdateIsActive) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $UpdateIsActive;
                return response()->json($data, 200)
                    ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                    ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
            } else {
                DB::rollback();
                $data['api_status'] = 0;
                $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
            $data['api_data'] = $e;
        }
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
}
