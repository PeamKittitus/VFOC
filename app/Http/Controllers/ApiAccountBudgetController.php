<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use PDO;

class ApiAccountBudgetController extends Controller
{
    function getAccountBudget()
    {
        $dataAccBudget = DB::table('accountBudget')
        ->select('accountBudget.id','accountBudget.AccName','accountBudget.AccCode','accountBudget.Amount','accountBudget.is_active')
        // ->where('is_active', 1)
        ->get();
        return $dataAccBudget;
    }
    function getAccountBudgetSub()
    {
        $dataAccBudgetSub = DB::table('accountBudgetSub')
        ->select('accountBudgetSub.id',
            'accountBudgetSub.account_id',
            'accountBudgetSub.AccName',
            'accountBudgetSub.AccCode',
            'accountBudgetSub.Amount',
            'accountBudgetSub.SubAmount',
            'accountBudgetSub.AccStartDate',
            'accountBudgetSub.AccEndDate',
            'accountBudgetSub.is_active',
        )
        // ->where('is_active', 1)
        ->get();
        return $dataAccBudgetSub;
    }
    function saveAccountBudget(Request $request)
    {
        $AccName = $request['AccName'];
        $BudgetYear = $request['BudgetYear'];
        $Amount = $request['Amount'];

        $countData = DB::table('accountBudget')->count();
        $AccCode = $BudgetYear . '-' . sprintf('%03d', $countData+1);

        DB::beginTransaction();
        try {
            $dataInsert = [];
            $dataInsert['AccName'] = $AccName;
            $dataInsert['BudgetYear'] = $BudgetYear;
            $dataInsert['Amount'] = $Amount;
            $dataInsert['AccCode'] = $AccCode;
            $dataInsert['is_active'] = 1;
            $dataInsert['created_at'] = date('Y-m-d H:i:s');
            $dataInsert['created_by'] = CRUDBooster::myId();
            $dataInsert['IsApproveProvince'] = 0;
            $dataInsert['IsApproveBranch'] = 0;
            $dataInsert['IsApproveCenter'] = 0;
            $AccountBudgetId = DB::table('accountBudget')->insertGetId($dataInsert);
            if ($AccountBudgetId) {

                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $AccountBudgetId;
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
    function delAccountBudget(Request $request)
    {
        $AccId = $request['AccId'];

        DB::beginTransaction();
        try {
            $existingActive = DB::table('accountBudget')->where('id', $AccId)->first();
            $allsub = DB::table('accountBudgetSub')->where('account_id', $AccId)->get();
            // dd($allsub);
            if ($existingActive->is_active == 0) {
                $dataUpdate['is_active'] = 1;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $UpdateIsActive = DB::table('accountBudget')->where('id', $AccId)->update($dataUpdate);
                foreach ($allsub as $subId) {
                    $UpdatesubIsActive = DB::table('accountBudgetSub')->where('id', $subId->id)->update($dataUpdate);
                }
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
            } else {
                $dataUpdate['is_active'] = 0;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $UpdateIsActive = DB::table('accountBudget')->where('id', $AccId)->update($dataUpdate);
                foreach ($allsub as $subId) {
                    $UpdatesubIsActive = DB::table('accountBudgetSub')->where('id', $subId->id)->update($dataUpdate);
                }
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

    function delsubAccountBudget(Request $request)
    {   
        $AccId = $request['AccSubId'];
        DB::beginTransaction();
        try {
            $existingActive = DB::table('accountBudgetSub')->where('id', $AccId)->first();
            if ($existingActive->is_active == 0) {
                $dataUpdate['is_active'] = 1;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $UpdateIsActive = DB::table('accountBudgetSub')->where('id', $AccId)->update($dataUpdate);
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
            } else {
                $dataUpdate['is_active'] = 0;
                $dataUpdate['updated_at'] = date('Y-m-d H:i:s');
                $dataUpdate['updated_by'] = CRUDBooster::myId();
                $UpdateIsActive = DB::table('accountBudgetSub')->where('id', $AccId)->update($dataUpdate);
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
    function saveAccountBudgetSub(Request $request)
    {
        //===========================================AccountBudgetSub
        $AccId = $request['AccId'];
        $AccName = $request['AccName'];
        $Amount = $request['Amount'];
        $SubAmount = $request['SubAmount'];
        $AccStartDate = $request['AccStartCombine'];
        $AccEndDate = $request['AccEndCombine'];
        $OpenDate = $request['OpenStartCombine'];
        $CloseDate = $request['EndStartCombine'];
        $Detail = $request['Detail'];
        //===========================================AccountBudgetSub
        
        //===========================================AccountBudgetRiskSub
        $LowActivity = $request['LowActivity'];
        $MidActivity = $request['MidActivity'];
        $HighActivity = $request['HighActivity'];
        $LowTiming = $request['LowTiming'];
        $MidTiming = $request['MidTiming'];
        $HighTiming = $request['HighTiming'];
        //===========================================AccountBudgetRiskSub

        //===========================================File
        $file = $request['file'];
        $totalfiles = $request['totalfiles'];
        $array_file = [];
        //===========================================File

        //============================================GetData
        $dataAccBudget = DB::table('accountBudget')->where('id', $AccId)->first();
        $dataAccBudgetSub = DB::table('accountBudgetSub')->where('account_id', $AccId)->count();
        $BudgetYear = $dataAccBudget->BudgetYear;
        $AccCode = $dataAccBudget->AccCode;
        $AccBudgetAmount = $dataAccBudget->Amount;


        $dataAccBudgetSubSumAmount = DB::table('accountBudgetSub')->where('account_id', $AccId)->get();
        $sumAmount = $dataAccBudgetSubSumAmount->sum('Amount')+$Amount;

        if($sumAmount > $AccBudgetAmount){
            DB::rollback();
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
            return response()->json($data, 200);
        }
        if($Amount < $SubAmount){
            DB::rollback();
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
            return response()->json($data, 200);
        }
        $AccCodeSub = $AccCode . '-' . sprintf('%03d', $dataAccBudgetSub+1);
        //============================================GetData
        DB::beginTransaction();
        try {
            $dataInsertSub = [];
            $dataInsertSub['account_id'] = $AccId;
            $dataInsertSub['AccName'] = $AccName;
            $dataInsertSub['AccCode'] = $AccCodeSub;
            $dataInsertSub['Amount'] = $Amount;
            $dataInsertSub['SubAmount'] = $SubAmount;
            $dataInsertSub['Detail'] = $Detail;
            $dataInsertSub['AccStartDate'] = $AccStartDate;
            $dataInsertSub['AccEndDate'] = $AccEndDate;
            $dataInsertSub['OpenDate'] = $OpenDate;
            $dataInsertSub['CloseDate'] = $CloseDate;
            $dataInsertSub['is_active'] = 1;
            $dataInsertSub['created_at'] = date('Y-m-d H:i:s');
            $dataInsertSub['created_by'] = CRUDBooster::myId();
            $dataInsertSub['IsApproveProvince'] = 0;
            $dataInsertSub['IsApproveBranch'] = 0;
            $dataInsertSub['IsApproveCenter'] = 0;
            $AccountBudgetSubId = DB::table('accountBudgetSub')->insertGetId($dataInsertSub);
            if ($AccountBudgetSubId) {
                
                $dataInsertSubRisk = [];
                $dataInsertSubRisk['account_sub_id'] = $AccountBudgetSubId;
                $dataInsertSubRisk['BudgetYear'] = $BudgetYear;
                $dataInsertSubRisk['LowActivity'] = $LowActivity;
                $dataInsertSubRisk['MidActivity'] = $MidActivity;
                $dataInsertSubRisk['HighActivity'] = $HighActivity;
                $dataInsertSubRisk['LowTiming'] = $LowTiming;
                $dataInsertSubRisk['MidTiming'] = $MidTiming;
                $dataInsertSubRisk['HighTiming'] = $HighTiming;
                $ProjectSubRiskId = DB::table('projectSubRisk')->insertGetId($dataInsertSubRisk);
                if($ProjectSubRiskId){

                    $PeriodNo = $request['PeriodNo'];
                    $PeriodPercent = $request['PeriodPercent'];

                    $dataAccBudgetSub = DB::table('accountBudgetSub')->where('id', $AccountBudgetSubId)->first();
                    $dataAccBudgetSubAmount =  $dataAccBudgetSub->SubAmount;
                    $PeriodAmount = $dataAccBudgetSubAmount * ($PeriodPercent / 100);

                    $dataInsertSubPeriod = [];
                    $dataInsertSubPeriod['account_sub_id'] = $AccountBudgetSubId;
                    $dataInsertSubPeriod['TransactionYear'] = $BudgetYear;
                    $dataInsertSubPeriod['PeriodNo'] = $PeriodNo;
                    $dataInsertSubPeriod['PeriodPercent'] = $PeriodPercent;
                    $dataInsertSubPeriod['PeriodAmount'] = $PeriodAmount;
                    $ProjectSubPeriodId = DB::table('projectSubPeriod')->insertGetId($dataInsertSubPeriod);
                    if($ProjectSubPeriodId){
                        $dataInsertSubDocument = [];
                        $dataInsertSubDocument['account_sub_id'] = $AccountBudgetSubId;
                        $dataInsertSubDocument['TransactionYear'] = $BudgetYear;
                        $dataInsertSubDocument['FileType'] = 1;
                        $dataInsertSubDocument['Approvemark'] = 0;
                        foreach ($file as $index => $val) {
                            $dataInsertSubDocument['FileName'] = $val->getClientOriginalName();
                            $dataInsertSubDocument['FilePath'] = "uploads/" . $val->getClientOriginalName();
                        }
                        $ProjectSubDocumentId = DB::table('projectBudgetDocument')->insertGetId($dataInsertSubDocument);
                        if($ProjectSubDocumentId){
                            DB::commit();
                            $data['api_status'] = 1;
                            $data['api_message'] = 'Success';
                            $data['id'] = $ProjectSubDocumentId;
                            return response()->json($data, 200)
                                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                        }else{
                            DB::rollback();
                            $data['api_status'] = 0;
                            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                            return response()->json($data, 200);
                        }
                    }
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
