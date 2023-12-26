@extends('crudbooster::admin_template')
@section('content')
<?php

use Carbon\Carbon;
?>

<head>
    <!-- Include Kanit font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }

        #example thead th {
            background-color: #1ab3a3;
            color: #fff;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before {
            background-color: #886ab5;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            margin-top: 25px !important;
        }

        .select2-container2 {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 200px !important;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .rounded-plus {
            border-radius: 10px;
        }

        .bg-faded {
            background-color: #f7f9fa;
        }

        .card,
        .card-group {
            -webkit-box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
            box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 4px;
        }

        label {
            display: inline-block;
            /* margin-bottom: 0.6rem !important; */
            color: #212529 !important;
            font-size: 1.2rem !important;
            font-weight: 400 !important;
        }

        .btn-primary {
            background-color: #039dab;
            border-color: #039dab;
            color: #fff;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 50px;
            /* height: calc(1.47em + 1rem + 2px); */
            padding: 0.5rem 0.875rem;
            /* font-size: 0.8125rem; */
            font-weight: 400;
            line-height: 1.47;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #E5E5E5;
            border-radius: 4px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .label {
            font-size: 20px !important;
            margin-left: -10px;
            margin-bottom: 5px !important;
        }

        input::placeholder,
        input {
            font-size: 14px;
            color: #333;
        }

        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }

        .custom-input {
            width: 80%;
            /* height: 40px; */
            padding: 10px;
            font-size: 16px;
            border: 2px solid grey;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        /* Style when the input is focused */
        .custom-input:focus {
            border-color: #2ecc71;
        }

        #editor {
            height: 300px;
            /* Adjust the height as needed */
        }
    </style>
</head>

<body>

    <div>
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/Home/Index">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="/EAccount/StructureIndex">ผังบัญชีงบประมาณโครงการ</a></li>
            <li class="breadcrumb-item active">สร้างใหม่</li>
        </ol>
    </div>


    <div class="flex-1 bg-pattern" style="background: #8dcde1">
        <div class="card p-4 rounded-plus bg-faded">
            <form id="saveAccountBudget" name="saveAccountBudget" method="post" enctype="multipart/form-data">

                <div class="card-body pb-1">
                    <div class="section-title">
                        <h4 class='font'><strong style="font-weight: 400;"><i class="fa fa-file-text-o" aria-hidden="true" style='margin-right: 10px'></i>สร้างใหม่</strong></h4>
                    </div>
                    <hr />
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label">ชื่อโครงการ<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="ชื่อโครงการ" id="AccName">
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label">วงเงินงบประมาณ<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="วงเงินงบประมาณ" id="Amount">
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label">งบประมาณต่อกองทุน<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="งบประมาณต่อกองทุน" id="SubAmount">
                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" style='color: red !important ; margin-bottom: 10px'>กำหนดแบ่งจ่ายเงินงบประมาณ</label><br>
                            <div class="d-flex flex-wrap" style="margin-top: 10px">
                                <button id="add_input" class="btn btn-warning" style='width: 150px ; margin-right: 10px ; color: white ; '>
                                    <i class="fa fa-plus" style='padding-right:10px'></i>เพิ่มงวดแบ่งจ่าย</button>
                                <button id="del_input" class="btn btn-danger" style='width: 150px ; color: white'>
                                    <i class="fa fa-eraser" style='padding-right:10px'></i>ลบ</button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group basic" id="budget_form">
                        <div class="d-flex" style="margin-bottom: 10px">
                            <div style="width: 20%; margin-right: 10px; display: inline-block;">
                                งวดที่
                                <input type="text" class="form-control" placeholder="งบประมาณต่อกองทุน" id="PeriodNo" style="width: 100%">
                            </div>
                            <div style="width: 20%; display: inline-block;">
                                อัตราจ่ายร้อยละ
                                <input type="number" class="form-control" placeholder="อัตราจ่ายร้อยละ" id="PeriodPercent" style="width: 100%">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 style="color:red">กำหนดเกณฑ์ความเสี่ยงของผู้ยื่นขอโครงการ ด้านกิจกรรมและระยะเวลาของโครงการ</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label style="font-size: 14px">ความเสี่ยงด้านกิจกรรม(จำนวนกิจกรรมในโครงการที่ควรมี)</label>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <div class="flex-wrap " style="display: flex;margin-top: 10px ;justify-content: space-between;">
                                <div>
                                    <div>ระดับต่ำ<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="LowActivity">
                                </div>
                                <div>
                                    <div>ระดับกลาง<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="MidActivity">
                                </div>
                                <div>
                                    <div>ระดับสูง<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="HighActivity">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <label style="font-size: 14px">ความเสี่ยงด้านระยะเวลาดำเนินการโครงการ(จำนวนวันรวมในโครงการที่ไม่ควรเกิน)</label>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <div class="flex-wrap " style="display: flex;margin-top: 10px ;justify-content: space-between;">
                                <div>
                                    <div>ระดับต่ำ<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="LowTiming">
                                </div>
                                <div>
                                    <div>ระดับกลาง<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="MidTiming">
                                </div>
                                <div>
                                    <div>ระดับสูง<strong style="color: red">*</strong></div>
                                    <input type="text" class="custom-input" id="HighTiming">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px">
                        <div style="width: 45%;">
                            <div>
                                วันที่เริ่มต้นโครงการ <strong style="color: red">*</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <select class="select2" style="width: 60px;" id="AccStartDate">
                                        <?php
                                        for ($day = 1; $day <= 31; $day++) {
                                            echo "<option value='$day'>$day</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="margin-right: 10px;">
                                    <select class="select2" style="width: 100px;" id="AccStartMonth">
                                        <?php

                                        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
                                            $monthName = Carbon::create()->month($monthNumber)->locale('th')->monthName;
                                            echo "<option value='$monthNumber'>$monthName</option>";
                                        }
                                        ?>
                                    </select>


                                </div>
                                <div>
                                    <select class="select2" style="width: 100px;" id="AccStartYear">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {
                                            $buddhistYear = $year + 543;
                                            echo "<option value='$year'>$buddhistYear </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="width: 45%;">
                            <div>
                                วันที่สิ้นสุดโครงการ <strong style="color: red">*</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <select class="select2" style="width: 60px;" id="AccEndDate">
                                        <?php
                                        for ($day = 1; $day <= 31; $day++) {
                                            echo "<option value='$day'>$day</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="margin-right: 10px;">
                                    <select class="select2" style="width: 100px;" id="AccEndMonth">
                                        <?php


                                        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
                                            $monthName = Carbon::create()->month($monthNumber)->locale('th')->monthName;
                                            echo "<option value='$monthNumber'>$monthName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <select class="select2" style="width: 100px;" id="AccEndYear">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {
                                            $buddhistYear = $year + 543;
                                            echo "<option value='$year'>$buddhistYear </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 20px">
                        <div style="width: 45%;">
                            <div>
                                วันที่เปิดรับโครงการ <strong style="color: red">*</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <select class="select2" style="width: 60px;" id="OpenStartDate">
                                        <?php
                                        for ($day = 1; $day <= 31; $day++) {
                                            echo "<option value='$day'>$day</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="margin-right: 10px;">
                                    <select class="select2" style="width: 100px;" id="OpenStartMonth">
                                        <?php


                                        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
                                            $monthName = Carbon::create()->month($monthNumber)->locale('th')->monthName;
                                            echo "<option value='$monthNumber'>$monthName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <select class="select2" style="width: 100px;" id="OpenStartYear">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {
                                            $buddhistYear = $year + 543;
                                            echo "<option value='$year'>$buddhistYear </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div style="width: 45%;">
                            <div>
                                วันที่ปิดรับโครงการ <strong style="color: red">*</strong>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <select class="select2" style="width: 60px;" id="EndStartDate">
                                        <?php
                                        for ($day = 1; $day <= 31; $day++) {
                                            echo "<option value='$day'>$day</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div style="margin-right: 10px;">
                                    <select class="select2" style="width: 100px;" id="EndStartMonth">
                                        <?php


                                        for ($monthNumber = 1; $monthNumber <= 12; $monthNumber++) {
                                            $monthName = Carbon::create()->month($monthNumber)->locale('th')->monthName;
                                            echo "<option value='$monthNumber'>$monthName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div>
                                    <select class="select2" style="width: 100px;" id="EndStartYear">
                                        <?php
                                        $currentYear = date('Y');
                                        for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {
                                            $buddhistYear = $year + 543;
                                            echo "<option value='$year'>$buddhistYear </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <label style="font-size: 14px">เอกสารแนบ <span style="color:red">(ขนาดไฟล์ของเอกสารแนบรวมไม่เกิน
                            50MB/1ครั้ง) </span></label>
                    <input type="file" name="file" id="file">
                    <hr>
                    <label style="font-size: 14px"> แหล่งที่มา/วัตถุประสงค์</span></label>
                    <textarea id="Detail"></textarea>


                    <br>
                    <div class="form-button-group  transparent">
                        <button type="submit" class="btn btn-success btn-block" style='background-color: #1ab3a3;width: 150px ; float: right;'>
                            <i class="fa fa-save" style='padding-right:10px'></i>บันทึก</button>
                    </div>

                </div>

            </form>
        </div>
    </div>



</body>

<script>
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
    $(document).ready(function() {
        let inputIndex = 2;
        $("#add_input").on("click", function(e) {
            e.preventDefault();
            var newBudgetInput = `
            <div class="d-flex" style="margin-bottom: 10px">
                <div style="width: 20%; margin-right: 10px; display: inline-block;">
                    <input type="text" class="form-control" placeholder="งบประมาณต่อกองทุน" style="width: 100%" value="${inputIndex}">
                </div>
                <div style="width: 20%; display: inline-block;">
                    <input type="number" class="form-control" placeholder="งบประมาณต่อกองทุน" style="width: 100%" >
                </div>
            </div>`;
            $("#budget_form").append(newBudgetInput);
            inputIndex++;
        });
        $("#del_input").on("click", function(e) {
            e.preventDefault();
            if ($("#budget_form .d-flex").length > 1) {
                $("#budget_form .d-flex:last").remove();
                inputIndex--;
            }
        });
    });
</script>
<script>
    let editor;
    ClassicEditor
        .create(document.querySelector('#Detail'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        //=============Submit
        $("form[name=saveAccountBudget]").submit(function(event) {
            event.preventDefault();
            // Get values from form fields
            // var AccId = $('#AccId').val();
            var AccId = 14;
            var AccName = $('#AccName').val();
            var Amount = $('#Amount').val();
            var SubAmount = $('#SubAmount').val();
            var PeriodNo = $('#PeriodNo').val();
            var PeriodPercent = $('#PeriodPercent').val();
            var LowActivity = $('#LowActivity').val();
            var MidActivity = $('#MidActivity').val();
            var HighActivity = $('#HighActivity').val();
            var LowTiming = $('#LowTiming').val();
            var MidTiming = $('#MidTiming').val();
            var HighTiming = $('#HighTiming').val();
            var AccStartDate = $('#AccStartDate').val();
            var AccStartMonth = $('#AccStartMonth').val();
            var AccStartYear = $('#AccStartYear').val();
            var AccEndDate = $('#AccEndDate').val();
            var AccEndMonth = $('#AccEndMonth').val();
            var AccEndYear = $('#AccEndYear').val();
            var OpenStartDate = $('#OpenStartDate').val();
            var OpenStartMonth = $('#OpenStartMonth').val();
            var OpenStartYear = $('#OpenStartYear').val();
            var EndStartDate = $('#EndStartDate').val();
            var EndStartMonth = $('#EndStartMonth').val();
            var EndStartYear = $('#EndStartYear').val();
            var totalfiles = document.getElementById("file").files.length;
            var editorData = editor.getData();
            var Detail = editorData;
            console.log("AccId:", AccId);
            console.log("AccName:", AccName);
            console.log("Amount:", Amount);
            console.log("SubAmount:", SubAmount);
            console.log("PeriodNo:", PeriodNo);
            console.log("PeriodPercent:", PeriodPercent);
            console.log("LowActivity:", LowActivity);
            console.log("MidActivity:", MidActivity);
            console.log("HighActivity:", HighActivity);
            console.log("LowTiming:", LowTiming);
            console.log("MidTiming:", MidTiming);
            console.log("HighTiming:", HighTiming);
            console.log("AccStartDate:", AccStartDate);
            console.log("AccStartMonth:", AccStartMonth);
            console.log("AccStartYear:", AccStartYear);
            console.log(AccStartYear+'-'+AccStartMonth+'-'+AccStartDate);
            console.log("AccEndDate:", AccEndDate);
            console.log("AccEndMonth:", AccEndMonth);
            console.log("AccEndYear:", AccEndYear);
            console.log("OpenStartDate:", OpenStartDate);
            console.log("OpenStartMonth:", OpenStartMonth);
            console.log("OpenStartYear:", OpenStartYear);
            console.log("EndStartDate:", EndStartDate);
            console.log("EndStartMonth:", EndStartMonth);
            console.log("EndStartYear:", EndStartYear);
            console.log("Total Files:", totalfiles);
            console.log("Editor Data:", Detail);
            // var formData = new FormData();
            // formData.append('idCard', idCard);
            // for (var index = 0; index < totalfiles; ++index) {
            //   formData.append(
            //     "file[]",
            //     document.getElementById("file").files[index]
            //   );
            // }
            // $.ajax({
            //     url: '/saveRegister',
            //     type: 'POST',
            //     data: formData,
            //     processData: false,
            //     contentType: false,
            //     success: function(response) {
            //         if (response.api_status == 1) {
            //             Swal.fire({
            //                 icon: 'success',
            //                 title: 'สำเร็จ!',
            //                 text: 'บันทึกข้อมูลเรียบร้อย'
            //             }).then(function() {
            //                 window.location.href = '/admin/login';
            //             });
            //         } else if (data.api_status == 2) {
            //             swal("ยกเลิก!", data.api_message, "error");
            //         } else {
            //             swal("ยกเลิก!", data.api_message, "error");
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.error('AJAX Error:', status, error);
            //     }
            // });
        });
    });
</script>
@endsection