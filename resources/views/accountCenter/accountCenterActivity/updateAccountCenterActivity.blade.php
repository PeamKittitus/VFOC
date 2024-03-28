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

        .plus-button {
            border: 2px solid white;
            background-color: #1dc9b7;
            font-size: 16px;
            height: 2.5em;
            width: 2.5em;
            border-radius: 999px;
            position: relative;

            &:after,
            &:before {
                content: "";
                display: block;
                background-color: white;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &:before {
                height: 1em;
                width: 0.2em;
            }

            &:after {
                height: 0.2em;
                width: 1em;
            }
        }

        .plus-button--small {
            font-size: 12px;
        }

        .plus-button--large {
            font-size: 17px;
        }
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">สร้างกิจกรรมโครงการ</h4>
        <form id="addAccountBudgetCenterActivity" name="addAccountBudgetCenterActivity" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ปีงบประมาณ</label>
                                    <select class="form-control" id="BudgetYear" disabled>
                                        <option value="0" disabled>----เลือกปีงบประมาณ----</option>
                                        <option value="2569" {{ $getAccountBudgetCenterSubById->BudgetYear == '2569' ? 'selected' : '' }}>2569</option>
                                        <option value="2568" {{ $getAccountBudgetCenterSubById->BudgetYear == '2568' ? 'selected' : '' }}>2568</option>
                                        <option value="2567" {{ $getAccountBudgetCenterSubById->BudgetYear == '2567' ? 'selected' : '' }}>2567</option>
                                        <option value="2566" {{ $getAccountBudgetCenterSubById->BudgetYear == '2566' ? 'selected' : '' }}>2566</option>
                                        <option value="2565" {{ $getAccountBudgetCenterSubById->BudgetYear == '2565' ? 'selected' : '' }}>2565</option>
                                        <option value="2564" {{ $getAccountBudgetCenterSubById->BudgetYear == '2564' ? 'selected' : '' }}>2564</option>
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
                                    <label>ชื่อแผนงาน/โครงการ </label>
                                    <input type="text" class="form-control" placeholder="ชื่อแผนงาน/โครงการ" id="AccName" value="{{$getAccountBudgetCenterSubById->AccName}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ฝ่าย </label>
                                    <select class="form-control" id="DivisionId" disabled>
                                        <option value="0" disabled>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>" <?= ($getAccountBudgetCenterSubById->DivisionId == $division->id) ? 'selected' : '' ?>><?= $division->name . '(' . $division->short_name . ')' ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>เจ้าหน้าที่รับผิดชอบ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ชื่อ" id="OfficerFirstName" value="{{$getAccountBudgetCenterSubDetailById->OfficerFirstName}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="นามสกุล" id="OfficerLastName" value="{{$getAccountBudgetCenterSubDetailById->OfficerLastName}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" id="OfficerDivisionId" disabled>
                                        <option value="0" disabled selected>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>" <?= ($getAccountBudgetCenterSubDetailById->OfficerDivisionId == $division->id) ? 'selected' : '' ?>><?= $division->name . '(' . $division->short_name . ')' ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="เบอร์โทร" id="OfficerPhone" value="{{$getAccountBudgetCenterSubDetailById->OfficerPhone}}" disabled>
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
                                    <?php
                                    $projectType = $getAccountBudgetCenterSubDetailById->ProjectType;
                                    $isCheckedValue1 = ($projectType == 1) ? 'checked' : '';
                                    $isCheckedValue2 = ($projectType == 2) ? 'checked' : '';
                                    ?>
                                    <label><input type="radio" name="ProjectType" value="1" <?= $isCheckedValue1 ?> disabled> พัฒนา </label>
                                    <label><input type="radio" name="ProjectType" value="2" <?= $isCheckedValue2 ?> disabled> ดำเนินการปกติ </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <?php
                            $ProjectExternal = $getAccountBudgetCenterSubDetailById->ProjectExternal;
                            $isCheckedValue1 = ($ProjectExternal == 1) ? 'checked' : '';
                            $isCheckedValue2 = ($ProjectExternal == 2) ? 'checked' : '';
                            $isCheckedValue3 = ($ProjectExternal == 3) ? 'checked' : '';

                            $externalAgencyHideStyle1 = ($ProjectExternal == 1) ? 'style="display: block;"' : 'style="display: none;"';
                            $externalAgencyHideStyle2 = ($ProjectExternal == 2) ? 'style="display: block;"' : 'style="display: none;"';
                            $externalAgencyHideStyle3 = ($ProjectExternal == 3) ? 'style="display: block;"' : 'style="display: none;"';
                            ?>
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label>1.2 )</label>
                                    <label><input type="radio" name="ProjectExternal" value="1" <?= $isCheckedValue1 ?> disabled> เป็นโครงการการประเมินจากหน่วยงานภายนอก</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="ExternalAgencyHide" <?= $externalAgencyHideStyle1 ?>>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="หน่วยงานภายนอก" id="ExternalAgency" value="{{$getAccountBudgetCenterSubDetailById->ExternalAgency}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label><input type="radio" name="ProjectExternal" value="2" <?= $isCheckedValue2 ?> disabled> เป็นโครงการตามตัวชี้วัดประจำปี</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="IndicatorsHide" <?= $externalAgencyHideStyle2 ?>>
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="ประจำปี" id="Indicators" value="{{$getAccountBudgetCenterSubDetailById->Indicators}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group" style="display: flex;gap:1%;align-items:baseline">
                                    <label><input type="radio" name="ProjectExternal" value="3" <?= $isCheckedValue3 ?> disabled> ข้อสั่งการ/นโยบาย/มติคณะกรรมการ กทบ.</label>
                                </div>
                            </div>
                            <div class="col-sm-6" id="PolicyHide" <?= $externalAgencyHideStyle3 ?>>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="ข้อสั่งการ/นโยบาย/มติคณะกรรมการ กทบ." id="Policy" value="{{$getAccountBudgetCenterSubDetailById->Policy}}" disabled>
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
                                    <?php
                                    $ProjectCharacteristics = $getAccountBudgetCenterSubDetailById->ProjectCharacteristics;
                                    $labels = array("ด้านเศรษฐกิจ", "ด้านสังคม", "ด้านสิ่งแวดล้อม", "ด้านความมั่นคง", "ด้านคุณภาพชีวิต");

                                    for ($i = 1; $i <= 5; $i++) {
                                        $isChecked = ($ProjectCharacteristics == $i) ? 'checked' : '';
                                        echo '<label><input type="radio" name="ProjectCharacteristics" disabled value="' . $i . '" ' . $isChecked . '> ' . $labels[$i - 1] . '</label>';
                                    }
                                    ?>
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
                                    <?php
                                    $OperationalCharacteristics = $getAccountBudgetCenterSubDetailById->OperationalCharacteristics;
                                    $labels = array("ทำครั้งเดียว", "ทำซ้ำทุกปีในกลุ่มเป้าหมายเดิม", "ทำซ้ำทุกปีโดยขยายกลุ่มเป้าหมายใหม่");

                                    for ($i = 1; $i <= 3; $i++) {
                                        $isChecked = ($OperationalCharacteristics == $i) ? 'checked' : '';
                                        echo '<label><input type="radio" disabled name="OperationalCharacteristics" value="' . $i . '" ' . $isChecked . '> ' . $labels[$i - 1] . '</label>';
                                    }
                                    ?>
                                    <!-- <label><input type="radio" name="OperationalCharacteristics" value="1"> ทำครั้งเดียว</label>
                                    <label><input type="radio" name="OperationalCharacteristics" value="2"> ทำซ้ำทุกปีในกลุ่มเป้าหมายเดิม</label>
                                    <label><input type="radio" name="OperationalCharacteristics" value="3"> ทำซ้ำทุกปีโดยขยายกลุ่มเป้าหมายใหม่</label> -->
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
                                    <?php
                                    $Experience = $getAccountBudgetCenterSubDetailById->Experience;
                                    $isCheckedValue1 = ($Experience == 1) ? 'checked' : '';
                                    $isCheckedValue2 = ($Experience == 2) ? 'checked' : '';
                                    $isCheckedValue3 = ($Experience == 3) ? 'checked' : '';

                                    $ExperienceHideStyle3 = ($Experience == 3) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <label><input type="radio" name="Experience" value="1" <?= $isCheckedValue1 ?> disabled> เป็นโครงการริเริ่มใหม่</label>
                                    <label><input type="radio" name="Experience" value="2" <?= $isCheckedValue2 ?> disabled> เป็นโครงการเดิมที่นำมาต่อยอดขยายผล</label>
                                    <label><input type="radio" name="Experience" value="3" <?= $isCheckedValue3 ?> disabled> อื่นๆ(โปรดระบุ)</label>
                                    <div class="wdh" id="ExperienceDetailHide" <?= $ExperienceHideStyle3 ?>>
                                        <input type="text" class="form-control" placeholder="อื่นๆ(โปรดระบุ)" id="ExperienceDetail" value="{{$getAccountBudgetCenterSubDetailById->ExperienceDetail}}" disabled>
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
                                    <select class="form-control" id="StrategyId" disabled>
                                        <option value="0" disabled selected>----เลือกยุทธศาสตร์ด้าน----</option>
                                        <?php foreach ($getNationalStrategy as $strategy) : ?>
                                            <option value="<?= $strategy->id ?>" <?= ($getAccountBudgetCenterSubDetailById->StrategyId == $strategy->id) ? 'selected' : '' ?>><?= $strategy->StrategyName ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <?php
                        $Strategy = $getAccountBudgetCenterSubDetailById->StrategyId;

                        $StrategyHideStyle = ($Experience != 0) ? 'style="display: block;"' : 'style="display: none;"';
                        ?>
                        <div <?= $StrategyHideStyle ?>>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นหลัก</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นหลัก" id="StrategyMain" value="{{$getAccountBudgetCenterSubDetailById->StrategyMain}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นย่อย</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นย่อย" id="StrategySub" value="{{$getAccountBudgetCenterSubDetailById->StrategySub}}" disabled>
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
                                    <?php
                                    $MasterPlan = $getAccountBudgetCenterSubDetailById->MasterPlan;
                                    $isCheckedValue1 = ($MasterPlan == 1) ? 'checked' : '';

                                    $MasterPlaneHideStyle1 = ($MasterPlan == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="MasterPlan" id="MasterPlan" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผนแม่บทภายใต้ยุทธศาสตร์ชาติ (23 ประเด็น)</label>
                                </div>
                            </div>
                        </div>
                        <div <?= $MasterPlaneHideStyle1 ?> id="MasterPlanHide">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นหลัก</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นหลัก" id="MasterPlanMain" value="{{$getAccountBudgetCenterSubDetailById->MasterPlanMain}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ประเด็นย่อย</label>
                                        <input type="text" class="form-control" placeholder="ประเด็นย่อย" id="MasterPlanMainSub" value="{{$getAccountBudgetCenterSubDetailById->MasterPlanMainSub}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    $DevelopmentPlan = $getAccountBudgetCenterSubDetailById->DevelopmentPlan;
                                    $isCheckedValue1 = ($DevelopmentPlan == 1) ? 'checked' : '';

                                    $DevelopmentPlanHideStyle1 = ($DevelopmentPlan == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="DevelopmentPlan" id="DevelopmentPlan" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ ฉบับที่ 13</label>
                                </div>
                            </div>
                        </div>
                        <div <?= $DevelopmentPlanHideStyle1 ?> id="DevelopmentPlanHide">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>หมุดหมายที่</label>
                                        <input type="text" class="form-control" placeholder="หมุดหมายที่" id="DevelopmentPlanNo" value="{{$getAccountBudgetCenterSubDetailById->DevelopmentPlanNo}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>เป้าหมายระดับหมุดหมาย</label>
                                        <input type="text" class="form-control" placeholder="เป้าหมายระดับหมุดหมาย" id="DevelopmentPlanMilestone" value="{{$getAccountBudgetCenterSubDetailById->DevelopmentPlanMilestone}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>ตัวชี้วัด</label>
                                        <input type="text" class="form-control" placeholder="ตัวชี้วัด" id="DevelopmentPlanIndicators" value="{{$getAccountBudgetCenterSubDetailById->DevelopmentPlanIndicators}}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    $PolicyPlan = $getAccountBudgetCenterSubDetailById->PolicyPlan;
                                    $isCheckedValue1 = ($PolicyPlan == 1) ? 'checked' : '';

                                    $PolicyPlanHideStyle1 = ($PolicyPlan == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="PolicyPlan" id="PolicyPlan" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผน/นโยบาย</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" <?= $PolicyPlanHideStyle1 ?> id="PolicyPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="PolicyPlanDetail" disabled>{{$getAccountBudgetCenterSubDetailById->PolicyPlanDetail}}</textarea>
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
                                    <?php
                                    $ActionPlan = $getAccountBudgetCenterSubDetailById->ActionPlan;
                                    $isCheckedValue1 = ($ActionPlan == 1) ? 'checked' : '';

                                    $ActionPlanHideStyle1 = ($ActionPlan == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="ActionPlan" id="ActionPlan" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผนปฎิบัติการ (ด้าน)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" <?= $isCheckedValue1 ?> id="ActionPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="แผนปฎิบัติการ (ด้าน)" id="ActionPlanDetail" value="{{$getAccountBudgetCenterSubDetailById->ActionPlanDetail}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    $CommunityFundStrategicPlan = $getAccountBudgetCenterSubDetailById->CommunityFundStrategicPlan;
                                    $isCheckedValue1 = ($CommunityFundStrategicPlan == 1) ? 'checked' : '';

                                    $CommunityFundStrategicPlanHideStyle1 = ($CommunityFundStrategicPlan == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="CommunityFundStrategicPlan" id="CommunityFundStrategicPlan" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" <?= $CommunityFundStrategicPlanHideStyle1 ?> id="CommunityFundStrategicPlanHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="แผนยุทธศาสตร์กองทุนหมู่บ้านและชุมชนเมืองแห่งชาติ" id="CommunityFundStrategicPlanDetail" value="{{$getAccountBudgetCenterSubDetailById->CommunityFundStrategicPlanDetail}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <?php
                                    $OperationalPlans = $getAccountBudgetCenterSubDetailById->OperationalPlans;
                                    $isCheckedValue1 = ($OperationalPlans == 1) ? 'checked' : '';

                                    $OperationalPlansHideStyle1 = ($OperationalPlans == 1) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <input type="checkbox" name="OperationalPlans" id="OperationalPlans" <?= $isCheckedValue1 ?> disabled>
                                    <label>แผนปฎิบัติการ ระยะ 5 ปี และประจำปี</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" <?= $OperationalPlansHideStyle1 ?> id="OperationalPlansHide">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control check_number" placeholder="แผนปฎิบัติการ ระยะ 5 ปี และประจำปี" id="OperationalPlansDetail" value="{{$getAccountBudgetCenterSubDetailById->OperationalPlansDetail}}" disabled>
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
                                    <?php
                                    $ProjectOriginId = $getAccountBudgetCenterSubDetailById->ProjectOriginId;
                                    $isCheckedValue0 = ($ProjectOriginId == 0) ? 'selected' : '';
                                    $isCheckedValue1 = ($ProjectOriginId == 1) ? 'selected' : '';
                                    $isCheckedValue2 = ($ProjectOriginId == 2) ? 'selected' : '';
                                    $isCheckedValue3 = ($ProjectOriginId == 3) ? 'selected' : '';
                                    $isCheckedValue4 = ($ProjectOriginId == 4) ? 'selected' : '';

                                    $ProjectOriginIdsHideStyle1 = ($ProjectOriginId != 0) ? 'style="display: block;"' : 'style="display: none;"';
                                    ?>
                                    <select disabled class="form-control" id="ProjectOriginId">
                                        <option value="0" <?= $isCheckedValue0 ?> disabled>----เลือกที่มาของโครงการ----</option>
                                        <option value="1" <?= $isCheckedValue1 ?>>มติคณะรัฐมนตรี (ชุดปัจจุบัน)</option>
                                        <option value="2" <?= $isCheckedValue2 ?>>ข้อสั่งการของนายกรัฐมนตรี</option>
                                        <option value="3" <?= $isCheckedValue3 ?>>นโยบายสำคัญของรัฐบาล</option>
                                        <option value="4" <?= $isCheckedValue4 ?>>อื่นๆ</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1" id="ProjectOriginHide" <?= $ProjectOriginIdsHideStyle1 ?>>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="รายละเอียด" id="ProjectOriginDetail" value="{{$getAccountBudgetCenterSubDetailById->ProjectOriginDetail}}" disabled>
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
                                    <textarea class="form-control" id="PrinciplesReason" disabled>{{$getAccountBudgetCenterSubDetailById->PrinciplesReason}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>2.วัตถุประสงค์</label>
                                    <textarea class="form-control" id="Objective" disabled>{{$getAccountBudgetCenterSubDetailById->Objective}}</textarea>
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
                                    <textarea class="form-control" id="Qualitativegoal" disabled>{{$getAccountBudgetCenterSubDetailById->Qualitativegoal}}</textarea>
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
                                    <textarea class="form-control" id="ExpectedResults" disabled>{{$getAccountBudgetCenterSubDetailById->ExpectedResults}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.2ดัชนีชี้วัดความสำเร็จ</label>
                                    <textarea class="form-control" id="SuccessIndicators" disabled>{{$getAccountBudgetCenterSubDetailById->SuccessIndicators}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>4.3กลุ่มเป้าหมาย/ผู้ที่ได้รับผลประโยชน์</label>
                                    <textarea class="form-control" id="Beneficiary" disabled>{{$getAccountBudgetCenterSubDetailById->Beneficiary}}</textarea>
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
                                    <label>วันที่เริ่มโครงการ</label>
                                    <input type="date" class="form-control" id="AccStartDate" value="{{$getAccountBudgetCenterSubById->AccStartDate}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดโครงการ</label>
                                    <input type="date" class="form-control" id="AccEndDate" value="{{$getAccountBudgetCenterSubById->AccEndDate}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>5.1แผนดำเนินการ/แผนงบประมาณ(โดยละเอียด)</label>
                                    <textarea id="Detail"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>5.2แผนการจัดซื้อจัดจ้าง (ถ้ามี)</label>
                                    <textarea class="form-control" id="Procurement" disabled>{{$getAccountBudgetCenterSubDetailById->Procurement}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>6.สถานที่ดำเนินโครงการ</label>
                                    <textarea class="form-control" id="ProjectLocation" disabled>{{$getAccountBudgetCenterSubDetailById->ProjectLocation}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>7.งบประมาณ (บาท)</label>
                                    <input type="text" class="form-control check_number" placeholder="งบประมาณ (บาท)" id="SubAmount" value="{{$getAccountBudgetCenterSubById->SubAmount}}" oninput="formatCurrency(this);" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>8.การติดตามและประเมินผล</label>
                                    <textarea class="form-control" disabled id="Monitoring">{{$getAccountBudgetCenterSubDetailById->Monitoring}}</textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <h4>เอกสารแนบ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectActivity" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">ชื่อเอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getAccountBudgetCenterSubFileById as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center"><a href="{{ asset($value->FilePath) }}" target="_blank">{{ $value->FileName }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h4 style="text-align: center;color:black">รายละเอียดแผนงานกิจกรรม</h4>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectActivity" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">กิจกรรม</th>
                                                <th style="text-align: center;">รายละเอียด</th>
                                                <th style="text-align: center;">งบประมาณ (บาท)</th>
                                                <th style="text-align: center;">จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getAccountBudgetCenterActivityById as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center">{{ $value->ActivityName}}</td>
                                                <td style="text-align:center">{{ $value->ActivityDetail}}</td>
                                                <td style="text-align:center">{{ number_format($value->ActivityAmount, 2)}}</td>
                                                <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                                    <a href="/viewAccountCenterActivityDetail/{{$value->id}}" class="btn" style="color: white; background-color: #1dc9b7;">ดูข้อมูล</a>
                                                    @if($value->ActivityStatus == 1)
                                                    <a href="/updateAccountCenterActivityDetail/{{$value->id}}" class="btn" style="color: white; background-color: #1dc9b7;">อัพเดทกิจกรรม</a>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <input type="hidden" id="DetailSub" name="DetailSub" value="{{$getAccountBudgetCenterSubById->Detail}}">
                        <input type="hidden" value="{{$accSubId}}" id="accSubId">
                        <input type="hidden" id="DetailQuantitativeGoal" name="DetailQuantitativeGoal" value="{{$getAccountBudgetCenterSubDetailById->QuantitativeGoal}}">

                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <a href="/admin/accountBudgetCenterActivity">
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
        formatCurrency(document.getElementById("SubAmount"));
    };

    function formatCurrencyData(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function formatCurrency(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function formatCurrencyInput(input) {
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
    $(document).ready(function() {

        let editor, editorQuantitativeGoal;
        var DetailSub = $('#DetailSub').val();
        var DetailQuantitativeGoal = $('#DetailQuantitativeGoal').val();

        ClassicEditor
            .create(document.querySelector('#Detail'), {
                readOnly: true,

            })
            .then(editor => {
                editor.enableReadOnlyMode("editor");
                var DetailSub = $('#DetailSub').val();
                const initialContent = DetailSub;
                editor.setData(initialContent);
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#QuantitativeGoal'), {
                readOnly: true,

            })
            .then(editor => {
                editor.enableReadOnlyMode("editor");
                var DetailQuantitativeGoal = $('#DetailQuantitativeGoal').val();
                const initialContent = DetailQuantitativeGoal;
                editor.setData(initialContent);
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection