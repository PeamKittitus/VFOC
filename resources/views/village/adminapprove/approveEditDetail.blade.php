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
                                <label>รหัสกองทุน ( 8 หลัก)(เก่า)</label>
                                <input type="text" class="form-control checkNumber" placeholder="รหัสกองทุน" id="VillageCodeTextOld" disabled value="{{$getOldVillageDetail->VillageCodeText}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageCodeText != $getNewVillageDetail->VillageCodeText)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสกองทุน ( 8 หลัก)(ใหม่)</label>
                                <input type="text" class="form-control checkNumber" placeholder="รหัสกองทุน" id="VillageCodeTextNew" disabled value="{{$getNewVillageDetail->VillageCodeText}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสผู้เสียภาษี/เลขนิติบุคคล ( 13 หลัก)(เก่า) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขนิติบุคคล" id="VillageDbdOld" disabled value="{{$getOldVillageDetail->VillageDbd}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageDbd != $getNewVillageDetail->VillageDbd)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสผู้เสียภาษี/เลขนิติบุคคล ( 13 หลัก)(ใหม่) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขนิติบุคคล" id="VillageDbdNew" disabled value="{{$getNewVillageDetail->VillageDbd}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เลขทะเบียนใบนิติบุคคล(เก่า) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขทะเบียนใบนิติบุคคล" id="VillageBdbCodeOld" disabled value="{{$getOldVillageDetail->VillageBdbCode}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageBdbCode != $getNewVillageDetail->VillageBdbCode)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เลขทะเบียนใบนิติบุคคล(ใหม่) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เลขทะเบียนใบนิติบุคคล" id="VillageBdbCodeNew" disabled value="{{$getNewVillageDetail->VillageBdbCode}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ชื่อนิติบุคคล(เก่า) </label>
                                <input type="text" class="form-control" placeholder="ชื่อนิติบุคคล" id="VillageNameOld" disabled value="{{$getOldVillageDetail->VillageName}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageName != $getNewVillageDetail->VillageName)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ชื่อนิติบุคคล(ใหม่) </label>
                                <input type="text" class="form-control" placeholder="ชื่อนิติบุคคล" id="VillageNameNew" disabled value="{{$getNewVillageDetail->VillageName}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์(เก่า) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เบอร์โทรศัพท์" id="VillagePhoneOld" disabled value="{{$getOldVillageDetail->VillagePhone}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillagePhone != $getNewVillageDetail->VillagePhone)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์(ใหม่) </label>
                                <input type="text" class="form-control checkNumber" placeholder="เบอร์โทรศัพท์" id="VillagePhoneNew" disabled value="{{$getNewVillageDetail->VillagePhone}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>อีเมล (e-mail)(เก่า) </label>
                                <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="VillageEmailOld" disabled value="{{$getOldVillageDetail->VillageEmail}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageEmail != $getNewVillageDetail->VillageEmail)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>อีเมล (e-mail)(ใหม่) </label>
                                <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="VillageEmailNew" disabled value="{{$getNewVillageDetail->VillageEmail}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>วันที่จัดตั้ง(เก่า)</label>
                                <?php
                                $value = date('d F Y', strtotime($getOldVillageDetail->DbdDate));
                                $valueThai = str_replace(
                                    array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                    array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                    $value
                                );
                                $yearThai = intval(date('Y', strtotime($getOldVillageDetail->DbdDate))) + 543; // แปลงปีเป็น พ.ศ.
                                $valueThai = str_replace(date('Y', strtotime($getOldVillageDetail->DbdDate)), $yearThai, $valueThai);
                                ?>
                                <input type="text" class="form-control" placeholder="วันที่จัดตั้ง" id="VillageDbdDateOld" disabled value="{{$valueThai}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->DbdDate != $getNewVillageDetail->DbdDate)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>วันที่จัดตั้ง(ใหม่)</label>
                                <?php
                                $value = date('d F Y', strtotime($getNewVillageDetail->DbdDate));
                                $valueThai = str_replace(
                                    array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                    array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                    $value
                                );
                                $yearThai = intval(date('Y', strtotime($getNewVillageDetail->DbdDate))) + 543; // แปลงปีเป็น พ.ศ.
                                $valueThai = str_replace(date('Y', strtotime($getNewVillageDetail->DbdDate)), $yearThai, $valueThai);
                                ?>
                                <input type="text" class="form-control" placeholder="วันที่จัดตั้ง" id="VillageDbdDateNew" disabled value="{{$valueThai}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ที่อยู่นิติบุคคล(เก่า)</label>
                                <input type="text" class="form-control" placeholder="ที่อยู่นิติบุคคล" id="VillageAddressOld" disabled value="{{$getOldVillageDetail->VillageAddress}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageAddress != $getNewVillageDetail->VillageAddress)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ที่อยู่นิติบุคคล(ใหม่)</label>
                                <input type="text" class="form-control" placeholder="ที่อยู่นิติบุคคล" id="VillageAddressNew" disabled value="{{$getNewVillageDetail->VillageAddress}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>หมู่ที่(เก่า)</label>
                                <input type="text" class="form-control" placeholder="หมู่ที่" id="VillageMooOld" disabled value="{{$getOldVillageDetail->VillageMoo}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillageMoo != $getNewVillageDetail->VillageMoo)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>หมู่ที่(ใหม่)</label>
                                <input type="text" class="form-control" placeholder="หมู่ที่" id="VillageMooNew" disabled value="{{$getNewVillageDetail->VillageMoo}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>จังหวัด(เก่า)</label>
                                <input type="text" class="form-control" id="VillageProvinceIdOld" disabled value="{{$getOldVillageDetail->ProvinceName}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->ProvinceName != $getNewVillageDetail->ProvinceName)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>จังหวัด(ใหม่)</label>
                                <input type="text" class="form-control" id="VillageProvinceIdNew" disabled value="{{$getNewVillageDetail->ProvinceName}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>อำเภอ/เขต(เก่า)</label>
                                <input type="text" class="form-control" id="VillageDistrictIdOld" disabled value="{{$getOldVillageDetail->AmphuresName}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->AmphuresName != $getNewVillageDetail->AmphuresName)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>อำเภอ/เขต(ใหม่)</label>
                                <input type="text" class="form-control" id="VillageDistrictIdNew" disabled value="{{$getNewVillageDetail->AmphuresName}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ตำบล/แขวง(เก่า)</label>
                                <input type="text" class="form-control" id="VillageSubDistrictIdOld" disabled value="{{$getOldVillageDetail->TambonsName}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->TambonsName != $getNewVillageDetail->TambonsName)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ตำบล/แขวง(ใหม่)</label>
                                <input type="text" class="form-control" id="VillageSubDistrictIdNew" disabled value="{{$getNewVillageDetail->TambonsName}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ไปรษณีย์(เก่า)</label>
                                <input type="text" class="form-control" name="VillagePostCode" id="VillagePostCodeOld" disabled value="{{$getOldVillageDetail->VillagePostCode}}">
                            </div>
                        </div>
                        @if($getOldVillageDetail->VillagePostCode != $getNewVillageDetail->VillagePostCode)
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ไปรษณีย์(ใหม่)</label>
                                <input type="text" class="form-control" name="VillagePostCode" id="VillagePostCodeNew" disabled value="{{$getNewVillageDetail->VillagePostCode}}" style="background: beige;">
                            </div>
                        </div>
                        @endif
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
                                    @foreach($getNewVillageMemberDetail as $index => $value)
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
                                    @foreach($getNewVillageFile as $index => $file)
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
                                    @foreach($getNewVillageBank as $index => $val)
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
                                <form id="Approve" name="Approve" method="post" enctype="multipart/form-data">
                                    <button type="subnit" class="btn" style="color: white ; background-color:#1dc9b7">อนุมัติ</button>
                                </form>
                                <button id="openModalBtn" type="submit" class="btn" style="color: white ; background-color:red">ไม่อนุมัติ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="NotApprove" name="NotApprove" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">กรุณาระบุเหตุผลในการไม่อนุมัติ</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>เหตุผล</label>
                            <input type="text" class="form-control" id="VillageComment" placeholder="เหตุผล">

                        </div>
                        <div class="form-group">
                            <label>แนบไฟล์</label>
                            <input type="file" class="form-control" id="VillageCommentFile">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white ; background-color:red">ยกเลิก</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
