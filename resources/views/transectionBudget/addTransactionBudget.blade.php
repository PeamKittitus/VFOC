@extends('crudbooster::admin_template')
@section('content')

    <head>
        <!-- Include Kanit font from Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.0/css/font-awesome.min.css">

        <!-- DataTables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <!-- Select2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <style>
            body {
                font-family: 'Kanit', sans-serif;
            }

            #example thead th {
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

            .select2-container2 {
                box-sizing: border-box;
                display: inline-block;
                margin: 0;
                position: relative;
                vertical-align: middle;
                width: 100% !important;
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
                height: 50px;
                /* height: calc(1.47em + 1rem + 2px); */
                /* padding: 0.5rem 0.875rem; */
                /* font-size: 0.8125rem; */
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

            label {
                font-size: 20px !important;
                margin-left: 0px !important;
                margin-bottom: 5px !important;
            }

            input::placeholder,
            input {
                font-size: 14px;
                color: #333;
            }

            select {
                width: 100%
            }

            input {
                width: 100%
            }

            label {
                font-size: 14px !important;
                margin-left: -10px;
                margin-bottom: 5px !important;
            }
        </style>
    </head>

    <body>

        <div>
            <ol class="breadcrumb page-breadcrumb">
                <li class="breadcrumb-item"><a href="/Home/Index">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="admin/TransacionAccountBudget">เบิกจ่ายงบประมาณ</a></li>
                <li class="breadcrumb-item active">เบิกจ่าย</li>
            </ol>
        </div>


        <div class="flex-1 bg-pattern" style="background: #8dcde1">
            <div class="card p-4 rounded-plus bg-faded">
                <form id="addaccountbudget" name="addaccountbudget" method="post" enctype="multipart/form-data">

                    <div class="card-body pb-1">
                        <div class="section-title">
                            <h4 class='font'><strong style="font-weight: 400;"><i class="fa fa-file-text-o"
                                        aria-hidden="true" style='margin-right: 10px'></i>เบิกจ่าย</strong></h4>
                        </div>
                        <hr />

                        <div class="panel-content">
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <div class="col-lg-8">
                                    <form id="addtransectionBudget" enctype="multipart/form-data" novalidate="novalidate"
                                        data-bv-message="This value is not valid"
                                        data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                                        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                                        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh"
                                        action="/EAccount/FormAddTransaction?BudgetYear=0" method="post" class="bv-form">
                                        <button type="submit" class="bv-hidden-submit"
                                            style="display: none; width: 0px; height: 0px;" disabled="disabled"></button>
                                        <div class="panel-content">
                                            <div class="col-lg-12">
                                                <label style="color:red !important;font-size:1.2rem"> หน่วยงานต้นทาง</label>
                                                <hr>
                                                <div class="form-group has-feedback has-error">
                                                    <label class="form-label"> ชื่อแผนงาน/โครงการ</label>
                                                    <select class="select2" id="AccountBudgetd" name="AccountBudgetd">
                                                    </select>
                                                    <small class="help-block" data-bv-validator="notEmpty"
                                                        data-bv-for="AccountBudgetd" data-bv-result="INVALID"
                                                        style="">กรุณากรอกข้อมูล</small>
                                                </div>
                                                <div class="form-group has-feedback">
                                                    <label class="form-label"> ชื่อบัญชี</label>
                                                    <select class="select2" id="SenderBookBankId" name="SenderBookBankId">
                                                    </select>
                                                </div>

                                                <label style="color: red !important; margin-top: 2rem; font-size: 1.2rem">
                                                    หน่วยงานปลายทาง </label>
                                                <hr>

                                                {{-- <div class="form-group">
                                                    <label class="form-label"> เลือกประเภทหน่วยงาน</label>
                                                    <select name="OrgType" id="OrgType" class="select2">
                                                        <option value="1" >กองทุน 1</option>
                                                        <option value="2" >กองทุน 2</option>
                                                        <option value="3" >กองทุน 3</option>
                                                    </select>
                                                </div> --}}

                                                <div id="IsHeadBrance">
                                                    <div class="form-group has-feedback">
                                                        <label class="form-label"> กองทุนหมูบ้าน</label>
                                                        <select id="Village" name="Village" class="select2">
                                                        </select>
                                                    </div>

                                                    <div class="form-group mt-4">
                                                        <label class="form-label"> ชื่อบัญชี <span
                                                                style="color:red !important">*</span></label>
                                                        <select class="select2" id="ReceiverBookBankId"
                                                            name="ReceiverBookBankId">
                                                        </select>
                                                        <small class="help-block" data-bv-validator="notEmpty"
                                                            data-bv-for="ReceiverBookBankId" data-bv-result="INVALID"
                                                            style="">กรุณาเลือกข้อมูลข้อมูล</small>
                                                    </div>

                                                    <div class="form-group mt-3">
                                                        <label class="form-label"> กองทุนละไม่เกิน (บาท) <span
                                                                style="color:red">*</span></label>
                                                        <input type="number" id="Amount" name="Amount"></i>
                                                        <small class="help-block" data-bv-validator="notEmpty"
                                                            data-bv-for="Amount" data-bv-result="NOT_VALIDATED"
                                                            style="display: none;">กรุณากรอกข้อมูล</small>
                                                    </div>
                                                    <div class="form-group has-feedback">
                                                        <label class="form-label"> เอกสารแนบ <span style="color:red"> *
                                                            </span><label style="color:red">
                                                                (ขนาดไฟล์ของเอกสารแนบรวมไม่เกิน 50MB/1ครั้ง)
                                                            </label></label>
                                                        <input type="file" name="FileUpload" id="FileUpload"
                                                            class="col-lg-12 col-md-12 col-sm-12 form-control"
                                                            multiple="" data-bv-notempty="true"
                                                            data-bv-notempty-message="กรุณากรอกข้อมูล"
                                                            accept=".pdf,.docx,.xlsx"
                                                            pattern="^.*\.(docx|DOCX|pdf|PDF|xlsx|XLSX)$"
                                                            data-bv-message="รองรับนามสกุลไฟล์ (xlsx,docx,pdf) เท่านั้น"
                                                            data-bv-field="FileUpload"><i class="form-control-feedback"
                                                            data-bv-icon-for="FileUpload" style="display: none;"></i>
                                                        <small class="help-block" data-bv-validator="notEmpty"
                                                            data-bv-for="FileUpload" data-bv-result="NOT_VALIDATED"
                                                            style="display: none;">กรุณากรอกข้อมูล</small><small
                                                            class="help-block" data-bv-validator="regexp"
                                                            data-bv-for="FileUpload" data-bv-result="NOT_VALIDATED"
                                                            style="display: none;">รองรับนามสกุลไฟล์ (xlsx,docx,pdf)
                                                            เท่านั้น</small>
                                                    </div>
                                                </div>

                                                <div class="form-button-group" style="">
                                                    <button type="button" class="btn btn-success btn-block"
                                                        id='submitTransectionBudget'
                                                        style='background-color: #1ab3a3;width: 150px ; float: right; margin-top: 15px;'>
                                                        <i class="fa fa-save"
                                                            style='padding-right:10px'></i>บันทึก</button>
                                                </div>

                                            </div>

                                    </form>
                                </div>
                                <div class="col-lg-2"></div>
                            </div>

                        </div>



                    </div>

                </form>
            </div>
        </div>



    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.select2').select2();
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

        function formatAmount(input) {
            let value = input.value.replace(/[^\d.]/g, '');

            let parts = value.split('.');
            let integerPart = parts[0];
            let decimalPart = parts.length > 1 ? '.' + parts[1] : '';

            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            value = integerPart + decimalPart;

            input.value = value;
        }
        $(".checkNumber").keypress(function() {
            var dInput = $(this).val();
            return bannedKey(dInput, 1);

        });

        $(document).ready(function() {


            // Get the select element
            const AccountBudgetd = $('#AccountBudgetd');
            const SenderBookBankId = $('#SenderBookBankId');
            const Village = $('#Village');
            

            // fetch โครงการ
            $.ajax({
                url: '/getAccountBudgetSub',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (index, option) {
                        AccountBudgetd.append('<option value="' + option.id + '">' + option.AccName + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });

             // fetch บัญชี
             $.ajax({
                url: '/getBookBankAdminApi',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (index, option) {
                        SenderBookBankId.append('<option value="' + option.id + '">' + option.BookBankName + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });

            $.ajax({
                url: '/getVillageApi',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    Village.append('<option value="0">เลือกกองทุน</option>');
                    $.each(data, function (index, option) {
                        Village.append('<option value="' + option.UserId + '">' + option.VillageName + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });


            $("#submitTransectionBudget").click(function(event) {
                // alert('asdsa');

                // Retrieve selected values from dropdowns
                var AccountBudgetd = $('#AccountBudgetd').val();
                var SenderBookBankId = $('#SenderBookBankId').val();
                var OrgType = $('#OrgType').val();
                var Village = $('#Village').val();
                var ReceiverBookBankId = $('#ReceiverBookBankId').val();
                var Amount = $('#Amount').val();
                // Create FormData object and append values
                var formData = new FormData();
                formData.append('AccountBudgetd', AccountBudgetd);
                formData.append('SenderBookBankId', SenderBookBankId);
                formData.append('OrgType', OrgType);
                formData.append('Village', Village);
                formData.append('ReceiverBookBankId', ReceiverBookBankId);
                formData.append('Amount', Amount);

                // Append the file input
                var fileInput = $('#FileUpload')[0].files[0];
                formData.append('FileUpload', fileInput);

                for (var pair of formData.entries()) {
                    console.log(pair[0] + ', ' + pair[1]);
                }

                Swal.fire({
                    title: "ยืนยัน",
                    text: "คุณต้องการเบิกจ่ายงบประมาณโครงการใช่หรือไม่?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/saveTransectionBudgetApi',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    title: "Success",
                                    text: "Form data saved successfully!",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "admin/TransacionAccountBudget";
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

        $(document).on("change", "#Village", function() {
            var villageID = $(this).val();
            // console.log(selectedValue);
            // alert(villageID);

            $.ajax({
                url: `/getVillageBookBankApi/`+ villageID,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    var ReceiverBookBankId = $('#ReceiverBookBankId');

                    ReceiverBookBankId.empty();

                    $.each(data, function (index, option) {
                        ReceiverBookBankId.append('<option value="' + option.id + '">' + option.BookBankName + '</option>');
                    });
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
    </script>
@endsection
