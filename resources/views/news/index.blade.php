@extends('crudbooster::admin_template')
@section('content')
@php
use Carbon\Carbon;
@endphp

<head>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- Include jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <!-- Include Kanit font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            font-weight: 400;
        }

        #example thead th {
            background-color: #1ab3a3;
            color: #fff;
        }

        .btn-success {
            background-color: #1ab3a3;
        }

        .btn-warning {
            background-color: orange;
        }

        .btn-danger {
            background-color: red;
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
            width: 50% !important;
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
            margin-top: 25px !important;
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

        /* CSS BUTTON */
        .checkbox-wrapper-7 .tgl {
            display: none;
        }

        .checkbox-wrapper-7 .tgl,
        .checkbox-wrapper-7 .tgl:after,
        .checkbox-wrapper-7 .tgl:before,
        .checkbox-wrapper-7 .tgl *,
        .checkbox-wrapper-7 .tgl *:after,
        .checkbox-wrapper-7 .tgl *:before,
        .checkbox-wrapper-7 .tgl+.tgl-btn {
            box-sizing: border-box;
        }

        .checkbox-wrapper-7 .tgl::-moz-selection,
        .checkbox-wrapper-7 .tgl:after::-moz-selection,
        .checkbox-wrapper-7 .tgl:before::-moz-selection,
        .checkbox-wrapper-7 .tgl *::-moz-selection,
        .checkbox-wrapper-7 .tgl *:after::-moz-selection,
        .checkbox-wrapper-7 .tgl *:before::-moz-selection,
        .checkbox-wrapper-7 .tgl+.tgl-btn::-moz-selection,
        .checkbox-wrapper-7 .tgl::selection,
        .checkbox-wrapper-7 .tgl:after::selection,
        .checkbox-wrapper-7 .tgl:before::selection,
        .checkbox-wrapper-7 .tgl *::selection,
        .checkbox-wrapper-7 .tgl *:after::selection,
        .checkbox-wrapper-7 .tgl *:before::selection,
        .checkbox-wrapper-7 .tgl+.tgl-btn::selection {
            background: none;
        }

        .checkbox-wrapper-7 .tgl+.tgl-btn {
            outline: 0;
            display: block;
            width: 40px;
            height: 20px;
            position: relative;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox-wrapper-7 .tgl+.tgl-btn:after,
        .checkbox-wrapper-7 .tgl+.tgl-btn:before {
            position: relative;
            display: block;
            content: "";
            width: 50%;
            height: 100%;
        }

        .checkbox-wrapper-7 .tgl+.tgl-btn:after {
            left: 0;
        }

        .checkbox-wrapper-7 .tgl+.tgl-btn:before {
            display: none;
        }

        .checkbox-wrapper-7 .tgl:checked+.tgl-btn:after {
            left: 50%;
        }

        .checkbox-wrapper-7 .tgl-ios+.tgl-btn {
            background: #fbfbfb;
            border-radius: 2em;
            padding: 2px;
            transition: all 0.4s ease;
            border: 1px solid #e8eae9;
        }

        .checkbox-wrapper-7 .tgl-ios+.tgl-btn:after {
            border-radius: 2em;
            background: #fbfbfb;
            transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
            box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1), 0 4px 0 rgba(0, 0, 0, 0.08);
        }

        .checkbox-wrapper-7 .tgl-ios+.tgl-btn:hover:after {
            will-change: padding;
        }

        .checkbox-wrapper-7 .tgl-ios+.tgl-btn:active {
            box-shadow: inset 0 0 0 2em #e8eae9;
        }

        .checkbox-wrapper-7 .tgl-ios+.tgl-btn:active:after {
            padding-right: 0.8em;
        }

        .checkbox-wrapper-7 .tgl-ios:checked+.tgl-btn {
            background: #886ab5;
        }

        .checkbox-wrapper-7 .tgl-ios:checked+.tgl-btn:active {
            box-shadow: none;
        }

        .checkbox-wrapper-7 .tgl-ios:checked+.tgl-btn:active:after {
            margin-left: -0.8em;
        }
        .custom-btn{
            background-color: #1ab3a3;
        }
    </style>

</head>

<?php
$data = [
    "items" => [
        [
            "id" => 1,
            "TransactionTitle" => "Test News 1",
            "TransactionType" => "1",
            "TransactionDate" => "2023-11-22 07:37:09",
            "TransactionDetail" => "detail 1",
            "IsActive" => 1,
            "IsApprove" => 1,
        ],
        [
            "id" => 2,
            "TransactionTitle" => "Test News 2",
            "TransactionType" => "1",
            "TransactionDate" => "2024-01-01 07:37:09",
            "TransactionDetail" => "detail 2",
            "IsActive" => 1,
            "IsApprove" => 1,
        ],
        [
            "id" => 3,
            "TransactionTitle" => "Test News 3",
            "TransactionType" => "0",
            "TransactionDate" => "2024-01-02 07:37:09",
            "TransactionDetail" => "detail 3",
            "IsActive" => 0,
            "IsApprove" => 1,
        ],
        [
            "id" => 4,
            "TransactionTitle" => "Test News 4",
            "TransactionType" => "1",
            "TransactionDate" => "2023-12-29 07:37:09",
            "TransactionDetail" => "detail 4",
            "IsActive" => 1,
            "IsApprove" => 1,
        ],
    ],
];

?>
 <script>
    var jsonData = @json($data);
    var items = jsonData.items; // Extracting the 'items' array
</script>

<body>

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายการข่าวสาร</li>
    </ol>

    <div class="row">
        <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
            <div class="panel panel-sortable" role="widget">
                <div class="panel-hdr" role="heading">
                    <h2 class="ui-sortable-handle"><i class="fa fa-users" aria-hidden="true" style="margin-right: 15px"></i>รายการข่าวสาร
                    </h2>
                </div>
                <div class="panel-container show" role="content">
                    <div class="panel-content">
                        <div id="JsonData">
                            <div id="JsonTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th>ชื่อเรื่อง</th>
                                                    <th class="text-center">ผู้รับข่าวสาร</th>
                                                    <th class="text-center">วันที่สร้างรายการ</th>
                                                    <th class="text-center">ประเภทข่าวสาร</th>
                                                    <th class="text-center">สถานะข่าวสาร</th>
                                                    <th class="text-center">จัดการข้อมูล</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $mainProjectNumber = 1;
                                                @endphp
                                                @foreach ($data['items'] as $get)
                                                    <tr class="text-center" style="vertical-align: middle;">
                                                        <td class="text-left">{{ $mainProjectNumber }}</td>
                                                        <td>{{ $get['TransactionTitle'] }}</td>
                                                        <td class="text-center">
                                                            @if($get['TransactionType'] == 1)
                                                                สารธารณะ
                                                            @else
                                                                <button class="btn custom-btn" title="Delete" data-id="{{ $get['id'] }}" style="width: 70% ; color: white">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i> ดูสมาชิก
                                                                </button>
                                                            @endif
                                                        </td>                                                        
                                                        <td>{{ \Carbon\Carbon::parse($get['TransactionDate'])->locale('th')->isoFormat('LL') }}</td>
                                                        <td class="text-center">
                                                            @if($get['TransactionType'] == 1)
                                                                สารธารณะ
                                                            @else
                                                                กลุ่ม
                                                            @endif
                                                        </td> 
                                                        <td class="text-center" style="width: 80px; vertical-align: middle;">
                                                            @if($get['IsActive'] == 1)
                                                                <i class="fa fa-check-circle-o" style="color: green; font-size: 1.5rem;"></i> <span style="color: green;">ใช้งาน</span>
                                                            @else
                                                                <i class="fa fa-times-circle-o" style="color: red; font-size: 1.5rem;"></i> <span style="color: red;">ไม่ใช้งาน</span>
                                                            @endif
                                                        </td>                                                        
                                                        <td class="text-center" style="">
                                                            <button class="btn" title="Delete" data-id="{{ $get['id'] }}" style="color: white ; background-color: #09d7f7"><i class="fa fa-eye" aria-hidden="true"></i> ดู </button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $mainProjectNumber++;
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

</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   function addToLocalStorage(event, value) {
        // Prevent the default link behavior (navigation)
        event.preventDefault();

        // Store the value in localStorage
        localStorage.setItem('AccId', value);

        // Navigate to the specified page
        window.location.href = event.target.getAttribute('href');
        }
    // jQuery(document).ready(function($) {
    //     $('select').select2(); 
    // });
    // $('.select2').select2();
    $(document).ready(function() {
        // Select2 initializationa
        

        // DataTable initialization
        $('#example').DataTable({
            responsive: true,
            // "columnDefs": [{
            //     "orderable": false,
            //     "targets": [0, 1, 2, 3, 4, 5, 6]
            // }],
            // "order": [],
            // "drawCallback": function(settings) {

            // }
        });

     
        
        // $('.select2').on('change', function() {
        $('#CurrentBudgetYear').on('change', function() {
            var BudgetYear = $(this).val();
            var formData = new FormData();
            formData.append('BudgetYear', BudgetYear);
            $.ajax({
                url: '/getAccountBudgetandSubAPI',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // if (response.api_status == 1) {
                    //     Swal.fire({
                    //         title: "สำเร็จ",
                    //         text: "เปลี่ยนข้อมูลสำเร็จ!",
                    //         icon: "success",
                    //         showCancelButton: false,
                    //         confirmButtonText: "OK",
                    //     }).then((result) => {
                    //         console.log(response);
                    //         // var dataTable = $('#example').DataTable();
                    //         // dataTable.clear().destroy();
                    //         updateTable(response.getAccountBudget, response.getAccountBudgetSub);
                    //     });
                    // }
                    updateTable(response.getAccountBudget, response.getAccountBudgetSub);
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
    });
</script>

@endsection