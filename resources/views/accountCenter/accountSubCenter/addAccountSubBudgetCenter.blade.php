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
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">สร้างแผนงานโครงการย่อย</h4>
        <form id="addAccountBudgetSubCenter" name="addAccountBudgetSubCenter" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ปีงบประมาณ</label>
                                    <select class="form-control" id="BudgetYear">
                                        <option value="0" disabled selected>----เลือกปีงบประมาณ----</option>
                                        {!! $generateYearOptions !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อแผนงาน/โครงการ <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ชื่อแผนงาน/โครงการ" id="AccName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ฝ่าย <span style="color: red;">*</span></label>
                                    <select class="form-control" id="DivisionId">
                                        <option value="0" disabled selected>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>"><?= $division->name . '(' . $division->short_name . ')' ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>งบประมาณ (บาท) <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control check_number" placeholder="งบประมาณ (บาท)" id="SubAmount">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่เริ่มโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccStartDate">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccEndDate">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>เอกสารแนบ<span style="color: red;">(ขนาดไฟล์ของเอกสารแนบรวมไม่เกิน 50MB/1ครั้ง)</span></label>
                                    <input type="file" class="form-control" id="file">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>แหล่งที่มา/วัตถุประสงค์<span style="color: red;">*</span></label>
                                    <textarea id="Detail"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/accountBudgetCenter">
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
    $(document).ready(function() {
        $('#BudgetYear').select2();
        $('#DivisionId').select2();

        let editor;
        ClassicEditor
            .create(document.querySelector('#Detail'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });

        $("form[name=addAccountBudgetSubCenter]").submit(function(event) {
            event.preventDefault();
            var AccId = localStorage.getItem('AccountBudgetCenterId');
            var BudgetYear = $('#BudgetYear').val();
            var AccName = $('#AccName').val();
            var DivisionId = $('#DivisionId').val();
            var SubAmount = $('#SubAmount').val();
            var AccStartDate = $('#AccStartDate').val();
            var AccEndDate = $('#AccEndDate').val();
            var totalfiles = document.getElementById("file").files.length;
            var editorData = editor.getData();
            var Detail = editorData;

            if (!BudgetYear) {
                showError('กรุณาเลือกปีงบประมาณ');
                return;
            }
            if (!AccName) {
                showError('กรุณากรอกชื่อยุทธศาสตร์');
                return;
            }
            if (!DivisionId) {
                showError('กรุณาเลือกฝ่าย');
                return;
            }
            if (!SubAmount) {
                showError('กรุณากรอกวงเงินงบประมาณ');
                return;
            }
            if (!Detail) {
                showError('กรุณากรอกแหล่งที่มา/วัตถุประสงค์');
                return;
            }     
            if (totalfiles === 0) {
                showError('กรุณาเลือกไฟล์');
                return;
            }     
            var startDate = new Date(AccStartDate);
            var endDate = new Date(AccEndDate);

            if (endDate < startDate) {
                showError('วันที่สิ้นสุดต้องไม่เป็นวันที่ก่อนวันที่เริ่มต้น');
                return;
            }
            var formData = new FormData();

            formData.append('AccId', AccId);
            formData.append('BudgetYear', BudgetYear);
            formData.append('AccName', AccName);
            formData.append('DivisionId', DivisionId);
            formData.append('SubAmount', SubAmount);
            formData.append('AccStartDate', AccStartDate);
            formData.append('AccEndDate', AccEndDate);
            formData.append('totalfiles', totalfiles);
            formData.append('Detail', Detail);
            for (var index = 0; index < totalfiles; ++index) {
              formData.append(
                "file[]",
                document.getElementById("file").files[index]
              );
            }

            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]); 
            }

            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการสร้างแผนงานโครงการย่อย",
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
                url: '/addAccountBudgetSubCenterApi',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    handleSuccess();
                    if(response.api_message == 'Success'){
                        handleSuccess()
                    }else{
                        Swal.fire({
                            title: "Error",
                            text: response.api_message,
                            icon: "error",
                            showCancelButton: false,
                            confirmButtonText: "OK",
                        });
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
                    window.location.href = "/admin/accountBudgetCenter";
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
                title: 'Invalid Input',
                text: message
            });
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