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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
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

        .select2-container {
            width: 100% !important;
        }

        .plus-button {
            border: 2px solid white;
            background-color: #1dc9b7;
            font-size: 16px;
            height: 2.5em;
            width: 2.5em;
            border-radius: 999px;
            position: relative;

            &:after,
            &:before {
                content: "";
                display: block;
                background-color: white;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            &:before {
                height: 1em;
                width: 0.2em;
            }

            &:after {
                height: 0.2em;
                width: 1em;
            }
        }

        .plus-button--small {
            font-size: 12px;
        }

        .plus-button--large {
            font-size: 17px;
        }
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">การรายงานผลการดำเนินงาน</h4>
        <form id="PerformanceReporting" name="PerformanceReporting" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>กิจกรรม/ขั้นตอน </label>
                                    <input type="text" class="form-control" placeholder="กิจกรรม/ขั้นตอน" id="ActivityName" value="{{$getAccountBudgetCenterActivityDetailById->ActivityName}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>รายละเอียดกิจกรรม </label>
                                    <textarea type="text" class="form-control" placeholder="รายละเอียดกิจกรรม" id="ActivityDetail" disabled>{{$getAccountBudgetCenterActivityDetailById->ActivityDetail}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>วันเริ่มต้นกิจกรรม </label>
                                    <input type="date" class="form-control" id="ActivityStartDate" value="{{$getAccountBudgetCenterActivityDetailById->ActivityStartDate}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>วันสิ้นสุดกิจกรรม </label>
                                    <input type="date" class="form-control" id="ActivityEndDate" value="{{$getAccountBudgetCenterActivityDetailById->ActivityEndDate}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>งบประมาณ (บาท)</label>
                                    <input type="text" class="form-control" placeholder="งบประมาณ (บาท)" id="ActivityAmount" oninput="formatCurrencyInput(this)" value="{{$getAccountBudgetCenterActivityDetailById->ActivityAmount}}" disabled>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผลการดำเนินงาน<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="Performance" placeholder="ผลการดำเนินงาน"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ลักษณะของการดำเนินงาน<span style="color: red;">*</span></label>
                                    <div class="form-group" style="display: flex;align-items:baseline;gap:10px">
                                        <label><input type="radio" name="NatureOperation" value="1"> ยุทธศาสตร์/แผนงาน/โครงการ</label>
                                        <label><input type="radio" name="NatureOperation" value="2"> ภารกิจของฝ่าย/สาขาเขต</label>
                                        <label><input type="radio" name="NatureOperation" value="3"> นโยบายรัฐบาล/คณะกรรมการฯ/ผู้บริหาร</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>หมายเหตุ<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="Note" placeholder="หมายเหตุ"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>แนบไฟล์ประกอบ(ถ้ามี)</label>
                                    <input type="file" class="form-control" id="file" accept=".doc, .docx, .pdf, image/*" multiple onchange="checkFileSize(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>สถานะ<span style="color: red;">*</span></label>
                                    <select class="form-control" id="ActivityStatus">
                                        <option value="0" disabled selected>----เลือกสถานะ----</option>
                                        <option value="1">กำลังดำเนินการ</option>
                                        <option value="2">เสร็จสิ้น</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="{{$getAccountBudgetCenterActivityDetailById->id}}" id="AccountBudgetCenterActivityId">
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/accountBudgetCenterActivity">
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
<script type="text/javascript">
    window.onload = function() {
        formatCurrencyData(document.getElementById("ActivityAmount"));
    };

    function formatCurrencyData(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    // Function to handle resizing of textarea element
    function resizeTextarea(textarea) {
        textarea.style.height = 'auto'; // Reset textarea height to auto
        textarea.style.height = textarea.scrollHeight + 'px'; // Set the new height based on content
    }

    // Function to add event listener to textarea element
    function addTextareaEventListener(id) {
        const textarea = document.getElementById(id);
        textarea.addEventListener('input', function() {
            resizeTextarea(this);
        });
    }

    // Array of textarea element IDs
    const textareaIds = ['Performance', 'Note'];

    // Loop through textareaIds array and add event listeners to each textarea element
    textareaIds.forEach(addTextareaEventListener);

    //checkFileSize
    function checkFileSize(input) {
        if (input.files && input.files.length > 0) {
            var maxSize = 50 * 1024 * 1024; // 50 MB ในหน่วยไบต์
            for (var i = 0; i < input.files.length; i++) {
                var fileSize = input.files[i].size; // ขนาดของไฟล์แต่ละไฟล์

                if (fileSize > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'ขนาดไฟล์ใหญ่เกินไป',
                        text: 'ไฟล์ที่คุณเลือกมีขนาดใหญ่เกินกว่าที่อนุญาต (50MB)',
                    });
                    input.value = ''; // ล้างการเลือกไฟล์
                    return; // หยุดการทำงานหากพบไฟล์ที่มีขนาดใหญ่เกิน
                }
            }
        }
    }

    $(document).ready(function() {
        $('#ActivityStatus').select2();

        $("form[name=PerformanceReporting]").submit(function(event) {
            event.preventDefault();

            var AccountBudgetCenterActivityId = $('#AccountBudgetCenterActivityId').val();
            var Performance = $('#Performance').val();
            var NatureOperation = $("input[name='NatureOperation']:checked").val();
            var Note = $('#Note').val();
            var ActivityStatus = $('#ActivityStatus').val();
            var totalfiles = document.getElementById("file").files.length;

            var fieldsToCheck = [{
                    value: Performance,
                    message: 'กรุณากรอกผลการดำเนินการ'
                },
                {
                    value: NatureOperation,
                    message: 'กรุณาเลือกลักษณะการดำเนินการ'
                },
                {
                    value: Note,
                    message: 'กรุณากรอกหมายเหตุ'
                },
                {
                    value: ActivityStatus,
                    message: 'กรุณาเลือกสถานะ'
                }
            ];

            if (!validateForm(fieldsToCheck)) {
                return false;
            }

            var formData = new FormData();

            formData.append('AccountBudgetCenterActivityId', AccountBudgetCenterActivityId);
            formData.append('Performance', Performance);
            formData.append('NatureOperation', NatureOperation);
            formData.append('Note', Note);
            formData.append('ActivityStatus', ActivityStatus);
            formData.append('totalfiles', totalfiles);
            if (totalfiles != 0) {
                for (var index = 0; index < totalfiles; ++index) {
                    formData.append(
                        "file[]",
                        document.getElementById("file").files[index]
                    );
                }
            }else{
                formData.append("file[]", "");
            }

            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการสร้างรายงานผลการดำเนินการ",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    submitFormData(formData);
                }
            });
        }

        // Function to handle form submission
        function submitFormData(formData) {
            $.ajax({
                url: '/updateAccountActivityDetail',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.api_message == 'Success') {
                        handleSuccess();
                    } else {
                        handleError();
                    }
                },
                error: function(xhr, status, error) {
                    handleError();
                }
            });
        }

        // Function to handle form submission success
        function handleSuccess() {
            Swal.fire({
                title: "สำเร็จ",
                text: "บันทึกข้อมูลสำเร็จ!",
                icon: "success",
                showCancelButton: false,
                confirmButtonText: "OK",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/accountBudgetCenterActivity";
                }
            });
        }

        // Function to handle form submission error
        function handleError() {
            Swal.fire({
                title: "Error",
                text: "An error occurred while saving the form data.",
                icon: "error",
                showCancelButton: false,
                confirmButtonText: "OK",
            });
        }

        // Function to display error messages
        function showError(message) {
            Swal.fire({
                icon: 'error',
                title: 'ข้อมูลไม่ถูกต้อง',
                text: message
            });
        }

        // Function to Validate
        function validateForm(fields) {
            for (let field of fields) {
                if (!field.value) {
                    showError(field.message);
                    return false;
                }
            }
            return true;
        }

        // Function to restrict input to numeric characters
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

        $(".check_number").keypress(function() {
            var dInput = $(this).val();
            return bannedKey(dInput, 1);
        });
    });
</script>
@endsection