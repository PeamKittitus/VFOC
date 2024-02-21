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
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">ข้อมูลเกี่ยวกับโครงการ</h4>
        <form id="addProjectBudget" name="addProjectBudget" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อโครงการ</label>
                                    <select class="form-control" id="accountBudgetSub">
                                        <option value="0" disabled selected>----ชื่อโครงการ----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>รายละเอียดโครงการ</label>
                                    <textarea type="text" class="form-control" id="accountBudgetSubDetail" disabled></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>จำนวนเงิน</label>
                                    <input type="text" class="form-control" placeholder="จำนวนเงิน" id="accountBudgetSubAmount" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>การจ่ายเงินงบประมาณ </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectSubPeriod" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">งวดที่</th>
                                                <th style="text-align: center;">จ่ายอัตราร้อยละ (%)</th>
                                                <th style="text-align: center;">จำนวนเงิน (บาท)</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>เอกสารแนบ </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectSubFile" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">ชื่อเอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            <tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>กำหนดวันที่เริ่มต้น-สิ้นสุดโครงการ </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่เริ่มโครงการ</label>
                                    <input type="date" class="form-control" placeholder="วันที่เริ่มโครงการ" id="accountBudgetSubAccStartDate">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดโครงการ</label>
                                    <input type="date" class="form-control" placeholder="วันที่เริ่มโครงการ" id="accountBudgetSubAccEndDate">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <h4>กิจกรรมในโครงการ</h4>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button id="addActivityBtn" type="button" class="btn" style="color: white ; background-color:#1dc9b7">เพิ่มกิจกรรม</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectActivity" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">กิจกรรม/โครงการ</th>
                                                <th style="text-align: center;">วันที่เริ่มต้น-วันที่สิ้นสุด</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <h4>ครุภัณฑ์</h4>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button id="addAssetBtn" type="button" class="btn" style="color: white ; background-color:#1dc9b7">เพิ่มครุภัณฑ์</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectAsset" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">เลขที่ครุภัณฑ์</th>
                                                <th style="text-align: center;">ชื่อครุภัณฑ์</th>
                                                <th style="text-align: center;">อายุครุภัณฑ์ (ปี)</th>
                                                <th style="text-align: center;">จำนวนครุภัณฑ์</th>
                                                <th style="text-align: center;">ราคาสุทธิ</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            <tr></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4>เอกสารแนบ</h4>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="file" class="form-control" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/memberVillage">
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
<!-- Modal -->
<div class="modal fade" id="addActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addActivityModalLabel">เพิ่มกิจกรรม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>กิจกรรม/โครงการ<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="กิจกรรม/โครงการ" id="ActivityDetail">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>งบประมาณกิจกรรม<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="งบประมาณกิจกรรม" id="ActivityBudget">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>วันเริ่มต้น<strong style="color:red">*</strong></label>
                            <input type="date" class="form-control" placeholder="วันเริ่มต้น" id="StartActivityDate">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>วันสิ้นสุด<strong style="color:red">*</strong></label>
                            <input type="date" class="form-control" placeholder="วันสิ้นสุด" id="EndActivityDate">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveActivityBtn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white ; background-color:red">ปิด</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssetModalLabel">เพิ่มครุภัณฑ์</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>เลขที่ครุภัณฑ์<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="เลขที่ครุภัณฑ์" id="AssetCode">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>ชื่อครุภัณฑ์<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="ชื่อครุภัณฑ์" id="AssetName">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>อายุครุภัณฑ์ (ปี)<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="อายุครุภัณฑ์ (ปี)" id="AssetAge">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>จำนวนครุภัณฑ์<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="จำนวนครุภัณฑ์" id="Amount">
                        </div>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>ราคาสุทธิ<strong style="color:red">*</strong></label>
                            <input type="text" class="form-control" placeholder="ราคาสุทธิ" id="AmountUnit">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="saveAssetBtn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white ; background-color:red">ปิด</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function() {

        let dataArrayActivity = []; //store data
        let dataArrayAsset = []; //store data

        $('#accountBudgetSub').select2();

        // เมื่อคลิกที่ปุ่ม "เพิ่มครุภัณฑ์"
        document.getElementById('addAssetBtn').addEventListener('click', function() {
            // Open Modal
            $('#addAssetModal').modal('show');

            // Clear modal inputs
            document.getElementById('AssetCode').value = "";
            document.getElementById('AssetName').value = "";
            document.getElementById('AssetAge').value = "";
            document.getElementById('Amount').value = "";
            document.getElementById('AmountUnit').value = "";

            // Remove the previous event listener for the "Save" button
            $('#saveAssetBtn').off('click').on('click', function() {
                // Close Modal
                $('#addAssetModal').modal('hide');

                // Extract data from modal inputs
                var AssetCode = document.getElementById('AssetCode').value;
                var AssetName = document.getElementById('AssetName').value;
                var AssetAge = document.getElementById('AssetAge').value;
                var Amount = document.getElementById('Amount').value;
                var AmountUnit = document.getElementById('AmountUnit').value;

                // Create an object to store the data
                var assetData = {
                    AssetCode: AssetCode,
                    AssetName: AssetName,
                    AssetAge: AssetAge,
                    Amount: Amount,
                    AmountUnit: AmountUnit
                };

                // Push the data object into the dataArrayActivity array
                dataArrayAsset.push(assetData);
                // Update the table with new data
                updateTableProjectAsset();
            });
        });

        //=============updateTableProjectActivity
        function updateTableProjectAsset() {
            var tableHtml = ''; // Store the HTML of the table
            for (var i = 0; i < dataArrayAsset.length; i++) {
                var row = dataArrayAsset[i];
                tableHtml += '<tr>';
                tableHtml += '<td style="text-align: center;">' + (i + 1) + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.AssetCode + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.AssetName + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.AssetAge + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.Amount + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.AmountUnit + '</td>';
                tableHtml += '</tr>';
            }
            $('#datatableProjectAsset tbody').html(tableHtml); // เปลี่ยน HTML ของ tbody ให้เป็นตารางใหม่
        }

        // เมื่อคลิกที่ปุ่ม "เพิ่มกิจกรรม"
        document.getElementById('addActivityBtn').addEventListener('click', function() {
            // Open Modal
            $('#addActivityModal').modal('show');

            // Clear modal inputs
            document.getElementById('ActivityDetail').value = "";
            document.getElementById('ActivityBudget').value = "";
            document.getElementById('StartActivityDate').value = "";
            document.getElementById('EndActivityDate').value = "";

            // Remove the previous event listener for the "Save" button
            $('#saveActivityBtn').off('click').on('click', function() {
                // Close Modal
                $('#addActivityModal').modal('hide');

                // Extract data from modal inputs
                var activityDetail = document.getElementById('ActivityDetail').value;
                var activityBudget = document.getElementById('ActivityBudget').value;
                var startActivityDate = document.getElementById('StartActivityDate').value;
                var endActivityDate = document.getElementById('EndActivityDate').value;

                // Create an object to store the data
                var activityData = {
                    activityDetail: activityDetail,
                    activityBudget: activityBudget,
                    startActivityDate: startActivityDate,
                    endActivityDate: endActivityDate
                };

                // Push the data object into the dataArrayActivity array
                dataArrayActivity.push(activityData);
                // Update the table with new data
                updateTableProjectActivity();
            });
        });

        //=============updateTableProjectActivity
        function updateTableProjectActivity() {
            var tableHtml = ''; // Store the HTML of the table
            for (var i = 0; i < dataArrayActivity.length; i++) {
                var row = dataArrayActivity[i];
                tableHtml += '<tr>';
                tableHtml += '<td style="text-align: center;">' + (i + 1) + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.activityDetail + '</td>';
                tableHtml += '<td style="text-align: center;">' + row.startActivityDate + ' - ' + row.endActivityDate + '</td>';
                tableHtml += '</tr>';
            }
            $('#datatableProjectActivity tbody').html(tableHtml); // เปลี่ยน HTML ของ tbody ให้เป็นตารางใหม่
        }

        //=============accountBudgetSubApi
        $.ajax({
            url: '/getAccountBudgetSubApi',
            type: 'GET',
            success: function(data) {
                if (data.api_status == 1) {
                    var selectElement = $('#accountBudgetSub');
                    data.data.forEach(function(value) {
                        var option = $('<option>', {
                            value: value.id,
                            text: value.AccName
                        });
                        selectElement.append(option);
                    });
                    //onchange event
                    selectElement.on('change', handleAccountBudgetChange);
                    selectElement.on('change', handleAccountBudgetDetailChange);
                    selectElement.on('change', handleAccountBudgetFileChange);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });

        //=============Onchange
        function handleAccountBudgetChange() {
            var selectedValue = $('#accountBudgetSub').val();
            var formData = new FormData();
            formData.append('id', selectedValue);
            $.ajax({
                url: '/getAccountBudgetSubPeriodDetailApi',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.api_status == 1) {
                        var data = response.data; // ข้อมูลที่ได้รับจาก API
                        var tableHtml = ''; // เก็บ HTML ของตาราง
                        for (var i = 0; i < data.length; i++) {
                            var row = data[i];
                            tableHtml += '<tr>';
                            tableHtml += '<td style="text-align: center;">' + row.PeriodNo + '</td>'; // งวดที่
                            tableHtml += '<td style="text-align: center;">' + row.PeriodPercent + '</td>'; // จ่ายอัตราร้อยละ (%)
                            tableHtml += '<td style="text-align: center;">' + row.PeriodAmount + '</td>'; // จำนวนเงิน (บาท)
                            tableHtml += '</tr>';
                        }
                        $('#datatableProjectSubPeriod tbody').html(tableHtml); // เปลี่ยน HTML ของ tbody ให้เป็นตารางใหม่
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        //=============Onchange 
        function handleAccountBudgetDetailChange() {
            var selectedValue = $('#accountBudgetSub').val();
            var formData = new FormData();
            formData.append('id', selectedValue);
            $.ajax({
                url: '/getAccountBudgetDetailSubApi',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.api_status == 1) {
                        var data = response.data;
                        var plainText = $('<div/>').html(data.Detail).text();
                        $('#accountBudgetSubDetail').val(plainText);
                        $('#accountBudgetSubAmount').val(data.Amount);
                        $('#accountBudgetSubAccStartDate').val(data.AccStartDate);
                        $('#accountBudgetSubAccEndDate').val(data.AccEndDate);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        function handleAccountBudgetFileChange() {
            var selectedValue = $('#accountBudgetSub').val();
            var formData = new FormData();
            formData.append('id', selectedValue);
            $.ajax({
                url: '/getAccountBudgetFileApi',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.api_status == 1) {
                        var data = response.data;
                        var tableHtml = ''; // เก็บ HTML ของตาราง
                        for (var i = 0; i < data.length; i++) {
                            var row = data[i];
                            tableHtml += '<tr>';
                            tableHtml += '<td style="text-align: center;">' + (i + 1) + '</td>';
                            tableHtml += '<td style="text-align: center;"><a href="' + row.FilePath + '" target="_blank">' + row.FileName + '</a></td>';
                            tableHtml += '</tr>';
                        }
                        $('#datatableProjectSubFile tbody').html(tableHtml); // เปลี่ยน HTML ของ tbody ให้เป็นตารางใหม่
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }

        //SubmitProjectBudget
        $("form[name=addProjectBudget]").submit(function(event) {
            event.preventDefault();
            var dataArrayActivityForm = dataArrayActivity;
            var dataArrayAssetForm = dataArrayAsset;
            var AccountBudgetSubId =  $('#accountBudgetSub').val();
            var StartProjectDate = $('#accountBudgetSubAccStartDate').val();
            var EndProjectDate = $('#accountBudgetSubAccEndDate').val();
            var formData = new FormData();

            formData.append('AccountBudgetSubId', AccountBudgetSubId);
            formData.append('StartProjectDate', StartProjectDate);
            formData.append('EndProjectDate', EndProjectDate);
            formData.append(
                "file[]",
                document.getElementById("file").files[0]
            );
            $.each(dataArrayActivityForm, function(i, value) {
                formData.append("dataArrayActivity[]", JSON.stringify(value));
            });
            $.each(dataArrayAssetForm, function(i, val) {
                formData.append("dataArrayAsset[]",JSON.stringify(val));
            });

            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการยื่นโครงการใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/addProjectBudgetApi',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "บันทึกข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/projectBudget";
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: "An error occurred while saving the form data.",
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            });
                        }
                    });
                }
            });
        });
    })
</script>
@endsection