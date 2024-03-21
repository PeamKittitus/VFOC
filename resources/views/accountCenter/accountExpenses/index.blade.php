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
    </style>
</head>

<body>
    <div class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/home">หน้าหลัก</a></li>
            <li class="breadcrumb-item active">เบิกจ่ายงบประมาณ</li>
        </ol>

        <div class="row">
            <div class="col-lg-12 sortable-grid ui-sortable" style="padding: 10px;">
                <div class="panel panel-sortable" role="widget">
                    <div class="panel-hdr" role="heading">
                        <h2 class="ui-sortable-handle"><i class="subheader-icon fal fa-money-bill"></i> เบิกจ่ายงบประมาณ</h2>
                    </div>
                    <div class="row" style="margin-top:10px">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <a href="/addAccountExpenses">
                                    <button type="button" class="btn" style="color: white ; background-color:#1dc9b7">เบิกจ่าย</button>
                                </a>
                            </div>
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
                                                        <th class="center">ชื่อยุทธศาสตร์/แผนงาน/โครงการ</th>
                                                        <!-- <th class="center">ฝ่าย</th> -->
                                                        <th class="center">กรอบวงเงินงบประมาณ (บาท)</th>
                                                        <th class="center">ยอดใช้จ่ายตามจริง (บาท)</th>
                                                        <th class="center">คงเหลือ (บาท)</th>
                                                        <th class="center">วันที่ทำรายการ</th>
                                                        <th class="center">สถานะ</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $counter = 1;
                                                    @endphp
                                                    @foreach ($getTransactionAccountBudgetCenterSub as $Tran)
                                                    <tr>
                                                        <td style="text-align:center">{{$counter}}</td>
                                                        <td style="text-align:center">{{$Tran->AccName}}</td>
                                                        <!-- <td style="text-align:center">{{$Tran->DivisionName}}</td> -->
                                                        <td style="text-align:center">{{ number_format($Tran->RealAmount, 2) }}</td>
                                                        <td style="text-align:center">{{ number_format($Tran->Amount, 2) }}</td>
                                                        <td style="text-align:center">{{ number_format($Tran->TotalAmount, 2) }}</td>
                                                        <?php
                                                        $StartAt = date('d F Y', strtotime($Tran->CreatedAt));
                                                        $StartAtThai = str_replace(
                                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                            array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                            $StartAt
                                                        );
                                                        $yearThai = intval(date('Y', strtotime($Tran->CreatedAt))) + 543; // แปลงปีเป็น พ.ศ.
                                                        $StartAtThai = str_replace(date('Y', strtotime($Tran->CreatedAt)), $yearThai, $StartAtThai);
                                                        ?>
                                                        <td style="text-align:center">{{$StartAtThai}}</td>
                                                        <td style="text-align:center">
                                                            <?php if ($Tran->Status == 1) : ?>
                                                                <span style="color: orange">กำลังดำเนินการ</span>
                                                            <?php else : ?>
                                                                <span style="color: #449d44">เสร็จสิ้น</span>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $counter++;
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




</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    jQuery(document).ready(function($) {
        $('.select2').select2();
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
    });
</script>
@endsection