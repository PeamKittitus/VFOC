<?php namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use DB;
	use CRUDBooster;
	use Illuminate\Support\Facades\Storage;

	class AdminProjectBudgetController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

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
			$this->table = "projectBudget";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];

			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"VillageId","name"=>"VillageId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"OrgId","name"=>"OrgId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"AccountBudgetSubId","name"=>"AccountBudgetSubId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"ProjectCode","name"=>"ProjectCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"TransactionYear","name"=>"TransactionYear","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"ProjectName","name"=>"ProjectName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Amount","name"=>"Amount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"Status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"SignProjectDate","name"=>"SignProjectDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"StartProjectDate","name"=>"StartProjectDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"EndProjectDate","name"=>"EndProjectDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"CreatedAt","name"=>"CreatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"CreatedBy","name"=>"CreatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"UpdatedAt","name"=>"UpdatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"UpdatedBy","name"=>"UpdatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"IsActive","name"=>"IsActive","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
			$getDataProjectBudget = $this->getDataProjectBudget();
			$data['getDataProjectBudget'] = $getDataProjectBudget;
			return view('project/superuser/index', $data);
		}
		public function addProjectBudget()
		{
			$data['AddProjectBudget'] = 'AddProjectBudget';
			return view('project/superuser/addProject', $data);
		}
		public function detailProject($id)
		{
			$getVillageDetail = $this->getVillageDetail($id);
			$getProjectActivity = $this->getProjectActivity($id);
			$getProjectAsset = $this->getProjectAsset($id);
			$getProjectFile = $this->getProjectFile($id);
			
			$data['getVillageDetail'] = $getVillageDetail;
			$data['getProjectActivity'] = $getProjectActivity;
			$data['getProjectAsset'] = $getProjectAsset;
			$data['getProjectFile'] = $getProjectFile;
			return view('project/superuser/detailProject', $data);
		}
		function getVillageDetail($id)
		{
			$VillageDetail = DB::table('projectBudget')
				->leftjoin('village','village.id','projectBudget.VillageId')
				->leftjoin('systemProvinces','systemProvinces.id','village.VillageProvinceId')
				->leftjoin('systemAmphures','systemAmphures.id','village.VillageDistrictId')
				->leftjoin('systemTambons','systemTambons.id','village.VillageSubDistrictId')
				->select(
					'village.id',
					'village.VillageName', 
					'village.VillageAddress',
					'village.VillageMoo',
					'village.VillagePostCode',
					'village.Phone as VillagePhone',
					'village.Email as VillageEmail',
					'village.VillageProvinceId',
					'village.VillageDistrictId',
					'village.VillageSubDistrictId',
					'systemProvinces.name_th as ProvinceName',
					'systemAmphures.name_th as AmphuresName',
					'systemTambons.name_th as TambonsName',
					'projectBudget.Amount',
					'projectBudget.TransactionYear',
					'projectBudget.ProjectName',
					'projectBudget.ProjectCode'
				)
				->where('village.IsActive',1)
				->where('projectBudget.IsActive',1)
				->where('projectBudget.id',$id)
				->first();
			return $VillageDetail;
		}
		function getProjectActivity($id)
		{
			$ProjectActivityDetail = DB::table('projectActivity')
				->leftjoin('projectBudget','projectBudget.id','projectActivity.ProjectBudgetId')
				->select(
					'projectActivity.id',
					'projectActivity.ActivityDetail', 
					'projectActivity.StartActivityDate',
					'projectActivity.EndActivityDate',
				)
				->where('projectBudget.IsActive',1)
				->where('projectActivity.ProjectBudgetId',$id)
				->get();
			return $ProjectActivityDetail;
		}
		function getProjectAsset($id)
		{
			$ProjectAssetDetail = DB::table('projectAsset')
				->leftjoin('projectBudget','projectBudget.id','projectAsset.ProjectBudgetId')
				->select(
					'projectAsset.id',
					'projectAsset.AssetCode', 
					'projectAsset.AssetName',
					'projectAsset.AssetAge',
					'projectAsset.Amount',
					'projectAsset.AmountUnit',
				)
				->where('projectBudget.IsActive',1)
				->where('projectAsset.ProjectBudgetId',$id)
				->get();
			return $ProjectAssetDetail;
		}
		function getProjectFile($id)
		{
			$ProjectFileDetail = DB::table('projectBudgetDocumentRequest')
				->leftjoin('projectBudget','projectBudget.id','projectBudgetDocumentRequest.ProjectBudgetId')
				->select(
					'projectBudgetDocumentRequest.id',
					'projectBudgetDocumentRequest.FileName', 
					'projectBudgetDocumentRequest.FilePath',
				)
				->where('projectBudget.IsActive',1)
				->where('projectBudgetDocumentRequest.ProjectBudgetId',$id)
				->get();
			return $ProjectFileDetail;
		}
		
		function getDataProjectBudget()
		{
			$ProjectData = DB::table('projectBudget')
				->select(
					'projectBudget.id',
					'projectBudget.ProjectCode',
					'projectBudget.ProjectName',
					'projectBudget.Amount',
					'projectBudget.Status',
					'projectBudget.StartProjectDate',
					'projectBudget.EndProjectDate',
					'projectBudget.IsActive',
				)
				->where('projectBudget.IsActive', 1)
				->where('projectBudget.CreatedBy', CRUDBooster::myId())
				->get();
			return $ProjectData;	
		}
		function getAccountBudgetSubApi()
		{
			$AccountBudgetSub = DB::table('accountBudgetSub')
				->select(
					'accountBudgetSub.id',
					'accountBudgetSub.AccName',
					'accountBudgetSub.is_active',
				)
				->where('accountBudgetSub.is_active',1)
				->get();
			$data['data'] = $AccountBudgetSub;
			$data['api_status'] = 1;
			$data['api_message'] = 'Success';
	
			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
		function getAccountBudgetDetailSubApi(Request $request)
		{
			$id = $request['id'];
			$AccountBudgetDetail = DB::table('accountBudgetSub')
				->select(
					'accountBudgetSub.id',
					'accountBudgetSub.Detail',
					'accountBudgetSub.Amount',
					'accountBudgetSub.AccStartDate',
					'accountBudgetSub.AccEndDate',
					'accountBudgetSub.is_active',
				)
				->where('accountBudgetSub.is_active',1)
				->where('accountBudgetSub.id', $id)
				->first();
	
			$data['data'] = $AccountBudgetDetail;
			$data['api_status'] = 1;
			$data['api_message'] = 'Success';
	
			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
		function getAccountBudgetSubPeriodDetailApi(Request $request)
		{
			$id = $request['id'];
			$BudgetSubPeriodDetail = DB::table('projectSubPeriod')
				->select(
					'projectSubPeriod.id',
					'projectSubPeriod.account_sub_id',
					'projectSubPeriod.PeriodNo',
					'projectSubPeriod.PeriodPercent',
					'projectSubPeriod.PeriodAmount',
				)
				->orderBy('id')
				->where('projectSubPeriod.account_sub_id', $id)
				->get();
	
			$data['data'] = $BudgetSubPeriodDetail;
			$data['api_status'] = 1;
			$data['api_message'] = 'Success';
	
			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
		function getAccountBudgetFileApi(Request $request)
		{
			$id = $request['id'];
			$BudgetSubPeriodDetail = DB::table('projectBudgetDocument')
				->select(
					'projectBudgetDocument.id',
					'projectBudgetDocument.account_sub_id',
					'projectBudgetDocument.FileName',
					'projectBudgetDocument.FilePath',
				)
				->orderBy('id')
				->where('projectBudgetDocument.account_sub_id', $id)
				->get();
	
			$data['data'] = $BudgetSubPeriodDetail;
			$data['api_status'] = 1;
			$data['api_message'] = 'Success';
	
			return response()->json($data, 200)
				->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
				->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
		}
		
		
	}