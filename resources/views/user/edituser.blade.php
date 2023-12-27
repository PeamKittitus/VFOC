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

    .select2-container .select2-selection--single {
        height: 34px !important;
    }
</style>
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">แก้ไขข้อมูลส่วนตัว</h3>
    </div>


    <form id="editProfile" name="editProfile" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label>สังกัดภายใต้เขต</label>
                <select name="SystemOrg" id="SystemOrg">
                    @foreach($getSystemOrg as $value)
                    <option value="{{$value->id}}" @if($getDataUser->orgId == $value->id) selected @endif>{{$value->orgName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>ชื่อ <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="BookBankNumber" value="{{$getDataUser->firstName}}">
            </div>
            <div class="form-group">
                <label>นามสกุล <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName" value="{{$getDataUser->lastName}}">
            </div>
            <div class="form-group">
                <label>เลขบัตรประจำตัวประชาชน <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="WithdrawName2" value="{{$getDataUser->idCard}}">
            </div>
            <div class="form-group">
                <label>เบอร์โทร<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName3" value="{{$getDataUser->phoneNumber}}">
            </div>
            <div class="form-group">
                <label>อีเมล (e-mail)<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName4" value="{{$getDataUser->email}}">
            </div>
            <div class="form-group">
                <label>ชื่อบัญชีผู้ใช้งานระบบ<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="WithdrawName5" value="{{$getDataUser->name}}">
            </div>
            <div class="form-group">
                <label>รหัสผ่าน <span style="color:red">*</span></label>
                <input type="password" class="form-control" id="WithdrawName5">
            </div>
            <div class="form-group">
                <label>ยืนยันรหัสผ่าน <span style="color:red">*</span></label>
                <input type="password" class="form-control" id="WithdrawName5">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-info">บันทึก</button>
            <a href="javascript:history.back()" class="btn btn-default">ยกเลิก</a>
        </div>
    </form>
</div>
@push('bottom')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
<script>
    $(function() {
        $('#SystemOrg').select2();
        $('#SystemOrg').prop('disabled', true);
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
    $(".checkNumber").keypress(function() {
        var dInput = $(this).val();
        return bannedKey(dInput, 1);

    });
</script>
@endpush
@endsection