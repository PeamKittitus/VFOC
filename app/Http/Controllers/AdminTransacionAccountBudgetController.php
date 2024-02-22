<?php
namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use CRUDBooster;

class AdminTransacionAccountBudgetController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{

		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->title_field = "id";
		$this->limit = "20";
		$this->orderby = "TransactionAccBudgeId,desc";
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
		$this->table = "TransacionAccountBudget";
		# END CONFIGURATION DO NOT REMOVE THIS LINE

		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = [];

		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = [];

		# END FORM DO NOT REMOVE THIS LINE

		# OLD START FORM
		//$this->form = [];
		//$this->form[] = ["label"=>"TransactionAccBudgeId","name"=>"TransactionAccBudgeId","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"AccountBudgetd","name"=>"AccountBudgetd","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Title","name"=>"Title","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"TransactionYear","name"=>"TransactionYear","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"TransactionType","name"=>"TransactionType","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"SenderOrgId","name"=>"SenderOrgId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"SenderBookBankId","name"=>"SenderBookBankId","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"ReceiverOrgId","name"=>"ReceiverOrgId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"ReceiverBookBankId","name"=>"ReceiverBookBankId","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Amount","name"=>"Amount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"SenderDate","name"=>"SenderDate","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
		//$this->form[] = ["label"=>"ReceiverDate","name"=>"ReceiverDate","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
		//$this->form[] = ["label"=>"UpdateDate","name"=>"UpdateDate","type"=>"datetime","required"=>TRUE,"validation"=>"required|date_format:Y-m-d H:i:s"];
		//$this->form[] = ["label"=>"UpdateBy","name"=>"UpdateBy","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"IsAcept","name"=>"IsAcept","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
		$this->alert = array();



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
		return view('transectionBudget/index');
	}

	public function addtransectionBudget()
	{
		return view('transectionBudget/addTransactionBudget');
	}

	public function saveTransectionBudget(Request $request)
	{
		// dd($request->Village);

		$myId = 45;
		$villageID = $request->Village;
		

		$OrgId = DB::table('user')
			->select('user.orgProvinceId')
			->where('user.is_active', 1)
			->where('user.cmsUserId', CRUDBooster::myId()) //ถ้าใช้งานจริงใช้อันนี้
			// ->where('user.cmsUserId', $myId) // mockdata 
			->value('orgProvinceId');

		$Projectname = DB::table('village')
			->select('village.VillageName')
			->where('village.UserId', $villageID) 
			->value('VillageName');
		// dd($Projectname);

		$file = $request['FileUpload'];	

		$dataTranBudget = [];
		$dataTranBudget['AccountBudgetd'] = $request->AccountBudgetd;
		$dataTranBudget['Title'] = "โอนเงินไปยังโครงการ " . $Projectname;
		$dataTranBudget['TransactionYear'] = date('Y') + 543;
		$dataTranBudget['TransactionType'] = 0; //or something		
		$dataTranBudget['SenderOrgId'] = $OrgId;
		$dataTranBudget['SenderBookBankId'] = $request->SenderBookBankId;
		$dataTranBudget['ReceiverOrgId'] = $request->OrgType;
		$dataTranBudget['ReceiverBookBankId'] = $request->ReceiverBookBankId;
		$dataTranBudget['ReceiverDate'] = now();
		$dataTranBudget['Amount'] = $request->Amount;
		$dataTranBudget['SenderDate'] = now();
		$dataTranBudget['IsAcept'] = 0; 
		// dd($dataTranBudget);
		//ค่าดว่ากองทุนจะต้องกดยืนยันก่อน ค่อยจะปรับเป็น 1
		//กองทุน กด accept จะอัพเดท reciverdata and updaatedat and IsAcept

		DB::beginTransaction();
		try {
			$tranBudgetId = DB::table('transacionAccountBudget')->insertGetId($dataTranBudget);
			if ($file !== "undefined") {
				$dataInsertFileProject = [];
				$dataInsertFileProject['TransactionAccBudgetId'] = $tranBudgetId;
				$dataInsertFileProject['TransactionYear'] = date('Y')+543;
				$dataInsertFileProject['FileName'] = $file->getClientOriginalName();
				$dataInsertFileProject['FilePath'] = "uploads/transactionDocument" . $file->getClientOriginalName();
				$dataInsertFileProject['FileType'] = 1;
				$dataInsertFileProject['created_at'] = now();
				$dataInsertFileProject['created_by'] = CRUDBooster::myId();
				$dataInsertFileProject['is_active'] = 1;
				// dd($dataInsertFileProject);
				$tranBudgetDoc = DB::table('transacionAccountBudgetDocument')->insertGetId($dataInsertFileProject);
				Storage::putFileAs('uploads/transactionDocument', $file, $file->getClientOriginalName());
			} 
			// dd($tranBudgetId);
			if ($tranBudgetId) {
				DB::commit();
				$data['api_status'] = 1;
				$data['api_message'] = 'Success';
				$data['id'] = $tranBudgetId;

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

}