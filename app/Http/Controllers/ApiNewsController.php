<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiNewsController extends Controller
{
    function getNewsNotApprove()
    {
        $newsData = DB::table('transactionNews')
            ->leftjoin('transactionFileNews', 'transactionFileNews.TransactionNewsId', 'transactionNews.id')
            ->leftjoin('user', 'user.cmsUserId', 'transactionNews.Created_by')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.TransactionTitle',
                'transactionNews.TransactionDetail',
                'transactionNews.NewStartDate',
                'transactionNews.NewEndDate',
                'transactionNews.NewType',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
                'user.firstName',
                'user.lastName',
            )
            ->orderBy('Created_at', 'desc')
            ->get();
        return $newsData;
    }
    function getNewsApprove()
    {
        $newsData = DB::table('transactionNews')
            ->leftjoin('transactionFileNews', 'transactionFileNews.TransactionNewsId', 'transactionNews.id')
            ->leftjoin('user', 'user.cmsUserId', 'transactionNews.Created_by')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.TransactionTitle',
                'transactionNews.TransactionDetail',
                'transactionNews.NewStartDate',
                'transactionNews.NewEndDate',
                'transactionNews.NewType',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
                'user.firstName',
                'user.lastName',
            )
            ->where('IsApprove', 1)
            ->where('IsActive', 1)
            ->where('IsDelete', 0)
            ->orderBy('Created_at', 'desc')
            ->take(5)
            ->get();
        return $newsData;
    }
    function getNewsAllById()
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
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
            )
            ->where('Created_by', CRUDBooster::myId())
            ->where('IsDelete', 0)
            ->orderBy('Created_at', 'desc')
            ->get();
        return $newsData;
    }
    function getNewsAll()
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
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
            )
            ->orderBy('Created_at', 'desc')
            ->get();
        return $newsData;
    }
    function getNewsById($id)
    {
        $newsData = DB::table('transactionNews')
            ->leftjoin('transactionFileNews', 'transactionFileNews.TransactionNewsId', 'transactionNews.id')
            ->leftjoin('user', 'user.cmsUserId', 'transactionNews.Created_by')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.TransactionTitle',
                'transactionNews.TransactionDetail',
                'transactionNews.NewStartDate',
                'transactionNews.NewEndDate',
                'transactionNews.NewType',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionFileNews.FileName',
                'transactionFileNews.FilePath',
                'user.firstName',
                'user.lastName',
            )
            ->where('transactionNews.id', $id)
            ->first();
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
            $dataInsert['IsDelete'] = 0;
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
        $totalfiles = $request['totalfiles'];
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
            $dataUpdate['Updated_at'] = date('Y-m-d H:i:s');
            $dataUpdate['Updated_by'] = CRUDBooster::myId();

            $newsId = DB::table('transactionNews')->where('id', $NewsId)->update($dataUpdate);
            if ($newsId) {
                if ($totalfiles != 0) {
                    $dataUpdateFile = [];
                    $dataUpdateFile['TransactionYear'] = $TransactionYear;
                    $dataUpdateFile['Updated_at'] = date('Y-m-d H:i:s');
                    $dataUpdateFile['Updated_by'] = CRUDBooster::myId();
                    if($file){
                        foreach ($file as $index => $val) {
                            $dataUpdateFile['FileName'] = $val->getClientOriginalName();
                            $dataUpdateFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                        }
                    }
                    $transactionFileId = DB::table('transactionFileNews')->where('transactionFileNews.TransactionNewsId', $NewsId)->update($dataUpdateFile);
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
            $dataUpdate['IsDelete'] = 1;
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
