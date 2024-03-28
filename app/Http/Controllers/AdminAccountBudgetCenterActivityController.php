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
use Excel;
use App\Exports\Export;

class AdminAccountBudgetCenterActivityController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table 			   = "accountBudgetCenterActivity";
		$this->title_field         = "id";
		$this->limit               = 20;
		$this->orderby             = "id,desc";
		$this->show_numbering      = FALSE;
		$this->global_privilege    = FALSE;
		$this->button_table_action = TRUE;
		$this->button_action_style = "button_icon";
		$this->button_add          = TRUE;
		$this->button_delete       = TRUE;
		$this->button_edit         = TRUE;
		$this->button_detail       = TRUE;
		$this->button_show         = TRUE;
		$this->button_filter       = TRUE;
		$this->button_export       = FALSE;
		$this->button_import       = FALSE;
		$this->button_bulk_action  = TRUE;
		$this->sidebar_mode		   = "normal"; //normal,mini,collapse,collapse-mini
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];

		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];

		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ["label"=>"AccBudgetCenterId","name"=>"AccBudgetCenterId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"ActivityName","name"=>"ActivityName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"ActivityDetail","name"=>"ActivityDetail","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"ActivityAmount","name"=>"ActivityAmount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"ActivityStartDate","name"=>"ActivityStartDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"ActivityEndDate","name"=>"ActivityEndDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"ActivityStatus","name"=>"ActivityStatus","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"UserId","name"=>"UserId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"IsActive","name"=>"IsActive","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"CreatedAt","name"=>"CreatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"CreatedBy","name"=>"CreatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"UpdatedAt","name"=>"UpdatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"UpdatedBy","name"=>"UpdatedBy","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
		//$this->form[] = ["label"=>"ActivityAmountStatus","name"=>"ActivityAmountStatus","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		# OLD END FORM

		/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
		$this->sub_module = array();


		/* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
		$this->addaction = array();


		/* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
		$this->button_selected = array();


		/* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
		$this->alert        = array();



		/* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
		$this->index_button = array();



		/* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
		$this->table_row_color = array();


		/*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
		$this->index_statistic = array();



		/*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
		$this->script_js = NULL;


		/*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
		$this->pre_index_html = null;



		/*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
		$this->post_index_html = null;



		/*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
		$this->load_js = array();



		/*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
		$this->style_css = NULL;



		/*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
		$this->load_css = array();
	}


	/*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	public function actionButtonSelected($id_selected, $button_name)
	{
		//Your code here

	}


	/*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	public function hook_query_index(&$query)
	{
		//Your code here

	}

	/*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */
	public function hook_row_index($column_index, &$column_value)
	{
		//Your code here
	}

	/*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	public function hook_before_add(&$postdata)
	{
		//Your code here

	}

	/* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	public function hook_after_add($id)
	{
		//Your code here

	}

	/* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	public function hook_before_edit(&$postdata, $id)
	{
		//Your code here

	}

	/* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	public function hook_after_edit($id)
	{
		//Your code here 

	}

	/* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	public function hook_before_delete($id)
	{
		//Your code here

	}

	/* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	public function hook_after_delete($id)
	{
		//Your code here

	}



	//By the way, you can still create your own method in here... :) 
	public function getIndex()
	{
		$getAccountBudgetCenter = $this->getAccountBudgetCenter();
		$getAccountBudgetCenterSub = $this->getAccountBudgetCenterSub();
		$generateYearOptions = (new FunctionController)->generateYearOptions();
		$getDivision = (new FunctionController)->getDivision();

		$data['getDivision'] = $getDivision;
		$data['generateYearOptions'] = $generateYearOptions;
		$data['getAccountBudgetCenter'] = $getAccountBudgetCenter;
		$data['getAccountBudgetCenterSub'] = $getAccountBudgetCenterSub;
		return view('accountCenter/accountCenterActivity/index', $data);
	}
	public function updateAccountCenter($id)
	{
		$getAccountBudgetCenterSubById = $this->getAccountBudgetCenterSubById($id);
		$data['getAccountBudgetCenterSubById'] = $getAccountBudgetCenterSubById;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($getAccountBudgetCenterSubById->AccBudgetCenterId);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		$getAccountBudgetCenterSubFileById = $this->getAccountBudgetCenterSubFileById($id);
		$data['getAccountBudgetCenterSubFileById'] = $getAccountBudgetCenterSubFileById;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		$data['accSubId'] = $id;
		$getAccountBudgetCenterActivityById = $this->getAccountBudgetCenterActivityById($id);
		$data['getAccountBudgetCenterActivityById'] = $getAccountBudgetCenterActivityById;
		$getAccountBudgetCenterSubDetailById = $this->getAccountBudgetCenterSubDetailById($id);
		$data['getAccountBudgetCenterSubDetailById'] = $getAccountBudgetCenterSubDetailById;
		$getNationalStrategy = $this->getNationalStrategy();
		$data['getNationalStrategy'] = $getNationalStrategy;
		return view('accountCenter/accountCenterActivity/updateAccountCenter', $data);
	}
	public function updateAccountCenterActivity($id)
	{
		$getAccountBudgetCenterSubById = $this->getAccountBudgetCenterSubById($id);
		$data['getAccountBudgetCenterSubById'] = $getAccountBudgetCenterSubById;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($getAccountBudgetCenterSubById->AccBudgetCenterId);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		$getAccountBudgetCenterSubFileById = $this->getAccountBudgetCenterSubFileById($id);
		$data['getAccountBudgetCenterSubFileById'] = $getAccountBudgetCenterSubFileById;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		$data['accSubId'] = $id;
		$getAccountBudgetCenterActivityById = $this->getAccountBudgetCenterActivityById($id);
		$data['getAccountBudgetCenterActivityById'] = $getAccountBudgetCenterActivityById;
		$getAccountBudgetCenterSubDetailById = $this->getAccountBudgetCenterSubDetailById($id);
		$data['getAccountBudgetCenterSubDetailById'] = $getAccountBudgetCenterSubDetailById;
		$getNationalStrategy = $this->getNationalStrategy();
		$data['getNationalStrategy'] = $getNationalStrategy;
		return view('accountCenter/accountCenterActivity/updateAccountCenterActivity', $data);
	}
	public function updateAccountCenterActivityDetail($id)
	{
		$getAccountBudgetCenterActivityDetailById = $this->getAccountBudgetCenterActivityDetailById($id);
		$data['getAccountBudgetCenterActivityDetailById'] = $getAccountBudgetCenterActivityDetailById;
		return view('accountCenter/accountCenterActivity/updateAccountCenterActivityDetail', $data);
	}
	public function viewAccountCenterActivityDetail($id)
	{
		$getDataAccountBudgetCenterActivityDetailById = $this->getDataAccountBudgetCenterActivityDetailById($id);
		$data['getDataAccountBudgetCenterActivityDetailById'] = $getDataAccountBudgetCenterActivityDetailById;
		return view('accountCenter/accountCenterActivity/viewAccountCenterActivityDetail', $data);
	}
	
	public function addAccountBudgetActivity($id)
	{
		$getAccountBudgetCenterSubById = $this->getAccountBudgetCenterSubById($id);
		$data['getAccountBudgetCenterSubById'] = $getAccountBudgetCenterSubById;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($getAccountBudgetCenterSubById->AccBudgetCenterId);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		$getAccountBudgetCenterSubFileById = $this->getAccountBudgetCenterSubFileById($id);
		$data['getAccountBudgetCenterSubFileById'] = $getAccountBudgetCenterSubFileById;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		$data['accSubId'] = $id;
		$getAccountBudgetCenterActivityById = $this->getAccountBudgetCenterActivityById($id);
		$data['getAccountBudgetCenterActivityById'] = $getAccountBudgetCenterActivityById;
		$getAccountBudgetCenterSubDetailById = $this->getAccountBudgetCenterSubDetailById($id);
		$data['getAccountBudgetCenterSubDetailById'] = $getAccountBudgetCenterSubDetailById;
		$getNationalStrategy = $this->getNationalStrategy();
		$data['getNationalStrategy'] = $getNationalStrategy;
		return view('accountCenter/accountCenterActivity/addAccountCenterActivity', $data);
	}
	function getNationalStrategy()
	{
		$getNationalStrategyData = DB::table('nationalStrategy')
			->select(
				'nationalStrategy.id',
				'nationalStrategy.StrategyName',
			)
			->where('IsActive', 1)
			->get();
		return $getNationalStrategyData;
	}
	function getDataAccountBudgetCenterActivityDetailById($id)
	{
		$getDataAccountBudgetCenterActivityDetailById = DB::table('accountBudgetCenterActivityDetail')
			->leftjoin('accountBudgetCenterActivity', 'accountBudgetCenterActivity.id', 'accountBudgetCenterActivityDetail.AccountBudgetCenterActivityId')
			->select(
				'accountBudgetCenterActivityDetail.id',
				'accountBudgetCenterActivityDetail.DetailPerformance',
				'accountBudgetCenterActivityDetail.NatureOperation',
				'accountBudgetCenterActivityDetail.Note',
				'accountBudgetCenterActivityDetail.FileName',
				'accountBudgetCenterActivityDetail.FilePath',
				'accountBudgetCenterActivity.AccBudgetCenterId',
				'accountBudgetCenterActivity.ActivityName',
				'accountBudgetCenterActivity.ActivityDetail',
				'accountBudgetCenterActivity.ActivityAmount',
				'accountBudgetCenterActivity.ActivityStartDate',
				'accountBudgetCenterActivity.ActivityEndDate',
			)
			->where('accountBudgetCenterActivityDetail.IsActive', 1)
			->where('accountBudgetCenterActivityDetail.AccountBudgetCenterActivityId', $id)
			->first();
		return $getDataAccountBudgetCenterActivityDetailById;
	}
	function getAccountBudgetCenterActivityById($id)
	{
		$getAccountBudgetCenterActivityById = DB::table('accountBudgetCenterActivity')
			->select(
				'accountBudgetCenterActivity.id',
				'accountBudgetCenterActivity.ActivityName',
				'accountBudgetCenterActivity.ActivityDetail',
				'accountBudgetCenterActivity.ActivityAmount',
				'accountBudgetCenterActivity.ActivityStartDate',
				'accountBudgetCenterActivity.ActivityEndDate',
				'accountBudgetCenterActivity.ActivityStatus',
			)
			->where('accountBudgetCenterActivity.IsActive', 1)
			->where('accountBudgetCenterActivity.AccBudgetCenterId', $id)
			->orderBy('accountBudgetCenterActivity.id')
			->get();
		return $getAccountBudgetCenterActivityById;
	}
	function getAccountBudgetCenterActivityDetailById($id)
	{
		$getAccountBudgetCenterActivityById = DB::table('accountBudgetCenterActivity')
			->select(
				'accountBudgetCenterActivity.*',
			)
			->where('accountBudgetCenterActivity.IsActive', 1)
			->where('accountBudgetCenterActivity.id', $id)
			->first();
		return $getAccountBudgetCenterActivityById;
	}
	function getAccountBudgetCenterSubDetailById($id)
	{
		$getAccountBudgetCenterSubDetailById = DB::table('accountBudgetCenterSubDetail')
			->select(
				'accountBudgetCenterSubDetail.*'
			)
			->where('accountBudgetCenterSubDetail.IsActive', 1)
			->where('accountBudgetCenterSubDetail.AccBudgetCenterSubId', $id)
			->first();
		return $getAccountBudgetCenterSubDetailById;
	}
	function getAccountBudgetCenterSubFileById($id)
	{
		$getAccountBudgetCenterSubFileById = DB::table('transactionFileAccountBudgetCenter')
			->select(
				'transactionFileAccountBudgetCenter.id',
				'transactionFileAccountBudgetCenter.FileName',
				'transactionFileAccountBudgetCenter.FilePath'
			)
			->where('transactionFileAccountBudgetCenter.IsActive', 1)
			->where('transactionFileAccountBudgetCenter.AccBudgetCenterSubId', $id)
			->get();
		return $getAccountBudgetCenterSubFileById;
	}
	function getAccountBudgetCenterById($id)
	{
		$dataAccBudgetCenterById = DB::table('accountBudgetCenter')
			->select('accountBudgetCenter.id', 'accountBudgetCenter.AccName', 'accountBudgetCenter.AccCode', 'accountBudgetCenter.Amount', 'accountBudgetCenter.IsActive', 'accountBudgetCenter.BudgetYear', 'accountBudgetCenter.AccDetail')
			->where('accountBudgetCenter.IsActive', 1)
			->where('accountBudgetCenter.id', $id)
			->first();
		return $dataAccBudgetCenterById;
	}
	function getAccountBudgetCenterSubById($id)
	{
		$getAccountBudgetCenterSubById = DB::table('accountBudgetCenterSub')
			->leftjoin('transactionFileAccountBudgetCenter', 'transactionFileAccountBudgetCenter.AccBudgetCenterId', 'accountBudgetCenterSub.AccBudgetCenterId')
			->select(
				'accountBudgetCenterSub.id',
				'accountBudgetCenterSub.AccBudgetCenterId',
				'accountBudgetCenterSub.AccName',
				'accountBudgetCenterSub.AccCode',
				'accountBudgetCenterSub.Detail',
				'accountBudgetCenterSub.DivisionId',
				'accountBudgetCenterSub.SubAmount',
				'accountBudgetCenterSub.BudgetYear',
				'accountBudgetCenterSub.IsActive',
				'accountBudgetCenterSub.AccStartDate',
				'accountBudgetCenterSub.AccEndDate',
				'transactionFileAccountBudgetCenter.FileName',
				'transactionFileAccountBudgetCenter.FilePath'
			)
			->where('accountBudgetCenterSub.IsActive', 1)
			->where('transactionFileAccountBudgetCenter.IsActive', 1)
			->where('accountBudgetCenterSub.id', $id)
			->first();
		return $getAccountBudgetCenterSubById;
	}
	function getAccountBudgetCenter()
	{
		$dataAccBudgetCenter = DB::table('accountBudgetCenter')
			->select('accountBudgetCenter.id', 'accountBudgetCenter.AccName', 'accountBudgetCenter.AccCode', 'accountBudgetCenter.Amount', 'accountBudgetCenter.IsActive', 'accountBudgetCenter.BudgetYear')
			->where('accountBudgetCenter.IsActive', 1)
			->get();
		return $dataAccBudgetCenter;
	}
	function getAccountBudgetCenterSub()
	{
		$dataAccBudgetCenterSub = DB::table('accountBudgetCenterSub')
			->leftjoin('systemDivision', 'systemDivision.id', 'accountBudgetCenterSub.DivisionId')
			->select(
				'accountBudgetCenterSub.id',
				'accountBudgetCenterSub.AccBudgetCenterId',
				'accountBudgetCenterSub.AccName',
				'accountBudgetCenterSub.AccCode',
				'accountBudgetCenterSub.SubAmount',
				'accountBudgetCenterSub.AccStartDate',
				'accountBudgetCenterSub.AccEndDate',
				'accountBudgetCenterSub.IsActive',
				'systemDivision.name as DivisionName'
			)
			->where('IsActive', 1)
			->get();
		foreach ($dataAccBudgetCenterSub as $key => $val) {
			$AccountBudgetCenterActivity = DB::table('accountBudgetCenterActivity')
				->where('AccBudgetCenterId', $val->id)
				->count();
			$StatusActivity = DB::table('accountBudgetCenterActivity')
				->where('AccBudgetCenterId', $val->id)
				->where('ActivityStatus', 2)
				->count();
			$percentage = ($AccountBudgetCenterActivity == 0 ? 0 : ($StatusActivity / $AccountBudgetCenterActivity) * 100);
			$val->percentage = $percentage;
		}
		return $dataAccBudgetCenterSub;
	}
	function updateAccountActivityDetail(Request $request)
	{
		$AccountBudgetCenterActivityId = $request['AccountBudgetCenterActivityId'];
		$Performance = $request['Performance'];
		$NatureOperation = $request['NatureOperation'];
		$Note = $request['Note'];
		$ActivityStatus = $request['ActivityStatus'];
		$file = $request['file'];
		$totalfiles = $request['totalfiles'];
		$ArrayFile = [];

		DB::beginTransaction();
		try {
			if ($totalfiles == 1) {
				foreach ($file as $index => $val) {
					$AccountBudgetCenterActivityDetailId = DB::table('accountBudgetCenterActivityDetail')->insertGetId([
						'AccountBudgetCenterActivityId' => $AccountBudgetCenterActivityId,
						'DetailPerformance' => $Performance,
						'NatureOperation' => $NatureOperation,
						'Note' => $Note,
						'IsActive' => 1,
						'CreatedAt' => now(),
						'CreatedBy' => CRUDBooster::myId(),
						'FileName' => $val->getClientOriginalName(),
						'FilePath' => "uploads/" . $val->getClientOriginalName()
					]);

					if (!$AccountBudgetCenterActivityDetailId) {
						throw new \Exception('Insert into accountBudgetCenterActivityDetail failed');
					}

					Storage::putFileAs('uploads/', $val, $val->getClientOriginalName());
					array_push($ArrayFile, $val->getClientOriginalName() . '.' . $val->getClientOriginalExtension());
				}

				// Update the IsActive status
				$dataUpdate = [
					'ActivityStatus' => $ActivityStatus,
					'UpdatedAt' => now(),
					'UpdatedBy' => CRUDBooster::myId()
				];
				$updateResult = DB::table('accountBudgetCenterActivity')->where('id', $AccountBudgetCenterActivityId)->update($dataUpdate);

				if (!$updateResult) {
					throw new \Exception('กรุณาทำรายการใหม่อีกครั้ง');
				}

				if ($updateResult) {
					DB::commit();
					return response()->json(['api_status' => 1, 'api_message' => 'Success', 'id' => $updateResult], 200)
						->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
						->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
				} else {
					DB::rollback();
					return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'], 200);
				}
			} else {
				$AccountBudgetCenterActivityDetailId = DB::table('accountBudgetCenterActivityDetail')->insertGetId([
					'AccountBudgetCenterActivityId' => $AccountBudgetCenterActivityId,
					'DetailPerformance' => $Performance,
					'NatureOperation' => $NatureOperation,
					'Note' => $Note,
					'IsActive' => 1,
					'CreatedAt' => now(),
					'CreatedBy' => CRUDBooster::myId(),
					'FileName' => null,
					'FilePath' => null
				]);

				if (!$AccountBudgetCenterActivityDetailId) {
					throw new \Exception('Insert into accountBudgetCenterActivityDetail failed');
				}
				// Update the IsActive status
				$dataUpdate = [
					'ActivityStatus' => $ActivityStatus,
					'UpdatedAt' => now(),
					'UpdatedBy' => CRUDBooster::myId()
				];
				$updateResult = DB::table('accountBudgetCenterActivity')->where('id', $AccountBudgetCenterActivityId)->update($dataUpdate);

				if (!$updateResult) {
					throw new \Exception('กรุณาทำรายการใหม่อีกครั้ง');
				}

				if ($updateResult) {
					DB::commit();
					return response()->json(['api_status' => 1, 'api_message' => 'Success', 'id' => $updateResult], 200)
						->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
						->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
				} else {
					DB::rollback();
					return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'], 200);
				}
			}
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง', 'api_data' => $e], 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
	}
}