@extends('crudbooster::admin_template')
@section("content")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Sarabun', sans-serif !important;
    }
    .card {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        margin-bottom: 1rem;
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-info:not(.card-outline)>.card-header,
    .card-info:not(.card-outline)>.card-header a {
        color: #fff;
    }

    .card-info:not(.card-outline)>.card-header {
        background-color: #039dab;
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        padding: .75rem 1.25rem;
        position: relative;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
        padding: .75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .03);
        border-bottom: 0 solid rgba(0, 0, 0, .125);
    }

    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1.25rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .label:not(.form-check-label):not(.custom-file-label) {
        font-weight: 700;
    }

    .col-form-label {
        padding-top: calc(.375rem + 1px);
        padding-bottom: calc(.375rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1.5;
    }

    .card-footer {
        padding: .75rem 1.25rem;
        background-color: rgba(0, 0, 0, .03);
        border-top: 0 solid rgba(0, 0, 0, .125);
        display: flex;
        justify-content: end;
        gap: 1%;
    }

    .btn-info {
        color: #fff;
        background-color: #039dab;
        border-color: #17a2b8;
        box-shadow: none;
    }

    .select2-container {
        width: 100% !important;
    }
</style>
<div class="w-box" style="margin: auto !important; padding: 10px">
        <h4 style="text-align: center;color:black">ตั้งค่าธนาคาร</h4>
        <form id="addBookBank" name="addBookBank" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ธนาคาร<span style="color: red;">*</span></label>
                                    <select class="form-control" id="BankMasterId" name="BankMasterId">
                                    <option value="" disabled selected>กรุณาเลือกธนาคาร</option>
                                    @foreach($getAccountBankMaster as $value)
                                    <option value="{{$value->id}}">{{$value->BankName}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อบัญชี <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ชื่อบัญชี" id="BookBankName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>หมายเลขบัญชี<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control checkNumber" placeholder="หมายเลขบัญชี" id="BookBankNumber">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 1 <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 1" id="WithdrawName">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 2 <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 2" id="WithdrawName2">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 3 <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 3" id="WithdrawName3">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 4 (ถ้ามี)</label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 4 (ถ้ามี)" id="WithdrawName4">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 5 (ถ้ามี)</label>
                                    <input type="text" class="form-control" placeholder="ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 5 (ถ้ามี)" id="WithdrawName5">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>แนบไฟล์หน้าสมุดบัญชี<span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" id="file">
                                </div>
                            </div>
                        </div>
       
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/accountBookBank">
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
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(function() {
        $('#BankMasterId').select2();

        $(".checkNumber").keypress(function(event) {
            var k = event.keyCode;
            if (!((k >= 48 && k <= 57) || k == 46)) {
                event.preventDefault();
            }
        });

        function showErrorAlert(title, message) {
            Swal.fire({
                icon: 'error',
                title: title,
                text: message
            });
        }
        $("form[name=addBookBank]").submit(function(event) {
            event.preventDefault();
            var BankMasterId = $('#BankMasterId').val();
            if (!(BankMasterId)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var BookBankName = $('#BookBankName').val();
            if (!(BookBankName)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var BookBankNumber = $('#BookBankNumber').val();
            if (!(BookBankNumber)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var WithdrawName = $('#WithdrawName').val();
            if (!(WithdrawName)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var WithdrawName2 = $('#WithdrawName2').val();
            if (!(WithdrawName2)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var WithdrawName3 = $('#WithdrawName3').val();
            if (!(WithdrawName3)) {
                showErrorAlert('ข้อมูลไม่ถูกต้อง', 'กรุณากรอกข้อมูลให้ครบถ้วน');
                return;
            }
            var WithdrawName4 = $('#WithdrawName4').val();
            var WithdrawName5 = $('#WithdrawName5').val();
            var totalfiles = $('#file')[0].files.length;
            if (totalfiles <= 0) {
                showErrorAlert('ไฟล์ไม่ถูกต้อง', 'กรุณาเลือกไฟล์อย่างน้อยหนึ่งไฟล์');
                return;
            }
            var formData = new FormData();
            formData.append('BankMasterId', BankMasterId);
            formData.append('BookBankName', BookBankName);
            formData.append('BookBankNumber', BookBankNumber);
            formData.append('WithdrawName', WithdrawName);
            formData.append('WithdrawName2', WithdrawName2);
            formData.append('WithdrawName3', WithdrawName3);
            formData.append('WithdrawName4', WithdrawName4);
            formData.append('WithdrawName5', WithdrawName5);
            for (var index = 0; index < totalfiles; ++index) {
                formData.append(
                    "file[]",
                    document.getElementById("file").files[index]
                );
            }
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการเพิ่มการตั้งค่าธนาคารใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/saveBookbank',
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
                                        "/admin/accountBookBank";
                                }
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "เกิดข้อผิดพลาด",
                                text: "เกิดข้อผิดพลาดขณะบันทึกข้อมูลแบบฟอร์ม",
                                icon: "error",
                                showCancelButton: false,
                                confirmButtonText: "ตกลง",
                            });
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
@endsection