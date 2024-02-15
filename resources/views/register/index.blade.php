<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="description" content="Register" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="image/logo.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js
        "></script>
    <link href="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.min.css
        " rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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


        .box-right-d {
            padding: 5%;
        }

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
    <div>
        <div class="w-box" style="margin: auto !important; padding: 10px">
            <h4 style="text-align: center;color:white">ลงทะเบียนใช้งานระบบ</h4>
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <form id="register" name="register" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <h4 style="color: red;">* กรุณากรอกข้อมูลให้ครบถ้วน</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>เลขบัตรประจำตัวประชาชน<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" maxlength="13" placeholder="เลขบัตรประจำตัวประชาชน" id="IDCard">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ชื่อ (ภาษาไทย)<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="ชื่อ" id="FirstName">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>นามสกุล (ภาษาไทย)<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="นามสกุล" id="LastName">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <h4 style="color: red;">ข้อมูลเข้าใช้งานระบบ</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ชื่อผู้ใช้งาน (ภาษาอังกฤษ)<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" id="Username">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>อีเมล<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="อีเมล" id="UserEmail">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>กองทุนหมู่บ้าน สาขา<strong style="color:red">*</strong></label>
                                        <select class="form-control" id="OrgStructure">
                                            <option value="0" selected disabled>----กองทุนหมู่บ้าน สาขา----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>พื้นที่รับผิดชอบ<strong style="color:red">*</strong></label>
                                        <select class="form-control" id="OrgStructureProvince">
                                            <option value="0" disabled>----พื้นที่รับผิดชอบ----</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <h4 style="color: red;">ยื่นคำขอขึ้นทะเบียน</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>รหัสกองทุน ( 8 หลัก)<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" placeholder="รหัสกองทุน" id="VillageCodeText" maxlength="8">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>รหัสผู้เสียภาษี/เลขนิติบุคคล ( 13 หลัก) <strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" placeholder="เลขนิติบุคคล" id="VillageDbd" maxlength="13">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>เลขทะเบียนใบนิติบุคคล <strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" placeholder="เลขทะเบียนใบนิติบุคคล" id="VillageBdbCode">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>ชื่อนิติบุคคล <strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="ชื่อนิติบุคคล" id="VillageName">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>เบอร์โทรศัพท์ <strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" placeholder="เบอร์โทรศัพท์" id="VillagePhone">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>อีเมล (e-mail) <strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="เบอร์โทรศัพท์" id="VillageEmail">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>วันที่จัดตั้ง<strong style="color:red">*</strong></label>
                                        <input type="date" class="form-control" placeholder="วันที่จัดตั้ง" id="VillageDbdDate">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ที่อยู่นิติบุคคล<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="ที่อยู่นิติบุคคล" id="VillageAddress">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>หมู่ที่<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="หมู่ที่" id="VillageMoo">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>จังหวัด</label>
                                        <select class="form-control" name="VillageProvinceId" id="VillageProvinceId" data-id="VillageDistrictId">
                                            <option value="" disabled selected>กรุณาเลือกจังหวัด</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>อำเภอ/เขต</label>
                                        <select class="form-control" name="VillageDistrictId" id="VillageDistrictId" data-id="VillageSubDistrictId">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ตำบล/แขวง</label>
                                        <select class="form-control" name="VillageSubDistrictId" id="VillageSubDistrictId" data-id="VillagePostCode">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>ไปรษณีย์</label>
                                        <input type="text" class="form-control" name="VillagePostCode" id="VillagePostCode" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12" style="display: flex;justify-content:space-between">
                                    <h4 style="color: red;">บัญชีธนาคารตั้งต้น</h4>
                                    <p class="btn" style="color: white ; background-color:#1dc9b7" data-toggle="modal" data-target="#addBankModal"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มธนาคาร </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <table id="bankTable" class="table">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>ชื่อบัญชี</th>
                                                <th>หมายเลขบัญชี</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bankTableBody" style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12" style="display: flex;justify-content:space-between">
                                    <h4 style="color: red;">สมาชิกหมู่บ้าน</h4>
                                    <p class="btn" style="color: white ; background-color:#1dc9b7" data-toggle="modal" data-target="#addMemberVillage"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มสมาชิก </p>
                                </div>
                                <hr>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <table id="memberTable" class="table">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th>ชื่อ</th>
                                                <th>สกุล</th>
                                            </tr>
                                        </thead>
                                        <tbody id="memberTableBody" style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12" style="display: flex;justify-content:space-between">
                                    <h4 style="color: red;">เอกสารแนบ</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>เอกสารแนบ<strong style="color:red">(1.ระเบียบข้อบังคับ 2.แนบรูป ที่อยู่ ภูมิลำเนา ขนาดไฟล์ของเอกสารแนบรวมไม่เกิน 50MB/1ครั้ง )</strong></label>
                                        <input type="file" class="form-control" id="VillageFile">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-12">
                                    <div class="form-group" style="display: flex;justify-content:end;">
                                        <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7" ;>บันทึก</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" name="addBankModal" id="addBankModal" tabindex="-1" role="dialog" aria-labelledby="addBankModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBankModalLabel">เพิ่มธนาคาร</h5>
                </div>
                <div class="modal-body">
                    <form id="addBookBank" name="addBookBank" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>ธนาคาร</label>
                            <select class="form-control" id="BankMasterId">
                                <option value="0" disabled selected>----ธนาคาร----</option>
                            </select>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ชื่อบัญชี<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ชื่อบัญชี" id="BookBankName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>หมายเลขบัญชี<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="หมายเลขบัญชี" id="BookBankNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 1<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 1" id="WithdrawName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 2<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 2" id="WithdrawName2">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 3<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 3" id="WithdrawName3">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 4 (ถ้ามี)</label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 4 (ถ้ามี)" id="WithdrawName4">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 5 (ถ้ามี)</label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 5 (ถ้ามี)" id="WithdrawName5">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>แนบไฟล์หน้าสมุดบัญชี<strong style="color:red">*</strong></label>
                                    <input type="file" class="form-control" placeholder="แนบไฟล์หน้าสมุดบัญชี" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="mt-1" style="display: flex;justify-content:end;gap:1%">
                            <button type="submit" id="saveBookbankModal" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="addMemberVillage" tabindex="-1" role="dialog" aria-labelledby="addMemberVillageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBankModalLabel">สร้างสมาชิก</h5>
                </div>
                <div class="modal-body">
                    <form id="addMemberVillage" name="addMemberVillage" method="post" enctype="multipart/form-data">
                        <div class="row mt-1" style="display: none;">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>รหัสสมาชิก<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="รหัสสมาชิก" id="MemberCode">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="checkbox" id="NoCitizenId" name="NoCitizenId" value="0">
                                    <label>ไม่มีบัตรประชาชน</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>รหัสประจำตัวประชาชน<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="รหัสประจำตัวประชาชน" id="CitizenId">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ชื่อ<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ชื่อ" id="MemberFirstName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>นามสกุล<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="นามสกุล" id="MemberLastName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>เพศ</label>
                                    <select class="form-control" id="GenderId">
                                        <option value="0" disabled selected>----เพศ----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="checkbox" id="NoBirthDate" name="NoBirthDate" value="0">
                                    <label>ไม่มีระบุวันเกิด</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>วัน/เดือน/ปี เกิด<strong style="color:red">*</strong></label>
                                    <input type="date" class="form-control" placeholder="วัน/เดือน/ปี เกิด" id="MemberBirthDate">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>เบอร์โทรติดต่อ<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="เบอร์โทรติดต่อ" id="MemberPhone">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>อาชีพสมาชิก<strong style="color:red">*</strong></label>
                                    <select class="form-control" id="MemberOccupationId">
                                        <option value="0" disabled selected>----อาชีพสมาชิก----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ที่อยู่สมาชิก<strong style="color:red">*</strong></label>
                                    <input type="text" class="form-control" placeholder="ที่อยู่สมาชิก" id="MemberAddress">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>ตำแหน่ง<strong style="color:red">*</strong></label>
                                    <select class="form-control" id="MemberPositionId">
                                        <option value="0" disabled selected>----ตำแหน่ง----</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>สถานะสมาชิก<strong style="color:red">*</strong></label>
                                    <select class="form-control" id="MemberStatusId">
                                        <option value="0" disabled selected>----สถานะสมาชิก----</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>ระดับเครือข่าย<strong style="color:red">*</strong></label>
                                    <select class="form-control" id="Connection" name="Connection" multiple>
                                        <option value="ระดับตำบล">ระดับตำบล</option>
                                        <option value="ระดับอำเภอ">ระดับอำเภอ</option>
                                        <option value="ระดับจังหวัด">ระดับจังหวัด</option>
                                    </select>
                                    <input type="text" class="form-control mt-1" id="selectedValues" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mt-1" style="display: flex;justify-content:end;gap:1%">
                            <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-danger">ยกเลิก</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#VillageProvinceId').select2();
            $('#VillageDistrictId').select2();
            $('#VillageSubDistrictId').select2();
            $('#OrgStructure').select2();
            $('#OrgStructureProvince').select2();
            
            let dataArray = []; //store data
            let dataArrayMember = [];

            //=============Province
            $.ajax({
                url: '/getProvince',
                method: "GET",
                success: function(data) {
                    var dropdown = $('#VillageProvinceId');
                    dropdown.empty();
                    dropdown.append('<option value="" disabled selected>กรุณาเลือกจังหวัด</option>');
                    $.each(data, function(index, province) {
                        dropdown.append('<option value="' + province.id + '">' + province.name_th + '</option>');
                    });
                }
            });

            document.getElementById('VillageProvinceId').onchange = function() {
                var VillageProvinceId = this.value;
                var DataId = $(this).attr("data-id")
                var Data = {
                    'VillageProvinceId': VillageProvinceId
                };
                $.ajax({
                    url: '/getAmphuresById',
                    method: "POST",
                    data: Data,
                    success: function(data) {
                        if (data.api_status == 1) {
                            $("select[name^='" + DataId + "']").html('');
                            $("select[name^='" + DataId + "']").append('<option value="" selected>กรุณาเลือกอำเภอ/เขต</option>');

                            $.each(data.api_data, function(key, value) {
                                $("select[name^='" + DataId + "']").append('<option value="' + value.id + '">' + value.name_th + '</option>');
                            });
                        } else {
                            swal("ยกเลิก!", data.api_message, "error");
                        }
                    }
                });
            };
            document.getElementById('VillageDistrictId').onchange = function() {
                var VillageDistrictId = this.value;
                var DataId = $(this).attr("data-id")
                var Data = {
                    'VillageDistrictId': VillageDistrictId
                };
                $.ajax({
                    url: '/getTambonsById',
                    method: "POST",
                    data: Data,
                    success: function(data) {
                        if (data.api_status == 1) {
                            $("select[name^='" + DataId + "']").html('');
                            $("select[name^='" + DataId + "']").append('<option value="" selected>กรุณาเลือกอำเภอ/เขต</option>');

                            $.each(data.api_data, function(key, value) {
                                $("select[name^='" + DataId + "']").append('<option value="' + value.id + '">' + value.name_th + '</option>');
                            });
                        } else {
                            swal("ยกเลิก!", data.api_message, "error");
                        }
                    }
                });
            };

            document.getElementById('VillageSubDistrictId').onchange = function() {
                var VillageSubDistrictId = this.value;
                var DataId = $(this).attr("data-id")
                var Data = {
                    'VillageSubDistrictId': VillageSubDistrictId
                };
                $.ajax({
                    url: '/getZipCodeById',
                    method: "POST",
                    data: Data,
                    success: function(data) {
                        if (data.api_status == 1) {
                            $.each(data.api_data, function(key, value) {
                                $("#VillagePostCode").val(value.zip_code);
                            });
                        } else {
                            swal("ยกเลิก!", data.api_message, "error");
                        }
                    }
                });
            };

            //=============getGender
            $.ajax({
                url: '/getGenderApi',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#GenderId');
                        data.data.forEach(function(gender) {
                            var option = $('<option>', {
                                value: gender.id,
                                text: gender.GenderName
                            });
                            selectElement.append(option);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            //=============getMemberOccupationId
            $.ajax({
                url: '/getOccupationApi',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#MemberOccupationId');
                        data.data.forEach(function(occu) {
                            var option = $('<option>', {
                                value: occu.id,
                                text: occu.Name
                            });
                            selectElement.append(option);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            //=============getMemberStatus
            $.ajax({
                url: '/getMemberStatusApi',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#MemberStatusId');
                        data.data.forEach(function(status) {
                            var option = $('<option>', {
                                value: status.id,
                                text: status.StatusName
                            });
                            selectElement.append(option);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            //=============getMemberPositionId
            $.ajax({
                url: '/getMemberPositionApi',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#MemberPositionId');
                        data.data.forEach(function(position) {
                            var option = $('<option>', {
                                value: position.id,
                                text: position.PositionNameTh
                            });
                            selectElement.append(option);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            //=============getOrgStructure
            $.ajax({
                url: '/getOrgStructure',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#OrgStructure');
                        data.data.forEach(function(org) {
                            var option = $('<option>', {
                                value: org.id,
                                text: org.orgName
                            });
                            selectElement.append(option);
                        });

                        //onchange event
                        selectElement.on('change', handleOrgStructureChange);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            //=============getAccountBankMasterApi
            $.ajax({
                url: '/getAccountBankMasterApi',
                type: 'GET',
                success: function(data) {
                    if (data.api_status == 1) {
                        var selectElement = $('#BankMasterId');
                        data.data.forEach(function(value) {
                            var option = $('<option>', {
                                value: value.id,
                                text: value.BankName
                            });
                            selectElement.append(option);
                        });

                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });

            $('#Connection').change(function() {
                // Get selected values
                var selectedValues = $('#Connection').val();

                // Handle the case where only one option is selected
                if ($.isArray(selectedValues)) {
                    // Update the input field with selected values
                    $('#selectedValues').val(selectedValues.join(', '));
                } else {
                    // Update the input field with the single selected value
                    $('#selectedValues').val(selectedValues);
                }
            });

            //=============Onchange
            function handleOrgStructureChange() {
                var selectedValue = $('#OrgStructure').val();
                var formData = new FormData();
                formData.append('id', selectedValue);
                $.ajax({
                    url: '/getOrgStructureProvince',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.api_status == 1) {
                            var selectElement = $('#OrgStructureProvince');
                            selectElement.empty();
                            response.data.forEach(function(org) {
                                var option = $('<option>', {
                                    value: org.id,
                                    text: org.provinceName
                                });
                                selectElement.append(option);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

            //=============CheckKey
            function bannedKey(evt, lang) {
                var k = event.keyCode;
                if (lang == 1) {
                    if ((k >= 48 && k <= 57) || k == 46) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
            $(".checkNumber").keypress(function() {
                var dInput = $(this).val();
                return bannedKey(dInput, 1);
            });

            //=============addBookBank
            $("form[name=addBookBank]").submit(function(event) {
                event.preventDefault();

                var BankMasterId = $('#BankMasterId').val();
                if (!(BankMasterId)) {
                    showError('Invalid BankMasterId');
                    return;
                }

                var BookBankName = $('#BookBankName').val();
                if (!(BookBankName)) {
                    showError('Invalid BookBankName');
                    return;
                }

                var BookBankNumber = $('#BookBankNumber').val();
                if (!(BookBankNumber)) {
                    showError('Invalid BookBankNumber');
                    return;
                }

                var WithdrawName = $('#WithdrawName').val();
                if (!(WithdrawName)) {
                    showError('Invalid WithdrawName');
                    return;
                }

                var WithdrawName2 = $('#WithdrawName2').val();
                if (!(WithdrawName2)) {
                    showError('Invalid WithdrawName2');
                    return;
                }

                var WithdrawName3 = $('#WithdrawName3').val();
                if (!(WithdrawName3)) {
                    showError('Invalid WithdrawName3');
                    return;
                }

                var WithdrawName4 = $('#WithdrawName4').val();

                var WithdrawName5 = $('#WithdrawName5').val();
                var Files = document.getElementById("file").files[0]
                var dataObject = {
                    IdObject: generateUniqueId(),
                    BankMasterId: BankMasterId,
                    BookBankName: BookBankName,
                    BookBankNumber: BookBankNumber,
                    WithdrawName: WithdrawName,
                    WithdrawName2: WithdrawName2,
                    WithdrawName3: WithdrawName3,
                    WithdrawName4: WithdrawName4,
                    WithdrawName5: WithdrawName5,
                    Files: Files
                };
                // Add the object to the array
                dataArray.push(dataObject);
                populateTable(dataArray);
            });

            function populateTable(dataArray) {
                // Assuming the table body has an id 'bankTableBody'
                var tableBody = $('#bankTableBody');

                // Clear existing rows in the table
                tableBody.empty();

                // Iterate through dataArray and add rows to the table
                dataArray.forEach(function(dataObject) {
                    var row =
                        '<tr>' +
                        '<td>' + dataObject.BookBankName + '</td>' +
                        '<td>' + dataObject.BookBankNumber + '</td>' +
                        '</tr>';

                    tableBody.append(row);
                });
            }

            //GenId
            function generateUniqueId() {
                // Function to generate a unique ID
                return Math.floor(Math.random() * Date.now());
            }

            //=============Validate
            function showError(message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: message
                });
            }

            //=============toggle
            toggleCitizenIdInput();
            $('#NoCitizenId').change(function() {
                toggleCitizenIdInput();
            });

            function toggleCitizenIdInput() {
                // Get the checkbox state
                var isChecked = $('#NoCitizenId').prop('checked');

                // Enable or disable the input field based on the checkbox state
                $('#CitizenId').prop('disabled', isChecked);

                // Clear the input field if it's disabled
                if (isChecked) {
                    $('#CitizenId').val('');
                }
            }
            toggleBirthDateInput();
            $('#NoBirthDate').change(function() {
                toggleBirthDateInput();
            });

            function toggleBirthDateInput() {
                // Get the checkbox state
                var isChecked = $('#NoBirthDate').prop('checked');

                // Enable or disable the input field based on the checkbox state
                $('#MemberBirthDate').prop('disabled', isChecked);

                // Clear the input field if it's disabled
                if (isChecked) {
                    $('#MemberBirthDate').val('');
                }
            }

            var NoCitizenId = $('#NoCitizenId').val();
            $('#NoCitizenId').change(function() {
                NoCitizenId = $(this).is(':checked') ? 0 : 1;
            });
            var NoBirthDate = $('#NoBirthDate').val();
            $('#NoBirthDate').change(function() {
                NoBirthDate = $(this).is(':checked') ? 0 : 1;
            });

            //SubmitMember
            $("form[name=addMemberVillage]").submit(function(event) {
                event.preventDefault();
                var CitizenId = $('#CitizenId').val();
                var MemberFirstName = $('#MemberFirstName').val();
                var MemberLastName = $('#MemberLastName').val();
                var GenderId = $('#GenderId').val();

                var MemberBirthDate = $('#MemberBirthDate').val();
                var MemberPhone = $('#MemberPhone').val();
                var MemberOccupationId = $('#MemberOccupationId').val();
                var MemberAddress = $('#MemberAddress').val();
                var MemberPositionId = $('#MemberPositionId').val();
                var MemberStatusId = $('#MemberStatusId').val();
                var Connection = $('#selectedValues').val();

                var dataObject = {
                    NoCitizenId: NoCitizenId,
                    CitizenId: CitizenId,
                    MemberFirstName: MemberFirstName,
                    MemberLastName: MemberLastName,
                    GenderId: GenderId,
                    NoBirthDate: NoBirthDate,
                    MemberBirthDate: MemberBirthDate,
                    MemberPhone: MemberPhone,
                    MemberOccupationId: MemberOccupationId,
                    MemberAddress: MemberAddress,
                    MemberPositionId: MemberPositionId,
                    MemberStatusId: MemberStatusId,
                    Connection: Connection,
                };
                // Add the object to the array
                dataArrayMember.push(dataObject);
                populateTableMember(dataArrayMember);
            });

            function populateTableMember(dataArrayMember) {
                // Assuming the table body has an id 'bankTableBody'
                var tableBody = $('#memberTableBody');

                // Clear existing rows in the table
                tableBody.empty();

                // Iterate through dataArray and add rows to the table
                dataArrayMember.forEach(function(dataObject) {
                    var row =
                        '<tr>' +
                        '<td>' + dataObject.MemberFirstName + '</td>' +
                        '<td>' + dataObject.MemberLastName + '</td>' +
                        '</tr>';

                    tableBody.append(row);
                });
            }

            //SubmitRegister
            $("form[name=register]").submit(function(event) {
                event.preventDefault();

                var ArrayBookbank = dataArray;
                var ArrayMember = dataArrayMember;
                var IDCard = $('#IDCard').val();
                var FirstName = $('#FirstName').val();
                var LastName = $('#LastName').val();
                var Username = $('#Username').val();
                var UserEmail = $('#UserEmail').val();
                var OrgStructure = $('#OrgStructure').val();
                var OrgStructureProvince = $('#OrgStructureProvince').val();
                var VillageCodeText = $('#VillageCodeText').val();
                var VillageDbd = $('#VillageDbd').val();
                var VillageBdbCode = $('#VillageBdbCode').val();
                var VillageName = $('#VillageName').val();
                var VillagePhone = $('#VillagePhone').val();
                var VillageEmail = $('#VillageEmail').val();
                var VillageDbdDate = $('#VillageDbdDate').val();
                var VillageAddress = $('#VillageAddress').val();
                var VillageMoo = $('#VillageMoo').val();
                var VillageProvinceId = $('#VillageProvinceId').val();
                var VillageDistrictId = $('#VillageDistrictId').val();
                var VillageSubDistrictId = $('#VillageSubDistrictId').val();
                var VillagePostCode = $('#VillagePostCode').val();
                
                var formData = new FormData();

                formData.append('IDCard', IDCard);
                formData.append('FirstName', FirstName);
                formData.append('LastName', LastName);
                formData.append('Username', Username);
                formData.append('UserEmail', UserEmail);
                formData.append('OrgStructure', OrgStructure);
                formData.append('OrgStructureProvince', OrgStructureProvince);
                formData.append('VillageCodeText', VillageCodeText);
                formData.append('VillageDbd', VillageDbd);
                formData.append('VillageBdbCode', VillageBdbCode);
                formData.append('VillageName', VillageName);
                formData.append('VillagePhone', VillagePhone);
                formData.append('VillageEmail', VillageEmail);
                formData.append('VillageDbdDate', VillageDbdDate);
                formData.append('VillageAddress', VillageAddress);
                formData.append('VillageMoo', VillageMoo);
                formData.append('VillageProvinceId', VillageProvinceId);
                formData.append('VillageDistrictId', VillageDistrictId);
                formData.append('VillageSubDistrictId', VillageSubDistrictId);
                formData.append('VillagePostCode', VillagePostCode);

                formData.append(
                    "VillageFile[]",
                    document.getElementById("VillageFile").files[0]
                );
                $.each(ArrayBookbank, function(i, value) {
                    formData.append("ArrayBookbank[]", JSON.stringify(value));
                });
                $.each(ArrayMember, function(i, val) {
                    formData.append("ArrayMember[]", JSON.stringify(val));
                });

                Swal.fire({
                    title: "ยืนยัน",
                    text: "คุณต้องการเพิ่มข้อมูลใช่หรือไม่?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ไม่",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/saveRegisterVillageAll',
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
</body>

</html>