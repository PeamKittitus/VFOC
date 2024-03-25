@extends('crudbooster::admin_template')
@section('content')

<head>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <style>
        body {
            font-family: 'Sarabun', sans-serif !important;
        }

        .select2-container2 {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle;
            width: 200px !important;
        }

        #datatable thead th {
            background-color: #1ab3a3;
            color: #fff;
        }

        table.dataTable.dtr-inline.collapsed>tbody>tr>td.dtr-control:before {
            background-color: #886ab5;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            margin-top: 10px !important;
        }

        .breadcrumb {
            background-color: #fff;
        }

        .page-content {
            padding: 1.5rem 2rem;
        }

        .page-breadcrumb {
            padding: 0;
            background: transparent;
            margin: 0 0 1.5rem;
            position: relative;
            text-shadow: #fff 0 1px;
        }

        .a {
            color: #039dab !important;
        }

        .breadcrumb>li>a {
            text-decoration: none !important;
            color: #039dab !important;
        }

        .breadcrumb-item.active {
            color: #868e96;
        }

        .color-primary-600 {
            color: #7a59ad;
        }

        .page-content .panel {
            margin-bottom: 1.5rem;
        }

        .panel {
            padding: 1.5rem 2rem;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            position: relative;
            background-color: #fff;
            -webkit-box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
            box-shadow: 0px 0px 13px 0px rgba(62, 44, 90, 0.08);
            margin-bottom: 1.5rem;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.09);
            border-bottom: 1px solid #e0e0e0;
            border-radius: 4px;
            -webkit-transition: border 500ms ease-out;
            transition: border 500ms ease-out;
        }

        .panel-hdr {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            background: #fff;
            min-height: 3rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.07);
            border-radius: 4px 4px 0 0;
            -webkit-transition: background-color 0.4s ease-out;
            transition: background-color 0.4s ease-out;
        }

        .panel-hdr h2 {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
            font-size: 0.875rem;
            margin: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            line-height: 3rem;
            color: inherit;
            color: #333;
            position: relative;
            font-weight: 500;
            font-size: 15px;
        }

        .subheader-icon {
            color: #a8a6ac;
            margin-right: 0.25rem;
        }

        .fal {
            font-family: 'Font Awesome 5 Pro';
            font-weight: 300;
        }

        .center {
            text-align: center;
        }

        .table.dataTable.no-footer {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <div class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">แผนงานโครงการ</li>
        </ol>
        <div class="row">
            <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
                <div class="panel panel-sortable" role="widget" style="width: 100% !important;height:300px !important">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
                <div class="panel panel-sortable" role="widget">
                    <div class="panel-hdr" role="heading">
                        <h2 class="ui-sortable-handle"><i class="subheader-icon fal fa-money-bill"></i> แผนงานโครงการ</h2>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-8" style="display: flex;">
                            <div class="form-group">
                                <a href="/addAccountBudgetCenter">
                                    <button id="addActivityBtn" type="button" class="btn" style="color: white ; background-color:#1dc9b7">สร้างใหม่</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4" style="display:flex;justify-content:end;gap:1%">
                            <div class="form-group">
                                <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="color: white ; background-color:#1dc9b7">นำเข้าข้อมูล</button>
                                <button type="button" class="btn btn-success">เทมเพลท</button>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <select class="form-control" id="BudgetYear">
                                    <option value="0" disabled selected>----เลือกปีงบประมาณ----</option>
                                    <option value="2569">2569</option>
                                    <option value="2568">2568</option>
                                    <option value="2567">2567</option>
                                    <option value="2566">2566</option>
                                    <option value="2565">2565</option>
                                    <option value="2564">2564</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
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
                        <div class="col-sm-4" style="display:flex;justify-content:end;gap:1%">
                            <button id="btnClear" class="btn btn-warning btnClear">เคลียการค้นหา</button>
                            <button id="btnSearch" class="btn btn-success btnSearch">ค้นหา</button>
                            <button style="display: none;" id="btnExport" class="btn btn-warning btnExport">ส่งออกข้อมูล
                        </div>
                    </div>
                    <div class="panel-container show" role="content">
                        <div class="panel-content">
                            <div id="JsonData">
                                <div id="JsonTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin-top: 20px !important">
                                                <thead>
                                                    <tr>
                                                        <th class="center">ลำดับ</th>
                                                        <th class="center">รหัสโครงการ</th>
                                                        <th class="center">ชื่อยุทธศาสตร์/แผนงาน/โครงการ</th>
                                                        <th class="center">ฝ่าย</th>
                                                        <th class="center">วันที่เริ่มต้น-สิ้นสุดโครงการ</th>
                                                        <th class="center">กรอบวงเงินงบประมาณ (บาท)</th>
                                                        <th class="center">งบประมาณ (บาท)</th>
                                                        <th class="center">จัดการข้อมูล</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $accountProjectNumber = 1;
                                                    @endphp
                                                    @foreach ($getAccountBudgetCenter as $center)
                                                    <tr>
                                                        <td style="text-align:center">{{ $accountProjectNumber }}</td>
                                                        <td style="text-align:center">{{ $center->AccCode }}</td>
                                                        <td style="text-align:center">{{ $center->AccName }}</td>
                                                        <td style="text-align:center">-</td>
                                                        <td style="text-align:center">-</td>
                                                        <td style="text-align:center">{{ number_format($center->Amount, 2)}}</td>
                                                        <td style="text-align:center">-</td>
                                                        <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                                            <a href="/addAccountBudgetSubCenter/{{$center->id}}" data-id="{{$center->id}}" class="btn addAccountBudgetSubCenterBtn" style="color: white; background-color: #449d44">เพิ่มโครงการย่อย</a>
                                                            <a href="/editAccountBudgetCenter/{{$center->id}}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                                            <button data-id="{{$center->id}}" class="btn deleteAccountCenter" style="color: white; background-color: red">ลบ</button>
                                                        </td>
                                                    </tr>

                                                    @php
                                                    $subAccountProjectNumber = 1; // Reset sub-project number for each main project
                                                    @endphp

                                                    @foreach ($getAccountBudgetCenterSub as $centerSub)
                                                    @if ($centerSub->AccBudgetCenterId == $center->id)
                                                    <tr>
                                                        <td class="text-center" style="text-align: center">{{ $accountProjectNumber }}.{{ $subAccountProjectNumber }}</td>
                                                        <td style="text-align: center"> {{ $centerSub->AccCode }}</td>
                                                        <td style="text-align: center"> {{ $centerSub->AccName }}</td>
                                                        <td style="text-align: center"> {{ $centerSub->DivisionName }}</td>
                                                        <?php
                                                        $StartAt = date('d F Y', strtotime($centerSub->AccStartDate));
                                                        $StartAtThai = str_replace(
                                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                            array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                            $StartAt
                                                        );
                                                        $yearThai = intval(date('Y', strtotime($centerSub->AccStartDate))) + 543; // แปลงปีเป็น พ.ศ.
                                                        $StartAtThai = str_replace(date('Y', strtotime($centerSub->AccStartDate)), $yearThai, $StartAtThai);

                                                        $EndAt = date('d F Y', strtotime($centerSub->AccEndDate));
                                                        $EndAtThai = str_replace(
                                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                            array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                            $EndAt
                                                        );
                                                        $yearThai = intval(date('Y', strtotime($centerSub->AccEndDate))) + 543; // แปลงปีเป็น พ.ศ.
                                                        $EndAtThai = str_replace(date('Y', strtotime($centerSub->AccEndDate)), $yearThai, $EndAtThai);
                                                        ?>
                                                        <td style="text-align:center">{{$StartAtThai}} - {{$EndAtThai}}</td>
                                                        <td class="text-right" style="text-align: center">-</td>
                                                        <td class="text-right" style="text-align: center">{{ number_format($centerSub->SubAmount, 2) }}</td>
                                                        <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                                            <a href="/viewAccountBudgetCenterSub/{{$centerSub->id}}" class="btn" style="color: white; background-color: #09d7f7">ดูข้อมูล</a>
                                                            <a href="/addAccountBudgetCenterActivity/{{$centerSub->id}}" class="btn" style="color: white; background-color: #449d44">อัพเดทกิจกรรม</a>
                                                            <a href="/editAccountBudgetCenterSub/{{$centerSub->id}}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                                            <button data-id="{{$centerSub->id}}" class="btn deleteAccountCenterSub" style="color: white; background-color: red">ลบ</button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $subAccountProjectNumber++;
                                                    @endphp
                                                    @endif
                                                    @endforeach

                                                    @php
                                                    $accountProjectNumber++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="uploadFile" name="uploadFile">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">อัพโหลดไฟล์</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <label>อัพโหลดไฟล์</label>
                                <input type="file" id="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const data = @json($getAccountBudgetCenter->pluck('Amount', 'AccName'));

    const ctx = document.getElementById('myChart');

    // Function to generate random colors
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color + '80'; // Add alpha channel for transparency
    }

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: Object.keys(data),
            datasets: [{
                label: 'กรอบวงเงินงบประมาณ',
                data: Object.values(data),
                backgroundColor: Object.keys(data).map(() => getRandomColor()), // Generate random colors dynamically
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: 'กรอบวงเงินงบประมาณ'
                },
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
<script>
    jQuery.noConflict();
    jQuery(document).ready(function($) {
        $('.select2').select2();
        $('#BudgetYear').select2();
        $('#DivisionId').select2();

        //Uploads
        $("form[name=uploadFile]").submit(function(event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);
            $.ajax({
                url: '/UploadAccountBudgetCenter',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.api_status == 1) {
                        Swal.fire({
                            title: "สำเร็จ!",
                            text: "นำเข้าข้อมูลสำเร็จ!",
                            icon: "success",
                        }).then(function(result) {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    } else if (data.api_status == 2 || data.api_status !== undefined) {
                        Swal.fire("ยกเลิก!", data.api_message || 'An error occurred', "error");
                    }
                }
            });
        });

        //Clear
        $('#btnClear').on('click', function() {
            window.location.reload();
        });

        //Search
        $('#btnSearch').on('click', function() {
            $('#btnExport').show();
            var BudgetYear = $("#BudgetYear").val();
            var DivisionId = $("#DivisionId").val();

            if (!BudgetYear && !DivisionId) {
                showError('กรุณาเลือกข้อมูล');
                $('#btnExport').hide();
                return;
            }
            var formData = new FormData();
            formData.append('BudgetYear', BudgetYear);
            formData.append('DivisionId', DivisionId);

            $.ajax({
                url: '/getSearchAccountBudgetCenter',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var responseDetail = response.api_detail;
                    var getAccountBudgetCenter = response.getAccountBudgetCenter;
                    var getAccountBudgetCenterSub = response.getAccountBudgetCenterSub;
                    updateTable(responseDetail, getAccountBudgetCenter, getAccountBudgetCenterSub);
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
        });

        // Function to display error messages
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'ข้อมูลไม่ถูกต้อง',
                text: message
            });
        }

        function updateTable(responseDetail, getAccountBudgetCenter, getAccountBudgetCenterSub) {

            // console.log("responseDetail>>", responseDetail);
            // console.log("getAccountBudgetCenter>>", getAccountBudgetCenter);
            // console.log("getAccountBudgetCenterSub>>", getAccountBudgetCenterSub);

            var tableBody = $('#datatable tbody');
            tableBody.empty();

            if (responseDetail == 'OnlyBudget') {
                if (getAccountBudgetCenter != "") {
                    var accountProjectNumber = 1;
                    getAccountBudgetCenter.forEach(function(center) {
                        var Amount = parseFloat(center.Amount).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                        tableBody.append(`
                            <tr>
                                <td style="text-align:center">${accountProjectNumber}</td>
                                <td style="text-align:center">${center.AccCode}</td>
                                <td style="text-align:center">${center.AccName}</td>
                                <td style="text-align:center">-</td>
                                <td style="text-align:center">-</td>
                                <td style="text-align:center">${Amount}</td>
                                <td style="text-align:center">-</td>
                                <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                    <a href="/addAccountBudgetSubCenter/${center.id}" data-id="${center.id}" class="btn addAccountBudgetSubCenterBtn" style="color: white; background-color: #449d44">เพิ่มโครงการย่อย</a>
                                    <a href="/editAccountBudgetCenter/${center.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                    <button data-id="${center.id}" class="btn deleteAccountCenter" style="color: white; background-color: red">ลบ</button>
                                </td>
                            </tr>
                        `);
                        var accountProjectNumberSub = 1;
                        getAccountBudgetCenterSub.forEach(function(centersub) {
                            var SubAmount = parseFloat(centersub.SubAmount).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            // ประกาศตัวแปร
                            var startDate = centersub.AccStartDate;
                            var endDate = centersub.AccEndDate;

                            // แปลงรูปแบบวันที่
                            var formattedStartDate = new Date(startDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            var formattedEndDate = new Date(endDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            if (centersub.AccBudgetCenterId == center.id) {
                                tableBody.append(`
                                    <tr>
                                        <td style="text-align: center">${accountProjectNumber}.${accountProjectNumberSub}</td>
                                        <td style="text-align: center">${centersub.AccCode}</td>
                                        <td style="text-align: center">${centersub.AccName}</td>
                                        <td style="text-align: center">${centersub.DivisionName}</td>
                                        <td style="text-align: center">${formattedStartDate} - ${formattedEndDate}</td>
                                        <td style="text-align: center">-</td>
                                        <td style="text-align: center">${SubAmount}</td>
                                        <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                            <a href="/viewAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: #09d7f7">ดูข้อมูล</a>
                                            <a href="/addAccountBudgetCenterActivity/${centersub.id}" class="btn" style="color: white; background-color: #449d44">อัพเดทกิจกรรม</a>
                                            <a href="/editAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                            <button data-id="${centersub.id}" class="btn deleteAccountCenterSub" style="color: white; background-color: red">ลบ</button>
                                        </td>
                                    </tr>
                                `);
                                accountProjectNumberSub++;
                            }
                        });
                        accountProjectNumber++;
                    });
                }
            } else if (responseDetail == 'OnlyDevision') {
                if (getAccountBudgetCenter != "") {
                    var accountProjectNumber = 1;
                    getAccountBudgetCenter.forEach(function(center) {
                        var Amount = parseFloat(center.Amount).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        // Check if the center id matches any id in getAccountBudgetCenterSub.AccBudgetCenterId
                        if (getAccountBudgetCenterSub.some(sub => sub.AccBudgetCenterId === center.id)) {
                            tableBody.append(`
                                <tr>
                                    <td style="text-align:center">${accountProjectNumber}</td>
                                    <td style="text-align:center">${center.AccCode}</td>
                                    <td style="text-align:center">${center.AccName}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">${Amount}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                        <a href="/addAccountBudgetSubCenter/${center.id}" data-id="${center.id}" class="btn addAccountBudgetSubCenterBtn" style="color: white; background-color: #449d44">เพิ่มโครงการย่อย</a>
                                        <a href="/editAccountBudgetCenter/${center.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                        <button data-id="${center.id}" class="btn deleteAccountCenter" style="color: white; background-color: red">ลบ</button>
                                    </td>
                                </tr>
                            `);
                        }

                        var accountProjectNumberSub = 1;
                        getAccountBudgetCenterSub.forEach(function(centersub) {
                            var SubAmount = parseFloat(centersub.SubAmount).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            var startDate = centersub.AccStartDate;
                            var endDate = centersub.AccEndDate;

                            var formattedStartDate = new Date(startDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            var formattedEndDate = new Date(endDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            if (centersub.AccBudgetCenterId == center.id) {
                                tableBody.append(`
                                    <tr>
                                        <td style="text-align: center">${accountProjectNumber}.${accountProjectNumberSub}</td>
                                        <td style="text-align: center">${centersub.AccCode}</td>
                                        <td style="text-align: center">${centersub.AccName}</td>
                                        <td style="text-align: center">${centersub.DivisionName}</td>
                                        <td style="text-align: center">${formattedStartDate} - ${formattedEndDate}</td>
                                        <td style="text-align: center">-</td>
                                        <td style="text-align: center">${SubAmount}</td>
                                        <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                            <a href="/viewAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: #09d7f7">ดูข้อมูล</a>
                                            <a href="/addAccountBudgetCenterActivity/${centersub.id}" class="btn" style="color: white; background-color: #449d44">อัพเดทกิจกรรม</a>
                                            <a href="/editAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                            <button data-id="${centersub.id}" class="btn deleteAccountCenterSub" style="color: white; background-color: red">ลบ</button>
                                        </td>
                                    </tr>
                                `);
                                accountProjectNumberSub++;
                            }
                        });
                        accountProjectNumber++;
                    });
                }
            } else {
                if (getAccountBudgetCenter != "") {
                    var accountProjectNumber = 1;
                    getAccountBudgetCenter.forEach(function(center) {
                        var Amount = parseFloat(center.Amount).toLocaleString('en-US', {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });

                        // Check if the center id matches any id in getAccountBudgetCenterSub.AccBudgetCenterId
                        if (getAccountBudgetCenterSub.some(sub => sub.AccBudgetCenterId === center.id)) {
                            tableBody.append(`
                                <tr>
                                    <td style="text-align:center">${accountProjectNumber}</td>
                                    <td style="text-align:center">${center.AccCode}</td>
                                    <td style="text-align:center">${center.AccName}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center">${Amount}</td>
                                    <td style="text-align:center">-</td>
                                    <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                        <a href="/addAccountBudgetSubCenter/${center.id}" data-id="${center.id}" class="btn addAccountBudgetSubCenterBtn" style="color: white; background-color: #449d44">เพิ่มโครงการย่อย</a>
                                        <a href="/editAccountBudgetCenter/${center.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                        <button data-id="${center.id}" class="btn deleteAccountCenter" style="color: white; background-color: red">ลบ</button>
                                    </td>
                                </tr>
                            `);
                        }

                        var accountProjectNumberSub = 1;
                        getAccountBudgetCenterSub.forEach(function(centersub) {
                            var SubAmount = parseFloat(centersub.SubAmount).toLocaleString('en-US', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            });
                            var startDate = centersub.AccStartDate;
                            var endDate = centersub.AccEndDate;

                            var formattedStartDate = new Date(startDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            var formattedEndDate = new Date(endDate).toLocaleDateString('th-TH', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            });
                            if (centersub.AccBudgetCenterId == center.id) {
                                tableBody.append(`
                                    <tr>
                                        <td style="text-align: center">${accountProjectNumber}.${accountProjectNumberSub}</td>
                                        <td style="text-align: center">${centersub.AccCode}</td>
                                        <td style="text-align: center">${centersub.AccName}</td>
                                        <td style="text-align: center">${centersub.DivisionName}</td>
                                        <td style="text-align: center">${formattedStartDate} - ${formattedEndDate}</td>
                                        <td style="text-align: center">-</td>
                                        <td style="text-align: center">${SubAmount}</td>
                                        <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                            <a href="/viewAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: #09d7f7">ดูข้อมูล</a>
                                            <a href="/addAccountBudgetCenterActivity/${centersub.id}" class="btn" style="color: white; background-color: #449d44">อัพเดทกิจกรรม</a>
                                            <a href="/editAccountBudgetCenterSub/${centersub.id}" class="btn" style="color: white; background-color: orange">แก้ไข</a>
                                            <button data-id="${centersub.id}" class="btn deleteAccountCenterSub" style="color: white; background-color: red">ลบ</button>
                                        </td>
                                    </tr>
                                `);
                                accountProjectNumberSub++;
                            }
                        });
                        accountProjectNumber++;
                    });
                }
            }
        }

        //Export
        $('#btnExport').on('click',function(){
            var BudgetCenter = 1;
            var BudgetYear = $("#BudgetYear").val();
            var DivisionId = $("#DivisionId").val();
            var url ="/ExportAccountBudgetCenter?BudgetCenter=1&BudgetYear="+BudgetYear+"&DivisionId="+DivisionId;
        });

        //Download
        function download(url) {
            const a = document.createElement('a')
            a.href = url
            a.download = url.split('/').pop()
            document.body.appendChild(a)
            a.click()
            document.body.removeChild(a)
        }

        $.extend(true, $.fn.dataTable.defaults, {
            "language": {
                "sProcessing": "กำลังดำเนินการ...",
                "sLengthMenu": "แสดง_MENU_ แถว",
                "sZeroRecords": "ไม่พบข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                "sInfoPostFix": "",
                "sSearch": "ค้นหา:",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "เริ่มต้น",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "สุดท้าย"
                }
            }
        });

        $('#datatable').DataTable();

        $('.deleteAccountCenter').on('click', function() {
            var AccId = $(this).data('id');
            var formData = new FormData();
            formData.append('AccId', AccId);
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการลบข้อมูลใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/delAccountBudgetCenter',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.api_status == 1) {
                                Swal.fire({
                                    title: "สำเร็จ",
                                    text: "ลบข้อมูลสำเร็จ!",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/accountBudgetCenter";
                                    }
                                });
                            } else {
                                Swal.fire("ยกเลิก!", response.api_message, "error");
                            }

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

        $('.deleteAccountCenterSub').on('click', function() {
            var AccId = $(this).data('id');
            var formData = new FormData();
            formData.append('AccCenterSubId', AccId);
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการลบข้อมูลใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/delSubAccountBudgetCenter',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.api_status == 1) {
                                Swal.fire({
                                    title: "สำเร็จ",
                                    text: "ลบข้อมูลสำเร็จ!",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = "/admin/accountBudgetCenter";
                                    }
                                });
                            } else {
                                Swal.fire("ยกเลิก!", response.api_message, "error");
                            }

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

        // Select all elements with class 'addAccountBudgetSubCenterBtn'
        const buttons = document.querySelectorAll('.addAccountBudgetSubCenterBtn');

        // Loop through each button and add event listener
        buttons.forEach(button => {
            button.addEventListener('click', function(event) {
                // Prevent the default link behavior
                event.preventDefault();

                // Get the value of the data-id attribute
                const dataId = this.getAttribute('data-id');
                // Store the data-id value in localStorage
                localStorage.setItem('AccountBudgetCenterId', dataId);

                // Redirect to the link's href
                window.location.href = this.href;
            });
        });
    });
</script>
@endsection