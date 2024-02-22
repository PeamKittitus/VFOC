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
        .text{
            display: block;
        }
    </style>
</head>

<body>

    <div class="w-box" style="margin: auto !important; padding: 10px">
        <form id="updatedProjectActivity" name="updatedProjectActivity" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4 style="color: #049DAB;">กิจกรรม</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <p class="text"><b>รายละเอียด </b>: {{$getProjectActivityById->ActivityDetail}} งบประมาณกิจกรรม {{$getProjectActivityById->ActivityBudget}} บาท</p>
                                    <?php
                                        $StartAt = date('d F Y', strtotime($getProjectActivityById->StartActivityDate));
                                        $StartAtThai = str_replace(
                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                            array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                            $StartAt
                                        );
                                        $yearThai = intval(date('Y', strtotime($getProjectActivityById->StartActivityDate))) + 543; // แปลงปีเป็น พ.ศ.
                                        $StartAtThai = str_replace(date('Y', strtotime($getProjectActivityById->StartActivityDate)), $yearThai, $StartAtThai);

                                        $EndAt = date('d F Y', strtotime($getProjectActivityById->EndActivityDate));
                                        $EndAtThai = str_replace(
                                            array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'),
                                            array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'),
                                            $EndAt
                                        );
                                        $yearThai = intval(date('Y', strtotime($getProjectActivityById->EndActivityDate))) + 543; // แปลงปีเป็น พ.ศ.
                                        $EndAtThai = str_replace(date('Y', strtotime($getProjectActivityById->EndActivityDate)), $yearThai, $EndAtThai);
                                    ?>
                                    <p class="text"><b>เริ่ม</b> : {{$StartAtThai}}</p>
                                    <p class="text"><b>สิ้นสุด</b> : {{$EndAtThai}}</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>หมายเหตุ</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>อัพเดทรายละเอียดกิจกรรม</label>
                                    <textarea class="form-control" id="Comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h4>เอกสารที่เกี่ยวข้อง</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>เอกสารแนบ</label>
                                    <input type="file" class="form-control" id="ActivityFile">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">อัพเดทกิจกรรม</button>
                                    <button type="button" class="btn" style="color: white ; background-color:red" onclick="goBack()">ย้อนกลับ</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="ProjectActivityId" value="{{$getProjectActivityById->id}}">
                        <input type="hidden" id="ProjectBudgetId" value="{{$getProjectActivityById->ProjectBudgetId}}">
                        
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
        //==========Goback
        function goBack() {
            window.history.back();
        }
        //=============approve
        $("form[name=updatedProjectActivity]").submit(function(event) {
            event.preventDefault();
            var ProjectActivityId = $('#ProjectActivityId').val();
            var ProjectBudgetId = $('#ProjectBudgetId').val();
            var Comment = $('#Comment').val();
            var formData = new FormData();
            formData.append('ProjectActivityId', ProjectActivityId);
            formData.append('ProjectBudgetId', ProjectBudgetId);
            formData.append('Comment', Comment);
            formData.append(
                "ActivityFile[]",
                document.getElementById("ActivityFile").files[0]
            );
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการอัพเดทกิจกรรมใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/updatedProjectActivity',
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
                                        "/admin/projectBudget";
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
    })
</script>
@endsection