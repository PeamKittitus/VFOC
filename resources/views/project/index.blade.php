@extends('crudbooster::admin_template')
@section('content')

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
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

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
                <tr>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>john@example.com</td>
                    <td><button class='primary-button'>+</button></td>
                </tr>
            </tbody>
        </table>

    </body>

    <script>
        jQuery(document).ready(function($) {
            $('#example').DataTable({
                responsive: true,
                language: {
                // Customize the pagination information text
                info: "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว"
            }
            }); 
            $('.select2').select2();
        });
    </script>
@endsection
