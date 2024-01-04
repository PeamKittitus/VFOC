@extends('crudbooster::admin_template')
@section('content')
<?php

use Carbon\Carbon;
?>

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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

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
            width: 200px !important;
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
            padding: 0.5rem 0.875rem;
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

        .label {
            font-size: 20px !important;
            margin-left: -10px;
            margin-bottom: 5px !important;
        }

        input::placeholder,
        input {
            font-size: 14px;
            color: #333;
        }

        input[type=file]::file-selector-button {
            margin-right: 20px;
            border: none;
            background: #084cdf;
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            background: #0d45a5;
        }

        .custom-input {
            width: 80%;
            /* height: 40px; */
            padding: 10px;
            font-size: 16px;
            border: 2px solid grey;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        /* Style when the input is focused */
        .custom-input:focus {
            border-color: #2ecc71;
        }

        #editor {
            height: 300px;
            /* Adjust the height as needed */
        }
    </style>
</head>

<body>

    <div>
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/Home/Index">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="/EAccount/StructureIndex">จัดการข่าวสาร</a></li>
            <li class="breadcrumb-item active">สร้างใหม่</li>
        </ol>
    </div>


    <div class="flex-1 bg-pattern" style="background: #8dcde1">
        <div class="card p-4 rounded-plus bg-faded">
            <form name="saveNews" method="post" enctype="multipart/form-data">

                <div class="card-body pb-1">
                    <div class="section-title">
                        <h4 class='font'><strong style="font-weight: 400;"><i class="fa fa-file-text-o" aria-hidden="true" style='margin-right: 10px'></i>สร้างใหม่</strong></h4>
                    </div>
                    <hr />
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label>เลือกประเภทผู้รับข่าวสาร</label>
                            <select class="select2" id='TransactionType' style="width: 100%">
                                <option value="0">สมาชิก</option>
                                <option value="1">สาธารณะ</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label>ประเภทข่าวสาร</label>
                            <select class="select2" id='NewType' style="width: 100%">
                                @foreach($getTypeNews as $item)
                                    <option value="{{ $item->LookupValue }}"> {{ $item->LookupText }} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <div class="flex-wrap " style="display: flex;margin-top: 10px ;justify-content: center;">
                                <div style="margin-right: 30px">
                                    <div>วันที่เริ่มต้นข่าวสาร<strong style="color: red">*</strong></div>
                                    <input type="text" name="date" id="NewStartDate">
                                </div>
                                <div>
                                    <div>วันที่สิ้นสุดข่าวสาร<strong style="color: red">*</strong></div>
                                    <input type="text" name="date" id="NewEndDate">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label class="form-label">สถานะใช้งาน </label>
                            <input type="checkbox" id="IsActive">
                            <span style="color:red">ใช้งาน</span>
                        </div>
                    </div>
                    <hr>

                    <label style="font-size: 14px">เอกสารแนบ <span style="color:red">(ขนาดไฟล์ของเอกสารแนบรวมไม่เกิน
                            50MB/1ครั้ง) </span></label>
                    <input type="file" name="file" id="file">
                    <hr>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label>หัวข้อข่าวสาร<strong style="color:red">*</strong></label>
                            <textarea type="text" class="form-control col-12" data-bv-notempty="true" data-bv-notempty-message="กรุณากรอกข้อมูล" rows="2" id="TransactionTitle" name="TransactionTitle" data-bv-field="TransactionTitle"></textarea>
                        </div>
                    </div>
                    <hr>
                    <label style="font-size: 14px">รายละเอียดข่าวสาร</span></label>
                    <textarea id="TransactionDetail"></textarea>


                    <br>
                    <div class="form-button-group  transparent">
                        <button type="submit" class="btn btn-success btn-block" style='background-color: #1ab3a3;width: 150px ; float: right;'>
                            <i class="fa fa-save" style='padding-right:10px'></i>บันทึก</button>
                    </div>

                </div>

            </form>
        </div>
    </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    jQuery(document).ready(function($) {
        $('.select2').select2();
    });
</script>
<script>
    let editor;
    ClassicEditor
        .create(document.querySelector('#TransactionDetail'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#NewStartDate").datepicker();
        $("#NewEndDate").datepicker();
        //=============Submit
        $("form[name=saveNews]").submit(function(event) {
            event.preventDefault();
            // Get values from form fields
            var TransactionType = $('#TransactionType').val();
            var NewType = $('#NewType').val();
            var NewStartDate = $('#NewStartDate').val();
            var NewEndDate = $('#NewEndDate').val();
            var totalfiles = $('#file')[0].files.length;
            var TransactionTitle = $('#TransactionTitle').val();
            var IsActive = $('#IsActive').is(':checked') ? 1 : 0;
            var editorData = editor.getData();
            var TransactionDetail = editorData;
            var totalfiles = document.getElementById("file").files.length;

            var formData = new FormData();
            formData.append('TransactionType', TransactionType);
            formData.append('NewType', NewType);
            formData.append('NewStartDate', NewStartDate);
            formData.append('NewEndDate', NewEndDate);
            formData.append('IsActive', IsActive);
            formData.append('TransactionTitle', TransactionTitle);
            formData.append('TransactionDetail', TransactionDetail);
            for (var index = 0; index < totalfiles; ++index) {
                formData.append(
                    "file[]",
                    document.getElementById("file").files[index]
                );
            }
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการเพิ่มข่าวสารใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/saveNews',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.api_status == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ!',
                                    text: 'บันทึกข้อมูลเรียบร้อย'
                                }).then(function() {
                                    window.location.href = '/admin/transactionNews';
                                });
                            } else if (response.api_status == 2) {
                                swal("ยกเลิก!", response.api_message, "error");
                            } else {
                                swal("ยกเลิก!", response.api_message, "error");
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
    });
</script>
@endsection