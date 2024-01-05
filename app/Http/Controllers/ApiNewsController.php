<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use stdClass;

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
                    if ($file) {
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

    function ReportApproveNews()
    {
        $newsData = DB::table('transactionNews')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.Created_at',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
            )
            ->groupBy('transactionNews.TransactionYear')
            ->get();

        $Models = [];
        foreach ($newsData as $index => $val) {
            $model = new stdClass();
            $model->TransactionYear = $val->TransactionYear;
            $model->AmountWait = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                // ->where('TransactionType', 0)
                ->where('IsApprove', 0)
                ->where('IsActive', 1)
                ->count();

            $model->AmountApprove = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                // ->where('TransactionType', 0)
                ->where('IsApprove', 1)
                ->where('IsActive', 1)
                ->count();

            $model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                // ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->count();

            $Models[] = $model;
        }
        return $Models;
    }
    function GetReportCreatorMost()
    {
        $years = date('Y') + 543;
        $months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        $Models = [];

        for ($i = 1; $i <= 12; $i++) {
            $Y = $years;
            $Model = new stdClass();
            $Model->TransactionYear = $years;
            $Tran = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->groupBy('Created_by')
                ->selectRaw('COUNT(*) as Count, MAX(Created_by) as Created_by')
                ->get();

            $TranMax = $Tran->sortByDesc('Count')->pluck('Created_by')->first();

            $Model->TransactionYear = $years;

            $Model->fullName = DB::table('user')
                ->where('cmsUserId', $TranMax)
                ->select(DB::raw('CONCAT(FirstName, " ", LastName) as fullName'))
                ->first()->fullName;

            $Model->Month = $months[$i - 1];

            $Model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountCreate = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();
            $Models[] = $Model;
        }
        return $Models;
    }
    function GetReportType()
    {
        $years = date('Y') + 543;
        $months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        $Models = [];

        for ($i = 1; $i <= 12; $i++) {
            $Y = $years;
            $Model = new stdClass();

            $Model->TransactionYear = $years;

            $Model->Month = $months[$i - 1];

            $Model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Models[] = $Model;
        }
        return $Models;
    }
    function ReportApproveNewsByMonth()
    {
        $years = date('Y') + 543;
        $months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        $Models = [];

        for ($i = 1; $i <= 12; $i++) {
            $Y = $years;
            $Model = new stdClass();

            $Model->TransactionYear = $years;

            $Model->Month = $months[$i - 1];

            $Model->AmountWait = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 0)
                ->where('IsApprove', 0)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountApprove = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 1)
                ->where('IsApprove', 1)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Models[] = $Model;
        }
        return $Models;
    }
    function GetReportCreator()
    {
        $years = date('Y') + 543;
        $newsData = DB::table('transactionNews')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
            )
            ->where('TransactionYear', $years)
            ->where('IsActive', 1)
            ->groupBy('transactionNews.Created_by')
            ->get();
        $Models = [];
        foreach ($newsData as $index => $val) {
            $model = new stdClass();
            $model->TransactionYear = $val->TransactionYear;

            $model->fullName = DB::table('user')
                ->where('cmsUserId', $val->Created_by)
                ->select(DB::raw('CONCAT(FirstName, " ", LastName) as fullName'))
                ->first()->fullName;

            $model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('Created_by', $val->Created_by)
                ->count();

            $model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('Created_by', $val->Created_by)
                ->count();

            $model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('IsActive', 1)
                ->where('Created_by', $val->Created_by)
                ->count();

            $Models[] = $model;
        }
        return $Models;
    }
    function ReportCreatorMostNews()
    {
        $newsData = DB::table('transactionNews')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
            )
            ->groupBy('transactionNews.TransactionYear')
            ->get();
        $Models = [];
        foreach ($newsData as $index => $val) {
            $Y = $val->TransactionYear;
            $Tran = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->groupBy('Created_by')
                ->selectRaw('COUNT(*) as Count, MAX(Created_by) as Created_by')
                ->get();

            $TranMax = $Tran->sortByDesc('Count')->pluck('Created_by')->first();

            $model = new stdClass();
            $model->TransactionYear = $val->TransactionYear;

            $model->fullName = DB::table('user')
                ->where('cmsUserId', $TranMax)
                ->select(DB::raw('CONCAT(FirstName, " ", LastName) as fullName'))
                ->first()->fullName;

            $model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->count();

            $model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->count();

            $model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->count();

            $Models[] = $model;
        }
        return $Models;
    }
    function ReportLateNews()
    {
        $newsData = DB::table('transactionNews')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
            )
            ->groupBy('transactionNews.TransactionYear')
            ->get();
        $Models = [];
        foreach ($newsData as $index => $val) {
           
            $today = date('Y-m-d');
            $date = (date('Y') < 2500) ? $today : date('Y-m-d', strtotime('-543 years', strtotime($today)));

            $model = new stdClass();
            $model->TransactionYear = $val->TransactionYear;

            $model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('NewEndDate', '<', $date)
                ->count();

            $model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('NewEndDate', '<', $date)
                ->count();

            $model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('IsActive', 1)
                ->where('NewEndDate', '<', $date)
                ->count();
            if($model->AmountNews > 0){
                $Models[] = $model;
            }
        }
        return $Models;
    }
    function ReportOnNews()
    {
        $newsData = DB::table('transactionNews')
            ->select(
                'transactionNews.id',
                'transactionNews.TransactionType',
                'transactionNews.TransactionYear',
                'transactionNews.Created_at',
                'transactionNews.Created_by',
                'transactionNews.IsActive',
                'transactionNews.IsApprove',
            )
            ->groupBy('transactionNews.TransactionYear')
            ->get();
        $Models = [];
        foreach ($newsData as $index => $val) {
           
            $today = date('Y-m-d');
            $date = (date('Y') < 2500) ? $today : date('Y-m-d', strtotime('-543 years', strtotime($today)));

            $model = new stdClass();
            $model->TransactionYear = $val->TransactionYear;

            $model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('NewStartDate', '<', $date)
                ->count();

            $model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('NewStartDate', '<', $date)
                ->count();

            $model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $val->TransactionYear)
                ->where('IsActive', 1)
                ->where('NewStartDate', '<', $date)
                ->where('NewEndDate', '>', $date)
                ->count();
            if($model->AmountNews > 0){
                $Models[] = $model;
            }
        }
        return $Models;
    }
    function getTransactionNewsReportCreatorMostNewsBy(Request $request){
        $TransactionYear = $request['TransactionYear']; 
        $months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        $Models = [];

        for ($i = 1; $i <= 12; $i++) {
            $Y = $TransactionYear;
            $Model = new stdClass();
            $Model->TransactionYear = $TransactionYear;
            $Tran = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->groupBy('Created_by')
                ->selectRaw('COUNT(*) as Count, MAX(Created_by) as Created_by')
                ->get();

            $TranMax = $Tran->sortByDesc('Count')->pluck('Created_by')->first();

            $Model->TransactionYear = $TransactionYear;

            $Model->fullName = DB::table('user')
                ->where('cmsUserId', $TranMax)
                ->select(DB::raw('CONCAT(FirstName, " ", LastName) as fullName'))
                ->first()->fullName;

            $Model->Month = $months[$i - 1];

            $Model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountCreate = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->where('Created_by', $TranMax)
                ->whereMonth('Created_at', $i)
                ->count();
            $Models[] = $Model;
        }
        return $Models;
    }
    function getTransactionNewsReportTypeNewsByMonth(Request $request){
        $TransactionYear = $request['TransactionYear']; 
        $months = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน",
            "กรกฎาคม", "สิงหาคม", "กันยายน",
            "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
        ];
        $Models = [];

        for ($i = 1; $i <= 12; $i++) {
            $Y = $TransactionYear;
            $Model = new stdClass();

            $Model->TransactionYear = $TransactionYear;

            $Model->Month = $months[$i - 1];

            $Model->AmountMember = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 0)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Model->AmountPublic = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('TransactionType', 1)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();
            
            $Model->AmountNews = DB::table('transactionNews')
                ->where('TransactionYear', $Y)
                ->where('IsActive', 1)
                ->whereMonth('Created_at', $i)
                ->count();

            $Models[] = $Model;
        }
        return $Models;
    }
    
}
