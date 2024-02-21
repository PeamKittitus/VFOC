@extends('crudbooster::admin_template')
@section('content')

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
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

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
                width: 100% !important;
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
                /* padding: 0.5rem 0.875rem; */
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

            label {
                font-size: 20px !important;
                margin-left: -10px;
                margin-bottom: 5px !important;
            }

            input::placeholder,
            input {
                font-size: 14px;
                color: #333;
            }

        </style>
    </head>

    <body>

        <div>
            <ol class="breadcrumb page-breadcrumb">
                <li class="breadcrumb-item"><a href="/Home/Index">หน้าหลัก</a></li>
                <li class="breadcrumb-item"><a href="/admin/accountBudget">ผังบัญชีงบประมาณโครงการ</a></li>
                <li class="breadcrumb-item active">สร้างใหม่</li>
            </ol>
        </div>


        <div class="flex-1 bg-pattern" style="background: #8dcde1">
            <div class="card p-4 rounded-plus bg-faded">
                <form id="addaccountbudget" name="addaccountbudget" method="post" enctype="multipart/form-data">

                    <div class="card-body pb-1">
                        <div class="section-title">
                            <h4 class='font'><strong style="font-weight: 400;"><i class="fa fa-file-text-o"
                                        aria-hidden="true" style='margin-right: 10px'></i>สร้างใหม่</strong></h4>
                        </div>
                        <hr />
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="IDCard">ปีงบระมาณ</label> <br>
                                <select id="BudgetYear" class="select2 select2-container2"
                                    style="height: 50px !important;">
                                    <option value="2572">2572</option>
                                    <option value="2571">2571</option>
                                    <option value="2570">2570</option>
                                    <option value="2569">2569</option>
                                    <option value="2568">2568</option>
                                    <option value="2567">2567</option>
                                    <option value="2566">2566</option>
                                    <option value="2565">2565</option>
                                    <option value="2564">2564</option>
                                    <option value="2563">2563</option>
                                    <option value="2563">2562</option>
                                </select>
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="Firstname">ชื่องบประมาณโครงการ<strong
                                        style="color:red">*</strong></label>
                                <input type="text" class="form-control" placeholder="ชื่องบประมาณโครงการ"
                                    id="AccName" value="{{$getAccountBudget->AccName}}">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="Firstname">จำนวนเงิน<strong style="color:red">*</strong></label>
                                <input type="text" class="form-control checkNumber" placeholder="จำนวนเงิน" id="Amount" 
                                oninput="formatAmount(this)" value="{{$getAccountBudget->Amount}}">
                                <i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
                            </div>
                        </div>
                        <div class="form-button-group  transparent">
                            <button type="submit" class="btn btn-success btn-block"
                                style='background-color: #1ab3a3;width: 150px ; float: right;'>
                                <i class="fa fa-save" style='padding-right:10px'></i>บันทึก</button>
                        </div>

                    </div>
                    <input type="hidden" id="AccId" value="{{$getAccountBudget->id}}">
                </form>
            </div>
        </div>



    </body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.select2').select2();
        });

        var getAccountBudget = @json($getAccountBudget);
        $("#BudgetYear").val(getAccountBudget.BudgetYear);

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
        function formatAmount(input) {
            let value = input.value.replace(/[^\d.]/g, '');

            let parts = value.split('.');
            let integerPart = parts[0];
            let decimalPart = parts.length > 1 ? '.' + parts[1] : '';

            integerPart = integerPart.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            value = integerPart + decimalPart;

            input.value = value;
        }
        $(".checkNumber").keypress(function() {
            var dInput = $(this).val();
            return bannedKey(dInput, 1);

        });

        

        $(document).ready(function() {


            $("form[name=addaccountbudget]").submit(function(event) {
                event.preventDefault();
                
                var AccId = $('#AccId').val();
                var AccName = $('#AccName').val();
                var BudgetYear = $('#BudgetYear').val();
                var Amount = $('#Amount').val();
                // Remove commas from the value
                Amount = Amount.replace(/,/g, '');
                var formData = new FormData();
                formData.append('AccId', AccId);
                formData.append('AccName', AccName);
                formData.append('BudgetYear', BudgetYear);
                formData.append('Amount', Amount);
                // for (var pair of formData.entries()) {
                //     console.log(pair[0]+ ', ' + pair[1]); 
                // }

                if (AccName == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Project Name field is missing',
                        text: 'Please enter Project Name.'
                    });
                    return;
                }

                if (BudgetYear == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'BudgetYear field is missing',
                        text: 'Please enter BudgetYear.'
                    });
                    return;
                }

                if (Amount == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Budget field is missing',
                        text: 'Please enter Budget.'
                    });
                    return;
                }

                
                Swal.fire({
                    title: "ยืนยัน",
                    text: "คุณต้องการเพิ่มโครงการใช่หรือไม่?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/editAccountBudget',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                Swal.fire({
                                    title: "Success",
                                    text: "Form data saved successfully!",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "OK",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href =
                                            "/admin/accountBudget";
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
@endsection
