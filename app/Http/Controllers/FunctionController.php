<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\SmartPunct\EllipsesParser;
use PDO;
use Firebase\JWT\JWT;
use Carbon\Carbon;
use DateTime;
use DateInterval;

class FunctionController extends Controller
{
    function getCurrentBudgetYear()
    {
        $thisDate = new \DateTime();
        $thisYear = $thisDate->format('Y') + 543;
        $thisMonth = $thisDate->format('n');

        $budgetYear = 0;

        if ($thisMonth >= 10) {
            $budgetYear = $thisYear + 1;
        } elseif ($thisMonth >= 1) {
            $budgetYear = $thisYear;
        }
        return $budgetYear;
    }
    function convertAndSplitDate($date)
    {
        $timestamp = strtotime($date);
        $formattedDate = date('Y-m-d', $timestamp);
        $dateArray = explode('-', $formattedDate);

        return [
            'formatted' => $formattedDate,
            'array' => $dateArray,
        ];
    }
    function formatDateString($date)
    {
        $dateTime = \DateTime::createFromFormat('m/d/Y', $date);
        $newFormattedDate = $dateTime->format('Y-m-d');
        return $newFormattedDate;
    }
    function generateYearOptions($selectedOffset = 0, $yearsBefore = 3, $yearsAfter = 2)
    {
        $currentYear = (int)date('Y');
        $startYear = $currentYear - $yearsBefore;
        $endYear = $currentYear + $yearsAfter;

        $options = '';

        for ($i = ($yearsBefore + $yearsAfter); $i >= 0; $i--) {
            $year = ($startYear + $i) + 543;

            if ($year == ($currentYear + 543)) {
                $options .= '<option selected value="' . $year . '">' . $year . '</option>';
            } else {
                $options .= '<option value="' . $year . '">' . $year . '</option>';
            }
        }

        return $options;
    }
    function getMenus()
    {
        $newsData = DB::table('cms_menus')
            ->select(
                'cms_menus.id',
                'cms_menus.name',
                'cms_menus.parent_id',
                'cms_menus.is_active',
                'cms_menus.ImageMenu',
                'cms_menus.IsLink',
                'cms_menus.PathLink'
            )
            ->where('parent_id', 0)
            ->where('ImageMenu', '!=', '')
            ->orderBy('id', 'asc')
            ->get();
        $data = [];
        $data['api_status'] = 1;
        $data['api_message'] = 'สำเร็จ';
        $data['data'] = $newsData;
        return $data;
    }
    function RedirectToOutSite(Request $request)
    {
        $MenuId = $request['MenuId'];
        $data = "";

        // CRUDBooster::myId(); 
        $currentUser =  CRUDBooster::myId();
        $userData = DB::table('cms_users')
            ->leftjoin('user', 'user.cmsUserId', 'cms_users.id')
            ->select(
                'cms_users.id',
                'cms_users.orgId',
                'cms_users.name',
                'cms_users.email',
                'user.idCard',
                'user.firstName',
                'user.lastName',
            )
            ->where('cms_users.id', $currentUser)
            ->first();
        // Generate token key
        $tokenKey = $this->generateJWTToken($userData->name, $userData->id);

        $getMenu = DB::table('cms_menus')
            ->where('id', $MenuId)
            ->first();
        $dateTime = now()->addHours(2);
        if ($getMenu->IsLink == 1) {
            $orgData = $userData->orgId != 0
                ? DB::table('systemOrgStructure')
                ->where('id', $userData->orgId)
                ->select('systemOrgStructure.orgName')
                ->first()
                : null;

            $setData = ($orgData !== null ? $orgData->orgName : "-")
                . "|" . $this->getDateThaiAndTime($dateTime)
                . "|" . $userData->firstName
                . "|" . $userData->lastName
                . "|" . $userData->name
                . "|" . $tokenKey
                . "|" . $userData->idCard
                . "|" . "นักวิชาการ(รอข้อมูลต้นทาง)";

            $encriptAssii = $this->encryptString($setData);
            $decriptAssii = $this->decryptString($encriptAssii);

            $response = $getMenu->PathLink . trim($encriptAssii);
            // Add log
            DB::beginTransaction();
            try {

                $dataInsertLog = [];
                $dataInsertLog['ipaddress'] = $_SERVER['REMOTE_ADDR'];
                $dataInsertLog['useragent'] = $_SERVER['HTTP_USER_AGENT'];
                $dataInsertLog['description'] = 'เข้าสู่ระบบ';
                $dataInsertLog['details'] = 'เข้าสู่ระบบหน้าหลัก';
                $dataInsertLog['id_cms_users'] = $userData->id;
                $dataInsertLog['created_at'] = date('Y-m-d H:i:s');
                $LogId = DB::table('cms_logs')->insertGetId($dataInsertLog);
                if ($LogId) {
                    DB::commit();
                    $data = [];
                    $data['valid'] = 1;
                    $data['data'] = $response;
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
        } else {
            return response()->json(['valid' => false]);
        }
    }
    function generateJWTToken($userName, $userId)
    {
        // Check records in table
        $getUserToken = DB::table('systemUserToken')->where('UserId', $userId)->get();

        if (count($getUserToken) > 0) {
            // Delete all transactions
            DB::table('systemUserToken')->where('UserId', $userId)->delete();
        }

        $key = 'd166eb04-a9b7-11ed-afa1-0242ac120002';
        $tokenHandler = new JWT();
        $tokenDescriptor = [
            'sub' => $userName,
            'jti' => uniqid(),
            'nameid' => 'DZVFOX' . now()->year,
            'exp' => now()->addHours(2)->timestamp,
            'nbf' => now()->timestamp,
            'iat' => now()->timestamp,
        ];
        $token = $tokenHandler::encode($tokenDescriptor, $key, 'HS256');
        DB::beginTransaction();
        try {

            $dataInsertToken = [];
            $dataInsertToken['ActiveDate'] = now();
            $dataInsertToken['TokenKey'] = $token;
            $dataInsertToken['UserId'] = $userId;

            $TokenId = DB::table('systemUserToken')->insertGetId($dataInsertToken);
            if ($TokenId) {
                DB::commit();
                return $token;
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
    }
    function getDateThaiAndTime($dateTime)
    {
        // Convert the input date and time to a Carbon instance
        $carbonDateTime = Carbon::parse($dateTime);

        // Format the date and time in Thai format
        $formattedDateTime = $carbonDateTime->locale('th')->isoFormat('lll');

        return $formattedDateTime;
    }
    function encryptString($strEncrypted)
    {
        try {
            $encodedData = base64_encode($strEncrypted);
            return $encodedData;
        } catch (Exception $ex) {
            throw new Exception("Error in base64Encode" . $ex->getMessage());
        }
    }
    function decryptString($encodedData)
    {
        try {
            $decData_byte = base64_decode($encodedData);
            $decryptedData = utf8_decode($decData_byte);
            return $decryptedData;
        } catch (Exception $ex) {
            throw new Exception("Error in base64Decode" . $ex->getMessage());
        }
    }
    function calculateAge($birthDate)
    {
        $birthDateTime = new DateTime($birthDate);
        $currentDateTime = new DateTime();
        $age = $currentDateTime->diff($birthDateTime)->y;

        return $age;
    }
    function calculateEndDate($startDate, $yearsToAdd)
    {
        $startDateObject = new DateTime($startDate);

        $startDateObject->add(new DateInterval('P' . $yearsToAdd . 'Y'));

        $endDate = $startDateObject->format('Y-m-d');

        return $endDate;
    }
    function getProvince()
    {
        $provinceData = DB::table('systemProvinces')
            ->select(
                'systemProvinces.id',
                'systemProvinces.name_th'
            )
            ->get();
        return $provinceData;
    }
    function getAmphures()
    {
        $AmphuresData = DB::table('systemAmphures')
            ->select(
                'systemAmphures.id',
                'systemAmphures.name_th'
            )
            ->get();
        return $AmphuresData;
    }
    function getTambons()
    {
        $TambonsData = DB::table('systemTambons')
            ->select(
                'systemTambons.id',
                'systemTambons.name_th'
            )
            ->get();
        return $TambonsData;
    }
    function getDivision()
    {
        $DivisionData = DB::table('systemDivision')
            ->select(
                'systemDivision.id',
                'systemDivision.name',
                'systemDivision.short_name'
            )
            ->where('systemDivision.is_active',1)
            ->get();
        return $DivisionData;
    }
    function getAmphuresById(Request $request)
    {
        $VillageProvinceId = $request['VillageProvinceId'];
        $amphuresData = DB::table('systemAmphures')->where('province_id', $VillageProvinceId)->get();
        try {
            if ($amphuresData) {
                $data['api_status'] = 1;
                $data['api_message'] = 'สำเร็จ';
                $data['api_data'] = $amphuresData;
            } else {
                $data['api_status'] = 0;
                $data['api_message'] = 'ไม่พบข้อมูล';
            }
        } catch (\Exception $e) {
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
        }
        return response()->json($data, 200);
    }
    function getTambonsById(Request $request)
    {
        $VillageDistrictId = $request['VillageDistrictId'];
        $tambonsData = DB::table('systemTambons')->where('amphure_id', $VillageDistrictId)->get();
        try {
            if ($tambonsData) {
                $data['api_status'] = 1;
                $data['api_message'] = 'สำเร็จ';
                $data['api_data'] = $tambonsData;
            } else {
                $data['api_status'] = 0;
                $data['api_message'] = 'ไม่พบข้อมูล';
            }
        } catch (\Exception $e) {
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
        }
        return response()->json($data, 200);
    }
    function getZipCodeById(Request $request)
    {
        $VillageSubDistrictId = $request['VillageSubDistrictId'];
        $zipcodeData = DB::table('systemTambons')->where('id', $VillageSubDistrictId)->get();
        try {
            if ($zipcodeData) {
                $data['api_status'] = 1;
                $data['api_message'] = 'สำเร็จ';
                $data['api_data'] = $zipcodeData;
            } else {
                $data['api_status'] = 0;
                $data['api_message'] = 'ไม่พบข้อมูล';
            }
        } catch (\Exception $e) {
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
        }
        return response()->json($data, 200);
    }
    function getVillageByIdProvince(Request $request)
    {
        $id = $request['id'];
        $villageData = DB::table('village')->select('village.id', 'village.VillageName', 'village.OrgProvinceId')->where('village.OrgProvinceId', $id)->get();
        try {
            if ($villageData) {
                $data['api_status'] = 1;
                $data['api_message'] = 'สำเร็จ';
                $data['data'] = $villageData;
            } else {
                $data['api_status'] = 0;
                $data['api_message'] = 'ไม่พบข้อมูล';
            }
        } catch (\Exception $e) {
            $data['api_status'] = 0;
            $data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
        }
        return response()->json($data, 200);
    }

    function LogAction($projectBudgetId, $detail)
    {
        $LogData = [];
        $LogData['ProjectBudgetId'] = $projectBudgetId;
        $LogData['Detail'] = $detail;
        $LogData['UpdatedAt'] = date("Y-m-d H:i:s");
        $LogData['UpdatedBy'] = CRUDBooster::myId();
        DB::beginTransaction();
        try {
            $LogInsert = DB::table('systemLogs')->insertGetId($LogData);
            if ($LogInsert) {
                DB::commit();
                return 1;
            } else {
                DB::rollback();
                return 0;
            }
        } catch (\Exception $e) {
            return 0;
        }
    }

    function getBookBankAdminApi(){
        
        $BookBank = DB::table('accountBookBank')
			->select('accountBookBank.*')
			->where('accountBookBank.created_by', 1)
			->get();

        response()->json($BookBank, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
			->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();    

    }
    function getVillageApi()
    {
        $Village = DB::table('village')
        ->select('village.*')
        ->where('village.IsActive', 1)
        ->get();
        response()->json($Village, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();

    }
    function getVillageBookBankApi($id)
    {
        $BookBank = DB::table('accountBookBank')
            ->select('accountBookBank.*')
            ->where('accountBookBank.created_by', $id)
            ->get();

        response()->json($BookBank, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
    }
}
