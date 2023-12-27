@extends('crudbooster::admin_template')
@section("content")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>
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
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">ตั้งค่าธนาคาร</h3>
    </div>


    <form id="editBookBank" name="editBookBank" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label>ธนาคาร</label>
                <select name="BankMasterId" id="BankMasterId">
                    <option value="" disabled selected>กรุณาเลือกธนาคาร</option>
                    @foreach($getAccountBankMaster as $value)
                    <option value="{{$value->id}}" @if($getAccountBookById->BankMasterId == $value->id) selected @endif>{{$value->BankName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>ชื่อบัญชี <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="BookBankName" value="{{$getAccountBookById->BookBankName}}">
            </div>
            <div class="form-group">
                <label>หมายเลขบัญชี <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="BookBankNumber" value="{{$getAccountBookById->BookBankNumber}}">
            </div>
            <div class="form-group">
                <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 1 <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName" value="{{$getAccountBookById->WithdrawName}}">
            </div>
            <div class="form-group">
                <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 2 <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName2" value="{{$getAccountBookById->WithdrawName2}}">
            </div>
            <div class="form-group">
                <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 3 <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName3" value="{{$getAccountBookById->WithdrawName3}}">
            </div>
            <div class="form-group">
                <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 4 (ถ้ามี)</label>
                <input type="text" class="form-control" id="WithdrawName4" value="{{$getAccountBookById->WithdrawName4}}">
            </div>
            <div class="form-group">
                <label>ผู้มีอำนาจเบิกถอนเงินในบัญชีคนที่ 5 (ถ้ามี)</label>
                <input type="text" class="form-control" id="WithdrawName5" value="{{$getAccountBookById->WithdrawName5}}">
            </div>
            <div class="form-group">
                <label>แนบไฟล์หน้าสมุดบัญชี <span style="color:red">*</span></label>
                <input type="file" class="form-control" id="file">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">บันทึก</button>
            <a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
        </div>
        <input type="hidden" id="AccountBookBankId" value="{{$getAccountBookById->id}}">
    </form>
</div>
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(function() {
        $('#BankMasterId').select2();

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
        $(".checkNumber").keypress(function() {
            var dInput = $(this).val();
            return bannedKey(dInput, 1);

        });
        $("form[name=editBookBank]").submit(function(event) {
            event.preventDefault();
            var AccountBookBankId = $('#AccountBookBankId').val();
            var BankMasterId = $('#BankMasterId').val();
            // if (!(BankMasterId)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid BankMasterId',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var BookBankName = $('#BookBankName').val();
            // if (!(BookBankName)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid BookBankName',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var BookBankNumber = $('#BookBankNumber').val();
            // if (!(BookBankNumber)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid BookBankNumber',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var WithdrawName = $('#WithdrawName').val();
            // if (!(WithdrawName)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid WithdrawName',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var WithdrawName2 = $('#WithdrawName2').val();
            // if (!(WithdrawName2)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid WithdrawName2',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var WithdrawName3 = $('#WithdrawName3').val();
            // if (!(WithdrawName3)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid WithdrawName3',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var WithdrawName4 = $('#WithdrawName4').val();
            var WithdrawName5 = $('#WithdrawName5').val();
            var totalfiles = $('#file')[0].files.length;
            // if (totalfiles <= 0) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid File',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var formData = new FormData();
            
            formData.append('AccountBookBankId', AccountBookBankId);
            formData.append('BankMasterId', BankMasterId);
            formData.append('BookBankName', BookBankName);
            formData.append('BookBankNumber', BookBankNumber);
            formData.append('WithdrawName', WithdrawName);
            formData.append('WithdrawName2', WithdrawName2);
            formData.append('WithdrawName3', WithdrawName3);
            formData.append('WithdrawName4', WithdrawName4);
            formData.append('WithdrawName5', WithdrawName5);
            formData.append('totalfiles', totalfiles);
            
            for (var index = 0; index < totalfiles; ++index) {
                formData.append(
                    "file[]",
                    document.getElementById("file").files[index]
                );
            }
            for (var pair of formData.entries()) {
                    console.log(pair[0] + '>>' + pair[1]);
                }
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการแก้ไขการตั้งค่าธนาคารใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/editBookbank',
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
@endpush
@endsection