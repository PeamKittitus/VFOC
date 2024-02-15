<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ cbLang('page_title_login') }} : {{ Session::get('appname') }}</title>
    <meta name='generator' content='CRUDBooster' />
    <meta name='robots' content='noindex,nofollow' />
    <link rel="shortcut icon"
        href="{{ CRUDBooster::getSetting('favicon') ? asset(CRUDBooster::getSetting('favicon')) : asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet"
        type="text/css" />



    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
        <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
        <link href="{{ asset('vendor/crudbooster/assets/rtl.css') }}" rel="stylesheet" type="text/css" />
    @endif
    <!-- font kanit -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap');
    </style>
    <!-- end font kanit -->
    <link rel='stylesheet' href='{{ asset('vendor/crudbooster/assets/css/main.css') }}' />
    <style type="text/css">
        .register-page {

            /* background: {{ CRUDBooster::getSetting('login_background_color') ?: '#9ed8e1' }} url('{{ CRUDBooster::getSetting('login_background_image') ? asset(CRUDBooster::getSetting('login_background_image')) : asset('vendor/crudbooster/assets/bg_blur3.jpg') }}'); */
            color: {
                    {
                    CRUDBooster: :getSetting("login_font_color")?:'#ffffff'
                }
            }

            !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: #9ed8e1;
        }

        .login-box,
        .register-box {
            margin: 2% auto;
        }

        .login-box-body {
            /* box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8); */
            background: rgba(255, 255, 255, 0.9);

            color: {
                    {
                    CRUDBooster: :getSetting("login_font_color")?:'#666666'
                }
            }

            !important;
        }

        html,
        body {
            overflow-x: hidden;
            overflow-y: auto;
            font-family: 'Kanit', sans-serif !important;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .rounded-plus {
            border-radius: 10px;
        }

        .bg-faded {
            background-color: #f7f9fa;
        }

        .card,
        .card-group {
            -webkit-box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
            box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
        }

        .p-4 {
            padding: 1.5rem !important;
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 4px;
        }

        label {
            display: inline-block;
            /* margin-bottom: 0.6rem !important; */
            color: #212529 !important;
            font-size: 1.2rem !important;
            font-weight: 400 !important;
        }

        .btn-primary {
            background-color: #039dab;
            border-color: #039dab;
            color: #fff;
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.47em + 1rem + 2px);
            padding: 0.5rem 0.875rem;
            font-size: 0.8125rem;
            font-weight: 400;
            line-height: 1.47;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #E5E5E5;
            border-radius: 4px;
            -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        }

        .font {
            font-family: 'Kanit', sans-serif !important;

        }


    </style>
</head>

