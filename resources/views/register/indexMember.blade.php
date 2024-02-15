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
                        <form id="SunmitMember" name="SunmitMember" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <h4 style="color: red;">* กรุณากรอกข้อมูลให้ครบถ้วน</h4>
                                </div>
                                <hr>
                            </div>
                            <div class="row ">
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
                                    <div class="form-group">
                                        <label>กองทุนหมู่บ้าน<strong style="color:red">*</strong></label>
                                        <select class="form-control" id="Village">
                                            <option value="0" selected disabled>----กองทุนหมู่บ้าน----</option>
                                        </select>
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
                                        <label>เลขบัตรประจำตัวประชาชน<strong style="color:red">*</strong></label>
                                        <input type="text" class="form-control checkNumber" maxlength="13" placeholder="เลขบัตรประจำตัวประชาชน" id="CitizenId">
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
            $('#OrgStructure').select2();
            $('#OrgStructureProvince').select2();
            $('#Village').select2();
            $('#GenderId').select2();
            $('#MemberOccupationId').select2();
            $('#MemberStatusId').select2();
            $('#MemberPositionId').select2();

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

            //DumpConnection
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

                            //onchange event
                            selectElement.on('change', handleOrgStructureProvinceChange);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }
            //=============Onchange
            function handleOrgStructureProvinceChange() {
                var selectedValue = $('#OrgStructureProvince').val();
                var formData = new FormData();
                formData.append('id', selectedValue);
                $.ajax({
                    url: '/getVillageByIdProvince',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.api_status == 1) {
                            var selectElement = $('#Village');
                            selectElement.empty();
                            response.data.forEach(function(v) {
                                var option = $('<option>', {
                                    value: v.id,
                                    text: v.VillageName
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
            //=========SunmitMember
            $("form[name=SunmitMember]").submit(function(event) {
                event.preventDefault();

                var OrgStructure = $('#OrgStructure').val();
                var OrgStructureProvince = $('#OrgStructureProvince').val();
                var Village = $('#Village').val();
                var NoCitizenId = $('#NoCitizenId').val();
                var CitizenId = $('#CitizenId').val();
                var FirstName = $('#FirstName').val();
                var LastName = $('#LastName').val();
                var GenderId = $('#GenderId').val();
                var NoBirthDate = $('#NoBirthDate').val();
                var MemberBirthDate = $('#MemberBirthDate').val();
                var MemberPhone = $('#MemberPhone').val();
                var MemberOccupationId = $('#MemberOccupationId').val();
                var MemberAddress = $('#MemberAddress').val();
                var MemberPositionId = $('#MemberPositionId').val();
                var MemberStatusId = $('#MemberStatusId').val();
                var Connection = $('#selectedValues').val();
                var Username = $('#Username').val();
                var UserEmail = $('#UserEmail').val();

                var formData = new FormData();

                formData.append('OrgStructure', OrgStructure);
                formData.append('OrgStructureProvince', OrgStructureProvince);
                formData.append('Village', Village);
                formData.append('NoCitizenId', NoCitizenId);
                formData.append('CitizenId', CitizenId);
                formData.append('FirstName', FirstName);
                formData.append('LastName', LastName);
                formData.append('GenderId', GenderId);
                formData.append('NoBirthDate', NoBirthDate);
                formData.append('MemberBirthDate', MemberBirthDate);
                formData.append('MemberPhone', MemberPhone);
                formData.append('MemberOccupationId', MemberOccupationId);
                formData.append('MemberAddress', MemberAddress);
                formData.append('MemberPositionId', MemberPositionId);
                formData.append('MemberStatusId', MemberStatusId);
                formData.append('Connection', Connection);
                formData.append('Username', Username);
                formData.append('UserEmail', UserEmail);
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
                            url: '/saveRegisterVillageMember',
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
                                            "/admin/login";
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
        </script>
</body>

</html>