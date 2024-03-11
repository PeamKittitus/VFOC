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

class AdminAccountBudgetCenterController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table 			   = "accountBudgetCenter";
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
		//$this->form[] = ["label"=>"AccName","name"=>"AccName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"BudgetYear","name"=>"BudgetYear","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"AccCode","name"=>"AccCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Amount","name"=>"Amount","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"IsActive","name"=>"IsActive","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"CreatedAt","name"=>"CreatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"CreatedBy","name"=>"CreatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"UpdatedAt","name"=>"UpdatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"UpdatedBy","name"=>"UpdatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
		$data['getAccountBudgetCenter'] = $getAccountBudgetCenter;
		$data['getAccountBudgetCenterSub'] = $getAccountBudgetCenterSub;
		return view('accountCenter/index', $data);
	}
	public function addAccountBudgetCenter()
	{
		$generateYearOptions = (new FunctionController)->generateYearOptions();
		$data['generateYearOptions'] = $generateYearOptions;
		return view('accountCenter/addAccountBudgetCenter', $data);
	}
	public function editAccountBudgetCenter($id)
	{
		$generateYearOptions = (new FunctionController)->generateYearOptions();
		$data['generateYearOptions'] = $generateYearOptions;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($id);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		return view('accountCenter/editAccountBudgetCenter', $data);
	}
	public function addAccountBudgetSubCenter($id)
	{
		$generateYearOptions = (new FunctionController)->generateYearOptions();
		$data['generateYearOptions'] = $generateYearOptions;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($id);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		return view('accountCenter/accountSubCenter/addAccountSubBudgetCenter', $data);
	}
	public function editAccountBudgetCenterSub($id)
	{
		$getAccountBudgetCenterSubById = $this->getAccountBudgetCenterSubById($id);
		$data['getAccountBudgetCenterSubById'] = $getAccountBudgetCenterSubById;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($getAccountBudgetCenterSubById->AccBudgetCenterId);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		$getAccountBudgetCenterSubFileById = $this->getAccountBudgetCenterSubFileById($id);
		$data['getAccountBudgetCenterSubFileById'] = $getAccountBudgetCenterSubFileById;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		return view('accountCenter/accountSubCenter/editAccountBudgetCenterSub', $data);
	}
	public function addAccountBudgetCenterActivity($id)
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
		return view('accountCenter/accountSubCenter/addAccountBudgetCenterActivity', $data);
	}
	public function viewAccountBudgetCenterSub($id)
	{
		$getAccountBudgetCenterSubById = $this->getAccountBudgetCenterSubById($id);
		$data['getAccountBudgetCenterSubById'] = $getAccountBudgetCenterSubById;
		$getAccountBudgetCenterSubFileById = $this->getAccountBudgetCenterSubFileById($id);
		$data['getAccountBudgetCenterSubFileById'] = $getAccountBudgetCenterSubFileById;
		$getDivision = (new FunctionController)->getDivision();
		$data['getDivision'] = $getDivision;
		$getAccountBudgetCenterActivityById = $this->getAccountBudgetCenterActivityById($id);
		$data['getAccountBudgetCenterActivityById'] = $getAccountBudgetCenterActivityById;
		$getAccountBudgetCenterById = $this->getAccountBudgetCenterById($getAccountBudgetCenterSubById->AccBudgetCenterId);
		$data['getAccountBudgetCenterById'] = $getAccountBudgetCenterById;
		return view('accountCenter/accountSubCenter/viewAccountBudgetCenterSub', $data);
	}
	
	function addAccountBudgetCenterApi(Request $request)
	{
		$data = [];
		$AccName = $request->input('AccName');
		$BudgetYear = $request->input('BudgetYear');
		$Amount = $request->input('Amount');
		$AccDetail = $request->input('AccDetail');
		// Count existing data
		$countData = DB::table('accountBudgetCenter')->count();
		$AccCode = $BudgetYear . '-' . sprintf('%03d', $countData + 1);

		DB::beginTransaction();
		try {
			$dataInsert = [
				'AccName' => $AccName,
				'BudgetYear' => $BudgetYear,
				'Amount' => $Amount,
				'AccCode' => $AccCode,
				'AccDetail' => $AccDetail,
				'IsActive' => 1,
				'CreatedAt' => now(),
				'CreatedBy' => CRUDBooster::myId()
			];

			$AccountBudgetCenterId = DB::table('accountBudgetCenter')->insertGetId($dataInsert);

			if ($AccountBudgetCenterId) {
				DB::commit();
				$data = [
					'api_status' => 1,
					'api_message' => 'Success',
					'id' => $AccountBudgetCenterId
				];
			} else {
				DB::rollback();
				$data = [
					'api_status' => 0,
					'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'
				];
			}
		} catch (\Exception $e) {
			DB::rollback();
			$data = [
				'api_status' => 0,
				'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง',
				'api_data' => $e
			];
		}
		return response()->json($data, 200)
			->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
			->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
	}
	function editAccountBudgetCenterApi(Request $request)
	{
		$data = [];
		$AccId = $request->input('AccId');
		$AccName = $request->input('AccName');
		$BudgetYear = $request->input('BudgetYear');
		$Amount = $request->input('Amount');
		$AccDetail = $request->input('AccDetail');
		DB::beginTransaction();
		try {
			$dataUpdate = [
				'AccName' => $AccName,
				'BudgetYear' => $BudgetYear,
				'AccDetail' => $AccDetail,
				'Amount' => $Amount,
				'UpdatedAt' => now(),
				'UpdatedBy' => CRUDBooster::myId()
			];

			$success = DB::table('accountBudgetCenter')
				->where('id', $AccId)
				->update($dataUpdate);

			if ($success) {
				DB::commit();
				$data = [
					'api_status' => 1,
					'api_message' => 'Success',
					'id' => $AccId
				];
			} else {
				DB::rollback();
				$data = [
					'api_status' => 0,
					'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'
				];
			}
		} catch (\Exception $e) {
			DB::rollback();
			$data = [
				'api_status' => 0,
				'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง',
				'api_data' => $e
			];
		}

		return response()->json($data, 200)
			->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
			->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
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
		return $dataAccBudgetCenterSub;
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
	function getAccountBudgetCenterActivityById($id)
	{
		$getAccountBudgetCenterActivityById = DB::table('accountBudgetCenterActivity')
			->select(
				'accountBudgetCenterActivity.id',
				'accountBudgetCenterActivity.ActivityName',
				'accountBudgetCenterActivity.ActivityDetail',
				'accountBudgetCenterActivity.ActivityAmount'
			)
			->where('accountBudgetCenterActivity.IsActive', 1)
			->where('accountBudgetCenterActivity.AccBudgetCenterId', $id)
			->orderBy('accountBudgetCenterActivity.id')
			->get();
		return $getAccountBudgetCenterActivityById;
	}
	function getAccountBudgetCenterActivityByIdApi(Request $request)
	{
		$ActivityId = $request['ActivityId'];
		$getAccountBudgetCenterActivityById = DB::table('accountBudgetCenterActivity')
			->select(
				'accountBudgetCenterActivity.id',
				'accountBudgetCenterActivity.AccBudgetCenterId',
				'accountBudgetCenterActivity.ActivityName',
				'accountBudgetCenterActivity.ActivityDetail',
				'accountBudgetCenterActivity.ActivityAmount'
			)
			->where('accountBudgetCenterActivity.IsActive', 1)
			->where('accountBudgetCenterActivity.id', $ActivityId)
			->first();
			response()->json($getAccountBudgetCenterActivityById, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
	}
	function delAccountBudgetCenter(Request $request)
	{
		$AccId = $request['AccId'];

		try {
			DB::beginTransaction();

			// Check if there are any active related entries
			$activeEntries = DB::table('accountBudgetCenterSub')
				->select('id')
				->where('AccBudgetCenterId', $AccId)
				->where('IsActive', '!=', 0)
				->exists();

			if ($activeEntries) {
				throw new \Exception('คุณจะต้องลบโครงการย่อยก่อน');
			}

			// Update the IsActive status
			$dataUpdate = [
				'IsActive' => 0,
				'UpdatedAt' => now(),
				'UpdatedBy' => CRUDBooster::myId()
			];

			$updateResult = DB::table('accountBudgetCenter')
				->where('id', $AccId)
				->update($dataUpdate);

			if (!$updateResult) {
				throw new \Exception('กรุณาทำรายการใหม่อีกครั้ง');
			}

			DB::commit();

			$data = [
				'api_status' => 1,
				'api_message' => 'Success',
				'id' => $AccId
			];

			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		} catch (\Exception $e) {
			DB::rollback();

			$data = [
				'api_status' => 0,
				'api_message' => $e->getMessage()
			];

			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
	}
	function delSubAccountBudgetCenter(Request $request)
	{
		$AccId = $request['AccCenterSubId'];
		DB::beginTransaction();
		try {
			$existingDelete = DB::table('accountBudgetCenterSub')->where('id', $AccId)->first();
			if ($existingDelete->IsActive == 1) {
				$dataUpdate['IsActive'] = 0;
				$dataUpdate['UpdatedAt'] = date('Y-m-d H:i:s');
				$dataUpdate['UpdatedBy'] = CRUDBooster::myId();
				$UpdateIsActive = DB::table('accountBudgetCenterSub')->where('id', $AccId)->update($dataUpdate);
				if ($UpdateIsActive) {
					DB::commit();
					$data['api_status'] = 1;
					$data['api_message'] = 'Success';
					$data['id'] = $UpdateIsActive;
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
		} catch (\Exception $e) {
			DB::rollback();
			$data['api_status'] = 0;
			$data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
			$data['api_data'] = $e;
		}
		response()->json($data, 200)->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
			->header("Access-Control-Allow-Methods", config('cors.allowed_methods'))->send();
	}
	function addAccountBudgetSubCenterApi(Request $request)
	{
		$AccId = $request->input('AccId');
		$BudgetYear = $request->input('BudgetYear');
		$AccName = $request->input('AccName');
		$DivisionId = $request->input('DivisionId');
		$SubAmount = $request->input('SubAmount');
		$AccStartDate = $request->input('AccStartDate');
		$AccEndDate = $request->input('AccEndDate');
		$totalfiles = $request->input('totalfiles');
		$Detail = $request->input('Detail');
		$file = $request->file('file');
		$array_file = [];

		// Get data from database
		$DataAccBudgetCenter = DB::table('accountBudgetCenter')->where('id', $AccId)->first();
		$AccBudgetCenterAmount = $DataAccBudgetCenter->Amount;

		$DataAccBudgetCenterSubCount = DB::table('accountBudgetCenterSub')->where('AccBudgetCenterId', $AccId)->count();
		$DataAccBudgetSubCenterSumAmount = DB::table('accountBudgetCenterSub')->where('AccBudgetCenterId', $AccId)->where('IsActive', 1)->get();

		// Check if sub amount exceeds budget center amount
		if ($DataAccBudgetSubCenterSumAmount->isEmpty()) {
			if ($SubAmount > $AccBudgetCenterAmount) {
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
			}
		} else {
			$sumAmount = $DataAccBudgetSubCenterSumAmount->sum('SubAmount') + $SubAmount;
			if ($sumAmount > $AccBudgetCenterAmount) {
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
			}
		}

		// Begin transaction
		DB::beginTransaction();

		try {
			// Insert data into accountBudgetCenterSub table
			$AccCode = $DataAccBudgetCenter->AccCode;
			$AccCodeSub = $AccCode . '-' . sprintf('%03d', $DataAccBudgetCenterSubCount + 1);

			$AccountBudgetSubCenterId = DB::table('accountBudgetCenterSub')->insertGetId([
				'AccBudgetCenterId' => $AccId,
				'AccName' => $AccName,
				'AccCode' => $AccCodeSub,
				'Detail' => $Detail,
				'DivisionId' => $DivisionId,
				'SubAmount' => $SubAmount,
				'AccStartDate' => $AccStartDate,
				'AccEndDate' => $AccEndDate,
				'BudgetYear' => $BudgetYear,
				'IsActive' => 1,
				'CreatedAt' => now(),
				'CreatedBy' => CRUDBooster::myId()
			]);

			if (!$AccountBudgetSubCenterId) {
				throw new \Exception('Insert into accountBudgetCenterSub failed');
			}

			// Insert data into transactionFileAccountBudgetCenter table
			foreach ($file as $index => $val) {
				$TransactionFileAccountBudgetCenterId = DB::table('transactionFileAccountBudgetCenter')->insertGetId([
					'AccBudgetCenterId' => $AccId,
					'AccBudgetCenterSubId' => $AccountBudgetSubCenterId,
					'TransactionYear' => $BudgetYear,
					'IsActive' => 1,
					'CreatedAt' => now(),
					'CreatedBy' => CRUDBooster::myId(),
					'FileName' => $val->getClientOriginalName(),
					'FilePath' => "uploads/" . $val->getClientOriginalName()
				]);

				if (!$TransactionFileAccountBudgetCenterId) {
					throw new \Exception('Insert into transactionFileAccountBudgetCenter failed');
				}

				Storage::putFileAs('uploads/', $val, $val->getClientOriginalName());
				array_push($array_file, $val->getClientOriginalName() . '.' . $val->getClientOriginalExtension());
			}

			// Commit transaction
			DB::commit();

			return response()->json(['api_status' => 1, 'api_message' => 'Success', 'id' => $TransactionFileAccountBudgetCenterId], 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		} catch (\Exception $e) {
			// Rollback transaction if any exception occurs
			DB::rollback();
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง', 'api_data' => $e], 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
	}
	function editAccountBudgetCenterSubApi(Request $request)
	{
		$AccId = $request['AccId'];
		$AccSubId = $request['AccSubId'];
		$SubAmount = $request['SubAmount'];

		// Get data from database
		$AccBudgetCenterAmount = DB::table('accountBudgetCenter')->where('id', $AccId)->value('Amount');

		// Get filtered data
		$filteredData = DB::table('accountBudgetCenterSub')
			->select('SubAmount')
			->where('AccBudgetCenterId', $AccId)
			->where('IsActive', 1)
			->where('id', '!=', $AccSubId)
			->get();

		// Check if sub amount exceeds budget center amount
		$sumAmount = $filteredData->sum('SubAmount') + $SubAmount;
		if ($sumAmount > $AccBudgetCenterAmount) {
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
		}

		// Update the database
		DB::beginTransaction();
		try {
			$dataUpdateSub = $request->only(['AccName', 'DivisionId', 'SubAmount', 'Detail', 'AccStartDate', 'AccEndDate']);
			$dataUpdateSub['UpdatedAt'] = date('Y-m-d');
			$dataUpdateSub['UpdatedBy'] = CRUDBooster::myId();

			$updatedRows = DB::table('accountBudgetCenterSub')->where('id', $AccSubId)->update($dataUpdateSub);

			if ($updatedRows) {
				DB::commit();
				return response()->json(['api_status' => 1, 'api_message' => 'Success', 'id' => $AccSubId], 200)
					->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
					->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
			} else {
				DB::rollback();
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'], 200);
			}
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง', 'api_data' => $e], 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
	}
	function addAccountBudgetCenterActivityApi(Request $request)
	{
		$data = [];
		$accSubId = $request->input('accSubId');
		$ActivityName = $request->input('ActivityName');
		$ActivityDetail = $request->input('ActivityDetail');
		$ActivityAmount = $request->input('ActivityAmount');

		// Get data from database
		$DataAccBudgetCenterSub = DB::table('accountBudgetCenterSub')->where('id', $accSubId)->first();
		$AccBudgetCenterSubAmount = $DataAccBudgetCenterSub->SubAmount; //1000000
		$DataAccBudgetSubCenterActivitySumAmount = DB::table('accountBudgetCenterActivity')->where('AccBudgetCenterId', $accSubId)->where('IsActive', 1)->get();
		// Check if sub amount exceeds budget center amount
		if ($DataAccBudgetSubCenterActivitySumAmount->isEmpty()) {
			if ($ActivityAmount > $AccBudgetCenterSubAmount) {
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
			}
		} else {
			$sumAmount = $DataAccBudgetSubCenterActivitySumAmount->sum('ActivityAmount') + $ActivityAmount;
			if ($sumAmount > $AccBudgetCenterSubAmount) {
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
			}
		}
		
		DB::beginTransaction();
		try {
			$dataInsert = [
				'AccBudgetCenterId' => $accSubId,
				'ActivityName' => $ActivityName,
				'ActivityDetail' => $ActivityDetail,
				'ActivityAmount' => $ActivityAmount,
				'IsActive' => 1,
				'UserId'  => CRUDBooster::myId(),
				'CreatedAt' => now(),
				'CreatedBy' => CRUDBooster::myId()
			];

			$AccountBudgetCenterActivityId = DB::table('accountBudgetCenterActivity')->insertGetId($dataInsert);

			if ($AccountBudgetCenterActivityId) {
				DB::commit();
				$data = [
					'api_status' => 1,
					'api_message' => 'Success',
					'id' => $AccountBudgetCenterActivityId
				];
			} else {
				DB::rollback();
				$data = [
					'api_status' => 0,
					'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'
				];
			}
		} catch (\Exception $e) {
			DB::rollback();
			$data = [
				'api_status' => 0,
				'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง',
				'api_data' => $e
			];
		}
		return response()->json($data, 200)
			->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
			->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
	}
	function editAccountBudgetCenterActivity(Request $request)
	{
		$ActivityModalId = $request['ActivityModalId'];
		$AccBudgetCenterId = $request['AccBudgetCenterId'];
		$ActivityModalName = $request['ActivityModalName'];
		$ActivityModalDetail = $request['ActivityModalDetail'];
		$ActivityModalAmount = $request['ActivityModalAmount'];
		
		// Get data from database
		$AccBudgetCenterAmount = DB::table('accountBudgetCenterSub')->where('id', $AccBudgetCenterId)->value('SubAmount');

		// Get filtered data
		$filteredData = DB::table('accountBudgetCenterActivity')
			->select('ActivityAmount')
			->where('AccBudgetCenterId', $AccBudgetCenterId)
			->where('IsActive', 1)
			->where('id', '!=', $ActivityModalId)
			->get();
		// Check if sub amount exceeds budget center amount
		$sumAmount = $filteredData->sum('ActivityAmount') + $ActivityModalAmount;
		if ($sumAmount > $AccBudgetCenterAmount) {
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาตรวจสอบข้อมูลวงเงินในโครงการ'], 200);
		}

		// Update the database
		DB::beginTransaction();
		try {
			$dataUpdate = [
				'ActivityName' => $ActivityModalName,
				'ActivityDetail' => $ActivityModalDetail,
				'ActivityAmount' => $ActivityModalAmount,
				'UpdatedAt' => now(),
				'UpdatedBy' => CRUDBooster::myId()
			];
			$updatedRows = DB::table('accountBudgetCenterActivity')->where('id', $ActivityModalId)->update($dataUpdate);

			if ($updatedRows) {
				DB::commit();
				return response()->json(['api_status' => 1, 'api_message' => 'Success', 'id' => $updatedRows], 200)
					->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
					->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
			} else {
				DB::rollback();
				return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง'], 200);
			}
		} catch (\Exception $e) {
			DB::rollback();
			return response()->json(['api_status' => 0, 'api_message' => 'กรุณาทำรายการใหม่อีกครั้ง', 'api_data' => $e], 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
	}
	
}
