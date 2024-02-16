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

class AdminVillageNewController extends \crocodicstudio\crudbooster\controllers\CBController
{

	public function cbInit()
	{
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table 			   = "village_new";
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
		//$this->form[] = ["label"=>"VillageId","name"=>"VillageId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"UserId","name"=>"UserId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillageCode","name"=>"VillageCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageDbd","name"=>"VillageDbd","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageName","name"=>"VillageName","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageAddress","name"=>"VillageAddress","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageMoo","name"=>"VillageMoo","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageProvinceId","name"=>"VillageProvinceId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillageDistrictId","name"=>"VillageDistrictId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillageSubDistrictId","name"=>"VillageSubDistrictId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillagePostCode","name"=>"VillagePostCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Phone","name"=>"Phone","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Email","name"=>"Email","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"DbdDate","name"=>"DbdDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"VillageStartDate","name"=>"VillageStartDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"VillageEndDate","name"=>"VillageEndDate","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"IsActive","name"=>"IsActive","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"UpdatedAt","name"=>"UpdatedAt","type"=>"date","required"=>TRUE,"validation"=>"required|date"];
		//$this->form[] = ["label"=>"UpdatedBy","name"=>"UpdatedBy","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"OrgProvinceId","name"=>"OrgProvinceId","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
		//$this->form[] = ["label"=>"VillageCodeText","name"=>"VillageCodeText","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"VillageBdbCode","name"=>"VillageBdbCode","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
		//$this->form[] = ["label"=>"Status","name"=>"Status","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
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
		$getNewDetailVillage = $this->getNewDetailVillage();
		$data['getNewDetailVillage'] = $getNewDetailVillage;
		return view('village/adminapprove/indexApproveDetail', $data);
	}
	public function approveEditDetail($id)
	{
		$getNewVillageDetail = $this->getNewVillageDetail($id);
		$getOldVillageDetail =  $this->getOldVillageDetail($id);
		$getNewVillageMemberDetail =  $this->getNewVillageMemberDetail($getNewVillageDetail->VillageId);
		$getNewVillageFile =  $this->getNewVillageFile($getNewVillageDetail->VillageId);
		$getNewVillageBank =  $this->getNewVillageBank($getNewVillageDetail->VillageId);

		$data['getNewVillageDetail'] = $getNewVillageDetail;
		$data['getOldVillageDetail'] = $getOldVillageDetail;
		$data['getNewVillageMemberDetail'] = $getNewVillageMemberDetail;
		$data['getNewVillageFile'] = $getNewVillageFile;
		$data['getNewVillageBank'] = $getNewVillageBank;
		return view('village/adminapprove/approveEditDetail', $data);
	}
	function getNewDetailVillage()
	{
		$VillageData = DB::table('village_new')
			->leftjoin('village', 'village.id', 'village_new.VillageId')
			->select(
				'village_new.id',
				'village_new.VillageCode',
				'village_new.VillageDbd',
				'village_new.VillageName',
				'village_new.IsActive',
				'village_new.VillageCodeText',
				'village_new.VillageBdbCode',
				'village_new.Status',
				'village.id as VillageOldId',
				'village.VillageCode as VillageCodeOld',
				'village.VillageDbd as VillageDbdOld',
				'village.VillageName as VillageNameOld',
				'village.IsActive as IsActiveOld',
				'village.VillageCodeText as VillageCodeTextOld',
				'village.VillageBdbCode as VillageBdbCodeOld',
				'village.Status as VillageStatusOld',
			)
			->where('village_new.IsActive', 1)
			->where('village_new.Status', 1)
			->where('village.Status', 2)
			->get();
		return $VillageData;
	}
	function getOldVillageDetail($id)
	{
		$VillageDetail = DB::table('village_old')
			->leftjoin('systemProvinces', 'systemProvinces.id', 'village_old.VillageProvinceId')
			->leftjoin('systemAmphures', 'systemAmphures.id', 'village_old.VillageDistrictId')
			->leftjoin('systemTambons', 'systemTambons.id', 'village_old.VillageSubDistrictId')
			->select(
				'village_old.id',
				'village_old.VillageId',
				'village_old.VillageCodeText',
				'village_old.VillageBdbCode',
				'village_old.VillageDbd',
				'village_old.VillageName',
				'village_old.VillageAddress',
				'village_old.VillageMoo',
				'village_old.VillagePostCode',
				'village_old.Phone as VillagePhone',
				'village_old.Email as VillageEmail',
				'village_old.DbdDate',
				'village_old.VillageStartDate',
				'village_old.VillageEndDate',
				'village_old.OrgProvinceId',
				'village_old.VillageProvinceId',
				'village_old.VillageDistrictId',
				'village_old.VillageSubDistrictId',
				'systemProvinces.name_th as ProvinceName',
				'systemAmphures.name_th as AmphuresName',
				'systemTambons.name_th as TambonsName'
			)
			->where('village_old.IsActive', 1)
			->where('village_old.id', $id)
			->first();
		return $VillageDetail;
	}
	function getNewVillageDetail($id)
	{
		$VillageDetail = DB::table('village_new')
			->leftjoin('systemProvinces', 'systemProvinces.id', 'village_new.VillageProvinceId')
			->leftjoin('systemAmphures', 'systemAmphures.id', 'village_new.VillageDistrictId')
			->leftjoin('systemTambons', 'systemTambons.id', 'village_new.VillageSubDistrictId')
			->select(
				'village_new.id',
				'village_new.VillageId',
				'village_new.VillageCodeText',
				'village_new.VillageBdbCode',
				'village_new.VillageDbd',
				'village_new.VillageName',
				'village_new.VillageAddress',
				'village_new.VillageMoo',
				'village_new.VillagePostCode',
				'village_new.Phone as VillagePhone',
				'village_new.Email as VillageEmail',
				'village_new.DbdDate',
				'village_new.VillageStartDate',
				'village_new.VillageEndDate',
				'village_new.OrgProvinceId',
				'village_new.VillageProvinceId',
				'village_new.VillageDistrictId',
				'village_new.VillageSubDistrictId',
				'systemProvinces.name_th as ProvinceName',
				'systemAmphures.name_th as AmphuresName',
				'systemTambons.name_th as TambonsName'
			)
			->where('village_new.IsActive', 1)
			->where('village_new.id', $id)
			->first();
		return $VillageDetail;
	}
	function getNewVillageMemberDetail($id)
	{
		$VillageMemberDetail = DB::table('memberVillage_new')
			->leftjoin('systemMemberPosition', 'systemMemberPosition.id', 'memberVillage_new.MemberPositionId')
			->leftjoin('systemMemberStatus', 'systemMemberStatus.id', 'memberVillage_new.MemberStatusId')
			->select(
				'memberVillage_new.id',
				'memberVillage_new.VillageId',
				'memberVillage_new.MemberCode',
				'memberVillage_new.MemberFirstName',
				'memberVillage_new.MemberLastName',
				'memberVillage_new.MemberStatusId',
				'memberVillage_new.Connection',
				'memberVillage_new.MemberOffComment',
				'memberVillage_new.MemberStatusApprove',
				'memberVillage_new.IsActive',
				'systemMemberPosition.PositionNameTh as PositionName',
				'systemMemberStatus.StatusName'
			)
			->where('memberVillage_new.IsActive', 1)
			->where('memberVillage_new.MemberStatusApprove', 1)
			->where('memberVillage_new.VillageId', $id)
			->orderBy('memberVillage_new.id')
			->get();
		return $VillageMemberDetail;
	}
	function getNewVillageFile($id)
	{
		$VillageFileDetail = DB::table('fileVillage_new')
			->select(
				'fileVillage_new.id',
				'fileVillage_new.FileName',
				'fileVillage_new.FilePath',
				'fileVillage_new.CreatedAt',
				'fileVillage_new.IsActive',
			)
			->where('fileVillage_new.IsActive', 1)
			->where('fileVillage_new.VillageId', $id)
			->orderBy('fileVillage_new.id')
			->get();
		return $VillageFileDetail;
	}
	function getNewVillageBank($id)
	{
		$VillageUserId = DB::table('village_new')->select('village_new.UserId')->where('village_new.VillageId', $id)->first();
		$VillageBankDetail = DB::table('accountBookBank')
			->leftjoin('accountBankMaster', 'accountBankMaster.id', 'accountBookBank.BankMasterId')
			->leftjoin('transactionFileBookbank', 'transactionFileBookbank.bookbank_id', 'accountBookBank.id')
			->select(
				'accountBookBank.id',
				'accountBookBank.BookBankNumber',
				'accountBookBank.BookBankName',
				'accountBankMaster.BankName',
				'accountBankMaster.BankShortName',
				'transactionFileBookbank.FileName',
				'transactionFileBookbank.FilePath'
			)
			->where('accountBookBank.created_by', $VillageUserId->UserId)
			->orderBy('accountBookBank.id')
			->get();
		return $VillageBankDetail;
	}
	function approveEditVillage(Request $request)
	{
		$Id = $request['Id'];
		$villageId = $request['villageId'];
		$ValueApprove = $request['ValueApprove'];
		$VillageComment = $request['VillageComment'];
		$VillageCommentFile = $request['VillageCommentFile'];
		$array_file = [];
		DB::beginTransaction();
		try {
			if ($ValueApprove == 1) {
				$VillageNewData = DB::table('village_new')
				->select(
					'village_new.*'
				)
				->where('village_new.id',$Id)
				->first();
				$UserData = DB::table('cms_users')
				->select(
					'cms_users.id',
					'cms_users.name',
					'cms_users.email',
				)
				->where('cms_users.id', $VillageNewData->UserId)
				->first();
				
				//=============UpdateVillageกลับ
				$InsertDataVillage = [];
				$InsertDataVillage['UserId'] = $VillageNewData->UserId;
				$InsertDataVillage['VillageDbd'] = $VillageNewData->VillageDbd;
				$InsertDataVillage['VillageName'] = $VillageNewData->VillageName;
				$InsertDataVillage['VillageAddress'] = $VillageNewData->VillageAddress;
				$InsertDataVillage['VillageMoo'] = $VillageNewData->VillageMoo;
				$InsertDataVillage['VillageProvinceId'] = $VillageNewData->VillageProvinceId;
				$InsertDataVillage['VillageDistrictId'] = $VillageNewData->VillageDistrictId;
				$InsertDataVillage['VillageSubDistrictId'] = $VillageNewData->VillageSubDistrictId;
				$InsertDataVillage['VillagePostCode'] = $VillageNewData->VillagePostCode;
				$InsertDataVillage['VillageCodeText'] = $VillageNewData->VillageCodeText;
				$InsertDataVillage['VillageBdbCode'] = $VillageNewData->VillageBdbCode;
				$InsertDataVillage['Phone'] = $VillageNewData->Phone;
				$InsertDataVillage['Email'] = $VillageNewData->Email;
				$InsertDataVillage['DbdDate'] = $VillageNewData->DbdDate;
				$InsertDataVillage['VillageStartDate'] = $VillageNewData->VillageStartDate;
				$InsertDataVillage['VillageEndDate'] = $VillageNewData->VillageEndDate;
				$InsertDataVillage['IsActive'] = $VillageNewData->IsActive;
				$InsertDataVillage['Status'] = $VillageNewData->Status;
				$InsertDataVillage['OrgProvinceId'] = $VillageNewData->OrgProvinceId;
				$VillageId = DB::table('village')->where('id', $VillageNewData->VillageId)->update($InsertDataVillage);
				//=============UpdateVillageกลับ
				if ($VillageId) {
					$UpdateIsActive['IsActive'] = 0;
					$VillageId = DB::table('village_old')->where('village_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
					$VillageId = DB::table('village_new')->where('village_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);

					$VillageId = DB::table('memberVillage_new')->where('memberVillage_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
					$VillageId = DB::table('memberVillage_old')->where('memberVillage_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);

					$VillageId = DB::table('fileVillage_new')->where('fileVillage_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
					$VillageId = DB::table('fileVillage_old')->where('fileVillage_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
					DB::commit();
					$data['api_status'] = 1;
					$data['api_message'] = 'Success';
					$data['id'] = $VillageId;
					$html_content =
						'<!DOCTYPE html>
								<html>
								<head>
									<meta charset="utf-8">
									<title>Welcome to Net!</title>
								</head>
								<body>
									<p>เรียน ' . $UserData->name . '</p>
									<p>
										อีเมลผู้ใช้ : ' . $UserData->email . '<br>
									</p>
									<span style="color:red;">* การแก้ไขข้อมูลกองทุนของคุณรับการอนุมัติ</span><br>
									
									<p>หากท่านมีคำถามหรือต้องการความช่วยเหลือในการเข้าใช้งาน หรือมีข้อสงสัยใด ๆ เกี่ยวกับการใช้งานแอปพลิเคชัน หรือบริการอื่นๆ กรุณาติดต่อเราทางอีเมลที่ support@email.com</p>
									<strong style="color: red;">อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ</strong>
									<p>ขอแสดงความนับถือ,<br>
									ทีมผู้ดูแล สทบ</p><br><br>
								</body>
								</html>';
					$object = new stdClass();
					$object->email_content = $html_content;
					Mail::to($UserData->email)->send(new JobMail($object, "แจ้งข้อมูลสำหรับเข้าใช้งานระบบ สทบ. ของสมาชิก"));
					return response()->json($data, 200)
						->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
						->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
				}
			} else {
				$VillageNewData = DB::table('village_new')
					->select(
						'village_new.*'
					)
					->where('village_new.id',$Id)
					->first();
				$UserData = DB::table('cms_users')
					->select(
						'cms_users.id',
						'cms_users.name',
						'cms_users.email',
					)
					->where('cms_users.id', $VillageNewData->UserId)
					->first();
				$DataUpdateVillage = [];
				$DataUpdateVillage['Status'] = 1;
				$DataUpdateVillage['UpdatedAt'] = date('Y-m-d');
				$DataUpdateVillage['UpdatedBy'] = CRUDBooster::myId();
				$DataUpdateVillageId = DB::table('village')->where('id', $VillageNewData->VillageId)->update($DataUpdateVillage);
				if ($DataUpdateVillageId) {
					$DataUpdateVillageComment = [];
					$DataUpdateVillageComment['VillageId'] = $VillageNewData->VillageId;
					$DataUpdateVillageComment['Comment'] = $VillageComment;
					$DataUpdateVillageComment['CreatedAt'] = date('Y-m-d');
					$DataUpdateVillageComment['CreatedBy'] = CRUDBooster::myId();
					foreach ($VillageCommentFile as $index => $val) {
						$DataUpdateVillageComment['FileName'] = $val->getClientOriginalName();
						$DataUpdateVillageComment['FilePath'] = "uploads/" . $val->getClientOriginalName();
					}
					$transactionVillageCommentId = DB::table('VillageComment')->insertGetId($DataUpdateVillageComment);
					if ($transactionVillageCommentId) {
						$UpdateIsActive['IsActive'] = 0;
						$VillageId = DB::table('village_old')->where('village_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
						$VillageId = DB::table('village_new')->where('village_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);

						$VillageId = DB::table('memberVillage_new')->where('memberVillage_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
						$VillageId = DB::table('memberVillage_old')->where('memberVillage_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);

						$VillageId = DB::table('fileVillage_new')->where('fileVillage_new.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
						$VillageId = DB::table('fileVillage_old')->where('fileVillage_old.VillageId', $VillageNewData->VillageId)->update($UpdateIsActive);
						DB::commit();
						$data['api_status'] = 1;
						$data['api_message'] = 'Success';
						$data['id'] = $transactionVillageCommentId;
						Storage::putFileAs('uploads/', $val, $val->getClientOriginalName());
						array_push($array_file, $val->getClientOriginalName() . '.' . $val->getClientOriginalExtension());
						$html_content =
							'<!DOCTYPE html>
								<html>
								<head>
									<meta charset="utf-8">
									<title>Welcome to Net!</title>
								</head>
								<body>
									<p>เรียน ' . $UserData->name . '</p>
									<p>
										อีเมลผู้ใช้ : ' . $UserData->email . '<br>
									</p>
									<span style="color:red;">* การแก้ไขข้อมูลกองทุนของคุณไม่ได้รับการอนุมัติ</span><br>
									
									<p> เนื่องจาก ' . $VillageComment . ' หากท่านมีคำถามหรือต้องการความช่วยเหลือในการเข้าใช้งาน หรือมีข้อสงสัยใด ๆ เกี่ยวกับการใช้งานแอปพลิเคชัน หรือบริการอื่นๆ กรุณาติดต่อเราทางอีเมลที่ support@email.com</p>
									<strong style="color: red;">อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบอัตโนมัติ กรุณาอย่าตอบกลับ</strong>
									<p>ขอแสดงความนับถือ,<br>
									ทีมผู้ดูแล สทบ</p><br><br>
								</body>
								</html>';
						$object = new stdClass();
						$object->email_content = $html_content;
						Mail::to($UserData->email)->send(new JobMail($object, "แจ้งข้อมูลสำหรับเข้าใช้งานระบบ สทบ. ของสมาชิก"));

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
