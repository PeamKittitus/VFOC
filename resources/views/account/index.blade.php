@extends('crudbooster::admin_template')
@section('content')
@php
use Carbon\Carbon;
@endphp

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



    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%" style="margin-top: 20px !important">
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
            @foreach($getAccountBookBank as $value)
            <tr>
                <td><?= $index + 1 ?></td>
                <td>{{$value->BookBankName}}({{$value->BookBankNumber}})</td>
                <td>{{$value->BankName}}({{$value->BankShortName}})</td>
                <td>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                        <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114m2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                        <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                    </svg>
                </td>
                <td>
                    <div class="flex justify-content-evenly">
                        <a href="/editbookbank/{{$value->id}}">
                            <button type="button" class="btn btn-default btn-sm edit_icon">
                                <span class="glyphicon glyphicon-pencil">แก้ไข</span>
                            </button>
                        </a>
                        <button type="button" class="btn btn-default btn-sm edit_icon" data-id="{{$value->id}}">
                            <span class="glyphicon glyphicon-trash">ลบ</span>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>



</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [
                [7, 'asc']
            ]
        });
        $('.edit_icon').on('click', function() {

            var AccountBookBankId = $(this).data('id');
            var formData = new FormData();
            formData.append('AccountBookBankId', AccountBookBankId);
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
                        url: '/delBookBank',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "ลบข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/accountBookBank";
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
    });
</script>
@endsection