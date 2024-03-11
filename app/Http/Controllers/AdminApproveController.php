<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;

class AdminApproveController extends \crocodicstudio\crudbooster\controllers\CBController
{


    public function Index()
    {

        $data = [];
        // ProjectBudget
        $data['page_title'] = 'พิจารณาอนุมัติโครงการ';
        $data['ProjectBudget'] = $this->GetAllProjectBudget();

        //ProjectActivity
        $data['page_title_activity'] = 'พิจารณาอนุมัติกิจกรรมโครงการ';
        $data['projectActivity'] = $this->GetAllprojectActivity();
        return view('approveall/index', $data);
    }



    public function GetAllProjectBudget()
    {
        $ProjectBudget = DB::table("projectBudget")->where('IsActive', 1)->get();
        foreach ($ProjectBudget as $key => $val) {
            $total_activity = DB::table('projectActivity')
                ->where('ProjectBudgetId', $val->id)
                ->count();
            $Approve_activity = DB::table('projectActivity')
                ->where('ProjectBudgetId', $val->id)
                ->where('Status', 5)
                ->count();
            $percentage = ($total_activity == 0 ? 0 : ($Approve_activity / $total_activity) * 100);
            $val->percentage = $percentage;
        }

        return $ProjectBudget;
    }

    public function approveProjectBudget(Request $request)
    {
        // dd($request->all());
        $ProjectBudgetID = $request['budgetId'];
        $statusBudget = $request['budgetstatus'];
        $dataUpdate = [];
        $dataUpdate['Status'] = $statusBudget;
        $dataUpdate['IsActive'] = 1;
        $dataUpdate['UpdatedAt'] = date('Y-m-d');
        $dataUpdate['UpdatedBy'] = CRUDBooster::myId();
        DB::beginTransaction();
        try {
            $budgetdata = DB::table('projectBudget')
                ->where('id', $ProjectBudgetID)
                ->update($dataUpdate);
            if ($budgetdata) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $budgetdata;

                return response()->json($data, 200);
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
            return response()->json($data, 200);
        }
    }

    public function GetAllprojectActivity()
    {
        $ProjectActivity = DB::table("projectActivity")->where('IsActive', 1)->get();
        return $ProjectActivity;
    }


    public function approveProjectActivity(Request $request)
    {

        // dd($request->all());
        // projectActivity


        $ProjectBudgetID = $request['projectId'];
        $activityID = $request['activityId'];
        $statusActivity = $request['activityStatus'];

        $detailAction = $request['action'];


        $dataUpdate = [];
        $dataUpdate['Status'] = $statusActivity;
        $dataUpdate['IsActive'] = 1;
        $dataUpdate['UpdatedAt'] = date('Y-m-d');
        $dataUpdate['UpdatedBy'] = CRUDBooster::myId();

        // updateProjectBudget
        $dataBudget = [];
        $dataBudget['IsActive'] = 1;
        $dataBudget['UpdatedAt'] = date('Y-m-d');
        $dataBudget['UpdatedBy'] = CRUDBooster::myId();
        // updateProjectBudget


        DB::beginTransaction();
        try {
            $activitydata = DB::table('projectActivity')
                ->where('id', $activityID)
                ->where('ProjectBudgetId', $ProjectBudgetID)
                ->update($dataUpdate);
            $budgetdata = DB::table('projectBudget')
                ->where('id', $ProjectBudgetID)
                ->update($dataBudget);
            $LogInsert = (new FunctionController)->LogAction($ProjectBudgetID, $detailAction);
            if ($activitydata && $LogInsert) {
                DB::commit();
                $data['api_status'] = 1;
                $data['api_message'] = 'Success';
                $data['id'] = $budgetdata;

                return response()->json($data, 200);
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
            return response()->json($data, 200);
        }
    }
}
