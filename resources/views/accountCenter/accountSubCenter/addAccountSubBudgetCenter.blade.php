@extends('crudbooster::admin_template')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <style>
        body {
            font-family: 'Sarabun', sans-serif !important;
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            background-color: #9ed8e1;
        }

        .w-box {
            width: 80%;
            display: block;
        }

        .box-right {
            background-color: white !important;
            border-radius: 10px 10px 10px 10px;
        }


        /* .box-right-d {
            padding: 5%;
        } */

        .mt-1 {
            margin-top: 1rem !important;
        }

        .dataTables_filter {
            display: none;
        }

        .dataTables_length {
            display: none;
        }

        .dataTables_info {
            display: none;
        }

        .dataTables_paginate {
            display: none;
        }

        .select2-container .select2-selection--single {
            height: 34px !important;
        }

        a:focus,
        a:hover {
            color: #23527c;
            text-decoration: none;
        }

        .select2-container {
            width: 100% !important;
        }
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">สร้างแผนงานโครงการย่อย</h4>
        <form id="addAccountBudgetSubCenter" name="addAccountBudgetSubCenter" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ปีงบประมาณ</label>
                                    <select class="form-control" id="BudgetYear" disabled>
                                        <option value="0" disabled selected>----เลือกปีงบประมาณ----</option>
                                        {!! $generateYearOptions !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อยุทธศาสตร์</label>
                                    <input type="text" class="form-control" value="{{$getAccountBudgetCenterById->AccName}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>กลยุทธ์</label>
                                    {!! $getAccountBudgetCenterById->AccDetail !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>กรอบวงเงินงบประมาณ</label>
                                    <input type="text" class="form-control" id="AccAmount" value="{{$getAccountBudgetCenterById->Amount}}" disabled oninput="formatCurrencyData(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อแผนงาน/โครงการ <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ชื่อแผนงาน/โครงการ" id="AccName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ฝ่าย/กลุ่มงานเลขานุการ/สทบ.สาขา<span style="color: red;">*</span></label>
                                    <select class="form-control" id="DivisionId">
                                        <option value="0" disabled selected>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>">
                                                <?= $division->name . ' (' . $division->short_name . ')' ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>เจ้าหน้าที่รับผิดชอบ<span style="color: red;">*</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อ" id="OfficerFirstName">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="นามสกุล" id="OfficerLastName">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" id="OfficerDivisionId">
                                        <option value="0" disabled selected>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>">
                                                <?= $division->name . ' (' . $division->short_name . ')' ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="เบอร์โทร" id="OfficerPhone">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12" style="display: flex;justify-content:center;padding-left:10px">
                                <h4>ส่วนที่ 1 ข้อมูลพื้นฐาน ความเชื่อมโยง ที่มาของโครงการ</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>1.ข้อมูลพื้นฐาน</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label>ประเภทของโครงการ</label>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="form-group" style="display: flex;gap: 1%;align-items: center;">
                                    <label>1.1 )</label>
                                    <label><input type="radio" name="ProjectType" value="1"> พัฒนา </label>
                                    <label><input type="radio" name="ProjectType" value="2"> ดำเนินการปกติ </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label>1.2 )</label>
                                    <label><input type="radio" name="ProjectExternal" value="1"> เป็นโครงการการประเมินจากหน่วยงานภายนอก</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="ExternalAgencyHide" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="หน่วยงานภายนอก" id="ExternalAgency">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label><input type="radio" name="ProjectExternal" value="2"> เป็นโครงการตามตัวชี้วัดประจำปี</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="IndicatorsHide" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="ประจำปี" id="Indicators">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label><input type="radio" name="ProjectExternal" value="3"> ข้อสั่งการ/นโยบาย/มติคณะกรรมการ กทบ.</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="PolicyHide" style="display: none;">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ข้อสั่งการ/นโยบาย/มติคณะกรรมการ กทบ." id="Policy">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>2.ลักษณะโครงการ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group" style="display: flex;align-items:baseline;gap:1%">
                                    <label><input type="radio" name="ProjectCharacteristics" value="1"> ด้านเศรษฐกิจ</label>
                                    <label><input type="radio" name="ProjectCharacteristics" value="2"> ด้านสังคม</label>
                                    <label><input type="radio" name="ProjectCharacteristics" value="3"> ด้านสิ่งแวดล้อม</label>
                                    <label><input type="radio" name="ProjectCharacteristics" value="4"> ด้านความมั่นคง</label>
                                    <label><input type="radio" name="ProjectCharacteristics" value="5"> ด้านคุณภาพชีวิต</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>3.ลักษณะการดำเนินการ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group" style="display: flex;align-items:baseline;gap:1%">
                                    <label><input type="radio" name="OperationalCharacteristics" value="1"> ทำครั้งเดียว</label>
                                    <label><input type="radio" name="OperationalCharacteristics" value="2"> ทำซ้ำทุกปีในกลุ่มเป้าหมายเดิม</label>
                                    <label><input type="radio" name="OperationalCharacteristics" value="3"> ทำซ้ำทุกปีโดยขยายกลุ่มเป้าหมายใหม่</label>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>4.ประสบการณ์และความเชี่ยวชาญในการดำเนินการ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group" style="display: flex;align-items:baseline;gap:1%">
                                    <label><input type="radio" name="Experience" value="1"> เป็นโครงการริเริ่มใหม่</label>
                                    <label><input type="radio" name="Experience" value="2"> เป็นโครงการเดิมที่นำมาต่อยอดขยายผล</label>
                                    <label><input type="radio" name="Experience" value="3"> อื่นๆ(โปรดระบุ)</label>
                                    <div style="width: 200px;display: none;" id="ExperienceDetailHide" >
                                        <input type="text" class="form-control" placeholder="อื่นๆ(โปรดระบุ)" id="ExperienceDetail">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>2.ความเชื่อมโยงกับแผนท้ัง 3 ระดับ</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>2.1 แผนระดับ 1 ยุทธศาสตร์ชาติ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ยุทธศาสตร์ด้าน</label>
                                    <select class="form-control" id="StrategyId" onchange="showHideStrategyFields()">
                                        <option value="0" disabled selected>----เลือกยุทธศาสตร์ด้าน----</option>
                                        <?php foreach ($getNationalStrategy as $strategy) : ?>
                                            <option value="<?= $strategy->id ?>"><?= $strategy->StrategyName ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="display: none;" id="StrategyHide">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นหลัก</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นหลัก" id="StrategyMain">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นย่อย</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นย่อย" id="StrategySub">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>2.2 แผนระดับ 2</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="MasterPlan" id="MasterPlan">
                                    <label>แผนแม่บทภายใต้ยุทธศาสตร์ชาติ (23 ประเด็น)</label>
                                </div>
                            </div>
                        </div>
                        <div style="display:none" id="MasterPlanHide">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นหลัก</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นหลัก" id="MasterPlanMain">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นย่อย</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นย่อย" id="MasterPlanMainSub">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="DevelopmentPlan" id="DevelopmentPlan">
                                    <label>แผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ ฉบับที่ 13</label>
                                </div>
                            </div>
                        </div>
                        <div style="display:none" id="DevelopmentPlanHide">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>หมุดหมายที่</label>
                                        <input type="text" class="form-control" placeholder="หมุดหมายที่" id="DevelopmentPlanNo">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>เป้าหมายระดับหมุดหมาย</label>
                                        <input type="text" class="form-control" placeholder="เป้าหมายระดับหมุดหมาย" id="DevelopmentPlanMilestone">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ตัวชี้วัด</label>
                                        <input type="text" class="form-control" placeholder="ตัวชี้วัด" id="DevelopmentPlanIndicators">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="PolicyPlan" id="PolicyPlan">
                                    <label>แผน/นโยบาย</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" style="display: none;" id="PolicyPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="PolicyPlanDetail"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>2.3 แผนระดับ 3</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="ActionPlan" id="ActionPlan">
                                    <label>แผนปฎิบัติการ (ด้าน)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" style="display: none;" id="ActionPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="แผนปฎิบัติการ (ด้าน)" id="ActionPlanDetail">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="CommunityFundStrategicPlan" id="CommunityFundStrategicPlan">
                                    <label>แผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" style="display: none;" id="CommunityFundStrategicPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="แผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ" id="CommunityFundStrategicPlanDetail">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="checkbox" name="OperationalPlans" id="OperationalPlans">
                                    <label>แผนปฎิบัติการ ระยะ 5 ปี และประจำปี</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" style="display: none;" id="OperationalPlansHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="แผนปฎิบัติการ ระยะ 5 ปี และประจำปี" id="OperationalPlansDetail">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12" style="display: flex;justify-content:space-between;padding-left:10px">
                                <h4>3.ที่มาของโครงการ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <select class="form-control" id="ProjectOriginId" onchange="showHideDiv()">
                                        <option value="0" disabled selected>----เลือกที่มาของโครงการ----</option>
                                        <option value="1">มติคณะรัฐมนตรี (ชุดปัจจุบัน)</option>
                                        <option value="2">ข้อสั่งการของนายกรัฐมนตรี</option>
                                        <option value="3">นโยบายสำคัญของรัฐบาล</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" style="display: none;" id="ProjectOriginHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="รายละเอียด" id="ProjectOriginDetail">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12" style="display: flex;justify-content:center;padding-left:10px">
                                <h4>ส่วนที่ 2 รายละเอียดโครงการ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>1.หลักการและเหตุผล</label>
                                    <textarea class="form-control" id="PrinciplesReason"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>2.วัตถุประสงค์</label>
                                    <textarea class="form-control" id="Objective"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>3.เป้าหมาย</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>3.1เป้าหมายเชิงปริมาณ</label>
                                    <textarea class="form-control" id="QuantitativeGoal"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>3.2เป้าหมายเชิงคุณภาพ</label>
                                    <textarea class="form-control" id="Qualitativegoal"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.ตัวชี้วัดความสำเร็จ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.1ผลที่คาดว่าจะได้รับ</label>
                                    <textarea class="form-control" id="ExpectedResults"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.2ดัชนีชี้วัดความสำเร็จ</label>
                                    <textarea class="form-control" id="SuccessIndicators"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.3กลุ่มเป้าหมาย/ผู้ที่ได้รับผลประโยชน์</label>
                                    <textarea class="form-control" id="Beneficiary"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>5.ขั้นตอน/ระยะเวลาดำเนินการ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่เริ่มโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccStartDate">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccEndDate">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>5.1แผนดำเนินการ/แผนงบประมาณ(โดยละเอียด)<span style="color: red;">*</span></label>
                                    <textarea id="Detail"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>5.2แผนการจัดซื้อจัดจ้าง (ถ้ามี)</label>
                                    <textarea class="form-control" id="Procurement"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>6.สถานที่ดำเนินโครงการ</label>
                                    <textarea class="form-control" id="ProjectLocation"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>7.งบประมาณ (บาท) <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control check_number" placeholder="งบประมาณ (บาท)" id="SubAmount" oninput="formatCurrency(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>8.การติดตามและประเมินผล</label>
                                    <textarea class="form-control" id="Monitoring"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>เอกสารแนบ<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" id="file">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/accountBudgetCenter">
                                        <button type="button" class="btn" style="color: white ; background-color:red">ย้อนกลับ</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    window.onload = function() {
        formatCurrencyData(document.getElementById("AccAmount"));
    };

    function formatCurrencyData(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function formatCurrency(input) {
        // Check if input value is not empty
        if (input.value.trim() !== "") {
            // Remove non-numeric characters
            let value = input.value.replace(/[^0-9]/g, "");
            // Format the number to have commas every three digits
            value = new Intl.NumberFormat('th-TH').format(value);
            // Set the formatted value back to the input
            input.value = value;
        }
    }

    // Function to handle resizing of textarea element
    function resizeTextarea(textarea) {
        textarea.style.height = 'auto'; // Reset textarea height to auto
        textarea.style.height = textarea.scrollHeight + 'px'; // Set the new height based on content
    }

    // Function to add event listener to textarea element
    function addTextareaEventListener(id) {
        const textarea = document.getElementById(id);
        textarea.addEventListener('input', function() {
            resizeTextarea(this);
        });
    }

    // Array of textarea element IDs
    const textareaIds = ['PolicyPlanDetail', 'PrinciplesReason', 'Objective', 'ExpectedResults', 'Beneficiary', 'Procurement', 'ProjectLocation', 'Monitoring','Qualitativegoal'];

    // Loop through textareaIds array and add event listeners to each textarea element
    textareaIds.forEach(addTextareaEventListener);


    document.addEventListener('DOMContentLoaded', function() {
        const radioInputs = document.querySelectorAll('input[name="ProjectExternal"]');
        const externalAgencyDiv = document.getElementById('ExternalAgencyHide');
        const indicatorsDiv = document.getElementById('IndicatorsHide');
        const policyDiv = document.getElementById('PolicyHide');

        function toggleDivVisibility(value, divToShow) {
            externalAgencyDiv.style.display = value === '1' ? 'block' : 'none';
            indicatorsDiv.style.display = value === '2' ? 'block' : 'none';
            policyDiv.style.display = value === '3' ? 'block' : 'none';
        }

        radioInputs.forEach(input => {
            input.addEventListener('change', function() {
                toggleDivVisibility(this.value);
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const radioInputs = document.querySelectorAll('input[name="Experience"]');
        const ExperienceDetailHide = document.getElementById('ExperienceDetailHide');

        function toggleDivVisibility(value, divToShow) {
            ExperienceDetailHide.style.display = value === '3' ? 'block' : 'none';
        }

        radioInputs.forEach(input => {
            input.addEventListener('change', function() {
                toggleDivVisibility(this.value);
            });
        });
    });

    // Function to handle checkbox change event
    function handleCheckboxChange(checkboxId, divId) {
        var checkbox = document.getElementById(checkboxId);
        var div = document.getElementById(divId);

        checkbox.addEventListener('change', function() {
            div.style.display = this.checked ? 'block' : 'none';
        });
    }

    // Call the function for each checkbox and corresponding div
    handleCheckboxChange('MasterPlan', 'MasterPlanHide');
    handleCheckboxChange('DevelopmentPlan', 'DevelopmentPlanHide');
    handleCheckboxChange('PolicyPlan', 'PolicyPlanHide');
    handleCheckboxChange('ActionPlan', 'ActionPlanHide');
    handleCheckboxChange('CommunityFundStrategicPlan', 'CommunityFundStrategicPlanHide');
    handleCheckboxChange('OperationalPlans', 'OperationalPlansHide');
    
    function showHideDiv() {
        var selectBox = document.getElementById("ProjectOriginId");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var divToToggle = document.getElementById("ProjectOriginHide");

        if (selectedValue == 0) {
            divToToggle.style.display = "none";
        } else {
            divToToggle.style.display = "block";
        }
    }

    // เพิ่ม event listener สำหรับ onchange event ที่ select element
    document.getElementById("ProjectOriginId").addEventListener("change", showHideDiv);

    function showHideStrategyFields() {
        var selectBox = document.getElementById("StrategyId");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var divToToggle = document.getElementById("StrategyHide");

        if (selectedValue == 0) {
            divToToggle.style.display = "none";
        } else {
            divToToggle.style.display = "block";
        }
    }

    // เพิ่ม event listener สำหรับ onchange event ที่ select element
    document.getElementById("StrategyId").addEventListener("change", showHideStrategyFields);
    
    $(document).ready(function() {
        $('#BudgetYear').select2();
        $('#DivisionId').select2();
        $('#OfficerDivisionId').select2();
        $('#StrategyId').select2();
        $('#ProjectOriginId').select2();

        let editor,editorQuantitativeGoal;
        ClassicEditor
            .create(document.querySelector('#Detail'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
        ClassicEditor
            .create(document.querySelector('#QuantitativeGoal'))
            .then(newEditor2 => {
                editorQuantitativeGoal = newEditor2;
                editorQuantitativeGoal.setData('<figure class="table"><table><thead><tr><th>ที่</th><th>กิจกรรม</th><th>หน่วยนับ</th><th>จำนวน</th></tr></thead><tbody><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>');
            })
            .catch(error => {
                console.error(error);
            });
        $("form[name=addAccountBudgetSubCenter]").submit(function(event) {
            event.preventDefault();
            var AccId = localStorage.getItem('AccountBudgetCenterId');
            var BudgetYear = $('#BudgetYear').val();
            var AccName = $('#AccName').val();
            var DivisionId = $('#DivisionId').val();
            var SubAmount = $('#SubAmount').val();
            SubAmount = SubAmount.replace(/[^\d]/g, '');
            SubAmount = parseInt(SubAmount);
            var AccStartDate = $('#AccStartDate').val();
            var AccEndDate = $('#AccEndDate').val();
            var totalfiles = document.getElementById("file").files.length;
            var editorData = editor.getData();
            var Detail = editorData;
            var startDate = new Date(AccStartDate);
            var endDate = new Date(AccEndDate);

            var OfficerFirstName = $('#OfficerFirstName').val();
            if (!OfficerFirstName) {
                showError('กรุณากรอกชื่อเจ้าหน้าที่');
                return;
            }
            var OfficerLastName = $('#OfficerLastName').val();
            if (!OfficerLastName) {
                showError('กรุณากรอกนามสกุลเจ้าหน้าที่');
                return;
            }
            var OfficerDivisionId = $('#OfficerDivisionId').val();
            if (!OfficerDivisionId) {
                showError('กรุณาเลือกฝ่ายเจ้าหน้าที่');
                return;
            }
            var OfficerPhone = $('#OfficerPhone').val();
            if (!OfficerPhone) {
                showError('กรุณากรอกเบอร์โทรเจ้าหน้าที่');
                return;
            }
            var ProjectType = $("input[name='ProjectType']:checked").val();
            if (!ProjectType) {
                showError('กรุณาเลือกประเภทของโครงการ');
                return;
            }
            var ProjectExternal = $("input[name='ProjectExternal']:checked").val();
            if (!ProjectExternal) {
                showError('กรุณาเลือกรายละเอียดประเภทของโครงการ');
                return;
            }
            var ExternalAgency = $('#ExternalAgency').val();
            var Indicators = $('#Indicators').val();
            var Policy = $('#Policy').val();
            var ProjectCharacteristics = $("input[name='ProjectCharacteristics']:checked").val();
            if (!ProjectCharacteristics) {
                showError('กรุณาเลือกลักษณะโครงการ');
                return;
            }
            var OperationalCharacteristics = $("input[name='OperationalCharacteristics']:checked").val();
            if (!OperationalCharacteristics) {
                showError('กรุณาเลือกลักษณะการดำเนินการ');
                return;
            }
            var Experience = $("input[name='Experience']:checked").val();
            if (!Experience) {
                showError('กรุณาเลือกประสบการณ์และความเชี่ยวชาญในการดำเนินการ');
                return;
            }
            var ExperienceDetail = $('#ExperienceDetail').val();
            var StrategyId = $('#StrategyId').val();
            if (!StrategyId) {
                showError('กรุณาเลือกแผนระดับ 1 ยุทธศาสตร์ชาติ');
                return;
            }
            var StrategyMain = $('#StrategyMain').val();
            var StrategySub = $('#StrategySub').val();
            var MasterPlan = $('#MasterPlan').prop('checked');
            if (!MasterPlan) {
                showError('กรุณาเลือกแผนแม่บทภายใต้ยุทธศาสตร์ชาติ (23 ประเด็น)');
                return;
            }
            var MasterPlanMain = $('#MasterPlanMain').val();
            var MasterPlanMainSub = $('#MasterPlanMainSub').val();
            var DevelopmentPlan = $('#DevelopmentPlan').prop('checked');
            if (!DevelopmentPlan) {
                showError('กรุณาเลือกแผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ ฉบับที่ 13');
                return;
            }
            var DevelopmentPlanNo = $('#DevelopmentPlanNo').val();
            var DevelopmentPlanMilestone = $('#DevelopmentPlanMilestone').val();
            var DevelopmentPlanIndicators = $('#DevelopmentPlanIndicators').val();
            var PolicyPlan = $('#PolicyPlan').prop('checked');
            if (!PolicyPlan) {
                showError('กรุณาเลือกแผน/นโยบาย');
                return;
            }
            var PolicyPlanDetail = $('#PolicyPlanDetail').val();
            var ActionPlan = $('#ActionPlan').prop('checked');
            if (!ActionPlan) {
                showError('กรุณาเลือกแผนปฎิบัติการ (ด้าน)');
                return;
            }
            var ActionPlanDetail = $('#ActionPlanDetail').val();
            var CommunityFundStrategicPlan = $('#CommunityFundStrategicPlan').prop('checked');
            if (!CommunityFundStrategicPlan) {
                showError('กรุณาเลือกแผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ');
                return;
            }
            var CommunityFundStrategicPlanDetail = $('#CommunityFundStrategicPlanDetail').val();
            var OperationalPlans = $('#OperationalPlans').prop('checked');
            if (!OperationalPlans) {
                showError('กรุณาเลือกแผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ');
                return;
            }
            var OperationalPlansDetail = $('#OperationalPlansDetail').val();
            var ProjectOriginId = $('#ProjectOriginId').val();
            if (!ProjectOriginId) {
                showError('กรุณาเลือกที่มาของโครงการ');
                return;
            }
            var ProjectOriginDetail = $('#ProjectOriginDetail').val();
            var PrinciplesReason = $('#PrinciplesReason').val();
            if (!PrinciplesReason) {
                showError('กรุณากรอกหลักการและเหตุผล');
                return;
            }
            var Objective = $('#Objective').val();
            if (!Objective) {
                showError('กรุณากรอกวัตถุประสงค์');
                return;
            }
            var ExpectedResults = $('#ExpectedResults').val();
            if (!ExpectedResults) {
                showError('กรุณากรอกผลที่คาดว่าจะได้รับ');
                return;
            }
            var SuccessIndicators = $('#SuccessIndicators').val();
            if (!SuccessIndicators) {
                showError('กรุณากรอกดัชนีชี้วัดความสำเร็จ');
                return;
            }
            var Beneficiary = $('#Beneficiary').val();
            if (!Beneficiary) {
                showError('กรุณากรอกกลุ่มเป้าหมาย/ผู้ที่ได้รับผลประโยชน์');
                return;
            }
            var Procurement = $('#Procurement').val();
            var ProjectLocation = $('#ProjectLocation').val();
            var Monitoring = $('#Monitoring').val();
            
            if (!BudgetYear) {
                showError('กรุณาเลือกปีงบประมาณ');
                return;
            }
            if (!AccName) {
                showError('กรุณากรอกชื่อยุทธศาสตร์');
                return;
            }
            if (!DivisionId) {
                showError('กรุณาเลือกฝ่าย');
                return;
            }
            if (!SubAmount) {
                showError('กรุณากรอกวงเงินงบประมาณ');
                return;
            }
            if (!Detail) {
                showError('กรุณากรอกแหล่งที่มา/วัตถุประสงค์');
                return;
            }
            if (!AccStartDate) {
                showError('กรุณากรอกวันที่เริ่มโครงการ');
                return;
            }
            if (!AccEndDate) {
                showError('กรุณากรอกวันที่สิ้นสุดโครงการ');
                return;
            }
            if (totalfiles === 0) {
                showError('กรุณาเลือกไฟล์');
                return;
            }
            if (endDate < startDate) {
                showError('วันที่สิ้นสุดต้องไม่เป็นวันที่ก่อนวันที่เริ่มต้น');
                return;
            }
            var editorDataQuantitative = editorQuantitativeGoal.getData();
            var QuantitativeGoal = editorDataQuantitative;
            var Qualitativegoal =  $('#Qualitativegoal').val();
            var formData = new FormData();

            formData.append('AccId', AccId);
            formData.append('BudgetYear', BudgetYear);
            formData.append('AccName', AccName);
            formData.append('DivisionId', DivisionId);
            formData.append('SubAmount', SubAmount);
            formData.append('AccStartDate', AccStartDate);
            formData.append('AccEndDate', AccEndDate);
            formData.append('totalfiles', totalfiles);
            formData.append('Detail', Detail);
            for (var index = 0; index < totalfiles; ++index) {
                formData.append(
                    "file[]",
                    document.getElementById("file").files[index]
                );
            }
            formData.append('OfficerFirstName', OfficerFirstName);
            formData.append('OfficerLastName', OfficerLastName);
            formData.append('OfficerDivisionId', OfficerDivisionId);
            formData.append('OfficerPhone', OfficerPhone);
            formData.append('ProjectType', ProjectType);
            formData.append('ProjectExternal', ProjectExternal);
            formData.append('ExternalAgency', ExternalAgency);
            formData.append('Indicators', Indicators);
            formData.append('Policy', Policy);
            formData.append('ProjectCharacteristics', ProjectCharacteristics);
            formData.append('OperationalCharacteristics', OperationalCharacteristics);
            formData.append('Experience', Experience);
            formData.append('ExperienceDetail', ExperienceDetail);
            formData.append('StrategyId', StrategyId);
            formData.append('StrategyMain', StrategyMain);
            formData.append('StrategySub', StrategySub);
            formData.append('MasterPlan', MasterPlan);
            formData.append('MasterPlanMain', MasterPlanMain);
            formData.append('MasterPlanMainSub', MasterPlanMainSub);
            formData.append('DevelopmentPlan', DevelopmentPlan);
            formData.append('DevelopmentPlanNo', DevelopmentPlanNo);
            formData.append('DevelopmentPlanMilestone', DevelopmentPlanMilestone);
            formData.append('DevelopmentPlanIndicators', DevelopmentPlanIndicators);
            formData.append('PolicyPlan', PolicyPlan);
            formData.append('PolicyPlanDetail', PolicyPlanDetail);
            formData.append('ActionPlan', ActionPlan);
            formData.append('ActionPlanDetail', ActionPlanDetail);
            formData.append('CommunityFundStrategicPlan', CommunityFundStrategicPlan);
            formData.append('CommunityFundStrategicPlanDetail', CommunityFundStrategicPlanDetail);
            formData.append('OperationalPlans', OperationalPlans);
            formData.append('OperationalPlansDetail', OperationalPlansDetail);
            formData.append('ProjectOriginId', ProjectOriginId);
            formData.append('ProjectOriginDetail', ProjectOriginDetail);
            formData.append('PrinciplesReason', PrinciplesReason);
            formData.append('Objective', Objective);
            formData.append('ExpectedResults', ExpectedResults);
            formData.append('SuccessIndicators', SuccessIndicators);
            formData.append('Beneficiary', Beneficiary);
            formData.append('Procurement', Procurement);
            formData.append('ProjectLocation', ProjectLocation);
            formData.append('Monitoring', Monitoring);

            formData.append('Qualitativegoal', Qualitativegoal);
            formData.append('QuantitativeGoal', QuantitativeGoal);
            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการสร้างแผนงานโครงการย่อย",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    submitFormData(formData);
                }
            });
        }

        // Function to handle form submission
        function submitFormData(formData) {
            $.ajax({
                url: '/addAccountBudgetSubCenterApi',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    handleSuccess();
                    if (response.api_message == 'Success') {
                        handleSuccess()
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: response.api_message,
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    handleError();
                }
            });
        }

        // Function to handle form submission success
        function handleSuccess() {
            Swal.fire({
                title: "สำเร็จ",
                text: "บันทึกข้อมูลสำเร็จ!",
                icon: "success",
                showCancelButton: false,
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/accountBudgetCenter";
                }
            });
        }

        // Function to handle form submission error
        function handleError() {
            Swal.fire({
                title: "Error",
                text: "An error occurred while saving the form data.",
                icon: "error",
                showCancelButton: false,
                confirmButtonText: "OK",
            });
        }

        // Function to display error messages
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'กรุณากรอกข้อมูลให้ครบ',
                text: message
            });
        }

        // Function to restrict input to numeric characters
        function bannedKey(evt, lang) {
            var k = event.keyCode;
            if (lang == 1) {
                if ((k >= 48 && k <= 57) || k == 46) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        $(".check_number").keypress(function() {
            var dInput = $(this).val();
            return bannedKey(dInput, 1);
        });
    });
</script>
@endsection