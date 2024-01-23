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
        <h3 class="card-title">ยื่นคำขอขึ้นทะเบียน</h3>
    </div>


    <form id="addVillage" name="addVillage" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label>รหัสกองทุน( 8 หลัก) <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="VillageCodeText" maxlength="8">
            </div>
            <div class="form-group">
                <label>รหัสผู้เสียภาษี/เลขนิติบุคคล ( 13 หลัก) <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="VillageDbd" maxlength="13">
            </div>
            <div class="form-group">
                <label>เลขทะเบียนใบนิติบุคคล <span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="VillageBdbCode">
            </div>
            <div class="form-group">
                <label>ชื่อนิติบุคคล <span style="color:red">*</span></label>
                <input type="text" class="form-control" id="VillageName">
            </div>
            <div class="form-group">
                <label>เบอร์โทรศัพท์<span style="color:red">*</span></label>
                <input type="text" class="form-control checkNumber" id="Phone" maxlength="10">
            </div>
            <div class="form-group">
                <label>อีเมล (e-mail)</label>
                <input type="text" class="form-control" id="Email">
            </div>
            <div class="form-group">
                <label>วันที่จัดตั้ง<span style="color:red">*</span></label>
                <input type="date" class="form-control" id="DbdDate">
            </div>
            <div class="form-group">
                <label>ที่อยู่นิติบุคคล<span style="color:red">*</span></label>
                <input type="text" class="form-control" id="VillageAddress">
            </div>
            <div class="form-group">
                <label>หมู่ที่</label>
                <input type="text" class="form-control" id="VillageMoo">
            </div>
            <div class="form-group">
                <label>จังหวัด</label>
                <select name="VillageProvinceId" id="VillageProvinceId" data-id="VillageDistrictId">
                    <option value="" disabled selected>กรุณาเลือกจังหวัด</option>
                    @foreach($getProvince as $value)
                    <option value="{{$value->id}}">{{$value->name_th}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>อำเภอ/เขต</label>
                <select name="VillageDistrictId" id="VillageDistrictId" data-id="VillageSubDistrictId">

                </select>
            </div>
            <div class="form-group">
                <label>ตำบล/แขวง</label>
                <select name="VillageSubDistrictId" id="VillageSubDistrictId" data-id="VillagePostCode">

                </select>
            </div>
            <div class="form-group">
                <label>ไปรษณีย์</label>
                <input type="text" class="form-control" name="VillagePostCode" id="VillagePostCode" disabled>
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
        $('#VillageProvinceId').select2();
        $('#VillageDistrictId').select2();
        $('#VillageSubDistrictId').select2();

        document.getElementById('VillageProvinceId').onchange = function() {
            var VillageProvinceId = this.value;
            var DataId = $(this).attr("data-id")
            var Data = {
                'VillageProvinceId': VillageProvinceId
            };
            $.ajax({
                url: '/getAmphuresById',
                method: "POST",
                data: Data,
                success: function(data) {
                    if (data.api_status == 1) {
                        $("select[name^='" + DataId + "']").html('');
                        $("select[name^='" + DataId + "']").append('<option value="" selected>กรุณาเลือกอำเภอ/เขต</option>');

                        $.each(data.api_data, function(key, value) {
                            $("select[name^='" + DataId + "']").append('<option value="' + value.id + '">' + value.name_th + '</option>');
                        });
                    } else {
                        swal("ยกเลิก!", data.api_message, "error");
                    }
                }
            });
        };
        document.getElementById('VillageDistrictId').onchange = function() {
            var VillageDistrictId = this.value;
            var DataId = $(this).attr("data-id")
            var Data = {
                'VillageDistrictId': VillageDistrictId
            };
            $.ajax({
                url: '/getTambonsById',
                method: "POST",
                data: Data,
                success: function(data) {
                    if (data.api_status == 1) {
                        $("select[name^='" + DataId + "']").html('');
                        $("select[name^='" + DataId + "']").append('<option value="" selected>กรุณาเลือกอำเภอ/เขต</option>');

                        $.each(data.api_data, function(key, value) {
                            $("select[name^='" + DataId + "']").append('<option value="' + value.id + '">' + value.name_th + '</option>');
                        });
                    } else {
                        swal("ยกเลิก!", data.api_message, "error");
                    }
                }
            });
        };

        document.getElementById('VillageSubDistrictId').onchange = function() {
            var VillageSubDistrictId = this.value;
            var DataId = $(this).attr("data-id")
            var Data = {
                'VillageSubDistrictId': VillageSubDistrictId
            };
            $.ajax({
                url: '/getZipCodeById',
                method: "POST",
                data: Data,
                success: function(data) {
                    if (data.api_status == 1) {
                        $.each(data.api_data, function(key, value) {
                            $("#VillagePostCode").val(value.zip_code);
                        });
                    } else {
                        swal("ยกเลิก!", data.api_message, "error");
                    }
                }
            });
        };

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

        $("form[name=addVillage]").submit(function(event) {
            event.preventDefault();
            // if (!(BankMasterId)) {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Invalid BankMasterId',
            //         text: 'Please enter a valid Thai ID card number consisting of 13 digits.'
            //     });
            //     return;
            // }
            var VillageCodeText = $('#VillageCodeText').val();
            var VillageDbd = $('#VillageDbd').val();
            var VillageBdbCode = $('#VillageBdbCode').val();
            var VillageName = $('#VillageName').val();
            var Phone = $('#Phone').val();
            var Email = $('#Email').val();
            var DbdDate = $('#DbdDate').val();
            var VillageAddress = $('#VillageAddress').val();
            var VillageMoo = $('#VillageMoo').val();
            var VillageProvinceId = $('#VillageProvinceId').val();
            var VillageDistrictId = $('#VillageDistrictId').val();
            var VillageSubDistrictId = $('#VillageSubDistrictId').val();
            var VillagePostCode = $('#VillagePostCode').val();

            var formData = new FormData();
            formData.append('VillageCodeText', VillageCodeText);
            formData.append('VillageDbd', VillageDbd);
            formData.append('VillageBdbCode', VillageBdbCode);
            formData.append('VillageName', VillageName);
            formData.append('Phone', Phone);
            formData.append('Email', Email);
            formData.append('DbdDate', DbdDate);
            formData.append('VillageAddress', VillageAddress);
            formData.append('VillageMoo', VillageMoo);
            formData.append('VillageProvinceId', VillageProvinceId);
            formData.append('VillageDistrictId', VillageDistrictId);
            formData.append('VillageSubDistrictId', VillageSubDistrictId);
            formData.append('VillagePostCode', VillagePostCode);

            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการยื่นคำขอขึ้นทะเบียนใช่หรือไม่?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "ใช่",
                cancelButtonText: "ไม่",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/saveRegisterVillage',
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
                                        "/admin/transactionReqVillage";
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

        $("form[name=addAccountBookbank]").submit(function(event) {
            event.preventDefault();
            alert();
            
        });
        
    });
</script>
@endpush
@endsection