<input type="hidden" id="Id" value="{{$getNewVillageDetail->id}}">
<input type="hidden" id="villageId" value="{{$getNewVillageDetail->VillageId}}">
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function() {
        //=============modal
        $("#openModalBtn").click(function() {
            $("#myModal").modal('show');
        });
        //=============approve
        $("form[name=Approve]").submit(function(event) {
            event.preventDefault();
            var Id = $('#Id').val();
            var villageId = $('#villageId').val();
            var ValueApprove = 1;
            var formData = new FormData();
            formData.append('Id', Id);
            formData.append('villageId', villageId);
            formData.append('ValueApprove', ValueApprove);
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการอนุมัติใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/approveEditVillage',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "บันทึกข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/village_new";
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
        //=============notapprove
        $("form[name=NotApprove]").submit(function(event) {
            event.preventDefault();
            var Id = $('#Id').val();
            var villageId = $('#villageId').val();
            var VillageComment = $('#VillageComment').val();
            var VillageCommentFile = $('#VillageCommentFile').val();
            var ValueApprove = 0;
            if (!(VillageComment)) {
                showError('Invalid VillageComment');
                return;
            }
            if (!(VillageCommentFile)) {
                showError('Invalid VillageCommentFile');
                return;
            }
            var formData = new FormData();
            formData.append('Id', Id);
            formData.append('villageId', villageId);
            formData.append('ValueApprove', ValueApprove);
            formData.append('VillageComment', VillageComment);
            formData.append(
                "VillageCommentFile[]",
                document.getElementById("VillageCommentFile").files[0]
            );
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณไม่ต้องการไม่อนุมัติใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/approveEditVillage',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "บันทึกข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/village_new";
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
        //=============Validate
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Input',
                text: message
            });
        }
    })
</script>
@endsection