<body class="login-page">
    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient"
        style="background-color: #FFFFFF; position: relative;">
        <div class="container p-0">
            <div style="display: flex; align-items: center;">
                <div style="flex: 1;">
                    <a href="javascript:void(0)">
                        <img src="/img/messageImage_1660636852495.jpg" style="width: 271px; padding: 1.5rem;">
                    </a>
                </div>
                <a href="/admin/login" class="btn-link text-break btn btn-info hidden-sm-down"
                    style="background-color: #8dcde1; color: #000; margin-left: auto;">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
    <div class="flex-1 bg-pattern" style="background: #8dcde1">
        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="text-white text-center fw-300 mb-3 d-sm-block font"
                        style='color: white ; font-weight: 300 ; font-size: 3rem'>ลงทะเบียนใช้งานระบบ </h1>
                    <div class="card p-4 rounded-plus bg-faded">
                        <form id="register" name="register" method="post" enctype="multipart/form-data">

                            <div class="card-body pb-1">
                                <div class="section-title">
                                    <h3 class='font'><strong style="color:red ;font-weight: 400;">*
                                            กรุณากรอกข้อมูลให้ครบถ้วน</strong></h3>
                                </div>
                                <hr />
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="IDCard">เลขบัตรประจำตัวประชาชน <strong
                                                style="color:red">*</strong></label>
                                        <input type="text" class="form-control" maxlength="13" placeholder="ID card"
                                            id="IDCard">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="Firstname">ชื่อ <strong
                                                style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="First name"
                                            id="FirstName">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="Lastname">นามสกุล <strong
                                                style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="Last name"
                                            id="LastName">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>

                                <div class="section-title">
                                    <h3 class='font' style="color:red ; font-weight: 400;">ข้อมูลเข้าใช้งานระบบ</h3>
                                </div>
                                <hr />
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="UserName"> ชื่อใช้งาน <strong
                                                style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="User Name"
                                            id="Username" />
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="Email">อีเมล <strong
                                                style="color:red">*</strong></label>
                                        <input type="text" class="form-control" placeholder="E-mail"
                                            id="Email" />
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="Password">รหัสผ่าน <strong
                                                style="color:red">*</strong></label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            maxlength="12" id="Password">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        <span style="color:gray ; font-size:  1rem">รหัสผ่านควรมีความยาวอย่างน้อย 6
                                            ตัวอักษร* (ตัวพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, อักขระพิเศษ) เช่น
                                            P@sswOrd*</span>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label" for="ConfirmPassword">ยืนยันรหัสผ่าน <strong
                                                style="color:red">*</strong></label>
                                        <input type="password" class="form-control" placeholder="Confirm password"
                                            maxlength="12" id="ConfirmPassword">
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        <span style="color:gray ; font-size: 1rem">รหัสผ่านควรมีความยาวอย่างน้อย 6
                                            ตัวอักษร* (ตัวพิมพ์ใหญ่, พิมพ์เล็ก, ตัวเลข, อักขระพิเศษ) เช่น
                                            P@sswOrd*</span>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">กองทุนหมู่บ้าน สาขา <strong
                                                style="color:red">*</strong></label>
                                        <select class="form-control" id="OrgStructure" maxlength="12">
                                            <option value="0" readonly>----กองทุนหมู่บ้าน สาขา----</option>
                                        </select>
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">พื้นที่รับผิดชอบ <strong
                                                style="color:red">*</strong></label>
                                        <select class="form-control" id="OrgStructureProvince">
                                            <option value="0" readonly>----พื้นที่รับผิดชอบ----</option>
                                        </select>
                                        <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                    </div>
                                </div>
                                <div class="form-button-group  transparent">
                                    <button type="submit" class="btn btn-success btn-block btn-lg">
                                        <i class="fa fa-save" style='padding-right:10px'></i>ลงทะเบียน</button>
                                </div>

                            </div>
                            <div class="card-body pb-1">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.4.1 JS -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

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

            //=============Submit
            $("form[name=register]").submit(function(event) {
                event.preventDefault();

                // Get values from form fields
                var idCard = $('#IDCard').val();
                var firstName = $('#FirstName').val();
                var lastName = $('#LastName').val();
                var username = $('#Username').val();
                var email = $('#Email').val();
                var password = $('#Password').val();
                var confirmPassword = $('#ConfirmPassword').val();
                var passwordPolicyRegex = /^(?=.*[A-Z])(?=.*\d).+$/;
                var orgStructureProvince = $('#OrgStructureProvince').val();

                // Check for empty values
                if (idCard === '' || firstName === '' || lastName === '' || username === '' || email ===
                    '' || password === '' || confirmPassword === '' || orgStructureProvince === '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Empty Fields',
                        text: 'Please fill in all required fields.'
                    });
                    return;
                }

                // Perform specific validations
                if (!isValidThaiIDCard(idCard)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Thai ID Card Format',
                        text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
                    });
                    return;
                }

                if (!isValidEmail(email)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Email Format',
                        text: 'Please enter a valid email address.'
                    });
                    return;
                }

                // Check if password meets the policy
                if (!passwordPolicyRegex.test(password)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password Format',
                        text: 'Password must contain at least one uppercase letter and one digit.'
                    });
                    return;
                }

                if (password != confirmPassword) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Passwords Do Not Match',
                        text: 'Please make sure the passwords match.'
                    });
                    return;
                }

            var formData = new FormData();
            formData.append('idCard', idCard);
            formData.append('firstName', firstName);
            formData.append('lastName', lastName);
            formData.append('username', username);
            formData.append('email', email);
            formData.append('password', password);
            formData.append('orgStructureProvince', orgStructureProvince);
            $.ajax({
                url: '/saveRegister',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.api_status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'บันทึกข้อมูลเรียบร้อย'
                        }).then(function() {
                            window.location.href = '/admin/login';
                        });
                    } else if (data.api_status == 2) {
                        swal("ยกเลิก!", data.api_message, "error");
                    } else {
                        swal("ยกเลิก!", data.api_message, "error");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        });
    });
</script>