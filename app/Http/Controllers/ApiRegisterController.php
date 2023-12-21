<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiRegisterController extends Controller
{
    function getOrgStructure()
    {
        $orgStructures = DB::table('systemOrgStructure')
            ->select('id', 'orgName')
            ->orderBy('id')
            ->get();

        $data['data'] = $orgStructures;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';

        return response()->json($data, 200)
            ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
    function getOrgStructureProvince(Request $request)
    {
        $id = $request['id'];
        $orgStructures = DB::table('systemOrgStructureProvince')
            ->select('id', 'provinceName')
            ->orderBy('id')
            ->where('systemOrgStructureProvince.orgId', $id)
            ->get();

        $data['data'] = $orgStructures;
        $data['api_status'] = 1;
        $data['api_message'] = 'Success';

        return response()->json($data, 200)
            ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
    function saveRegister(Request $request)
    {
        $idCard = $request['idCard'];
        $firstName = $request['firstName'];
        $lastName = $request['lastName'];
        $username = $request['username'];
        $email = $request['email'];
        $password = $request['password'];
        $orgStructureProvince = $request['orgStructureProvince'];

        DB::beginTransaction();
        try {
            $existingEmail = DB::table('cms_users')->where('email', $email)->exists();
            if (!$existingEmail) {

                $data_cms_user = [];
                $data_cms_user['name'] = $username;
                $data_cms_user['email'] = $email;
                $data_cms_user['password'] = bcrypt($password);
                $data_cms_user['id_cms_privileges'] = 1;
                $data_cms_user['created_at'] = date('Y-m-d H:i:s');
                $data_cms_user['status'] = 'Active';
                $userCmsID = DB::table('cms_users')->insertGetId($data_cms_user);

                if ($userCmsID) {

                    $data_user = [];
                    $data_user['idCard'] = $idCard;
                    $data_user['firstName'] = $firstName;
                    $data_user['lastName'] = $lastName;
                    $data_user['email'] = $email;
                    $data_user['orgProvinceId'] = $orgStructureProvince;
                    $data_user['is_active'] = 1;
                    $data_user['created_at'] = date('Y-m-d H:i:s');
                    $data_user['created_by'] = CRUDBooster::myId();
                    $userID = DB::table('user')->insertGetId($data_user);

                    if ($userID) {
                        DB::commit();
                        $data['api_status'] = 1;
                        $data['api_message'] = 'Success';
                        $data['id'] = $userID;
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
