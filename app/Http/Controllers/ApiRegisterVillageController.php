<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use \stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobMail;
use Exception;
class ApiRegisterVillageController extends Controller
{
    function saveRegisterVillage(Request $request)
    {
        $VillageDbd = $request['VillageDbd'];
        $VillageName = $request['VillageName'];
        $VillageAddress = $request['VillageAddress'];
        $VillageMoo = $request['VillageMoo'];
        $VillageProvinceId = $request['VillageProvinceId'];
        $VillageDistrictId = $request['VillageDistrictId'];
        $VillageSubDistrictId = $request['VillageSubDistrictId'];
        $VillagePostCode = $request['VillagePostCode'];
        $VillageCodeText = $request['VillageCodeText'];
        $VillageBdbCode = $request['VillageBdbCode'];
        $Phone = $request['Phone'];
        $Email = $request['Email'];
        $DbdDate = $request['DbdDate'];


        $UserId = CRUDBooster::myId();
        $UserData = DB::table('user')->select('orgProvinceId')->where('cmsUserId', $UserId)->first();
        $UserOrgProvinceId = $UserData->orgProvinceId;
        DB::beginTransaction();
        try {
            $DataTransReqVillage = [];
            $DataTransReqVillage['UserId'] = CRUDBooster::myId();
            $DataTransReqVillage['TransactionType'] = 1;
            $DataTransReqVillage['TransactionYear'] = date('Y') + 543;
            $DataTransReqVillage['StatusId'] = 3;
            $DataTransReqVillage['CreatedAt'] = date('Y-m-d H:i:s');
            $DataTransReqVillage['CreatedBy'] = CRUDBooster::myId();
            $DataTransReqVillage['OrgProvinceId'] = $UserOrgProvinceId;
            $DataTransReqVillageId = DB::table('transactionReqVillage')->insertGetId($DataTransReqVillage);
            if ($DataTransReqVillageId) {

                $DataTransVillage = [];
                $DataTransVillage['TransactionReqId'] = $DataTransReqVillageId;
                $DataTransVillage['UserId'] = CRUDBooster::myId();
                $DataTransVillage['VillageDbd'] = $VillageDbd;
                $DataTransVillage['VillageName'] = $VillageName;
                $DataTransVillage['VillageAddress'] = $VillageAddress;
                $DataTransVillage['VillageMoo'] = $VillageMoo;
                $DataTransVillage['VillageProvinceId'] = $VillageProvinceId;
                $DataTransVillage['VillageDistrictId'] = $VillageDistrictId;
                $DataTransVillage['VillageSubDistrictId'] = $VillageSubDistrictId;
                $DataTransVillage['VillagePostCode'] = $VillagePostCode;
                $DataTransVillage['VillageCodeText'] = $VillageCodeText;
                $DataTransVillage['VillageBdbCode'] = $VillageBdbCode;
                $DataTransVillage['Phone'] = $Phone;
                $DataTransVillage['Email'] = $Email;
                $DataTransVillage['DbdDate'] = $DbdDate;
                $DataTransVillage['VillageStartDate'] = $DbdDate;
                $DataTransVillage['VillageEndDate'] = (new FunctionController)->calculateEndDate($DbdDate, 1);
                $DataTransVillage['IsActive'] = 1;
                $DataTransVillage['OrgProvinceId'] = $UserOrgProvinceId;

                $DataTransVillage = DB::table('transactionVillage')->insertGetId($DataTransVillage);
                if ($DataTransVillage) {
                    DB::commit();
                    $data['api_status'] = 1;
                    $data['api_message'] = 'Success';
                    $data['id'] = $DataTransVillage;
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
    function editRegisterVillage(Request $request)
    {
        $TransactionRequestId = $request['TransactionRequestId'];
        $VillageDbd = $request['VillageDbd'];
        $VillageName = $request['VillageName'];
        $VillageAddress = $request['VillageAddress'];
        $VillageMoo = $request['VillageMoo'];
        $VillageProvinceId = $request['VillageProvinceId'];
        $VillageDistrictId = $request['VillageDistrictId'];
        $VillageSubDistrictId = $request['VillageSubDistrictId'];
        $VillagePostCode = $request['VillagePostCode'];
        $VillageCodeText = $request['VillageCodeText'];
        $VillageBdbCode = $request['VillageBdbCode'];
        $Phone = $request['Phone'];
        $Email = $request['Email'];
        $DbdDate = $request['DbdDate'];
        DB::beginTransaction();
        try {
            $DataUpdateTransReqVillage = [];
            $DataUpdateTransReqVillage['UpdatedAt'] = date('Y-m-d H:i:s');
            $DataUpdateTransReqVillage['UpdatedBy'] = CRUDBooster::myId();
            $DataUpdateTransReqVillageId = DB::table('transactionReqVillage')->where('id', $TransactionRequestId)->update($DataUpdateTransReqVillage);

            $DataUpdateTransVillage = [];
            $DataUpdateTransVillage['VillageDbd'] = $VillageDbd;
            $DataUpdateTransVillage['VillageName'] = $VillageName;
            $DataUpdateTransVillage['VillageAddress'] = $VillageAddress;
            $DataUpdateTransVillage['VillageMoo'] = $VillageMoo;
            $DataUpdateTransVillage['VillageProvinceId'] = $VillageProvinceId;
            $DataUpdateTransVillage['VillageDistrictId'] = $VillageDistrictId;
            $DataUpdateTransVillage['VillageSubDistrictId'] = $VillageSubDistrictId;
            $DataUpdateTransVillage['VillagePostCode'] = $VillagePostCode;
            $DataUpdateTransVillage['VillageCodeText'] = $VillageCodeText;
            $DataUpdateTransVillage['VillageBdbCode'] = $VillageBdbCode;
            $DataUpdateTransVillage['Phone'] = $Phone;
            $DataUpdateTransVillage['Email'] = $Email;
            $DataUpdateTransVillage['DbdDate'] = $DbdDate; //2024-01-01;
            $DataUpdateTransVillage['VillageStartDate'] = $DbdDate;
            $DataUpdateTransVillage['VillageEndDate'] = (new FunctionController)->calculateEndDate($DbdDate, 1);
            $DataUpdateTransVillage['UpdatedAt'] = date('Y-m-d');
            $DataUpdateTransVillage['UpdatedBy'] = CRUDBooster::myId();
            $DataUpdateTransVillageId = DB::table('transactionVillage')->where('transactionVillage.TransactionReqId', $TransactionRequestId)->update($DataUpdateTransVillage);
            if ($DataUpdateTransVillageId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $DataUpdateTransVillageId;
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
    function saveMemberVillage(Request $request)
    {
        $TransactionVillageId = $request['TransactionVillageId'];
        $NoCitizenId = $request['NoCitizenId'];
        $CitizenId = $request['CitizenId'];
        $MemberFirstName = $request['MemberFirstName'];
        $MemberLastName = $request['MemberLastName'];
        $GenderId = $request['GenderId'];
        $NoBirthDate = $request['NoBirthDate'];
        $MemberBirthDate = $request['MemberBirthDate'];  //2024-01-01;
        $Age = (new FunctionController)->calculateAge($MemberBirthDate);
        $MemberPhone = $request['MemberPhone'];
        $MemberOccupationId = $request['MemberOccupationId'];
        $MemberAddress = $request['MemberAddress'];
        $MemberPositionId = $request['MemberPositionId'];
        $MemberStatusId = $request['MemberStatusId'];
        $Connection = $request['Connection'];
        $MemberOffComment = $request['MemberOffComment'];
        $MemberOccupationOther = $request['MemberOccupationOther'];
        $UserId =  CRUDBooster::myId();
        $VillageId = $request['VillageId'];
        $MemberCode = $request['MemberCode'];
        DB::beginTransaction();
        try {
            $DataTransMemberVillage = [];
            $DataTransMemberVillage['TransactionVillageId'] = $TransactionVillageId;
            if ($VillageId != 0) {
                $DataTransMemberVillage['VillageId'] = $VillageId;
            }
            $DataTransMemberVillage['MemberCode'] = $MemberCode;
            $DataTransMemberVillage['NoCitizenId'] = $NoCitizenId;
            if ($NoCitizenId != 0) {
                $DataTransMemberVillage['CitizenId'] = $CitizenId;
            }
            $DataTransMemberVillage['MemberFirstName'] = $MemberFirstName;
            $DataTransMemberVillage['MemberLastName'] = $MemberLastName;
            $DataTransMemberVillage['GenderId'] = $GenderId;
            $DataTransMemberVillage['NoBirthDate'] = $NoBirthDate;
            if ($NoBirthDate != 0) {
                $DataTransMemberVillage['Age'] = $Age;
                $DataTransMemberVillage['MemberBirthDate'] = $MemberBirthDate;
            }
            $DataTransMemberVillage['MemberPhone'] = $MemberPhone;
            $DataTransMemberVillage['MemberOccupationId'] = $MemberOccupationId;
            $DataTransMemberVillage['MemberAddress'] = $MemberAddress;
            $DataTransMemberVillage['MemberPositionId'] = $MemberPositionId;
            $DataTransMemberVillage['MemberStatusId'] = $MemberStatusId;
            $DataTransMemberVillage['Connection'] = $Connection;
            if ($MemberStatusId == 2) {
                $DataTransMemberVillage['MemberOffComment'] = $MemberOffComment;
            }
            if ($MemberOccupationOther) {
                $DataTransMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
            }
            if ($UserId) {
                $DataTransMemberVillage['UserId'] = $UserId;
                $DataTransMemberVillage['MemberStatusApprove'] = 0;
            }
            $DataTransMemberVillage['MemberStatusApprove'] = 1;
            $DataTransMemberVillage['MemberRenewal'] = 0;
            $DataTransMemberVillage['IsActive'] = 1;
            $DataTransMemberVillage['MemberDate'] = date('Y-m-d');
            $DataTransMemberVillage['MemberEndDate'] = (new FunctionController)->calculateEndDate($DataTransMemberVillage['MemberDate'], 2);
            $DataTransMemberVillage['CreatedAt'] =  date('Y-m-d');
            $DataTransMemberVillage['CreatedBy'] =  20; //CRUDBooster::myId();

            $DataTransMemberVillageId = DB::table('transactionMemberVillage')->insertGetId($DataTransMemberVillage);
            if ($DataTransMemberVillageId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $DataTransMemberVillageId;
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
    function editMemberVillage(Request $request)
    {
        $MemberVillageId = $request['MemberVillageId'];
        $TransactionVillageId = $request['TransactionVillageId'];
        $NoCitizenId = $request['NoCitizenId'];
        $CitizenId = $request['CitizenId'];
        $MemberFirstName = $request['MemberFirstName'];
        $MemberLastName = $request['MemberLastName'];
        $GenderId = $request['GenderId'];
        $NoBirthDate = $request['NoBirthDate'];
        $MemberBirthDate = $request['MemberBirthDate'];  //2024-01-01;
        $Age = (new FunctionController)->calculateAge($MemberBirthDate);
        $Phone = $request['Phone'];
        $MemberOccupationId = $request['MemberOccupationId'];
        $MemberAddress = $request['MemberAddress'];
        $MemberPositionId = $request['MemberPositionId'];
        $MemberStatusId = $request['MemberStatusId'];
        $Connection = $request['Connection'];
        $MemberOffComment = $request['MemberOffComment'];
        $MemberOccupationOther = $request['MemberOccupationOther'];
        $UserId =  CRUDBooster::myId();
        $VillageId = $request['VillageId'];
        $MemberCode = $request['MemberCode'];
        DB::beginTransaction();
        try {
            $UpdateDataMemberVillage = [];
            $UpdateDataMemberVillage['TransactionVillageId'] = $TransactionVillageId;
            if ($VillageId != 0) {
                $UpdateDataMemberVillage['VillageId'] = $VillageId;
            }
            $UpdateDataMemberVillage['MemberCode'] = $MemberCode;
            $UpdateDataMemberVillage['NoCitizenId'] = $NoCitizenId;
            if ($NoCitizenId != 0) {
                $UpdateDataMemberVillage['CitizenId'] = $CitizenId;
            }
            $UpdateDataMemberVillage['MemberFirstName'] = $MemberFirstName;
            $UpdateDataMemberVillage['MemberLastName'] = $MemberLastName;
            $UpdateDataMemberVillage['GenderId'] = $GenderId;
            $UpdateDataMemberVillage['NoBirthDate'] = $NoBirthDate;
            if ($NoBirthDate != 0) {
                $UpdateDataMemberVillage['Age'] = $Age;
                $UpdateDataMemberVillage['MemberBirthDate'] = $MemberBirthDate;
            }
            $UpdateDataMemberVillage['Phone'] = $Phone;
            $UpdateDataMemberVillage['MemberOccupationId'] = $MemberOccupationId;
            $UpdateDataMemberVillage['MemberAddress'] = $MemberAddress;
            $UpdateDataMemberVillage['MemberPositionId'] = $MemberPositionId;
            $UpdateDataMemberVillage['MemberStatusId'] = $MemberStatusId;
            $UpdateDataMemberVillage['Connection'] = $Connection;
            if ($MemberStatusId == 2) {
                $UpdateDataMemberVillage['MemberOffComment'] = $MemberOffComment;
            }
            if ($MemberOccupationOther) {
                $UpdateDataMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
            }
            if ($UserId) {
                $UpdateDataMemberVillage['UserId'] = $UserId;
                $UpdateDataMemberVillage['MemberStatusApprove'] = 0;
            }
            $UpdateDataMemberVillage['MemberStatusApprove'] = 1;
            $UpdateDataMemberVillage['MemberRenewal'] = 0;
            $UpdateDataMemberVillage['IsActive'] = 1;
            $UpdateDataMemberVillage['MemberDate'] = date('Y-m-d');
            $UpdateDataMemberVillage['MemberEndDate'] = (new FunctionController)->calculateEndDate($UpdateDataMemberVillage['MemberDate'], 2);
            $UpdateDataMemberVillage['UpdatedAt'] =  date('Y-m-d');
            $UpdateDataMemberVillage['UpdatedBy'] =  20; //CRUDBooster::myId();

            $UpdateDataMemberVillageId = DB::table('transactionMemberVillage')->where('id', $MemberVillageId)->update($UpdateDataMemberVillage);
            if ($UpdateDataMemberVillageId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $UpdateDataMemberVillageId;
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
    function deleteMemberInVallage(Request $request)
    {
        $MemberVillageId = $request['MemberVillageId'];
        DB::beginTransaction();
        try {
            $UpdateMemberVillage = [];
            $UpdateMemberVillage['IsActive'] = 0;

            $UpdateMemberVillage['UpdatedAt'] =  date('Y-m-d');
            $UpdateMemberVillage['UpdatedBy'] =  20; //CRUDBooster::myId();

            $UpdateMemberVillageId = DB::table('transactionMemberVillage')->where('id', $MemberVillageId)->update($UpdateMemberVillage);
            if ($UpdateMemberVillageId) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $UpdateMemberVillageId;
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
    function getVillage()
    {
        $Data = [];
        $getCmsUser = DB::table('cms_users')->where('id', CRUDBooster::myId())->first();
        $VillageData = DB::table('transactionVillage')
            ->leftjoin('systemProvinces', 'systemProvinces.id', 'transactionVillage.VillageProvinceId')
            ->leftjoin('systemAmphures', 'systemAmphures.id', 'transactionVillage.VillageDistrictId')
            ->leftjoin('systemTambons', 'systemTambons.id', 'transactionVillage.VillageSubDistrictId')
            ->leftjoin('transactionReqVillage', 'transactionReqVillage.id', 'transactionVillage.TransactionReqId')
            ->select(
                'transactionVillage.id',
                'transactionVillage.VillageDbd',
                'transactionVillage.VillageName',
                'transactionVillage.VillageAddress',
                'transactionVillage.VillageMoo',
                'transactionVillage.VillageProvinceId',
                'transactionVillage.VillageDistrictId',
                'transactionVillage.VillageSubDistrictId',
                'transactionVillage.VillagePostCode',
                'transactionVillage.Phone',
                'transactionVillage.Email',
                'transactionVillage.DbdDate',
                'transactionVillage.VillageStartDate',
                'transactionVillage.VillageEndDate',
                'transactionVillage.OrgProvinceId',
                'transactionVillage.VillageCodeText',
                'transactionVillage.VillageBdbCode',
                'transactionVillage.IsActive',
                'systemProvinces.name_th as ProvincesName',
                'systemAmphures.name_th as AmphuresName',
                'systemTambons.name_th as TambonsName',
                'systemTambons.zip_code as ZipCode',
                'transactionReqVillage.StatusId as StatusId',
            )
            ->where('transactionVillage.UserId', CRUDBooster::myId())  //CRUDBooster::myId();
            ->where('transactionVillage.IsActive', 1)
            ->where('transactionReqVillage.StatusId', 3)
            ->get();
        // $AccountBankData = DB::table('accountBookBank')
        // ->leftjoin('accountBankMaster', 'accountBankMaster.id', 'accountBookBank.BankMasterId')
        // ->leftjoin('transactionFileBookbank', 'transactionFileBookbank.bookbank_id', 'accountBookBank.id')
        // ->select('accountBookBank.id',
        //     'accountBookBank.BankMasterId',
        //     'accountBookBank.BookBankNumber',
        //     'accountBookBank.BookBankName',
        //     'accountBookBank.created_by',
        //     'accountBookBank.WithdrawName',
        //     'accountBookBank.WithdrawName2',
        //     'accountBookBank.WithdrawName3',
        //     'accountBookBank.WithdrawName4',
        //     'accountBookBank.WithdrawName5',
        //     'accountBankMaster.BankCode',
        //     'accountBankMaster.BankName',
        //     'accountBankMaster.BankShortName',
        //     'transactionFileBookbank.FilePath',
        //     'transactionFileBookbank.FileName'
        // )
        // ->where('accountBookBank.OrgId',$getCmsUser->orgId) //CRUDBooster::myId();
        // ->where('accountBookBank.is_active', 1)
        // ->get();
        // $Data['Village']=$VillageData;
        // $Data['AccountBankData']=$AccountBankData;
        return $VillageData;
    }
    function getVillageById($VillageId)
    {
        $Data = [];
        $VillageData = DB::table('transactionVillage')
            ->leftjoin('transactionReqVillage', 'transactionReqVillage.id', 'transactionVillage.TransactionReqId')
            ->select(
                'transactionVillage.id',
                'transactionVillage.TransactionReqId',
                'transactionVillage.VillageDbd',
                'transactionVillage.VillageName',
                'transactionVillage.VillageAddress',
                'transactionVillage.VillageMoo',
                'transactionVillage.VillageProvinceId',
                'transactionVillage.VillageDistrictId',
                'transactionVillage.VillageSubDistrictId',
                'transactionVillage.VillagePostCode',
                'transactionVillage.Phone',
                'transactionVillage.Email',
                'transactionVillage.DbdDate',
                'transactionVillage.VillageStartDate',
                'transactionVillage.VillageEndDate',
                'transactionVillage.OrgProvinceId',
                'transactionVillage.VillageCodeText',
                'transactionVillage.VillageBdbCode',
                'transactionVillage.IsActive',
                'transactionReqVillage.StatusId as StatusId',
            )
            ->where('transactionVillage.id', $VillageId)
            ->where('transactionVillage.UserId', CRUDBooster::myId())  //CRUDBooster::myId();
            ->where('transactionVillage.IsActive', 1)
            ->where('transactionReqVillage.StatusId', 3)
            ->first();
        return $VillageData;
    }
    function getMemberVillage($TransactionVillageId)
    {
        $VillageMemberData = DB::table('transactionMemberVillage')
            // ->leftjoin('systemGender', 'systemGender.id', 'transactionMemberVillage.GenderId')
            ->select(
                'transactionMemberVillage.id',
                'transactionMemberVillage.MemberCode',
                'transactionMemberVillage.CitizenId',
                'transactionMemberVillage.MemberFirstName',
                'transactionMemberVillage.MemberLastName',
                'transactionMemberVillage.GenderId',
                'transactionMemberVillage.Age',
                'transactionMemberVillage.Phone',
                'transactionMemberVillage.MemberOccupationId',
                'transactionMemberVillage.MemberAddress',
                'transactionMemberVillage.MemberPositionId',
                'transactionMemberVillage.MemberStatusId',
                'transactionMemberVillage.MemberOffComment',
                'transactionMemberVillage.Connection',
                'transactionMemberVillage.MemberOccupationOther',
                'transactionMemberVillage.NoCitizenId',
                'transactionMemberVillage.NoBirthDate',
                'transactionMemberVillage.MemberStatusApprove',
                'transactionMemberVillage.MemberDate',
                'transactionMemberVillage.MemberEndDate',
                'transactionMemberVillage.MemberBirthDate',

                // 'systemGender.GenderName'
            )
            ->where('transactionMemberVillage.TransactionVillageId', $TransactionVillageId)  //CRUDBooster::myId();
            ->where('transactionMemberVillage.IsActive', 1)
            ->get();
        return $VillageMemberData;
    }
    function getGenderApi()
    {

        $genderData = DB::table('systemGender')
            ->select(
                'systemGender.id',
                'systemGender.GenderName',
            )
            ->get();
        $data['data'] = $genderData;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
    function getOccupationApi()
    {

        $OccupationData = DB::table('systemOccupationMaster')
            ->select(
                'systemOccupationMaster.id',
                'systemOccupationMaster.Name',
            )
            ->get();
        $data['data'] = $OccupationData;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
    function getMemberPositionApi()
    {

        $OccupationData = DB::table('systemMemberPosition')
            ->select(
                'systemMemberPosition.id',
                'systemMemberPosition.PositionNameTh',
            )
            ->get();
        $data['data'] = $OccupationData;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
    function getMemberStatusApi()
    {

        $OccupationData = DB::table('systemMemberStatus')
            ->select(
                'systemMemberStatus.id',
                'systemMemberStatus.StatusName',
            )
            ->get();
        $data['data'] = $OccupationData;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';
        response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }

    function saveRegisterVillageAll(Request $request)
    {
        $IDCard = $request['IDCard'];
        $FirstName = $request['FirstName'];
        $LastName = $request['LastName'];
        $Username = $request['Username'];
        $UserEmail = $request['UserEmail'];
        $OrgStructure = $request['OrgStructure'];
        $OrgStructureProvince = $request['OrgStructureProvince'];
        $VillageCodeText = $request['VillageCodeText'];
        $VillageDbd = $request['VillageDbd'];
        $VillageBdbCode = $request['VillageBdbCode'];
        $VillageName = $request['VillageName'];
        $VillagePhone = $request['VillagePhone'];
        $VillageEmail = $request['VillageEmail'];
        $VillageDbdDate = $request['VillageDbdDate'];
        $VillageAddress = $request['VillageAddress'];
        $VillageMoo = $request['VillageMoo'];
        $VillageProvinceId = $request['VillageProvinceId'];
        $VillageDistrictId = $request['VillageDistrictId'];
        $VillageSubDistrictId = $request['VillageSubDistrictId'];
        $VillagePostCode = $request['VillagePostCode'];
        $ArrayBookbank = $request['ArrayBookbank'];
        $ArrayMember = $request['ArrayMember'];
        $VillageFile = $request['VillageFile'];
        $OrgData = DB::table('systemOrgStructureProvince')->where('id', $OrgStructureProvince)->first();
        $OrgId = $OrgData->orgId;
        $array_file = [];
        DB::beginTransaction();
        try {
            $existingEmail = DB::table('cms_users')->where('email', $UserEmail)->exists();
            if (!$existingEmail) {

                $cmsUserData = [];
                $cmsUserData['name'] = $Username;
                $cmsUserData['email'] = $UserEmail;
                $cmsUserData['orgId'] = $OrgId;
                $cmsUserData['id_cms_privileges'] = 1;
                $cmsUserData['created_at'] = date('Y-m-d H:i:s');
                $cmsUserData['status'] = 'Active';
                $userCmsID = DB::table('cms_users')->insertGetId($cmsUserData);

                if ($userCmsID) {

                    $userData = [];
                    $userData['idCard'] = $IDCard;
                    $userData['cmsUserId'] = $userCmsID;
                    $userData['firstName'] = $FirstName;
                    $userData['lastName'] = $LastName;
                    $userData['email'] = $UserEmail;
                    $userData['orgProvinceId'] = $OrgStructureProvince;
                    $userData['is_active'] = 1;
                    $userData['created_at'] = date('Y-m-d H:i:s');
                    $userData['created_by'] = $userCmsID;
                    $userID = DB::table('user')->insertGetId($userData);

                    if ($userID) {
                        $DataTransReqVillage = [];
                        $DataTransReqVillage['UserId'] = $userCmsID;
                        $DataTransReqVillage['TransactionType'] = 1;
                        $DataTransReqVillage['TransactionYear'] = date('Y') + 543;
                        $DataTransReqVillage['StatusId'] = 3;
                        $DataTransReqVillage['CreatedAt'] = date('Y-m-d H:i:s');
                        $DataTransReqVillage['CreatedBy'] = $userCmsID;
                        $DataTransReqVillage['OrgProvinceId'] = $OrgStructureProvince;

                        $DataTransReqVillageId = DB::table('transactionReqVillage')->insertGetId($DataTransReqVillage);
                        if ($DataTransReqVillageId) {

                            $DataTransVillage = [];
                            $DataTransVillage['TransactionReqId'] = $DataTransReqVillageId;
                            $DataTransVillage['UserId'] = $userCmsID;
                            $DataTransVillage['VillageDbd'] = $VillageDbd;
                            $DataTransVillage['VillageName'] = $VillageName;
                            $DataTransVillage['VillageAddress'] = $VillageAddress;
                            $DataTransVillage['VillageMoo'] = $VillageMoo;
                            $DataTransVillage['VillageProvinceId'] = $VillageProvinceId;
                            $DataTransVillage['VillageDistrictId'] = $VillageDistrictId;
                            $DataTransVillage['VillageSubDistrictId'] = $VillageSubDistrictId;
                            $DataTransVillage['VillagePostCode'] = $VillagePostCode;
                            $DataTransVillage['VillageCodeText'] = $VillageCodeText;
                            $DataTransVillage['VillageBdbCode'] = $VillageBdbCode;
                            $DataTransVillage['Phone'] = $VillagePhone;
                            $DataTransVillage['Email'] = $VillageEmail;
                            $DataTransVillage['DbdDate'] = $VillageDbdDate;
                            $DataTransVillage['VillageStartDate'] = $VillageDbdDate;
                            $DataTransVillage['VillageEndDate'] = (new FunctionController)->calculateEndDate($VillageDbdDate, 1);
                            $DataTransVillage['IsActive'] = 1;
                            $DataTransVillage['OrgProvinceId'] = $OrgStructureProvince;

                            $DataTransVillageId = DB::table('transactionVillage')->insertGetId($DataTransVillage);
                            if ($DataTransVillageId) {

                                foreach ($ArrayBookbank as $item) {
                                    $decodedItem = json_decode($item, true);

                                    $BankMasterId = $decodedItem['BankMasterId'];
                                    $BookBankName = $decodedItem['BookBankName'];
                                    $BookBankNumber = $decodedItem['BookBankNumber'];
                                    $WithdrawName = $decodedItem['WithdrawName'];
                                    $WithdrawName2 = $decodedItem['WithdrawName2'];
                                    $WithdrawName3 = $decodedItem['WithdrawName3'];
                                    $WithdrawName4 = $decodedItem['WithdrawName4'];
                                    $WithdrawName5 = $decodedItem['WithdrawName5'];
                                    $Files = $decodedItem['Files'];

                                    $dataInsertBankMaster = [];
                                    $dataInsertBankMaster['OrgId'] = $OrgStructure;
                                    $dataInsertBankMaster['BookBankNumber'] = $BookBankNumber;
                                    $dataInsertBankMaster['BookBankName'] = $BookBankName;
                                    $dataInsertBankMaster['BankMasterId'] = $BankMasterId;
                                    $dataInsertBankMaster['WithdrawName'] = $WithdrawName;
                                    $dataInsertBankMaster['WithdrawName2'] = $WithdrawName2;
                                    $dataInsertBankMaster['WithdrawName3'] = $WithdrawName3;
                                    $dataInsertBankMaster['WithdrawName4'] = $WithdrawName4;
                                    $dataInsertBankMaster['WithdrawName5'] = $WithdrawName5;
                                    $dataInsertBankMaster['is_active'] = 1;
                                    $dataInsertBankMaster['created_at'] = date('Y-m-d H:i:s');
                                    $dataInsertBankMaster['created_by'] = $userCmsID;
                                    $accountBookBankId = DB::table('accountBookBank')->insertGetId($dataInsertBankMaster);
                                    if($accountBookBankId){
                                        $dataInsertFile = [];
                                        $dataInsertFile['bookbank_id'] = $accountBookBankId;
                                        $dataInsertFile['TransactionYear'] = date('Y') + 543;
                                        foreach ($Files as $index => $val) {
                                            $dataInsertFile['FileName'] = $val->getClientOriginalName();
                                            $dataInsertFile['FilePath'] = "uploads/" . $val->getClientOriginalName();
                                        }
                                        $transactionFileId = DB::table('transactionFileBookbank')->insertGetId($dataInsertFile);
                                    }else{
                                        DB::rollback();
                                        $data['api_status'] = 0;
                                        $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                                        return response()->json($data, 200);
                                    }
                                }

                                $sequenceNumber = 1;
                                foreach ($ArrayMember as $member) {
                                    $decodedMember = json_decode($member, true);
                                    $MemberCode = $VillageCodeText * 1000 + $sequenceNumber;
                                    $sequenceNumber++;

                                    $TransactionVillageId = $DataTransVillageId;
                                    $NoCitizenId = $decodedMember['NoCitizenId'];
                                    $CitizenId = $decodedMember['CitizenId'];
                                    $MemberFirstName = $decodedMember['MemberFirstName'];
                                    $MemberLastName = $decodedMember['MemberLastName'];
                                    $GenderId = $decodedMember['GenderId'];
                                    $NoBirthDate = $decodedMember['NoBirthDate'];
                                    $MemberBirthDate = $decodedMember['MemberBirthDate'];  //2024-01-01;
                                    $Age = (new FunctionController)->calculateAge($MemberBirthDate);
                                    $MemberPhone = $decodedMember['MemberPhone'];
                                    $MemberOccupationId = $decodedMember['MemberOccupationId'];
                                    $MemberAddress = $decodedMember['MemberAddress'];
                                    $MemberPositionId = $decodedMember['MemberPositionId'];
                                    $MemberStatusId = $decodedMember['MemberStatusId'];
                                    $Connection = $decodedMember['Connection'];

                                    // $UserId =  $userCmsID;
                                    // $MemberOffComment = $request['MemberOffComment'];
                                    // $MemberOccupationOther = $request['MemberOccupationOther'];
                             
                                    // if ($VillageId != 0) {
                                    //     $DataTransMemberVillage['VillageId'] = $VillageId;
                                    // }
                                    // if ($MemberStatusId == 2) {
                                    //     $DataTransMemberVillage['MemberOffComment'] = $MemberOffComment;
                                    // }
                                    // if ($MemberOccupationOther) {
                                    //     $DataTransMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
                                    // }
                                    // if ($UserId) {
                                    //     $DataTransMemberVillage['UserId'] = $UserId;
                                    //     $DataTransMemberVillage['MemberStatusApprove'] = 0;
                                    // }
                                    $DataTransMemberVillage = [];
                                    $DataTransMemberVillage['TransactionVillageId'] = $TransactionVillageId;
                                    $DataTransMemberVillage['MemberCode'] = $MemberCode;
                                    $DataTransMemberVillage['NoCitizenId'] = $NoCitizenId;
                                    if ($NoCitizenId != 0) {
                                        $DataTransMemberVillage['CitizenId'] = $CitizenId;
                                    }
                                    $DataTransMemberVillage['MemberFirstName'] = $MemberFirstName;
                                    $DataTransMemberVillage['MemberLastName'] = $MemberLastName;
                                    $DataTransMemberVillage['GenderId'] = $GenderId;
                                    $DataTransMemberVillage['NoBirthDate'] = $NoBirthDate;
                                    if ($NoBirthDate != 0) {
                                        $DataTransMemberVillage['Age'] = $Age;
                                        $DataTransMemberVillage['MemberBirthDate'] = $MemberBirthDate;
                                    }
                                    $DataTransMemberVillage['Phone'] = $MemberPhone;
                                    $DataTransMemberVillage['MemberOccupationId'] = $MemberOccupationId;
                                    $DataTransMemberVillage['MemberAddress'] = $MemberAddress;
                                    $DataTransMemberVillage['MemberPositionId'] = $MemberPositionId;
                                    $DataTransMemberVillage['MemberStatusId'] = $MemberStatusId;
                                    $DataTransMemberVillage['Connection'] = $Connection;
                                    $DataTransMemberVillage['MemberStatusApprove'] = 1;
                                    $DataTransMemberVillage['MemberRenewal'] = 0;
                                    $DataTransMemberVillage['IsActive'] = 1;
                                    $DataTransMemberVillage['MemberDate'] = date('Y-m-d');
                                    $DataTransMemberVillage['MemberEndDate'] = (new FunctionController)->calculateEndDate($DataTransMemberVillage['MemberDate'], 2);
                                    $DataTransMemberVillage['CreatedAt'] =  date('Y-m-d');
                                    $DataTransMemberVillage['CreatedBy'] =  $userCmsID;

                                    $DataTransMemberVillageId = DB::table('transactionMemberVillage')->insertGetId($DataTransMemberVillage);
                                }
                                $dataInsertFileVillage = [];
                                $dataInsertFileVillage['TransactionVillageId'] = $DataTransVillageId;
                                $dataInsertFileVillage['VillageId'] =0;
                                $dataInsertFileVillage['VillageCode'] =0;
                                $dataInsertFileVillage['ApproveMark'] = 1;
                                $dataInsertFileVillage['TransactionYear'] = date('Y') + 543;;
                                foreach ($VillageFile as $index => $val) {
                                    $dataInsertFileVillage['FileName'] = $val->getClientOriginalName();
                                    $dataInsertFileVillage['FilePath'] = "uploads/" . $val->getClientOriginalName();
                                }
                                $dataInsertFileVillage['CreatedAt'] = date('Y-m-d');
                                $dataInsertFileVillage['CreatedBy'] = $userCmsID;
                                
                                $transactionFileId = DB::table('transactionFileVillage')->insertGetId($dataInsertFileVillage);
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
                } else {
                    DB::rollback();
                    $data['api_status'] = 0;
                    $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                    return response()->json($data, 200);
                }
            } else {
                DB::rollback();
                $data['api_status'] = 2;
                $data['api_message'] = 'ไม่สามารถใช้ email นี้ได้ เนื่องจากมี email นี้ในระบบแล้ว';
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
    function getApproveVillage()
    {
        $RequestVillage = DB::table('transactionVillage')
            ->leftjoin('transactionReqVillage','transactionReqVillage.id','transactionVillage.TransactionReqId')
            ->select(
                'transactionVillage.id',
                'transactionVillage.TransactionReqId',
                'transactionVillage.VillageCodeText', //รหัสกองทุนหมู่บ้าน
                'transactionVillage.VillageName', //ชื่อนิติบุคคล
                'transactionVillage.VillageDbd', //รหัสนิติบุคคล
                'transactionReqVillage.StatusId',
            )
            ->where('transactionReqVillage.StatusId',3)
            ->orderBy('transactionVillage.id')
            ->get();
        return $RequestVillage;
    }
    function getVillageDetail($id)
    {
        $VillageDetail = DB::table('transactionVillage')
            ->leftjoin('transactionReqVillage','transactionReqVillage.id','transactionVillage.TransactionReqId')
            ->leftjoin('systemProvinces','systemProvinces.id','transactionVillage.VillageProvinceId')
            ->leftjoin('systemAmphures','systemAmphures.id','transactionVillage.VillageDistrictId')
            ->leftjoin('systemTambons','systemTambons.id','transactionVillage.VillageSubDistrictId')
            ->select(
                'transactionVillage.id',
                'transactionVillage.TransactionReqId',
                'transactionVillage.VillageCodeText',
                'transactionVillage.VillageBdbCode',
                'transactionVillage.VillageDbd', 
                'transactionVillage.VillageName', 
                'transactionVillage.VillageAddress',
                'transactionVillage.VillageMoo',
                'transactionVillage.VillagePostCode',
                'transactionVillage.Phone as VillagePhone',
                'transactionVillage.Email as VillageEmail',
                'transactionVillage.DbdDate',
                'transactionVillage.VillageStartDate',
                'transactionVillage.VillageEndDate',
                'transactionVillage.OrgProvinceId',
                'systemProvinces.name_th as ProvinceName',
                'systemAmphures.name_th as AmphuresName',
                'systemTambons.name_th as TambonsName'
            )
            ->where('transactionVillage.IsActive',1)
            ->where('transactionVillage.id',$id)
            ->first();
        return $VillageDetail;
    }
    function getVillageMemberDetail($id)
    {
        $VillageMemberDetail = DB::table('transactionMemberVillage')
            ->leftjoin('systemMemberPosition','systemMemberPosition.id','transactionMemberVillage.MemberPositionId')
            ->leftjoin('systemMemberStatus','systemMemberStatus.id','transactionMemberVillage.MemberStatusId')
            ->select(
                'transactionMemberVillage.id',
                'transactionMemberVillage.TransactionVillageId',
                'transactionMemberVillage.MemberCode',
                'transactionMemberVillage.MemberFirstName', 
                'transactionMemberVillage.MemberLastName', 
                'transactionMemberVillage.MemberStatusId',
                'transactionMemberVillage.Connection',
                'transactionMemberVillage.MemberOffComment',
                'systemMemberPosition.PositionNameTh as PositionName',
                'systemMemberStatus.StatusName'
            )
            ->where('transactionMemberVillage.MemberStatusApprove',1)
            ->where('transactionMemberVillage.TransactionVillageId',$id)
            ->orderBy('transactionMemberVillage.id')
            ->get();
        return $VillageMemberDetail;
    }
    function getVillageFile($id)
    {
        $VillageFileDetail = DB::table('transactionFileVillage')
            ->select(
                'transactionFileVillage.id',
                'transactionFileVillage.FileName',
                'transactionFileVillage.FilePath',
                'transactionFileVillage.CreatedAt',
                
            )
            ->where('transactionFileVillage.TransactionVillageId',$id)
            ->orderBy('transactionFileVillage.id')
            ->get();
        return $VillageFileDetail;
    }
    function getVillageBank($id)
    {
        $VillageUserId = DB::table('transactionVillage')->select('transactionVillage.UserId')->where('transactionVillage.id',$id)->first();
        $VillageBankDetail = DB::table('accountBookBank')
            ->leftjoin('accountBankMaster','accountBankMaster.id','accountBookBank.BankMasterId')
            ->leftjoin('transactionFileBookbank','transactionFileBookbank.bookbank_id','accountBookBank.id')
            ->select(
                'accountBookBank.id',
                'accountBookBank.BookBankNumber',
                'accountBookBank.BookBankName',
                'accountBankMaster.BankName',
                'accountBankMaster.BankShortName',
                'transactionFileBookbank.FileName',
                'transactionFileBookbank.FilePath'
            )
            ->where('accountBookBank.created_by',$VillageUserId->UserId)
            ->orderBy('accountBookBank.id')
            ->get();
        return $VillageBankDetail;
    }
    function generateRandomPassword() {
        // Define
        $chars = '123456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
        $length = 8;

        // Get the number of characters in $chars
        $charLength = strlen($chars);
        $password = '';
    
        // Generate
        for ($i = 0; $i < $length; $i++) {
            $randomChar = $chars[mt_rand(0, $charLength - 1)];
            $password .= $randomChar;
        }
    
        return $password;
    }

    function approveVillage(Request $request)
    {
        $TransactionReqId = $request['TransactionReqId'];
        $ValueApprove = $request['ValueApprove'];
        $VillageComment = $request['VillageComment'];
        $VillageCommentFile = $request['VillageCommentFile'];
        $array_file = [];
        $randomPassword = $this->generateRandomPassword();
        DB::beginTransaction();
        try {
           if($ValueApprove == 1){
                $DataUpdateTransReqVillage = [];
                $DataUpdateTransReqVillage['StatusId'] = 1;
                $DataUpdateTransReqVillage['IsAlreadyCheck'] = 1;
                $DataUpdateTransReqVillage['ApproveDate'] = date('Y-m-d');
                $DataUpdateTransReqVillage['ApproveBy'] = CRUDBooster::myId();
                $DataUpdateTransReqVillageId = DB::table('transactionReqVillage')->where('id', $TransactionReqId)->update($DataUpdateTransReqVillage);
                if($DataUpdateTransReqVillageId){
                    $VillageData = DB::table('transactionVillage')
                    ->select(
                        'transactionVillage.id',
                        'transactionVillage.UserId',
                        'transactionVillage.TransactionReqId',
                        'transactionVillage.VillageCode',
                        'transactionVillage.VillageDbd',
                        'transactionVillage.VillageName',
                        'transactionVillage.VillageAddress',
                        'transactionVillage.VillageMoo',
                        'transactionVillage.VillageProvinceId',
                        'transactionVillage.VillageDistrictId',
                        'transactionVillage.VillageSubDistrictId',
                        'transactionVillage.VillagePostCode',
                        'transactionVillage.Phone',
                        'transactionVillage.Email',
                        'transactionVillage.DbdDate',
                        'transactionVillage.VillageStartDate',
                        'transactionVillage.VillageEndDate',
                        'transactionVillage.IsActive',
                        'transactionVillage.OrgProvinceId',
                        'transactionVillage.VillageCodeText',
                        'transactionVillage.VillageBdbCode',
                    )
                    ->where('transactionVillage.TransactionReqId',$TransactionReqId)
                    ->first();
                    $UserData = DB::table('cms_users')
                    ->select(
                        'cms_users.id',
                        'cms_users.name',
                        'cms_users.email',
                    )
                    ->where('cms_users.id',$VillageData->UserId)
                    ->first();
                    $DataUpdateUser = [];
                    $hashedPassword = \Hash::make($randomPassword);
                    $DataUpdateUser['password'] = $hashedPassword;
                    $DataUpdateUser['updated_at'] = date('Y-m-d');
                    $DataUpdateUserId = DB::table('cms_users')->where('id', $VillageData->UserId)->update($DataUpdateUser);
                    //=============AddVillage
                    $DataVillage = [];
                    $DataVillage['UserId'] = $VillageData->UserId;
                    $DataVillage['VillageDbd'] = $VillageData->VillageDbd;
                    $DataVillage['VillageName'] = $VillageData->VillageName;
                    $DataVillage['VillageAddress'] = $VillageData->VillageAddress;
                    $DataVillage['VillageMoo'] = $VillageData->VillageMoo;
                    $DataVillage['VillageProvinceId'] = $VillageData->VillageProvinceId;
                    $DataVillage['VillageDistrictId'] = $VillageData->VillageDistrictId;
                    $DataVillage['VillageSubDistrictId'] = $VillageData->VillageSubDistrictId;
                    $DataVillage['VillagePostCode'] = $VillageData->VillagePostCode;
                    $DataVillage['VillageCodeText'] = $VillageData->VillageCodeText;
                    $DataVillage['VillageBdbCode'] = $VillageData->VillageBdbCode;
                    $DataVillage['Phone'] = $VillageData->Phone;
                    $DataVillage['Email'] = $VillageData->Email;
                    $DataVillage['DbdDate'] = $VillageData->DbdDate;
                    $DataVillage['VillageStartDate'] = date('Y-m-d');
                    $DataVillage['VillageEndDate'] =(new FunctionController)->calculateEndDate($DataVillage['VillageStartDate'], 2);
                    $DataVillage['IsActive'] = 1;
                    $DataVillage['OrgProvinceId'] = $VillageData->OrgProvinceId;
                    $VillageId = DB::table('village')->insertGetId($DataVillage);
                    if($VillageId){

                        //=============AddMemberIntoVillage
                        $MemberData = DB::table('transactionMemberVillage')
                        ->select(
                            'transactionMemberVillage.id',
                            'transactionMemberVillage.MemberCode',
                            'transactionMemberVillage.CitizenId',
                            'transactionMemberVillage.MemberFirstName',
                            'transactionMemberVillage.MemberLastName',
                            'transactionMemberVillage.GenderId',
                            'transactionMemberVillage.Age',
                            'transactionMemberVillage.Phone',
                            'transactionMemberVillage.MemberOccupationId',
                            'transactionMemberVillage.MemberAddress',
                            'transactionMemberVillage.MemberPositionId',
                            'transactionMemberVillage.MemberStatusId',
                            'transactionMemberVillage.MemberOffComment',
                            'transactionMemberVillage.MemberRenewal',
                            'transactionMemberVillage.Connection',
                            'transactionMemberVillage.MemberOccupationOther',
                            'transactionMemberVillage.NoCitizenId',
                            'transactionMemberVillage.NoBirthDate',
                            'transactionMemberVillage.UserId',
                            'transactionMemberVillage.IsActive',
                            'transactionMemberVillage.MemberDate',
                            'transactionMemberVillage.MemberEndDate',
                            'transactionMemberVillage.MemberBirthDate',
                            'transactionMemberVillage.MemberDate',
                        )
                        ->where('transactionMemberVillage.TransactionVillageId',$VillageData->id)
                        ->get();
                        foreach ($MemberData as $member) {
                            $MemberCode = $member->MemberCode;
                            $CitizenId = $member->CitizenId;
                            $MemberFirstName = $member->MemberFirstName;
                            $MemberLastName = $member->MemberLastName;
                            $GenderId = $member->GenderId;
                            $Age = $member->Age;
                            $Phone = $member->Phone;
                            $OccupationId = $member->MemberOccupationId;
                            $Address = $member->MemberAddress;
                            $PositionId = $member->MemberPositionId;
                            $MemberStatusId = $member->MemberStatusId;
                            $MemberOffComment = $member->MemberOffComment;
                            $MemberRenewal = $member->MemberRenewal;
                            $Connection = $member->Connection;
                            $MemberOccupationOther = $member->MemberOccupationOther;
                            $NoCitizenId = $member->NoCitizenId;
                            $NoBirthDate = $member->NoBirthDate;
                            $UserId = $member->UserId;
                            $IsActive = $member->IsActive;
                            $MemberDate = $member->MemberDate;
                            $MemberEndDate = $member->MemberEndDate;
                            $MemberBirthDate = $member->MemberBirthDate;

                            $DataMemberVillage = [];
                            $DataMemberVillage['VillageId'] = $VillageId;
                            $DataMemberVillage['MemberCode'] = $MemberCode;
                            $DataMemberVillage['CitizenId'] = $CitizenId;
                            $DataMemberVillage['MemberFirstName'] = $MemberFirstName;
                            $DataMemberVillage['MemberLastName'] = $MemberLastName;
                            $DataMemberVillage['GenderId'] = $GenderId;
                            $DataMemberVillage['Age'] = $Age;
                            $DataMemberVillage['Phone'] = $Phone;
                            $DataMemberVillage['MemberOccupationId'] = $OccupationId;
                            $DataMemberVillage['MemberAddress'] = $Address;
                            $DataMemberVillage['MemberPositionId'] = $PositionId;
                            $DataMemberVillage['MemberStatusId'] = $MemberStatusId;
                            $DataMemberVillage['MemberOffComment'] = $MemberOffComment;
                            $DataMemberVillage['MemberRenewal'] = $MemberRenewal;
                            $DataMemberVillage['Connection'] = $Connection;
                            $DataMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
                            $DataMemberVillage['NoCitizenId'] = $NoCitizenId;
                            $DataMemberVillage['NoBirthDate'] = $NoBirthDate;
                            $DataMemberVillage['UserId'] = $UserId;
                            $DataMemberVillage['IsActive'] = $IsActive;
                            $DataMemberVillage['MemberDate'] = $MemberDate;
                            $DataMemberVillage['MemberEndDate'] = $MemberEndDate;
                            $DataMemberVillage['MemberBirthDate'] = $MemberBirthDate;
                            
                            $DataMemberVillage['CreatedAt'] =  date('Y-m-d');
                            $DataMemberVillage['CreatedBy'] =  CRUDBooster::myId();

                            $DataMemberVillageId = DB::table('memberVillage')->insertGetId($DataMemberVillage);
                        }
                        DB::commit();
                        $data['api_status'] = 1;
                        $data['api_message'] = 'Success';
                        $data['id'] = $VillageId;
                        $html_content = 
                            '<!DOCTYPE html>
                            <html>
                            <head>
                                <meta charset="utf-8">
                                <title>Welcome to Net!</title>
                            </head>
                            <body>
                                <p>เรียน '.$UserData -> name.'</p>
                                <p>
                                    อีเมลผู้ใช้ : '.$UserData -> email.'<br>
                                    รหัสผ่าน : '.$randomPassword.'
                                </p>
                                <span style="color:red;">* กองทุนของคุณรับการอนุมัติ</span><br>
                                
                                <p>หากท่านมีคำถามหรือต้องการความช่วยเหลือในการเข้าใช้งาน หรือมีข้อสงสัยใด ๆ เกี่ยวกับการใช้งานแอปพลิเคชัน หรือบริการอื่นๆ กรุณาติดต่อเราทางอีเมลที่ support@email.com</p>
                                <strong style="color: red;">อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ</strong>
                                <p>ขอแสดงความนับถือ,<br>
                                ทีมผู้ดูแล สทบ</p><br><br>
                            </body>
                            </html>'
                        ;
                        $object = new stdClass();
                        $object->email_content = $html_content;
                        Mail::to($UserData -> email)->send(new JobMail($object, "แจ้งข้อมูลสำหรับเข้าใช้งานระบบ สทบ. ของสมาชิก"));
                        return response()->json($data, 200)
                        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                    }
                }
           }else{
                $VillageData = DB::table('transactionVillage')
                    ->select(
                        'transactionVillage.UserId',
                    )
                    ->where('transactionVillage.TransactionReqId',$TransactionReqId)
                    ->first();
                $UserData = DB::table('cms_users')
                    ->select(
                        'cms_users.id',
                        'cms_users.name',
                        'cms_users.email',
                    )
                    ->where('cms_users.id',$VillageData->UserId)
                    ->first();
                $DataUpdateTransReqVillage = [];
                $DataUpdateTransReqVillage['StatusId'] = 2;
                $DataUpdateTransReqVillage['IsAlreadyCheck'] = 0;
                $DataUpdateTransReqVillage['ApproveDate'] = date('Y-m-d');
                $DataUpdateTransReqVillage['ApproveBy'] = CRUDBooster::myId();
                $DataUpdateTransReqVillageId = DB::table('transactionReqVillage')->where('id', $TransactionReqId)->update($DataUpdateTransReqVillage);
                if($DataUpdateTransReqVillageId){
                    $DataUpdateTransReqVillageComment = [];
                    $DataUpdateTransReqVillageComment['TransactionReqVillageId'] = $TransactionReqId;
                    $DataUpdateTransReqVillageComment['Comment'] = $VillageComment;
                    $DataUpdateTransReqVillageComment['CreatedAt'] = date('Y-m-d');
                    $DataUpdateTransReqVillageComment['CreatedBy'] = CRUDBooster::myId();
                    foreach ($VillageCommentFile as $index => $val) {
                        $DataUpdateTransReqVillageComment['FileName'] = $val->getClientOriginalName();
                        $DataUpdateTransReqVillageComment['FilePath'] = "uploads/" . $val->getClientOriginalName();
                    }
                    $transactionRequestVillageCommentId = DB::table('transactionReqVillageComment')->insertGetId($DataUpdateTransReqVillageComment);
                    if ($transactionRequestVillageCommentId) {
                        DB::commit();
                        $data['api_status'] = 1;
                        $data['api_message'] = 'Success';
                        $data['id'] = $transactionRequestVillageCommentId;
                        Storage::putFileAs('uploads/', $val, $val->getClientOriginalName());
                        array_push($array_file, $val->getClientOriginalName() . '.' . $val->getClientOriginalExtension());
                        $html_content = 
                            '<!DOCTYPE html>
                            <html>
                            <head>
                                <meta charset="utf-8">
                                <title>Welcome to Net!</title>
                            </head>
                            <body>
                                <p>เรียน '.$UserData -> name.'</p>
                                <p>
                                    อีเมลผู้ใช้ : '.$UserData -> email.'<br>
                                </p>
                                <span style="color:red;">* กองทุนของคุณไม่ได้รับการอนุมัติ</span><br>
                                
                                <p> เนื่องจาก '.$VillageComment.' หากท่านมีคำถามหรือต้องการความช่วยเหลือในการเข้าใช้งาน หรือมีข้อสงสัยใด ๆ เกี่ยวกับการใช้งานแอปพลิเคชัน หรือบริการอื่นๆ กรุณาติดต่อเราทางอีเมลที่ support@email.com</p>
                                <strong style="color: red;">อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ</strong>
                                <p>ขอแสดงความนับถือ,<br>
                                ทีมผู้ดูแล สทบ</p><br><br>
                            </body>
                            </html>'
                        ;
                        $object = new stdClass();
                        $object->email_content = $html_content;
                        Mail::to($UserData -> email)->send(new JobMail($object, "แจ้งข้อมูลสำหรับเข้าใช้งานระบบ สทบ. ของสมาชิก"));
                        
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
    function saveRegisterVillageMember(Request $request)
    {
        $OrgStructure = $request['OrgStructure'];
        $OrgStructureProvince = $request['OrgStructureProvince'];
        $Village = $request['Village'];
        $NoCitizenId = $request['NoCitizenId'];
        $CitizenId = $request['CitizenId'];
        $FirstName = $request['FirstName'];
        $LastName = $request['LastName'];
        $GenderId = $request['GenderId'];
        $NoBirthDate = $request['NoBirthDate'];
        $MemberBirthDate = $request['MemberBirthDate'];
        $MemberPhone = $request['MemberPhone'];
        $MemberOccupationId = $request['MemberOccupationId'];
        $MemberAddress = $request['MemberAddress'];
        $MemberPositionId = $request['MemberPositionId'];
        $MemberStatusId = $request['MemberStatusId'];
        $Connection = $request['Connection'];
        $Username = $request['Username'];
        $UserEmail = $request['UserEmail'];
        DB::beginTransaction();
        try {
            $existingEmail = DB::table('cms_users')->where('email', $UserEmail)->exists();
            $VillageCode = DB::table('village')->select('village.VillageCodeText')->where('id', $Village)->first();
            $numberOfMembers = DB::table('memberVillage')->where('VillageId', $Village)->count();
            $MemberCode = $VillageCode->VillageCodeText * 1000 + $numberOfMembers+1;
            if (!$existingEmail) {
                $DataCmsUser = [];
                $DataCmsUser['name'] = $Username;
                $DataCmsUser['email'] = $UserEmail;
                $DataCmsUser['orgId'] = $OrgStructure;
                $DataCmsUser['id_cms_privileges'] = 1;
                $DataCmsUser['created_at'] = date('Y-m-d H:i:s');
                $DataCmsUser['status'] = 'Active';
                $userCmsID = DB::table('cms_users')->insertGetId($DataCmsUser);
                if($userCmsID){
                    $DataUser = [];
                    $DataUser['idCard'] = $CitizenId;
                    $DataUser['cmsUserId'] = $userCmsID;
                    $DataUser['firstName'] = $FirstName;
                    $DataUser['lastName'] = $LastName;
                    $DataUser['email'] = $UserEmail;
                    $DataUser['orgProvinceId'] = $OrgStructureProvince;
                    $DataUser['is_active'] = 1;
                    $DataUser['created_at'] = date('Y-m-d H:i:s');
                    $DataUser['created_by'] = CRUDBooster::myId();
                    $userID = DB::table('user')->insertGetId($DataUser);
                    if($userID){
                        $DataUserVillage = [];
                        $DataUserVillage['VillageId'] = $Village;
                        $DataUserVillage['MemberCode'] = $MemberCode;
                        $DataUserVillage['CitizenId'] = $CitizenId;
                        $DataUserVillage['MemberFirstName'] = $FirstName;
                        $DataUserVillage['MemberLastName'] = $LastName;
                        $DataUserVillage['GenderId'] = $GenderId;
                        $DataUserVillage['Age'] = (new FunctionController)->calculateAge($MemberBirthDate);
                        $DataUserVillage['Phone'] = $MemberPhone;
                        $DataUserVillage['MemberOccupationId'] = $MemberOccupationId;
                        $DataUserVillage['MemberAddress'] = $MemberAddress;
                        $DataUserVillage['MemberPositionId'] = $MemberPositionId;
                        $DataUserVillage['MemberStatusId'] = $MemberStatusId;
                        // $DataUserVillage['MemberOffComment'] = $MemberOffComment;
                        // $DataUserVillage['MemberOccupationOther'] = $MemberOccupationOther;
                        $DataUserVillage['MemberRenewal'] = 0;
                        $DataUserVillage['Connection'] = $Connection;
                        $DataUserVillage['NoCitizenId'] = $NoCitizenId;
                        $DataUserVillage['NoBirthDate'] = $NoBirthDate;
                        $DataUserVillage['UserId'] = $userCmsID;
                        $DataUserVillage['IsActive'] = 1;
                        $DataUserVillage['MemberDate'] = date('Y-m-d');
                        $DataUserVillage['MemberEndDate'] = (new FunctionController)->calculateEndDate($DataUserVillage['MemberDate'], 2);
                        $DataUserVillage['MemberBirthDate'] = $MemberBirthDate;
                        $DataUserVillage['MemberStatusApprove'] = 0;
                        
                        $DataUserVillage['CreatedAt'] =  date('Y-m-d');
                        $DataUserVillage['CreatedBy'] =  CRUDBooster::myId();
                        $DataMemberVillageId = DB::table('memberVillage')->insertGetId($DataUserVillage);
                        if ($DataMemberVillageId) {
                            DB::commit();
                            $data['api_status'] = 1;
                            $data['api_message'] = 'Success';
                            $data['id'] = $DataMemberVillageId;
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
                        DB::rollback();
                        $data['api_status'] = 0;
                        $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                        return response()->json($data, 200);
                    }
                }else {
                    DB::rollback();
                    $data['api_status'] = 0;
                    $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
                    return response()->json($data, 200);
                }
            }else{
                DB::rollback();
                $data['api_status'] = 2;
                $data['api_message'] = 'ไม่สามารถใช้ email นี้ได้ เนื่องจากมี email นี้ในระบบแล้ว';
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
