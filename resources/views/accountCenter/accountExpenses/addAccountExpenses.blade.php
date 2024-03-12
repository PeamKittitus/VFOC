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
        <h4 style="text-align: center;color:black">สร้างรายการจ่าย</h4>
        <form id="addAccountExpenses" name="addAccountExpenses" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-12 col-sm-12 box-right">
                    <div class="box-right-d">
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
                        <hr>
                        <div class="row mt-1">
                            <div class="col-12">
                                <h4 style="color: red;">รายการเบิกจ่าย</h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>ชื่อแผนงาน/โครงการ <span style="color: red;">*</span></label>
                                    <select class="form-control" id="AccountBudgetCenterSubId">
                                        <option value="0" disabled selected>----เลือกชื่อแผนงาน/โครงการ----</option>
                                        <?php foreach ($getAccountBudgetCenterSub as $BudgetSub) : ?>
                                            <option value="<?= $BudgetSub->id ?>"><?= $BudgetSub->AccName ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                    <label>วันที่ทำรายการ<span style="color: red;">*</span></label>
                                    <input type="date" class="form-control" id="ReceiverDate">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>รายการเบิกจ่าย<span style="color: red;">*</span></label>
                                    <textarea class="form-control" id="Detail" placeholder="รายการเบิกจ่าย"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>วงเงินงบประมาณ</label>
                                    <input class="form-control" id="RealAmount" disabled oninput="formatCurrencyData(this)">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>ยอดใช้จ่าย<span style="color: red;">*</span></label>
                                    <input class="form-control check_number" id="Amount" oninput="formatCurrency(this)" onchange="getValue(this)">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>คงเหลือ</label>
                                    <input class="form-control" id="TotalAmount" disabled oninput="formatCurrencyData(this)">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>สถานะ<span style="color: red;">*</span></label>
                                    <select class="form-control" id="Status">
                                        <option value="0" disabled selected>----เลือกสถานะ----</option>
                                        <option value="1">กำลังดำเนินการ</option>
                                        <option value="2">เสร็จสิ้น</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-12">
                                <div class="form-group" style="display: flex;justify-content:end;gap:1%">
                                    <button type="submit" class="btn" style="color: white ; background-color:#1dc9b7">บันทึก</button>
                                    <a href="/admin/transactionAccountBudgetCenter">
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
    function getValue(input) {
        var Amount = input.value;
        Amount = Amount.replace(/[^\d]/g, '');
        Amount = parseInt(Amount);

        var RealAmount = $('#RealAmount').val();
        RealAmount = RealAmount.replace(/[^\d]/g, '');
        RealAmount = parseInt(RealAmount);

        var TotalAmount = RealAmount - Amount;
        if (TotalAmount < 0) {
            Swal.fire({
                icon: 'error',
                title: 'ข้อมูลไม่ถูกต้อง',
                text: 'ไม่สามารถเบิกยอดค่าใช้จ่ายได้มากกว่าวงเงินงบประมาณ'
            });
            $('#Amount').val('');
            return;
        } else {
            $('#TotalAmount').val(TotalAmount);
            formatCurrencyData(document.getElementById("TotalAmount"));
        }

    }

    function formatCurrencyData(input) {
        input.value = input.value.replace(/[^\d]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function formatCurrency(input) {
        if (input.value.trim() !== "") {
            let value = input.value.replace(/[^0-9]/g, "");
            value = new Intl.NumberFormat('th-TH').format(value);
            input.value = value;
        }
    }
    $(document).ready(function() {

        $('#DivisionId').select2();
        $('#BudgetYear').select2();
        $('#AccountBudgetCenterSubId').select2();
        $('#Status').select2();

        // เลือก textarea โดยใช้ id
        const textarea = document.getElementById('Detail');

        // เพิ่ม event listener เมื่อมีการเปลี่ยนแปลงใน textarea
        textarea.addEventListener('input', function() {
            // ปรับขนาดของ textarea ให้เหมาะสมกับข้อความที่มี
            this.style.height = 'auto'; // ตั้งค่าสูงเป็น 'auto' เพื่อให้ textarea ปรับตามขนาดข้อความใหม่
            this.style.height = (this.scrollHeight) + 'px'; // ตั้งค่าสูงใหม่ของ textarea ตามความสูงของข้อความ
        });

        document.getElementById('AccountBudgetCenterSubId').onchange = function() {
            var AccountBudgetCenterSubId = this.value;
            var Data = {
                'AccountBudgetCenterSubId': AccountBudgetCenterSubId
            };
            $.ajax({
                url: '/getAccountBudgetCenterSubDetail',
                method: "POST",
                data: Data,
                success: function(data) {
                    if (data.api_status == 1) {
                        $('#RealAmount').val(data.api_data.TotalAmount);
                        formatCurrencyData(document.getElementById("RealAmount"));
                    } else {
                        swal("ยกเลิก!", data.api_message, "error");
                    }
                }
            });
        };

        $("form[name=addAccountExpenses]").submit(function(event) {
            event.preventDefault();

            var DivisionId = $('#DivisionId').val();
            var AccountBudgetCenterSubId = $('#AccountBudgetCenterSubId').val();
            var BudgetYear = $('#BudgetYear').val();
            var ReceiverDate = $('#ReceiverDate').val();
            var Detail = $('#Detail').val();
            var Amount = $('#Amount').val();
            Amount = Amount.replace(/[^\d]/g, '');
            Amount = parseInt(Amount);
            var Status = $('#Status').val();
            var TotalAmount = $('#TotalAmount').val();
            TotalAmount = TotalAmount.replace(/[^\d]/g, '');
            TotalAmount = parseInt(TotalAmount);

           // Usage
            const fieldsToCheck = [
                { value: DivisionId, message: 'กรุณาเลือกฝ่าย' },
                { value: AccountBudgetCenterSubId, message: 'กรุณาเลือกแผนงาน/โครงการ' },
                { value: BudgetYear, message: 'กรุณาเลือกปีงบประมาณ' },
                { value: ReceiverDate, message: 'กรุณาเลือกวันที่ทำรายการ' },
                { value: Detail, message: 'กรุณากรอกรายการเบิกจ่าย' },
                { value: Amount, message: 'กรุณากรอกยอดใช้จ่าย' },
                { value: Status, message: 'กรุณาเลือกสถานะ' }
            ];

            if (!validateForm(fieldsToCheck)) {
                return false;
            }

            var formData = new FormData();

            formData.append('DivisionId', DivisionId);
            formData.append('AccountBudgetCenterSubId', AccountBudgetCenterSubId);
            formData.append('BudgetYear', BudgetYear);
            formData.append('ReceiverDate', ReceiverDate);
            formData.append('Detail', Detail);
            formData.append('Amount', Amount);
            formData.append('Status', Status);
            formData.append('TotalAmount', TotalAmount);

            confirmAction(formData);
        });

        // Function to handle form submission confirmation
        function confirmAction(formData) {
            Swal.fire({
                title: "ยืนยัน",
                text: "คุณต้องการสร้างรายการจ่าย",
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
                url: '/addAccountExpensesApi',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if(response.api_message == 'Success'){
                        handleSuccess();
                    }else{
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
                    window.location.href = "/admin/transactionAccountBudgetCenter";
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