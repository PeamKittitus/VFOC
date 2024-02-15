@extends('crudbooster::admin_template')
@section("content")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
<div class="w-box" style="margin: auto !important; padding: 10px">
    <h4 style="text-align: center;color:black;font-family: 'Sarabun', sans-serif !important;">แก้ไขข้อมูลส่วนตัว</h4>
    <div class="row">
        <form id="editProfile" name="editProfile" method="post" enctype="multipart/form-data">
            <div class="col-12 col-sm-12 box-right">
                <div class="box-right-d">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>สังกัดภายใต้เขต</label>
                                <select name="SystemOrg" id="SystemOrg" style="width: 100%;">
                                    @foreach($getSystemOrg as $value)
                                    <option value="{{$value->id}}" @if($getDataUser->orgId == $value->id) selected @endif>{{$value->orgName}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>ชื่อ <span style="color:red">*</span></label>
                                <input type="text" class="form-control checkNumber" id="firstName" value="{{$getDataUser->firstName}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>นามสกุล <span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="lastName" value="{{$getDataUser->lastName}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>เลขบัตรประจำตัวประชาชน <span style="color:red">*</span></label>
                                <input type="text" class="form-control checkNumber" id="idCard" value="{{$getDataUser->idCard}}" maxlength="13">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>เบอร์โทร<span style="color:red">*</span></label>
                                <input type="text" class="form-control checkNumber" id="phoneNumber" value="{{$getDataUser->phoneNumber}}" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>อีเมล (e-mail)<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="email" value="{{$getDataUser->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>ชื่อบัญชีผู้ใช้งานระบบ<span style="color:red">*</span></label>
                                <input type="text" class="form-control" id="username" value="{{$getDataUser->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>รหัสผ่าน <span style="color:red">*</span></label>
                                <input type="password" class="form-control" id="Password">
                                <span style="color:gray ; font-size: 1rem">รหัสผ่านควรมีความยาวอย่างน้อย 6
                                    ตัวอักษร* (ตัวพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, อักขระพิเศษ) เช่น
                                    P@sswOrd*</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>ยืนยันรหัสผ่าน <span style="color:red">*</span></label>
                                <input type="password" class="form-control" id="ConfirmPassword">
                                <span style="color:gray ; font-size: 1rem">รหัสผ่านควรมีความยาวอย่างน้อย 6
                                    ตัวอักษร* (ตัวพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, อักขระพิเศษ) เช่น
                                    P@sswOrd*</span>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="cmsUserId" value="{{$getDataUser->cmsUserId}}">
                    </div>
                    <div class="row mt-1">
                        <div class="col-12">
                            <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                <a href="/admin" class="btn" style="color: white ; background-color:red">ยกเลิก</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(function() {
        $('#SystemOrg').select2();
        $('#SystemOrg').prop('disabled', true);
    });

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
    //=============NumberOnly
    $(".checkNumber").keypress(function() {
        var dInput = $(this).val();
        return bannedKey(dInput, 1);

    });

    //=============ValidIDCard
    function isValidThaiIDCard(idCard) {

        var idCardRegex = /^\d{13}$/;

        return idCardRegex.test(idCard);
    }
    //=============Email
    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        return emailRegex.test(email);
    }

    $("form[name=editProfile]").submit(function(event) {
        event.preventDefault();

        var cmsUserId = $('#cmsUserId').val();
        var firstName = $('#firstName').val();
        var lastName = $('#lastName').val();
        var phoneNumber = $('#phoneNumber').val();
        var username = $('#username').val();
        var Password = $('#Password').val();
        var ConfirmPassword = $('#ConfirmPassword').val();
        var passwordPolicyRegex = /^(?=.*[A-Z])(?=.*\d).+$/;
        var phoneNumberRegex = /^\d{10}$/;
        var idCard = $('#idCard').val();
        var email = $('#email').val();

        // Perform specific validations
        if (!isValidThaiIDCard(idCard)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Thai ID Card Format',
                text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            });
            return;
        }
        // Perform specific validations
        if (!isValidEmail(email)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email Format',
                text: 'Please enter a valid email address.'
            });
            return;
        }
        // Perform specific validations
        if (!phoneNumberRegex.test(phoneNumber)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Phone Number Format',
                text: 'Please enter a valid 10-digit phone number.'
            });
            return;
        }
        // Check if Password is provided
        if (Password) {
            // Check if password meets the policy
            if (!passwordPolicyRegex.test(Password)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Password Format',
                    text: 'Password must contain at least one uppercase letter and one digit.'
                });
                return;
            }

            // Check if ConfirmPassword is provided
            if (ConfirmPassword) {
                // Check if Password and ConfirmPassword match
                if (Password !== ConfirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords Do Not Match',
                        text: 'Please make sure the passwords match.'
                    });
                    return;
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Passwords Do Not Match',
                    text: 'Please make sure the passwords match.'
                });
                return;
            }
        }
        var formData = new FormData();

        formData.append('cmsUserId', cmsUserId);
        formData.append('idCard', idCard);
        formData.append('firstName', firstName);
        formData.append('lastName', lastName);
        formData.append('username', username);
        formData.append('phoneNumber', phoneNumber);
        formData.append('email', email);
        formData.append('password', Password);
        Swal.fire({
            title: "ยืนยัน",
            text: "คุณต้องการแก้ไขข้อมูลส่วนตัวใช่หรือไม่?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "ใช่",
            cancelButtonText: "ไม่",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/editProfile',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.api_status == 1) {
                            Swal.fire({
                                title: "สำเร็จ",
                                text: "แก้ข้อมูลสำเร็จ!",
                                icon: "success",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href =
                                        "/admin/user";
                                }
                            });
                        } else if (response.api_status == 2) {
                            Swal.fire({
                                title: "Error",
                                text: "ไม่สามารถใช้ email นี้ได้ เนื่องจากมี email นี้ในระบบแล้ว",
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            });
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: "An error occurred while saving the form data.",
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: "OK",
                            });
                        }

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
@endpush
@endsection