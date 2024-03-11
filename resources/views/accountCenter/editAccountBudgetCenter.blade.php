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
        <h4 style="text-align: center;color:black">แก้ไขแผนงานโครงการ</h4>
        <form id="editAccountBudgetCenter" name="editAccountBudgetCenter" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ปีงบประมาณ</label>
                                    <select class="form-control" id="BudgetYear" disabled>
                                        <option value="0" disabled>----เลือกปีงบประมาณ----</option>
                                        <option value="2569" {{ $getAccountBudgetCenterById->BudgetYear == '2569' ? 'selected' : '' }}>2569</option>
                                        <option value="2568" {{ $getAccountBudgetCenterById->BudgetYear == '2568' ? 'selected' : '' }}>2568</option>
                                        <option value="2567" {{ $getAccountBudgetCenterById->BudgetYear == '2567' ? 'selected' : '' }}>2567</option>
                                        <option value="2566" {{ $getAccountBudgetCenterById->BudgetYear == '2566' ? 'selected' : '' }}>2566</option>
                                        <option value="2565" {{ $getAccountBudgetCenterById->BudgetYear == '2565' ? 'selected' : '' }}>2565</option>
                                        <option value="2564" {{ $getAccountBudgetCenterById->BudgetYear == '2564' ? 'selected' : '' }}>2564</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อยุทธศาสตร์ <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ชื่อยุทธศาสตร์" id="AccName" value="{{$getAccountBudgetCenterById->AccName}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>กรอบวงเงินงบประมาณ (บาท) <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control check_number" placeholder="กรอบวงเงินงบประมาณ (บาท)" id="Amount" value="{{$getAccountBudgetCenterById->Amount}}" oninput="formatCurrency(this);">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>กลยุทธ์<span style="color: red;">*</span></label>
                                    <textarea id="AccDetail"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <input type="hidden" id="AccId" value="{{$getAccountBudgetCenterById->id}}">
                        <input type="hidden" id="AccDetailEditor" name="AccDetailEditor" value="{{$getAccountBudgetCenterById->AccDetail}}">
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
<script>


</script>
<script type="text/javascript">
    window.onload = function() {
        formatCurrency(document.getElementById("Amount"));
    };
    function formatCurrency(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }
    $(document).ready(function() {
        let editor;
        var AccDetailEditor = $('#AccDetailEditor').val();
        ClassicEditor
            .create(document.querySelector('#AccDetail'))
            .then(createdEditor => {
                editor = createdEditor;
                const initialContent = AccDetailEditor;
                editor.setData(initialContent);
            })
            .catch(error => {
                console.error(error);
            });
            
        $('#BudgetYear').select2();
        $("form[name=editAccountBudgetCenter]").submit(function(event) {
            event.preventDefault();
            var AccId = $('#AccId').val();
            var BudgetYear = $('#BudgetYear').val();
            var AccName = $('#AccName').val();
            var Amount = $('#Amount').val();
            Amount = Amount.replace(/[^\d]/g, '');
            // แปลงเป็น integer
            Amount = parseInt(Amount);

            var editorData = editor.getData();
            var AccDetail = editorData;

            if (!BudgetYear) {
                showError('กรุณาเลือกปีงบประมาณ');
                return;
            }
            if (!AccName) {
                showError('กรุณากรอกชื่อยุทธศาสตร์');
                return;
            }
            if (!Amount) {
                showError('กรุณากรอกวงเงินงบประมาณ');
                return;
            }
            if(!AccDetail){
                showError('กรุณากรอกกลยุทธ์');
                return;
            }

            var formData = new FormData();

            formData.append('AccId', AccId);
            formData.append('BudgetYear', BudgetYear);
            formData.append('AccName', AccName);
            formData.append('Amount', Amount);
            formData.append('AccDetail', AccDetail);

            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการแก้ไขแผนงานโครงการ",
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
                url: '/editAccountBudgetCenterApi',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    handleSuccess();
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
                title: 'ข้อมูลไม่ถูกต้อง',
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