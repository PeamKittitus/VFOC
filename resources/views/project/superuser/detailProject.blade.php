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
        .text{
            display: block;
        }
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">{{$getVillageDetail->ProjectName}} ({{$getVillageDetail->ProjectCode}})</h4>
        <form id="addProjectBudget" name="addProjectBudget" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4 style="color: #049DAB;">ชื่อกองทุนหมู่บ้าน: {{$getVillageDetail->VillageName}} </h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p class="text"><b>งบประมาณ </b>: {{$getVillageDetail->Amount}} บาท</p>
                                    <p class="text"><b>ประจำปีงบประมาณ</b> : {{$getVillageDetail->TransactionYear}}</p>
                                    <p class="text"><b>ที่อยู่</b> : {{$getVillageDetail->VillageAddress}} ตำบล/{{$getVillageDetail->TambonsName}} อำเภอ/{{$getVillageDetail->AmphuresName}} จังหวัด{{$getVillageDetail->ProvinceName}} {{$getVillageDetail->VillagePostCode}}</p>
                                    <p class="text"><b>เบอร์โทร</b> : {{$getVillageDetail->VillagePhone}}</p>
                                    <p class="text"><b>อีเมล</b> : {{$getVillageDetail->VillageEmail}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>กิจกรรมในโครงการ</h4>
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
                                                <th style="text-align: center;">ประเภทกิจกรรม</th>
                                                <th style="text-align: center;">กิจกรรม/โครงการ</th>
                                                <th style="text-align: center;">วันที่เริ่มต้น</th>
                                                <th style="text-align: center;">วันที่สิ้นสุด</th>
                                                <th style="text-align: center;">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getProjectActivity as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center">{{$value->name}}</td>
                                                <td style="text-align:center">{{$value->ActivityDetail}}</td>
                                                <?php
                                                    $StartAt = date('d F Y', strtotime($value->StartActivityDate));
                                                    $StartAtThai = str_replace(
                                                        array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                        array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                        $StartAt
                                                    );
                                                    $yearThai = intval(date('Y', strtotime($value->StartActivityDate))) + 543; // แปลงปีเป็น พ.ศ.
                                                    $StartAtThai = str_replace(date('Y', strtotime($value->StartActivityDate)), $yearThai, $StartAtThai);

                                                    $EndAt = date('d F Y', strtotime($value->EndActivityDate));
                                                    $EndAtThai = str_replace(
                                                        array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                        array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                        $EndAt
                                                    );
                                                    $yearThai = intval(date('Y', strtotime($value->EndActivityDate))) + 543; // แปลงปีเป็น พ.ศ.
                                                    $EndAtThai = str_replace(date('Y', strtotime($value->EndActivityDate)), $yearThai, $EndAtThai);
                                                ?>
                                                <td style="text-align:center;">{{$StartAtThai}}</td>
                                                <td style="text-align:center">{{$EndAtThai}}</td>
                                                @if($value->Status == 1)
                                                    <td style="text-align:center">-</td>
                                                @elseif($value->Status == 2)
                                                    <td style="text-align:center">รอตรวจสอบ</td>
                                                @elseif($value->Status == 5)
                                                    <td style="text-align:center">อนุมัติ</td>
                                                @elseif($value->Status == 6)
                                                    <td style="text-align:center">ไม่อนุมัติ</td>
                                                @else
                                                    <td style="text-align:center">-</td>
                                                @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>สินทรัพย์</h4>
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
                                                <th style="text-align: center;">เลขที่สินทรัพย์</th>
                                                <th style="text-align: center;">ชื่อสินทรัพย์</th>
                                                <th style="text-align: center;">อายุสินทรัพย์ (ปี)</th>
                                                <th style="text-align: center;">จำนวนสินทรัพย์</th>
                                                <th style="text-align: center;">ราคาสุทธิ</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getProjectAsset as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center">{{$value->AssetCode}}</td>
                                                <td style="text-align:center;">{{$value->AssetName}}</td>
                                                <td style="text-align:center">{{$value->AssetAge}}</td>
                                                <td style="text-align:center">{{$value->Amount}}</td>
                                                <td style="text-align:center">{{$value->AmountUnit}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>เอกสารที่เกี่ยวข้อง</h4>
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
                                                <th style="text-align: center;">ชื่อเอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getProjectFile as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center"><a href="{{ asset($value->FilePath) }}" target="_blank">{{ $value->FileName }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <a href="/admin/projectBudget">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection