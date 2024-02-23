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
    </style>
</head>

<body>

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">เบิกจ่ายงบประมาณโครงการ</li>
    </ol>

    <div class="d-flex justify-content-start flex-wrap demo" style="margin-bottom: 25px">
        <div class="btn-group" style="border: 1px solid grey; border-radius: 10px">
            <a href="/addtransectionBudget" class="btn btn-light waves-effect waves-themed" id="AddForm">
                <i class="fa fa-plus-circle" aria-hidden="true" style="font-size: 20px"></i><br>
                <span class="fs-nano color-primary-600">เบิกจ่ายโครงการ</span>
            </a>
        </div>
    </div>
    <div style="width: 100%">
        {{-- <div style="display: inline-block ; width: 30% ;margin-right: 30px" >
            <label for="">ปีงบประมาณ</label> <br>
            <select id="AccountBudgetId" class="select2" style="width: 100%">
                <option value="1">โครงการ 1</option>
                <option value="2">โครงการ 2</option>
                <option value="3">โครงการ 3</option>
                <option value="4">โครงการ 4</option>
            </select>
        </div> --}}
        <div style="display: inline-block ; width: 30%">
            <label for="">ปีงบประมาณ</label> <br>
            <select id="CurrentBudgetYear" class="select2" style="width: 100%">
                <option selected disabled>All</option>
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
        </div>
    </div>

    


    <div class="row">
        <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
            <div class="panel panel-sortable" role="widget">
                <div class="panel-hdr" role="heading">
                    <h2 class="ui-sortable-handle"><i class="subheader-icon fal fa-money-bill"></i>ชื่อแผนงาน/โครงการ
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
                                                    <th style="text-align: center">ลำดับ</th>
                                                    <th style="text-align: left">รายการ</th>
                                                    <th style="text-align: left">โครงการ</th>
                                                    <th style="text-align: left">ผู้รับโอน</th>
                                                    <th style="text-align: left">จำนวนเงิน</th>
                                                    <th style="text-align: left">เมื่อวันที่</th>
                                                    <th style="text-align: center">เอกสารแนบ</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                $mainProjectNumber = 1;
                                                @endphp
                                                @foreach ($result as $result)
                                                <tr>
                                                    <td class="text-center">{{ $mainProjectNumber }}.</td>
                                                    <td>{{ $result->Title }}</td>
                                                    <td>{{ $result->Sendername }}</td>
                                                    <td>{{ $result->VillageName }}</td>
                                                    <td class="text-left">{{ number_format($result->Amount, 2) }}</td>
                                                    <td class="text-left">{{ \Carbon\Carbon::parse($result->SenderDate)->toDateString() }}</td>
                                                    <td class="text-center">
                                                        <a href="{{asset($result->FilePath) }}" target="_blank" rel="noopener noreferrer">
                                                            <svg style="width:25px;height:25px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                                                                <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114m2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                                                <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                                            </svg>
                                                        </a>
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
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>

<script>

    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
    $(document).ready(function() {
        // DataTable initialization
        $('#example').DataTable({
            responsive: true,
            "columnDefs": [{
                "orderable": false,
                "targets": [0, 1, 2, 3, 4, 5, 6]
            }],
            "order": [],
            "drawCallback": function(settings) {

            }
        });
    });
      
</script>

@endsection