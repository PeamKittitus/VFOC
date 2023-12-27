<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;

class ApiUserController extends Controller
{
    function editProfile(Request $request)
    {
        $cmsUserId = $request['cmsUserId'];
        $idCard = $request['idCard'];
        $firstName = $request['firstName'];
        $lastName = $request['lastName'];
        $username = $request['username'];
        $phoneNumber = $request['phoneNumber'];
        $email = $request['email'];
        $password = $request['password'];
        DB::beginTransaction();
        try {
            if ($password) {
                $cmsUpdateData = [];
                $cmsUpdateData['name'] = $username;
                $cmsUpdateData['email'] = $email;
                $cmsUpdateData['password'] = bcrypt($password);
                $cmsUpdateData['updated_at'] = date('Y-m-d H:i:s');
                $userCmsID = DB::table('cms_users')->where('id', $cmsUserId)->update($cmsUpdateData);
                if ($userCmsID) {

                    $userUpdateData = [];
                    $userUpdateData['idCard'] = $idCard;
                    $userUpdateData['firstName'] = $firstName;
                    $userUpdateData['lastName'] = $lastName;
                    $userUpdateData['email'] = $email;
                    $userUpdateData['phoneNumber'] = $phoneNumber;
                    $userUpdateData['updated_at'] = date('Y-m-d H:i:s');
                    $userUpdateData['updated_by'] = CRUDBooster::myId();
                    $userID = DB::table('user')->where('cmsUserId', $cmsUserId)->update($userUpdateData);

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
                $cmsUpdateData = [];
                $cmsUpdateData['name'] = $username;
                $cmsUpdateData['email'] = $email;
                $cmsUpdateData['updated_at'] = date('Y-m-d H:i:s');
                $userCmsID = DB::table('cms_users')->where('id', $cmsUserId)->update($cmsUpdateData);
                if ($userCmsID) {

                    $userUpdateData = [];
                    $userUpdateData['idCard'] = $idCard;
                    $userUpdateData['firstName'] = $firstName;
                    $userUpdateData['lastName'] = $lastName;
                    $userUpdateData['email'] = $email;
                    $userUpdateData['phoneNumber'] = $phoneNumber;
                    $userUpdateData['updated_at'] = date('Y-m-d H:i:s');
                    $userUpdateData['updated_by'] = CRUDBooster::myId();
                    $userID = DB::table('user')->where('cmsUserId', $cmsUserId)->update($userUpdateData);

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
