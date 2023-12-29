<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiNewsController extends Controller
{
    function getTypeNews()
    {
        $newsData = DB::table('systemLookupMaster')
        ->select('systemLookupMaster.id',
        'systemLookupMaster.LookupValue',
        'systemLookupMaster.LookupText',
        )
        ->where('LookupStatus', 1)
        ->where('LookupGroupId', 3) //ประเภทข่าวสาร
        ->get();
        return $newsData;
    }
    function saveNews(Request $request)
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
}
