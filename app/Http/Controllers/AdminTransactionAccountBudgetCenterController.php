<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use CRUDBooster;
use Illuminate\Support\Facades\Storage;
use \stdClass;
use Illuminate\Support\Facades\Mail;
use App\Mail\JobMail;
use Exception;

	class AdminTransactionAccountBudgetCenterController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "AccBudgetCenterSubId,desc";
			$this->global_privilege = false;
			$this->button_table_action = false;
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = false;
			$this->button_filter = false;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "transactionAccountBudgetCenter";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];

			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"AccBudgetCenterSubId","name"=>"AccBudgetCenterSubId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"TransactionYear","name"=>"TransactionYear","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Amount","name"=>"Amount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"RealAmount","name"=>"RealAmount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TotalAmount","name"=>"TotalAmount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Detail","name"=>"Detail","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"ReceiverDate","name"=>"ReceiverDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"DivisionId","name"=>"DivisionId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
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
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }
	    //By the way, you can still create your own method in here... :) 
		public function getIndex()
		{
			$data['getTransactionAccountBudgetCenterSub'] = $this->getTransactionAccountBudgetCenterSub();
			return view('accountCenter/accountExpenses/index', $data);
		}
		
		public function addAccountExpenses()
		{
			$data = [
				'generateYearOptions' => (new FunctionController)->generateYearOptions(),
				'getDivision' => (new FunctionController)->getDivision(),
				'getAccountBudgetCenterSub' => $this->getAccountBudgetCenterSub(),
			];
		
			return view('accountCenter/accountExpenses/addAccountExpenses', $data);
		}
		
		function getTransactionAccountBudgetCenterSub()
		{
			$getTransactionAccountBudgetCenterSub = DB::table('transactionAccountBudgetCenter')
				->leftjoin('systemDivision', 'systemDivision.id', 'transactionAccountBudgetCenter.DivisionId')
				->leftjoin('accountBudgetCenterSub', 'accountBudgetCenterSub.id', 'transactionAccountBudgetCenter.AccBudgetCenterSubId')
				->select(
					'transactionAccountBudgetCenter.id',
					'transactionAccountBudgetCenter.AccBudgetCenterSubId',
					'transactionAccountBudgetCenter.TransactionYear',
					'transactionAccountBudgetCenter.Amount',
					'transactionAccountBudgetCenter.RealAmount',
					'transactionAccountBudgetCenter.Detail',
					'transactionAccountBudgetCenter.ReceiverDate',
					'transactionAccountBudgetCenter.CreatedAt',
					'transactionAccountBudgetCenter.Status',
					'transactionAccountBudgetCenter.TotalAmount',
					'systemDivision.name as DivisionName',
					'accountBudgetCenterSub.AccName',
				)
				->where('transactionAccountBudgetCenter.IsActive', 1)
				->orderBy('transactionAccountBudgetCenter.id')
				->get();
			return $getTransactionAccountBudgetCenterSub;
		}
		function getAccountBudgetCenterSub()
		{
			$dataAccBudgetCenterSub = DB::table('accountBudgetCenterSub')
				->leftjoin('systemDivision', 'systemDivision.id', 'accountBudgetCenterSub.DivisionId')
				->select(
					'accountBudgetCenterSub.id',
					'accountBudgetCenterSub.AccBudgetCenterId',
					'accountBudgetCenterSub.AccName',
					'accountBudgetCenterSub.IsActive',
					'systemDivision.name as DivisionName'
				)
				->where('IsActive', 1)
				->get();
			return $dataAccBudgetCenterSub;
		}
		function getAccountBudgetCenterSubDetail(Request $request)
		{
			$AccountBudgetCenterSubId = $request['AccountBudgetCenterSubId'];
			$AccountBudgetCenterSubData = DB::table('accountBudgetCenterSub')->where('id', $AccountBudgetCenterSubId)->where('IsActive',1)->first();
			try {
				if ($AccountBudgetCenterSubData) {
					$data['api_status'] = 1;
					$data['api_message'] = 'สำเร็จ';
					$data['api_data'] = $AccountBudgetCenterSubData;
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
		function getAccountBudgetCenterSubDetailActivity(Request $request)
		{
			$AccountBudgetCenterSubId = $request['AccountBudgetCenterSubId'];
			$getAccountBudgetCenterSubById = DB::table('accountBudgetCenterActivity')
			->select(
				'accountBudgetCenterActivity.id',
				'accountBudgetCenterActivity.AccBudgetCenterId',
				'accountBudgetCenterActivity.ActivityName',
				'accountBudgetCenterActivity.ActivityDetail',
				'accountBudgetCenterActivity.ActivityAmount',
				'accountBudgetCenterActivity.IsActive',
				'accountBudgetCenterActivity.ActivityAmountStatus',
			)
			->where('accountBudgetCenterActivity.IsActive', 1)
			->where('accountBudgetCenterActivity.AccBudgetCenterId', $AccountBudgetCenterSubId)
			->get();
			try {
				if ($getAccountBudgetCenterSubById) {
					$data['api_status'] = 1;
					$data['api_message'] = 'สำเร็จ';
					$data['api_data'] = $getAccountBudgetCenterSubById;
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
		function addAccountExpensesApi(Request $request)
		{
			$data = [];
			// $DivisionId = $request->input('DivisionId');
			$AccountBudgetCenterSubId = $request->input('AccountBudgetCenterSubId');
			$BudgetYear = $request->input('BudgetYear');
			$ReceiverDate = $request->input('ReceiverDate');
			$Detail = $request->input('Detail');
			$Amount = $request->input('Amount');
			$Status = $request->input('Status');
			$TotalAmount = $request->input('TotalAmount');

			$IdActivity = $request['IdActivity'];

			$AccountBudgetCenterSubData = DB::table('accountBudgetCenterSub')->where('id', $AccountBudgetCenterSubId)->where('IsActive',1)->first();
			$RealAmount = $AccountBudgetCenterSubData->SubAmount;
			DB::beginTransaction();
			try {
				$dataInsert = [
					// 'DivisionId' => $DivisionId,
					'AccBudgetCenterSubId' => $AccountBudgetCenterSubId,
					'TransactionYear' => $BudgetYear,
					'Amount' => $Amount,
					'RealAmount' => $RealAmount,
					'TotalAmount' => $TotalAmount,
					'Detail' => $Detail,
					'ReceiverDate' => $ReceiverDate,
					'Status' => $Status,
					'IsActive' => 1,
					'CreatedAt' => now(),
					'CreatedBy' => CRUDBooster::myId()
				];

				$TransactionAccountBudgetCenterId = DB::table('transactionAccountBudgetCenter')->insertGetId($dataInsert);

				$dataUpdate = [
					'TotalAmount' => $TotalAmount,
					'UpdatedAt' => now(),
					'UpdatedBy' => CRUDBooster::myId()
				];
				$updatedRows = DB::table('accountBudgetCenterSub')->where('id', $AccountBudgetCenterSubId)->update($dataUpdate);

				foreach ($IdActivity as $Act) {
					$decodedActivity = json_decode($Act, true);
					$ActivityId = $decodedActivity;

					$UpdateStatusAmount = [];
					$UpdateStatusAmount['ActivityAmountStatus'] = 2;
					$ActivityAmountStatusId = DB::table('accountBudgetCenterActivity')->where('id', $ActivityId)->update($UpdateStatusAmount);
				}

				if ($TransactionAccountBudgetCenterId && $updatedRows) {
					DB::commit();
					$data = [
						'api_status' => 1,
						'api_message' => 'Success',
						'id' => $TransactionAccountBudgetCenterId
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
	}