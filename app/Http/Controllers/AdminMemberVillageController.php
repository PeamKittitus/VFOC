<?php namespace App\Http\Controllers;

	use Session;
	use DB;
	use CRUDBooster;
	use Illuminate\Http\Request;
	class AdminMemberVillageController extends \crocodicstudio\crudbooster\controllers\CBController {

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
			$this->table = "memberVillage";
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
			//$this->form[] = ["label"=>"MemberCode","name"=>"MemberCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"CitizenId","name"=>"CitizenId","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberFirstName","name"=>"MemberFirstName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberLastName","name"=>"MemberLastName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"GenderId","name"=>"GenderId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Age","name"=>"Age","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Phone","name"=>"Phone","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberOccupationId","name"=>"MemberOccupationId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"MemberAddress","name"=>"MemberAddress","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberPositionId","name"=>"MemberPositionId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"MemberStatusId","name"=>"MemberStatusId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"MemberOffComment","name"=>"MemberOffComment","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberRenewal","name"=>"MemberRenewal","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Connection","name"=>"Connection","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"MemberOccupationOther","name"=>"MemberOccupationOther","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"NoCitizenId","name"=>"NoCitizenId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"NoBirthDate","name"=>"NoBirthDate","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"UserId","name"=>"UserId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"IsActive","name"=>"IsActive","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"MemberDate","name"=>"MemberDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"MemberEndDate","name"=>"MemberEndDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"MemberBirthDate","name"=>"MemberBirthDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"CreatedAt","name"=>"CreatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"CreatedBy","name"=>"CreatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"UpdatedAt","name"=>"UpdatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
			//$this->form[] = ["label"=>"UpdatedBy","name"=>"UpdatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"MemberStatusApprove","name"=>"MemberStatusApprove","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
			$getVillage = (new ApiRegisterVillageController)->getDetailVillageById();
			$getCountMemberVillage = $this->getCountVillageMemberDetail();
			$data['getVillage'] = $getVillage;
			$data['getCountMemberVillage'] = $getCountMemberVillage;
			return view('village/superuserapprove/index',$data);
		}
		public function approveMemberVillage($id)
		{
			$getVillageDetail = $this->getVillageDetail($id);
			$getVillageMemberDetail =  $this->getVillageMemberDetail($id);
			$getVillageFile =  $this->getVillageFile($id);
			$getVillageBank =  $this->getVillageBank($id);
			
			$data['getVillageDetail'] = $getVillageDetail;
			$data['getVillageMemberDetail'] = $getVillageMemberDetail;
			$data['getVillageFile'] = $getVillageFile;
			$data['getVillageBank'] = $getVillageBank;
			return view('village/superuserapprove/approveMember',$data);
		}
		public function detailMemberVillage($id)
		{
			$getVillageDetail = $this->getVillageDetail($id);
			$getVillageMemberDetail =  $this->getVillageMemberDetail($id);
			$getVillageFile =  $this->getVillageFile($id);
			$getVillageBank =  $this->getVillageBank($id);
			
			$data['getVillageDetail'] = $getVillageDetail;
			$data['getVillageMemberDetail'] = $getVillageMemberDetail;
			$data['getVillageFile'] = $getVillageFile;
			$data['getVillageBank'] = $getVillageBank;
			return view('village/superuserapprove/detailMember',$data);
		}
		public function editMemberVillage($id)
		{
			$getVillageDetail = $this->getVillageDetail($id);
			$getVillageMemberDetail =  $this->getVillageMemberDetail($id);
			$getVillageFile =  $this->getVillageFile($id);
			$getVillageBank =  $this->getVillageBank($id);
			$getProvince =  (new FunctionController)->getProvince();
			$getAmphures =  (new FunctionController)->getAmphures();
			$getTambons =  (new FunctionController)->getTambons();
			$data['getVillageDetail'] = $getVillageDetail;
			$data['getVillageMemberDetail'] = $getVillageMemberDetail;
			$data['getVillageFile'] = $getVillageFile;
			$data['getVillageBank'] = $getVillageBank;
			$data['getProvince'] = $getProvince;
			$data['getAmphures'] = $getAmphures;
			$data['getTambons'] = $getTambons;
			return view('village/superuserapprove/editMember',$data);
		}
		function getCountVillageMemberDetail()
		{
			$VillageMemberDetail = DB::table('memberVillage')
				->leftjoin('village','village.id','memberVillage.VillageId')
				->where('memberVillage.MemberStatusApprove',0)
				->where('village.UserId',CRUDBooster::myId())
				->count();
			return $VillageMemberDetail;
		}
		function getVillageDetail($id)
		{
			$VillageDetail = DB::table('village')
				->leftjoin('systemProvinces','systemProvinces.id','village.VillageProvinceId')
				->leftjoin('systemAmphures','systemAmphures.id','village.VillageDistrictId')
				->leftjoin('systemTambons','systemTambons.id','village.VillageSubDistrictId')
				->select(
					'village.id',
					'village.VillageCodeText',
					'village.VillageBdbCode',
					'village.VillageDbd', 
					'village.VillageName', 
					'village.VillageAddress',
					'village.VillageMoo',
					'village.VillagePostCode',
					'village.Phone as VillagePhone',
					'village.Email as VillageEmail',
					'village.DbdDate',
					'village.VillageStartDate',
					'village.VillageEndDate',
					'village.OrgProvinceId',
					'village.VillageProvinceId',
					'village.VillageDistrictId',
					'village.VillageSubDistrictId',
					'systemProvinces.name_th as ProvinceName',
					'systemAmphures.name_th as AmphuresName',
					'systemTambons.name_th as TambonsName'
				)
				->where('village.IsActive',1)
				->where('village.id',$id)
				->first();
			return $VillageDetail;
		}
		function getVillageMemberDetail($id)
		{
			$VillageMemberDetail = DB::table('memberVillage')
				->leftjoin('systemMemberPosition','systemMemberPosition.id','memberVillage.MemberPositionId')
				->leftjoin('systemMemberStatus','systemMemberStatus.id','memberVillage.MemberStatusId')
				->select(
					'memberVillage.id',
					'memberVillage.VillageId',
					'memberVillage.MemberCode',
					'memberVillage.MemberFirstName', 
					'memberVillage.MemberLastName', 
					'memberVillage.MemberStatusId',
					'memberVillage.Connection',
					'memberVillage.MemberOffComment',
					'memberVillage.MemberStatusApprove',
					'systemMemberPosition.PositionNameTh as PositionName',
					'systemMemberStatus.StatusName'
				)
				->whereIn('memberVillage.MemberStatusApprove', [1, 0])
				->where('memberVillage.VillageId',$id)
				->orderBy('memberVillage.id')
				->get();
			return $VillageMemberDetail;
		}
		function getVillageFile($id)
		{
			$VillageFileDetail = DB::table('fileVillage')
				->select(
					'fileVillage.id',
					'fileVillage.FileName',
					'fileVillage.FilePath',
					'fileVillage.CreatedAt',
					
				)
				->where('fileVillage.VillageId',$id)
				->orderBy('fileVillage.id')
				->get();
			return $VillageFileDetail;
		}
		function getVillageBank($id)
		{
			$VillageUserId = DB::table('village')->select('village.UserId')->where('village.id',$id)->first();
			$VillageBankDetail = DB::table('accountBookBank')
				->leftjoin('accountBankMaster','accountBankMaster.id','accountBookBank.BankMasterId')
				->leftjoin('transactionFileBookbank','transactionFileBookbank.bookbank_id','accountBookBank.id')
				->select(
					'accountBookBank.id',
					'accountBookBank.BookBankNumber',
					'accountBookBank.BookBankName',
					'accountBankMaster.BankName',
					'accountBankMaster.BankShortName',
					'transactionFileBookbank.FileName',
					'transactionFileBookbank.FilePath'
				)
				->where('accountBookBank.created_by',$VillageUserId->UserId)
				->orderBy('accountBookBank.id')
				->get();
			return $VillageBankDetail;
		}
		function editDataVillage(Request $request)
		{
			$villageId = $request['villageId'];
			$VillageCodeText = $request['VillageCodeText'];
			$VillageDbd = $request['VillageDbd'];
			$VillageBdbCode = $request['VillageBdbCode'];
			$VillageName = $request['VillageName'];
			$VillagePhone = $request['VillagePhone'];
			$VillageEmail = $request['VillageEmail'];
			$VillageDbdDate = $request['VillageDbdDate'];
			$VillageAddress = $request['VillageAddress'];
			$VillageMoo = $request['VillageMoo'];
			$VillageProvinceId = $request['VillageProvinceId'];
			$VillageDistrictId = $request['VillageDistrictId'];
			$VillageSubDistrictId = $request['VillageSubDistrictId'];
			$VillagePostCode = $request['VillagePostCode'];
			DB::beginTransaction();
			try {
				$VillageData = DB::table('village')
				->select(
					'village.*'
				)
				->where('village.id',$villageId)
				->first();
				$VillageMemberData = DB::table('memberVillage')
				->select(
					'memberVillage.*'
				)
				->where('memberVillage.VillageId',$villageId)
				->where('memberVillage.MemberStatusApprove',1)
				->get();
				$VillageFileData = DB::table('fileVillage')
				->select(
					'fileVillage.*'
				)
				->where('fileVillage.VillageId',$villageId)
				->get();
				//==================InsertVillageOld
				$InsertDataVillageOld = [];
				$InsertDataVillageOld['UserId'] = $VillageData->UserId;
				$InsertDataVillageOld['VillageId'] = $villageId;
				$InsertDataVillageOld['VillageDbd'] = $VillageData->VillageDbd;
				$InsertDataVillageOld['VillageName'] = $VillageData->VillageName;
				$InsertDataVillageOld['VillageAddress'] = $VillageData->VillageAddress;
				$InsertDataVillageOld['VillageMoo'] = $VillageData->VillageMoo;
				$InsertDataVillageOld['VillageProvinceId'] = $VillageData->VillageProvinceId;
				$InsertDataVillageOld['VillageDistrictId'] = $VillageData->VillageDistrictId;
				$InsertDataVillageOld['VillageSubDistrictId'] = $VillageData->VillageSubDistrictId;
				$InsertDataVillageOld['VillagePostCode'] = $VillageData->VillagePostCode;
				$InsertDataVillageOld['VillageCodeText'] = $VillageData->VillageCodeText;
				$InsertDataVillageOld['VillageBdbCode'] = $VillageData->VillageBdbCode;
				$InsertDataVillageOld['Phone'] = $VillageData->Phone;
				$InsertDataVillageOld['Email'] = $VillageData->Email;
				$InsertDataVillageOld['DbdDate'] = $VillageData->DbdDate;
				$InsertDataVillageOld['VillageStartDate'] = $VillageData->VillageStartDate;
				$InsertDataVillageOld['VillageEndDate'] = $VillageData->VillageEndDate;
				$InsertDataVillageOld['IsActive'] = $VillageData->IsActive;
				$InsertDataVillageOld['Status'] = $VillageData->Status;
				$InsertDataVillageOld['OrgProvinceId'] = $VillageData->OrgProvinceId;
				$VillageOldId = DB::table('village_old')->insertGetId($InsertDataVillageOld);
				//==================InsertVillageOld

				//==================InsertVillageNew
				$InsertDataVillageNew = [];
				$InsertDataVillageNew['UserId'] = $VillageData->UserId;
				$InsertDataVillageNew['VillageId'] = $villageId;
				$InsertDataVillageNew['VillageDbd'] = $VillageDbd;
				$InsertDataVillageNew['VillageName'] = $VillageName;
				$InsertDataVillageNew['VillageAddress'] = $VillageAddress;
				$InsertDataVillageNew['VillageMoo'] = $VillageMoo;
				$InsertDataVillageNew['VillageProvinceId'] = $VillageProvinceId;
				$InsertDataVillageNew['VillageDistrictId'] = $VillageDistrictId;
				$InsertDataVillageNew['VillageSubDistrictId'] = $VillageSubDistrictId;
				$InsertDataVillageNew['VillagePostCode'] = $VillagePostCode;
				$InsertDataVillageNew['VillageCodeText'] = $VillageCodeText;
				$InsertDataVillageNew['VillageBdbCode'] = $VillageBdbCode;
				$InsertDataVillageNew['Phone'] = $VillagePhone;
				$InsertDataVillageNew['Email'] = $VillageEmail;
				$InsertDataVillageNew['DbdDate'] = $VillageDbdDate;
				$InsertDataVillageNew['VillageStartDate'] = $VillageData->VillageStartDate;
				$InsertDataVillageNew['VillageEndDate'] = (new FunctionController)->calculateEndDate($InsertDataVillageNew['VillageStartDate'], 2);
				$InsertDataVillageNew['IsActive'] = $VillageData->IsActive;
				$InsertDataVillageNew['Status'] = $VillageData->Status;
				$InsertDataVillageNew['OrgProvinceId'] = $VillageData->OrgProvinceId;
				$VillageNewId = DB::table('village_new')->insertGetId($InsertDataVillageNew);
				//==================InsertVillageNew
				if($VillageOldId && $VillageNewId){
					$UpdateStatusVillage = [];
					$UpdateStatusVillage['Status'] = 2;
					$UpdateStatusVillage['UpdatedAt'] = date('Y-m-d');
					$UpdateStatusVillage['UpdatedBy'] = CRUDBooster::myId();
					$UpdateStatusVillageId = DB::table('village')->where('id', $villageId)->update($UpdateStatusVillage);
					if($UpdateStatusVillageId){
						foreach ($VillageMemberData as $member) {
							$insertMemberData = [
								'VillageId' => $member->VillageId,
								'MemberCode' => $member->MemberCode,
								'CitizenId' => $member->CitizenId,
								'MemberFirstName' => $member->MemberFirstName,
								'MemberLastName' => $member->MemberLastName,
								'GenderId' => $member->GenderId,
								'Age' => $member->Age,
								'Phone' => $member->Phone,
								'MemberOccupationId' => $member->MemberOccupationId,
								'MemberAddress' => $member->MemberAddress,
								'MemberPositionId' => $member->MemberPositionId,
								'MemberStatusId' => $member->MemberStatusId,
								'MemberOffComment' => $member->MemberOffComment,
								'MemberRenewal' => $member->MemberRenewal,
								'Connection' => $member->Connection,
								'MemberOccupationOther' => $member->MemberOccupationOther,
								'NoCitizenId' => $member->NoCitizenId,
								'NoBirthDate' => $member->NoBirthDate,
								'UserId' => $member->UserId,
								'IsActive' => $member->IsActive,
								'MemberDate' => $member->MemberDate,
								'MemberEndDate' => $member->MemberEndDate,
								'MemberBirthDate' => $member->MemberBirthDate,
								'CreatedAt' => $member->CreatedAt,
								'CreatedBy' => $member->CreatedBy,
								'UpdatedAt' => $member->UpdatedAt,
								'UpdatedBy' => $member->UpdatedBy,
								'MemberStatusApprove' => $member->MemberStatusApprove,
							];
							
							// Insert data into village_old table
							$villageMemberOldId = DB::table('memberVillage_new')->insertGetId($insertMemberData);
							$villageMemberNewId = DB::table('memberVillage_old')->insertGetId($insertMemberData);
						}
						foreach ($VillageFileData as $file) {
							$insertFileData = [
								'VillageId' => $file->VillageId,
								'TransactionYear' => $file->TransactionYear,
								'FileName' => $file->FileName,
								'FilePath' => $file->FilePath,
								'CreatedAt' => $file->CreatedAt,
								'CreatedBy' => $file->CreatedBy,
							];
						
							// Insert data into village_old table 
							$villageFileOldId = DB::table('fileVillage_new')->insertGetId($insertFileData);
							$villageFileNewId = DB::table('fileVillage_old')->insertGetId($insertFileData);
						}
						DB::commit();
						$data['api_status'] = 1;
						$data['api_message'] = 'Success';
						$data['id'] = $UpdateStatusVillageId;
						return response()->json($data, 200)
							->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
							->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
					}else{
						DB::rollback();
						$data['api_status'] = 0;
						$data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
					}
				}else{
					DB::rollback();
					$data['api_status'] = 0;
					$data['api_message'] = 'กรุณาทำรายการใหม่อีกครั้ง';
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