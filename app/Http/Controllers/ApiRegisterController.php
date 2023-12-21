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
    
}
