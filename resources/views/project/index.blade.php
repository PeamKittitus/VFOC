@extends('crudbooster::admin_template')
@section('content')
@php
use Carbon\Carbon;
@endphp

<head>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">

    <!-- Include jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
            width: 200px !important;
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
    </style>
</head>

<body>

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">ข้อมูลพื้นฐาน</a></li>
        <li class="breadcrumb-item active">ชื่อแผนงาน/โครงการ</li>
    </ol>

    <div class="d-flex justify-content-start flex-wrap demo" style="margin-bottom: 25px">
        <div class="btn-group" style="border: 1px solid grey; border-radius: 10px">
            <a href="/addproject" class="btn btn-light waves-effect waves-themed" id="AddForm">
                <i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 20px"></i><br>
                <span class="fs-nano color-primary-600">สร้างใหม่</span>
            </a>
        </div>
    </div>

    <select id="CurrentBudgetYear" class="select2 select2-container2">
        <option value="2572">2572</option>
        <option value="2571">2571</option>
        <option value="2570">2570</option>
        <option value="2569">2569</option>
        <option value="2568">2568</option>
        <option value="2567">2567</option>
        <option value="2566">2566</option>
        <option value="2565">2565</option>
        <option value="2564">2564</option>
        <option value="2563">2563</option>
    </select>

    <div class="row">
        <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
            <div class="panel panel-sortable" role="widget">
                <div class="panel-hdr" role="heading">
                    <h2 class="ui-sortable-handle"><i class="subheader-icon fal fa-money-bill"></i>ชื่อแผนงาน/โครงการ</h2>
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
                                                    <th>ลำดับ</th>
                                                    <th>รหัสโครงการ</th>
                                                    <th>ชื่อบัญชีงบประมาณโครงการ</th>
                                                    <th>วันที่เริ่มต้น-สิ้นสุดโครงการ</th>
                                                    <th>วงเงินงบประมาณ (บาท)</th>
                                                    <th>งบประมาณของกองทุน (บาท)</th>
                                                    <th>สถานะโครงการ</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                $mainProjectNumber = 1;
                                                @endphp
                                                @foreach ($getAccountBudget as $get)
                                                <tr>
                                                    <td class="text-left">{{ $mainProjectNumber }}.</td>
                                                    <td>{{ $get->AccCode }}</td>
                                                    <td>{{ $get->AccName }}</td>
                                                    <td>-</td>
                                                    <td class="text-left">{{ number_format($get->Amount, 2) }}</td>
                                                    <td class="text-left">-</td>
                                                    <td class="text-center">
                                                        <div class="checkbox-wrapper-7" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                            <input class="tgl tgl-ios accdel" id="cb2-7-{{ $mainProjectNumber }}" type="checkbox" data-val="{{ $get->id }}" {{ $get->is_active == 1 ? 'checked' : '' }} />
                                                            <label class="tgl-btn" for="cb2-7-{{ $mainProjectNumber }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/addsubproject" class="btn btn-xs btn-success addParent" title="Create" onclick="addToLocalStorage(event, {{$get->id}})"><i class="fa fa-plus" aria-hidden="true" ></i> เพิ่มรายการ </a>
                                                        <a href="javascript:void(0);" data-parent="MAIN" data-val="10241" class="btn btn-xs btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i> แก้ไข </a>
                                                        <a href="javascript:void(0);" data-val="10241" class="btn btn-xs btn-danger  delete" title="Delete"><i class="fa fa-times" aria-hidden="true"></i> ลบ </a>
                                                    </td>
                                                </tr>
                                                @php
                                                $subProjectNumber = 1; // Reset sub-project number for each main project
                                                @endphp
                                                @foreach ($getAccountBudgetSub as $get2)
                                                @if ($get2->account_id == $get->id)
                                                <tr>
                                                    <td class="text-center" style="text-align: center"> -
                                                        {{ $mainProjectNumber }}.{{ $subProjectNumber }}
                                                    </td>
                                                    <td style="text-align: center"> - {{ $get2->AccCode }}</td>
                                                    <td style="text-align: center"> - {{ $get2->AccName }}</td>
                                                    <td style="text-align: center">
                                                        {{ \Carbon\Carbon::parse($get2->AccStartDate)->toDateString() }} -
                                                        {{ \Carbon\Carbon::parse($get2->AccEndDate)->toDateString() }}
                                                    </td>
                                                    <td class="text-right" style="text-align: center"> - {{ number_format($get2->Amount, 2) }}
                                                    </td>
                                                    <td class="text-right" style="text-align: center"> -
                                                        {{ number_format($get2->SubAmount, 2) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="checkbox-wrapper-7" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                            <input class="tgl tgl-ios subaccdel" id="cb2-7-{{ $mainProjectNumber }}-{{ $subProjectNumber }}" type="checkbox" data-val="{{ $get2->id }}" {{ $get2->is_active == 1 ? 'checked' : '' }} />
                                                            <label class="tgl-btn" for="cb2-7-{{ $mainProjectNumber }}-{{ $subProjectNumber }}"></label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center" style="">

                                                        <a href="javascript:void(0);" data-parent="PARENT" data-val="10242" class="btn btn-xs btn-warning edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i> แก้ไข </a>
                                                        <a href="javascript:void(0);" data-val="10242" class="btn btn-xs btn-danger  delete" title="Delete"><i class="fa fa-times" aria-hidden="true"></i> ลบ </a>

                                                    </td>
                                                </tr>
                                                @php
                                                $subProjectNumber++;
                                                @endphp
                                                @endif
                                                @endforeach
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
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
    function addToLocalStorage(event, value) {
        // Prevent the default link behavior (navigation)
        event.preventDefault();

        // Store the value in localStorage
        localStorage.setItem('AccId', value);

        // Navigate to the specified page
        window.location.href = event.target.getAttribute('href');
    }
    $(document).on('change', '.accdel', function() {
        var dataVal = $(this).data('val');
        var formData = new FormData();
        formData.append('AccId', dataVal);
        Swal.fire({
            title: "ยืนยัน",
            text: "คุณต้องการเปลี่ยนแปลงข้อมูลใช่หรือไม่?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "ใช่",
            cancelButtonText: "ไม่",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/subStatusAccountBudget',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.api_status == 1) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "เปลี่ยนข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/accountBudget";
                                }
                            });
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

    $(document).on('change', '.subaccdel', function() {
        var dataVal = $(this).data('val');
        var formData = new FormData();
        formData.append('AccSubId', dataVal);
        // for (var pair of formData.entries()) {
        //      console.log(pair[0]+ ', ' + pair[1]); 
        // }
        Swal.fire({
            title: "ยืนยัน",
            text: "คุณต้องการเปลี่ยนแปลงข้อมูลใช่หรือไม่?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "ใช่",
            cancelButtonText: "ไม่",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/subStatusSubAccountBudget',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.api_status == 1) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "เปลี่ยนข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/accountBudget";
                                }
                            });
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

    $(document).ready(function() {

        $('#example').DataTable({
            responsive: true,
            "columnDefs": [{
                    "orderable": false,
                    "targets": [0, 1, 2, 3, 4, 5, 6]
                } // Disable sorting for certain columns
            ],
            "order": [],
            "drawCallback": function(settings) {

            }
        });
    });
</script>

@endsection