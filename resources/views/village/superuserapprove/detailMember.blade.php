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
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">รายละเอียดหมู่บ้าน</h4>
        <div class="row">
            <div class="col-12 col-sm-12 box-right">
                <div class="box-right-d">
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสกองทุน ( 8 หลัก)</label>
                                <input type="text" class="form-control checkNumber" placeholder="รหัสกองทุน" id="VillageCodeText" disabled value="{{$getVillageDetail->VillageCodeText}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสผู้เสียภาษี/เลขนิติบุคคล ( 13 หลัก) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขนิติบุคคล" id="VillageDbd" disabled value="{{$getVillageDetail->VillageDbd}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เลขทะเบียนใบนิติบุคคล </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขทะเบียนใบนิติบุคคล" id="VillageBdbCode" disabled value="{{$getVillageDetail->VillageBdbCode}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ชื่อนิติบุคคล </label>
                                <input type="text" class="form-control" placeholder="ชื่อนิติบุคคล" id="VillageName" disabled value="{{$getVillageDetail->VillageName}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์ </label>
                                <input type="text" class="form-control checkNumber" placeholder="เบอร์โทรศัพท์" id="VillagePhone" disabled value="{{$getVillageDetail->VillagePhone}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>อีเมล (e-mail) </label>
                                <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="VillageEmail" disabled value="{{$getVillageDetail->VillageEmail}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>วันที่จัดตั้ง</label>
                                <?php
                                $value = date('d F Y', strtotime($getVillageDetail->DbdDate));
                                $valueThai = str_replace(
                                    array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                    array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                    $value
                                );
                                $yearThai = intval(date('Y', strtotime($getVillageDetail->DbdDate))) + 543; // แปลงปีเป็น พ.ศ.
                                $valueThai = str_replace(date('Y', strtotime($getVillageDetail->DbdDate)), $yearThai, $valueThai);
                                ?>
                                <input type="text" class="form-control" placeholder="วันที่จัดตั้ง" id="VillageDbdDate" disabled value="{{$valueThai}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ที่อยู่นิติบุคคล</label>
                                <input type="text" class="form-control" placeholder="ที่อยู่นิติบุคคล" id="VillageAddress" disabled value="{{$getVillageDetail->VillageAddress}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>หมู่ที่</label>
                                <input type="text" class="form-control" placeholder="หมู่ที่" id="VillageMoo" disabled value="{{$getVillageDetail->VillageMoo}}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>จังหวัด</label>
                                <input type="text" class="form-control" id="VillageProvinceId" disabled value="{{$getVillageDetail->ProvinceName}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>อำเภอ/เขต</label>
                                <input type="text" class="form-control" id="VillageDistrictId" disabled value="{{$getVillageDetail->AmphuresName}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ตำบล/แขวง</label>
                                <input type="text" class="form-control" id="VillageSubDistrictId" disabled value="{{$getVillageDetail->TambonsName}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>ไปรษณีย์</label>
                                <input type="text" class="form-control" name="VillagePostCode" id="VillagePostCode" disabled value="{{$getVillageDetail->VillagePostCode}}">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4>สมาชิกกองทุนหมู่บ้าน</h4>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;color:white">ลำดับ</th>
                                        <th style="text-align:center;color:white">รหัสสมาชิก</th>
                                        <th style="text-align:center;color:white">ชื่อ-นามสกุล</th>
                                        <th style="text-align:center;color:white">ตำแหน่ง</th>
                                        <th style="text-align:center;color:white">สถานะ</th>
                                        <th style="text-align:center;color:white">ระดับเครือข่าย</th>
                                        <th style="text-align:center;color:white">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                    @foreach($getVillageMemberDetail as $index => $value)
                                    <tr>
                                        <td style="text-align:center"><?= $index + 1 ?></td>
                                        <td style="text-align:center">{{$value->MemberCode}}</td>
                                        <td style="text-align:center;">{{$value->MemberFirstName}} {{$value->MemberLastName}}</td>
                                        <td style="text-align:center">{{$value->PositionName}}</td>
                                        <td style="text-align:center">{{$value->StatusName}}</td>
                                        <td style="text-align:center">{{$value->Connection}}</td>
                                        <td style="text-align:center">{{$value->MemberOffComment}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4>ไฟล์แนบ</h4>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;color:white">ลำดับ</th>
                                        <th style="text-align:center;color:white">ชื่อเอกสาร</th>
                                        <th style="text-align:center;color:white">วันที่อัพโหลด</th>
                                        <th style="text-align:center;color:white">เอกสารแนบ</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                    @foreach($getVillageFile as $index => $file)
                                    <tr>
                                        <td style="text-align:center">{{ $index + 1 }}</td>
                                        <td style="text-align:center">{{ $file->FileName }}</td>
                                        <td style="text-align:center;">
                                            <?php
                                            $createdAt = date('d F Y', strtotime($file->CreatedAt));
                                            $createdAtThai = str_replace(
                                                array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                                array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                                $createdAt
                                            );
                                            $yearThai = intval(date('Y', strtotime($file->CreatedAt))) + 543; // แปลงปีเป็น พ.ศ.
                                            $createdAtThai = str_replace(date('Y', strtotime($file->CreatedAt)), $yearThai, $createdAtThai);
                                            echo $createdAtThai;
                                            ?>
                                        </td>

                                        <td style="text-align:center;">
                                            <a href="{{asset($file->FilePath) }}" target="_blank" rel="noopener noreferrer">
                                                <svg style="width:25px;height:25px;color:#1dc9b7" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                                                    <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114m2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                                    <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-1">
                        <div class="col-12">
                            <h4>บัญชีธนาคารตั้งต้น</h4>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;color:white">ลำดับ</th>
                                        <th style="text-align:center;color:white">ชื่อบัญชี</th>
                                        <th style="text-align:center;color:white">ธนาคาร</th>
                                        <th style="text-align:center;color:white">เอกสารแนบ</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                    @foreach($getVillageBank as $index => $val)
                                    <tr>
                                        <td style="text-align:center">{{ $index + 1 }}</td>
                                        <td style="text-align:center">{{ $val->BookBankName }} ({{ $val->BookBankNumber }})</td>
                                        <td style="text-align:center">{{ $val->BankName }} ({{ $val->BankShortName }})</td>
                                        <td style="text-align:center;">
                                            <a href="{{asset($val->FilePath) }}" target="_blank" rel="noopener noreferrer">
                                                <svg style="width:25px;height:25px;color:#1dc9b7" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf-fill" viewBox="0 0 16 16">
                                                    <path d="M5.523 10.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647c-.119.025-.237.05-.356.078a21.035 21.035 0 0 0 .5-1.05 11.96 11.96 0 0 0 .51.858c-.217.032-.436.07-.654.114m2.525.939a3.888 3.888 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 4.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                                                    <path fill-rule="evenodd" d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m.165 11.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.64 11.64 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.707 19.707 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                <a href="/admin/memberVillage">
                                    <button class="btn" style="color: white ; background-color:red">ย้อนกลับ</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<input type="hidden" id="villageId" value="{{$getVillageDetail->id}}">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection