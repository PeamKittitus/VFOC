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



        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%"
            style="margin-top: 20px !important">
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
                        <td class="text-left">-</td>
                        <td class="text-left">-</td>
                    </tr>
                    @php
                        $subProjectNumber = 1; // Reset sub-project number for each main project
                    @endphp
                    @foreach ($getAccountBudgetSub as $get2)
                        @if ($get2->account_id == $get->id)
                            <tr>
                                <td class="text-center" style="text-align: center"> -
                                    {{ $mainProjectNumber }}.{{ $subProjectNumber }}</td>
                                <td style="text-align: center"> - {{ $get2->AccCode }}</td>
                                <td style="text-align: center"> - {{ $get2->AccName }}</td>
                                <td style="text-align: center">
                                    {{ \Carbon\Carbon::parse($get2->AccStartDate)->toDateString() }} -
                                    {{ \Carbon\Carbon::parse($get2->AccEndDate)->toDateString() }}</td>
                                <td class="text-right" style="text-align: center"> - {{ number_format($get2->Amount, 2) }}
                                </td>
                                <td class="text-right" style="text-align: center"> -
                                    {{ number_format($get2->SubAmount, 2) }}</td>
                                <td class="text-center">-</td>
                                <td class="text-center">-</td>
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



    </body>

    <script>
        jQuery(document).ready(function($) {
            $('.select2').select2();
        });
        // datatable custom sub td
        // $(document).ready(function() {
        //     var table = $('#example2').DataTable({
        //         "order": [
        //             [1, 'asc']
        //         ], 
        //     });
        // });
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [
                    [7, 'asc']
                ]
            });
        });
    </script>
@endsection
