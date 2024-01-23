<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

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
                if($DataTransVillage){
                    DB::commit();
                    $data['api_status'] = 1;
                    $data['api_message'] = 'Success';
                    $data['id'] = $DataTransVillage;
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
            $DataUpdateTransVillage['UpdatedBy'] =CRUDBooster::myId();
            $DataUpdateTransVillageId = DB::table('transactionVillage')->where('transactionVillage.TransactionReqId', $TransactionRequestId)->update($DataUpdateTransVillage);
            if($DataUpdateTransVillageId){
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $DataUpdateTransVillageId;
                return response()->json($data, 200)
                    ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                    ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
            }else{
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
            $DataTransMemberVillage = [];
            $DataTransMemberVillage['TransactionVillageId'] = $TransactionVillageId;
            if($VillageId != 0){
                $DataTransMemberVillage['VillageId'] = $VillageId;
            }
            $DataTransMemberVillage['MemberCode'] = $MemberCode;
            $DataTransMemberVillage['NoCitizenId'] = $NoCitizenId;
            if($NoCitizenId != 0){
                $DataTransMemberVillage['CitizenId'] = $CitizenId;
            }
            $DataTransMemberVillage['MemberFirstName'] = $MemberFirstName;
            $DataTransMemberVillage['MemberLastName'] = $MemberLastName;
            $DataTransMemberVillage['GenderId'] = $GenderId;
            $DataTransMemberVillage['NoBirthDate'] = $NoBirthDate;
            if($NoBirthDate != 0){
                $DataTransMemberVillage['Age'] = $Age;
                $DataTransMemberVillage['MemberBirthDate'] = $MemberBirthDate;
            }
            $DataTransMemberVillage['Phone'] = $Phone;
            $DataTransMemberVillage['MemberOccupationId'] = $MemberOccupationId;
            $DataTransMemberVillage['MemberAddress'] = $MemberAddress;
            $DataTransMemberVillage['MemberPositionId'] = $MemberPositionId;
            $DataTransMemberVillage['MemberStatusId'] = $MemberStatusId;
            $DataTransMemberVillage['Connection'] = $Connection;
            if($MemberStatusId == 2){
                $DataTransMemberVillage['MemberOffComment'] = $MemberOffComment;
            }
            if($MemberOccupationOther){
                $DataTransMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
            }
            if($UserId){
                $DataTransMemberVillage['UserId'] = $UserId;
                $DataTransMemberVillage['MemberStatusApprove'] =0;
            }
            $DataTransMemberVillage['MemberStatusApprove'] =1;
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
            if($VillageId != 0){
                $UpdateDataMemberVillage['VillageId'] = $VillageId;
            }
            $UpdateDataMemberVillage['MemberCode'] = $MemberCode;
            $UpdateDataMemberVillage['NoCitizenId'] = $NoCitizenId;
            if($NoCitizenId != 0){
                $UpdateDataMemberVillage['CitizenId'] = $CitizenId;
            }
            $UpdateDataMemberVillage['MemberFirstName'] = $MemberFirstName;
            $UpdateDataMemberVillage['MemberLastName'] = $MemberLastName;
            $UpdateDataMemberVillage['GenderId'] = $GenderId;
            $UpdateDataMemberVillage['NoBirthDate'] = $NoBirthDate;
            if($NoBirthDate != 0){
                $UpdateDataMemberVillage['Age'] = $Age;
                $UpdateDataMemberVillage['MemberBirthDate'] = $MemberBirthDate;
            }
            $UpdateDataMemberVillage['Phone'] = $Phone;
            $UpdateDataMemberVillage['MemberOccupationId'] = $MemberOccupationId;
            $UpdateDataMemberVillage['MemberAddress'] = $MemberAddress;
            $UpdateDataMemberVillage['MemberPositionId'] = $MemberPositionId;
            $UpdateDataMemberVillage['MemberStatusId'] = $MemberStatusId;
            $UpdateDataMemberVillage['Connection'] = $Connection;
            if($MemberStatusId == 2){
                $UpdateDataMemberVillage['MemberOffComment'] = $MemberOffComment;
            }
            if($MemberOccupationOther){
                $UpdateDataMemberVillage['MemberOccupationOther'] = $MemberOccupationOther;
            }
            if($UserId){
                $UpdateDataMemberVillage['UserId'] = $UserId;
                $UpdateDataMemberVillage['MemberStatusApprove'] =0;
            }
            $UpdateDataMemberVillage['MemberStatusApprove'] =1;
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
            $UpdateMemberVillage['IsActive'] =0;
            
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
        $Data=[];
        $getCmsUser = DB::table('cms_users')->where('id', CRUDBooster::myId())->first();
        $VillageData = DB::table('transactionVillage')
        ->leftjoin('systemProvinces', 'systemProvinces.id', 'transactionVillage.VillageProvinceId')
        ->leftjoin('systemAmphures', 'systemAmphures.id', 'transactionVillage.VillageDistrictId')
        ->leftjoin('systemTambons', 'systemTambons.id', 'transactionVillage.VillageSubDistrictId')
        ->leftjoin('transactionReqVillage', 'transactionReqVillage.id', 'transactionVillage.TransactionReqId')
        ->select('transactionVillage.id',
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
        $Data=[];
        $VillageData = DB::table('transactionVillage')
        ->leftjoin('transactionReqVillage', 'transactionReqVillage.id', 'transactionVillage.TransactionReqId')
        ->select('transactionVillage.id',
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
        ->where('transactionVillage.id',$VillageId )
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
        ->select('transactionMemberVillage.id',
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
}
