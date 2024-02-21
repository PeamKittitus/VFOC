<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use DB;
use CRUDBooster;

class AdminApproveProjectBudgetController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "id";
		$this->limit = "20";
		$this->orderby = "id,desc";
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
		$this->table = "projectAsset";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];

		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];

		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ["label"=>"ProjectBudgetId","name"=>"ProjectBudgetId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillageId","name"=>"VillageId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"AssetCode","name"=>"AssetCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"AssetName","name"=>"AssetName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Status","name"=>"Status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"AssetAge","name"=>"AssetAge","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"Amount","name"=>"Amount","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"AmountUnit","name"=>"AmountUnit","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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


	public function getIndex()
	{
		// $GetReportCreatorMost = (new ApiNewsController)->GetReportCreatorMost();
		// $generateYearOptions = (new FunctionController)->generateYearOptions();
		// $data['GetReportCreatorMost'] = $GetReportCreatorMost;
		// $data['generateYearOptions'] = $generateYearOptions;
		$data = [];
		$data['page_title'] = 'พิจารณาอนุมัติโครงการ';
		$data['ProjectBudget'] = $this->GetAllProjectBudget();
		return $this->view('approveproject/index', $data);
	}


	public function GetAllProjectBudget()
	{
		$ProjectBudget = DB::table("projectBudget")->where('IsActive', 1)->get();
		return $ProjectBudget;
		//
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
			$budgetdata =DB::table('projectBudget')
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
	//By the way, you can still create your own method in here... :) 


}
