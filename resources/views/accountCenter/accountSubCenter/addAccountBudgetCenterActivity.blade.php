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
        <h4 style="text-align: center;color:black">สร้างกิจกรรมโครงการ</h4>
        <form id="addAccountBudgetCenterActivity" name="addAccountBudgetCenterActivity" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ปีงบประมาณ</label>
                                    <select class="form-control" id="BudgetYear" disabled>
                                        <option value="0" disabled>----เลือกปีงบประมาณ----</option>
                                        <option value="2569" {{ $getAccountBudgetCenterSubById->BudgetYear == '2569' ? 'selected' : '' }}>2569</option>
                                        <option value="2568" {{ $getAccountBudgetCenterSubById->BudgetYear == '2568' ? 'selected' : '' }}>2568</option>
                                        <option value="2567" {{ $getAccountBudgetCenterSubById->BudgetYear == '2567' ? 'selected' : '' }}>2567</option>
                                        <option value="2566" {{ $getAccountBudgetCenterSubById->BudgetYear == '2566' ? 'selected' : '' }}>2566</option>
                                        <option value="2565" {{ $getAccountBudgetCenterSubById->BudgetYear == '2565' ? 'selected' : '' }}>2565</option>
                                        <option value="2564" {{ $getAccountBudgetCenterSubById->BudgetYear == '2564' ? 'selected' : '' }}>2564</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อแผนงาน/โครงการ <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ชื่อแผนงาน/โครงการ" id="AccName" value="{{$getAccountBudgetCenterSubById->AccName}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ฝ่าย <span style="color: red;">*</span></label>
                                    <select class="form-control" id="DivisionId" disabled>
                                        <option value="0" disabled>----เลือกฝ่าย----</option>
                                        <?php foreach ($getDivision as $division) : ?>
                                            <option value="<?= $division->id ?>" <?= ($getAccountBudgetCenterSubById->DivisionId == $division->id) ? 'selected' : '' ?>><?= $division->name . '(' . $division->short_name . ')' ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>งบประมาณ (บาท) <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control check_number" placeholder="งบประมาณ (บาท)" id="SubAmount" value="{{$getAccountBudgetCenterSubById->SubAmount}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่เริ่มโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccStartDate" value="{{$getAccountBudgetCenterSubById->AccStartDate}}" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>วันที่สิ้นสุดโครงการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="AccEndDate" value="{{$getAccountBudgetCenterSubById->AccEndDate}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectActivity" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">ชื่อเอกสาร</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getAccountBudgetCenterSubFileById as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center"><a href="{{ asset($value->FilePath) }}" target="_blank">{{ $value->FileName }}</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                        <h4 style="text-align: center;color:black">รายละเอียดแผนงานกิจกรรม</h4>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <table id="datatableProjectActivity" class="table table-striped table-bordered" cellspacing="0" width="100%" style="background-color: #1dc9b7;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">ลำดับ</th>
                                                <th style="text-align: center;">กิจกรรม</th>
                                                <th style="text-align: center;">รายละเอียด</th>
                                                <th style="text-align: center;">งบประมาณ (บาท)</th>
                                                <th style="text-align: center;">จัดการข้อมูล</th>
                                            </tr>
                                        </thead>
                                        <tbody style="background-color: white;">
                                            @foreach($getAccountBudgetCenterActivityById as $index => $value)
                                            <tr>
                                                <td style="text-align:center"><?= $index + 1 ?></td>
                                                <td style="text-align:center">{{ $value->ActivityName}}</td>
                                                <td style="text-align:center">{{ $value->ActivityDetail}}</td>
                                                <td style="text-align:center">{{ $value->ActivityAmount}}</td>
                                                <td style="text-align:center; display: flex; gap: 1%; justify-content: center;">
                                                    <button type="button" data-id="{{$value->id}}" class="btn editActivityBtn" style="color: white; background-color: orange">แก้ไข</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="addMore">
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>กิจกรรม/ขั้นตอน <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" placeholder="กิจกรรม/ขั้นตอน" id="ActivityName">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>รายละเอียดกิจกรรม <span style="color: red;">*</span></label>
                                        <textarea type="text" class="form-control" placeholder="รายละเอียดกิจกรรม" id="ActivityDetail"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>งบประมาณ (บาท)<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control check_number" placeholder="งบประมาณ (บาท)" id="ActivityAmount">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <input type="hidden" id="DetailSub" name="DetailSub" value="{{$getAccountBudgetCenterSubById->Detail}}">
                            <input type="hidden" value="{{$accSubId}}" id="accSubId">
                        </div>
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
<!-- Modal -->
<div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="addActivityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editData" name="editData">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addActivityModalLabel">แก้ไขรายละเอียดแผนงานกิจกรรม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>กิจกรรม/โครงการ<strong style="color:red">*</strong></label>
                                <input type="text" class="form-control" placeholder="กิจกรรม/โครงการ" id="ActivityModalName">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>รายละเอียดกิจกรรม<strong style="color:red">*</strong></label>
                                <input type="text" class="form-control" placeholder="รายละเอียดกิจกรรม" id="ActivityModalDetail">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>งบประมาณ (บาท)<strong style="color:red">*</strong></label>
                                <input type="text" class="form-control" placeholder="งบประมาณ (บาท)" id="ActivityModalAmount">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="ActivityModalId" id="ActivityModalId" value="" />
                <input type="hidden" name="AccBudgetCenterId" id="AccBudgetCenterId" value="" />
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="saveActivityBtn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="color: white ; background-color:red">ปิด</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function() {

        let editor;
        var DetailSub = $('#DetailSub').val();
        ClassicEditor
            .create(document.querySelector('#Detail'), {
                readOnly: true,

            })
            .then(editor => {
                editor.enableReadOnlyMode("editor");
                var DetailSub = $('#DetailSub').val();
                const initialContent = DetailSub;
                editor.setData(initialContent);
            })
            .catch(error => {
                console.error(error);
            });

        // เลือก textarea ด้วย ID
        var textarea = document.getElementById("ActivityDetail");

        // เพิ่ม event listener เมื่อมีการพิมพ์ใน textarea
        textarea.addEventListener("input", function() {
            // ปรับขนาดของ textarea ตามข้อความที่ผู้ใช้พิมพ์เข้าไป
            this.style.height = "auto";
            this.style.height = (this.scrollHeight) + "px";
        });

        $("form[name=addAccountBudgetCenterActivity]").submit(function(event) {
            event.preventDefault();

            var accSubId = $('#accSubId').val();
            var ActivityName = $('#ActivityName').val();
            var ActivityDetail = $('#ActivityDetail').val();
            var ActivityAmount = $('#ActivityAmount').val();

            if (!ActivityName) {
                showError('กรุณากรอกกิจกรรม');
                return;
            }
            if (!ActivityDetail) {
                showError('กรุณากรอกรายละเอียดกิจกรรม');
                return;
            }
            if (!ActivityAmount) {
                showError('กรุณากรอกงบประมาณ');
                return;
            }

            var formData = new FormData();

            formData.append('accSubId', accSubId);
            formData.append('ActivityName', ActivityName);
            formData.append('ActivityDetail', ActivityDetail);
            formData.append('ActivityAmount', ActivityAmount);

            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการสร้างกิจกรรมโครงการ",
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
                url: '/addAccountBudgetCenterActivityApi',
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
                    window.location.reload();
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

        // เมื่อคลิกที่ปุ่ม "แก้ไขกิจกรรม"
        var btnEditList = document.querySelectorAll('.editActivityBtn');
        btnEditList.forEach(function(btnEdit) {
            btnEdit.addEventListener('click', function() {
                var ActivityId = $(this).data('id');
                var formData = new FormData();
                formData.append("ActivityId", ActivityId);
                $.ajax({
                    url: "/getAccountBudgetCenterActivityByIdApi",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#editActivityModal').modal('show');
                        $('#ActivityModalId').val(response.id);
                        $('#AccBudgetCenterId').val(response.AccBudgetCenterId);
                        
                        $('#ActivityModalName').val(response.ActivityName);
                        $('#ActivityModalDetail').val(response.ActivityDetail);
                        $('#ActivityModalAmount').val(response.ActivityAmount);

                        $('#saveActivityBtn').on('click', function() {
                            var ActivityModalId = $('#ActivityModalId').val();
                            var AccBudgetCenterId = $('#AccBudgetCenterId').val();
                            
                            var ActivityModalName = $('#ActivityModalName').val();
                            var ActivityModalDetail = $('#ActivityModalDetail').val();
                            var ActivityModalAmount = $('#ActivityModalAmount').val();
                            
                            var formData = new FormData();
                            formData.append("ActivityModalId", ActivityModalId);
                            formData.append("AccBudgetCenterId", AccBudgetCenterId);
                            formData.append("ActivityModalName", ActivityModalName);
                            formData.append("ActivityModalDetail", ActivityModalDetail);
                            formData.append("ActivityModalAmount", ActivityModalAmount);
                            $.ajax({
                                url: "/editAccountBudgetCenterActivity",
                                method: "POST",
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    Swal.fire({
                                        title: "สำเร็จ",
                                        text: "แก้ไขข้อมูลเรียบร้อยแล้ว!",
                                        icon: "success",
                                        showCancelButton: false,
                                        confirmButtonText: "ตกลง",
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.reload();
                                        }
                                    });
                                },
                                error: function(xhr, status, error) {
                                    // จัดการข้อผิดพลาดตามที่ต้องการ
                                    console.error(error);
                                }
                            });
                            
                            // Close the modal after handling the delete
                            // $('#editActivityModal').modal('hide');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    });
</script>
@endsection