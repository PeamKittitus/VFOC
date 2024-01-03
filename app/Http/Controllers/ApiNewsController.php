<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiNewsController extends Controller
{
    function getTypeNewsNotApprove()
    {
        $newsData = DB::table('transactionNews')
            ->leftjoin('transactionFileNews', 'transactionFileNews.TransactionNewsId', 'transactionNews.id')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.TransactionTitle',
                'transactionNews.TransactionDetail',
                'transactionNews.NewStartDate',
                'transactionNews.NewEndDate',
                'transactionNews.NewType',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
            )
            ->get();
        return $newsData;
    }
    function getTypeNews()
    {
        $newsData = DB::table('systemLookupMaster')
            ->select(
                'systemLookupMaster.id',
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
        $getYear = date("Y") + 543;
        $TransactionYear = $getYear;
        $TransactionType = $request['TransactionType'];  //0=สมาชิก,1=สาธารณะ
        $TransactionTitle = $request['TransactionTitle'];
        $TransactionDetail = $request['TransactionDetail'];
        $IsActive = $request['IsActive'];
        $NewStartDate =  (new FunctionController)->formatDateString($request['NewStartDate']);
        $NewEndDate = (new FunctionController)->formatDateString($request['NewEndDate']);
        $NewType = $request['NewType'];
        $file = $request['file'];
        $array_file = [];
        DB::beginTransaction();
        try {

            $dataInsert = [];
            $dataInsert['TransactionType'] = $TransactionType;
            $dataInsert['TransactionYear'] = $TransactionYear;
            $dataInsert['TransactionTitle'] = $TransactionTitle;
            $dataInsert['TransactionDetail'] = $TransactionDetail;
            $dataInsert['NewStartDate'] = $NewStartDate;
            $dataInsert['NewEndDate'] = $NewEndDate;
            $dataInsert['NewType'] = $NewType;
            $dataInsert['IsActive'] = $IsActive;
            $dataInsert['IsApprove'] = 0;
            $dataInsert['Created_at'] = date('Y-m-d H:i:s');
            $dataInsert['Created_by'] = CRUDBooster::myId();

            $newsId = DB::table('transactionNews')->insertGetId($dataInsert);
            if ($newsId) {
                $dataInsertFile = [];
                $dataInsertFile['TransactionNewsId'] = $newsId;
                $dataInsertFile['TransactionYear'] = $TransactionYear;
                foreach ($file as $index => $val) {
                    $dataInsertFile['FileName'] = $val->getClientOriginalName();
                    $dataInsertFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                }
                $transactionFileId = DB::table('transactionFileNews')->insertGetId($dataInsertFile);
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
    function editNews(Request $request)
    {
        $NewsId = $request['NewsId'];
        $TransactionYear = date("Y") + 543;
        $TransactionYear = $TransactionYear;
        $TransactionType = $request['TransactionType'];  //0=สมาชิก,1=สาธารณะ
        $TransactionYear = $request['TransactionYear'];
        $TransactionTitle = $request['TransactionTitle'];
        $TransactionDetail = $request['TransactionDetail'];
        $IsActive = $request['IsActive'];
        $NewStartDate = $request['NewStartDate'];
        $NewEndDate = $request['NewEndDate'];
        $NewType = $request['NewType'];
        $file = $request['file'];
        $array_file = [];
        DB::beginTransaction();
        try {

            $dataUpdate = [];
            $dataUpdate['TransactionType'] = $TransactionType;
            $dataUpdate['TransactionYear'] = $TransactionYear;
            $dataUpdate['TransactionTitle'] = $TransactionTitle;
            $dataUpdate['TransactionDetail'] = $TransactionDetail;
            $dataUpdate['NewStartDate'] = $NewStartDate;
            $dataUpdate['NewEndDate'] = $NewEndDate;
            $dataUpdate['NewType'] = $NewType;
            $dataUpdate['IsActive'] = $IsActive;
            $dataUpdate['IsApprove'] = 0;
            $dataUpdate['Updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['Updated_by'] = CRUDBooster::myId();

            $newsId = DB::table('transactionNews')->where('id', $NewsId)->update($dataUpdate);
            if ($newsId) {
                if ($file) {
                    $dataUpdateFile = [];
                    $dataUpdateFile['TransactionNewsId'] = $newsId;
                    $dataUpdateFile['TransactionYear'] = $TransactionYear;
                    $dataUpdateFile['Updated_at'] = date('Y-m-d H:i:s');
                    $dataUpdateFile['Updated_by'] = CRUDBooster::myId();
                    foreach ($file as $index => $val) {
                        $dataUpdateFile['FileName'] = $val->getClientOriginalName();
                        $dataUpdateFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                    }
                    $transactionFileId = DB::table('transactionFileNews')->where('TransactionNewsId', $NewsId)->update($dataUpdateFile);
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
                }
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $newsId;
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
    function delNews(Request $request)
    {
        $NewsId = $request['NewsId'];
        DB::beginTransaction();
        try {

            $dataUpdate = [];
            $dataUpdate['IsActive'] = 0;
            $dataUpdate['Updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['Updated_by'] = CRUDBooster::myId();

            $newsId = DB::table('transactionNews')->where('id', $NewsId)->update($dataUpdate);
            if ($newsId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $newsId;
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
    function approveNews(Request $request)
    {
        $NewsId = $request['NewsId'];
        DB::beginTransaction();
        try {

            $dataUpdate = [];
            $dataUpdate['IsApprove'] = 1;
            $dataUpdate['Updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['Updated_by'] = CRUDBooster::myId();

            $newsId = DB::table('transactionNews')->where('id', $NewsId)->update($dataUpdate);
            if ($newsId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $newsId;
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
