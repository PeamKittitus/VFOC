@extends('crudbooster::admin_template')
@section('content')

<head>
    <!-- Include DataTables CSS -->

    <!-- Include DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

    <!-- Include jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Include DataTables JS -->

    <!-- DataTable -->


    <!-- Include Kanit font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
</head>
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

    .custom-btn {
        background-color: #1ab3a3;
    }

    div.dataTables_filter label {
        display: none;
    }

    .dt-buttons {
        position: fixed;
        left: 90%;
    }
</style>
{{-- <?php
        $jsonData = [
            [
                "id" => 1,
                "year" => 2566,
                "month" => "มกราคม",
                "Waitapprove" => 20,
                "Approve" => 1,
                "AmountNews" => 25,
            ],
            [
                "id" => 1,
                "year" => 2566,
                "month" => "กุมภา",
                "Waitapprove" => 20,
                "Approve" => 1,
                "AmountNews" => 25,
            ], [
                "id" => 1,
                "year" => 2566,
                "month" => "มีนา",
                "Waitapprove" => 20,
                "Approve" => 1,
                "AmountNews" => 25,
            ], [
                "id" => 1,
                "year" => 2566,
                "month" => "เมษา",
                "Waitapprove" => 20,
                "Approve" => 1,
                "AmountNews" => 25,
            ],
        ];
        ?> --}}

<body>

    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
        <li class="breadcrumb-item active">รายงานสรุปจำนวนข่าวสารรออนุมัติ/อนุมัติ แยกรายเดือน</li>
    </ol>
    <div class="row">
        <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
            <div class="panel panel-sortable" role="widget">
                <div class="panel-hdr" role="heading">
                    <h2 class="ui-sortable-handle"><i class="fa fa-users" aria-hidden="true" style="margin-right: 15px"></i>รายงานสรุปจำนวนข่าวสารรออนุมัติ/อนุมัติ แยกรายเดือน
                    </h2>
                </div>
                <div class="panel-container show" role="content">
                    <div class="panel-content">
                        <div id="JsonData">
                            <div id="JsonTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <select id="CurrentBudgetYear" class="select2 select2-container2">
                                            {!! $generateYearOptions !!}
                                        </select>
                                    </div>
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ลำดับ</th>
                                                    <th class="text-center">ปี</th>
                                                    <th class="text-center">เดือน</th>
                                                    <th class="text-center">รออนุมัติ</th>
                                                    <th class="text-center">ร้อยละ</th>
                                                    <th class="text-center">อนุมัติ</th>
                                                    <th class="text-center">ร้อยละ</th>
                                                    <th class="text-center">ข่าวสารทั้งหมด</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $No = 1;
                                                @endphp
                                                @foreach ($ReportApproveNewsByMonth as $index => $rp)
                                                <tr>
                                                    <td class="text-center">{{ $No++ }}.</td>
                                                    <td class="text-center">{{ $rp->TransactionYear }}</td>
                                                    <td class="text-center">{{ $rp->Month }}</td>
                                                    <td class="text-center">{{ $rp->AmountWait }}</td>
                                                    <td class="text-center">
                                                        @if ($rp->AmountNews > 0)
                                                        {{ number_format(($rp->AmountWait * 100 / $rp->AmountNews), 2) }}
                                                        @else
                                                        0%
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $rp->AmountApprove }}</td>
                                                    <td class="text-center">
                                                        @if ($rp->AmountNews > 0)
                                                        {{ number_format(($rp->AmountApprove * 100 / $rp->AmountNews), 2) }}
                                                        @else
                                                        0%
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $rp->AmountNews }}</td>
                                                </tr>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    pdfMake.fonts = {
        THSarabun: {
            normal: 'THSarabun.ttf',
            bold: 'THSarabun-Bold.ttf',
            italics: 'THSarabun-Italic.ttf',
            bolditalics: 'THSarabun-BoldItalic.ttf'
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            pageLength: 12,
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp;EXCEL',
                    titleAttr: 'Excel',
                    autoFilter: true,
                    footer: false,
                    attr: {
                        class: 'btn btn-success btn-sm mr-1'
                    }
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;&nbsp;PDF',
                    pageSize: 'A4',
                    footer: true,
                    attr: {
                        class: 'btn btn-danger btn-sm mr-1'
                    }
                }
            ]
        });
        $('.dt-buttons').css('margin-bottom', '20px');

        //==================CurrentBudgetYear Add onchange event
        $('#CurrentBudgetYear').on('change', function() {
            var TransactionYear = $(this).val();
            var formData = new FormData();
            formData.append('TransactionYear', TransactionYear);

            $.ajax({
                url: '/getTransactionNewsReportApproveNewsByMonth',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var tableBody = $('#example tbody');
                    tableBody.empty(); // Clear

                    // Loop through the response data
                    $.each(response, function(index, rp) {
                        var newRow = '<tr>' +
                            '<td class="text-center">' + (index + 1) + '.</td>' +
                            '<td class="text-center">' + rp.TransactionYear + '</td>' +
                            '<td class="text-center">' + rp.Month + '</td>' +
                            '<td class="text-center">' + rp.AmountWait + '</td>' +
                            '<td class="text-center">';

                        // Add the condition for AmountNews
                        if (rp.AmountNews > 0) {
                            newRow += (rp.AmountWait * 100 / rp.AmountNews).toFixed(2) + '%';
                        } else {
                            newRow += '0%';
                        }

                        // Continue building the newRow
                        newRow += '</td>' +
                            '<td class="text-center">' + rp.AmountApprove + '</td>' +
                            '<td class="text-center">';

                        // Add the condition for AmountNews in the second percentage
                        if (rp.AmountNews > 0) {
                            newRow += (rp.AmountApprove * 100 / rp.AmountNews).toFixed(2) + '%';
                        } else {
                            newRow += '0%';
                        }

                        // Continue building the newRow
                        newRow += '</td>' +
                            '<td class="text-center">' + rp.AmountNews + '</td>' +
                            '</tr>';

                        // Append the newRow to the table
                        tableBody.append(newRow);
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


        });
    });
</script>
@endsection