<div class="page-inner bg-brand-gradient" style="background-color: #9ed8e1">
    <div class="page-content-wrapper bg-transparent m-0">
        <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient" style="background-color: #FFFFFF">
            <div class="d-flex align-items-center container p-0">
                <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                    <!---------href="/Identity/Account/Login?ReturnUrl=%2F"---------------------------------->
                    <a href="/Identity/Account/Login?ReturnUrl=%2F" class="page-logo-link press-scale-down d-flex align-items-center">
                        <img src="https://office.vfoconline.com/img/demo/villagefund_1.png" class="img-responsive" style="width:271px">
                    </a>
                </div>
                <!-- <a href="/Identity/Account/Login" class="btn-link text-break ml-auto btn btn-info hidden-sm-down" style="background-color: #8dcde1;color:#000">เข้าสู่ระบบ</a> -->
            </div>
        </div>
        <!---------style="background: url(/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover; "---------------------------------->
        <div class="flex-1">
            <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <h1 class="text-white text-center fw-300 mb-3 d-sm-block">ลงทะเบียนใช้งานระบบ </h1>
                        <div class="card p-4 rounded-plus bg-faded">
                            <form id="register" name="register" method="post" enctype="multipart/form-data">

                                <div class="card-body pb-1">
                                    <div class="section-title">
                                        <h3><strong style="color:red">* กรุณากรอกข้อมูลให้ครบถ้วน</strong></h3>
                                    </div>
                                    <hr />
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="IDCard">เลขบัตรประจำตัวประชาชน <strong style="color:red">*</strong></label>
                                            <input type="text" class="form-control" maxlength="13" placeholder="ID card" id="IDCard">
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="Firstname">ชื่อ <strong style="color:red">*</strong></label>
                                            <input type="text" class="form-control" placeholder="First name" id="FirstName">
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="Lastname">นามสกุล <strong style="color:red">*</strong></label>
                                            <input type="text" class="form-control" placeholder="Last name" id="LastName">
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>

                                    <div class="section-title">
                                        <h3 style="color:red">ข้อมูลเข้าใช้งานระบบ</h3>
                                    </div>
                                    <hr />
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="UserName"> ชื่อใช้งาน <strong style="color:red">*</strong></label>
                                            <input type="text" class="form-control" placeholder="User Name" id="Username" />
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="Email">อีเมล <strong style="color:red">*</strong></label>
                                            <input type="text" class="form-control" placeholder="E-mail" id="Email" />
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="Password">รหัสผ่าน <strong style="color:red">*</strong></label>
                                            <input type="password" class="form-control" placeholder="Password" maxlength="12" id="Password">
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label" for="ConfirmPassword">ยืนยันรหัสผ่าน <strong style="color:red">*</strong></label>
                                            <input type="password" class="form-control" placeholder="Confirm password" maxlength="12" id="ConfirmPassword">
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label">กองทุนหมู่บ้าน สาขา <strong style="color:red">*</strong></label>
                                            <select class="form-control" id="OrgStructure" maxlength="12">
                                                <option value="0" readonly>----กองทุนหมู่บ้าน สาขา----</option>
                                            </select>
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="label">พื้นที่รับผิดชอบ <strong style="color:red">*</strong></label>
                                            <select class="form-control" id="OrgStructureProvince">
                                                <option value="0" readonly>----พื้นที่รับผิดชอบ----</option>
                                            </select>
                                            <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                                        </div>
                                    </div>
                                    <div class="form-button-group  transparent">
                                        <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fal fa-save"></i> ลงทะเบียน</button>
                                    </div>
                                    <div class="col-lg-12 pr-lg-1 my-2 text-center">
                                        <a href="/Identity/Account/Login" class="hidden-sm-up"> เข้าสู่ระบบ</a>
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
    </div>
</div>
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
            if (idCard === '' || firstName === '' || lastName === '' || username === '' || email === '' || password === '' || confirmPassword === '' || orgStructureProvince === '') {
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
                            window.location.href = '/home';
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