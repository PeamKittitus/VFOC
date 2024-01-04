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

        .mb-g {
            margin-bottom: 1.5rem !important;
        }

        .card,
        .card-group {
            -webkit-box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
            box-shadow: 0px 0px 13px 0px rgba(74, 53, 107, 0.08);
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

        .card> :last-child,
        .card-group> :last-child {
            margin-bottom: 0px;
        }

        .pl-4,
        .px-4 {
            padding-left: 1.5rem !important;
        }

        .pr-4,
        .px-4 {
            padding-right: 1.5rem !important;
        }

        .pb-0,
        .py-0 {
            padding-bottom: 0 !important;
        }

        .pb-3,
        .py-3 {
            padding-bottom: 1rem !important;
        }

        .pt-2,
        .py-2 {
            padding-top: 0.5rem !important;
        }

        .flex-row {
            -webkit-box-orient: horizontal !important;
            -webkit-box-direction: normal !important;
            -ms-flex-direction: row !important;
            flex-direction: row !important;
        }

        .d-flex {
            display: -webkit-box !important;
            display: -ms-flexbox !important;
            display: flex !important;
        }

        .fw-500 {
            font-weight: 500 !important;
        }

        .flex-1 {
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .text-dark {
            color: #505050 !important;
        }

        .opacity-70 {
            opacity: 0.7;
        }

        .fs-xs {
            font-size: 1rem !important;
        }

        .text-muted {
            color: #868e96 !important;
        }
    </style>
</head>
@php
setlocale(LC_TIME, 'th_TH.utf8'); // Set Thai locale

$formattedDate = Carbon::parse($getNewsById->Created_at)
->locale('th_TH')
->isoFormat('LL LTS'); // Format date with month and year in Thai
@endphp

<body>

    <div>
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/Home/Index">หน้าหลัก</a></li>
            <li class="breadcrumb-item"><a href="/EAccount/StructureIndex">รายละเอียดข่าวสาร</a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-g">
                <div class="card-body pb-0 px-4">
                    <div class="d-flex flex-row pb-3 pt-2">
                        <h2 class="mb-0 flex-1 text-dark fw-500">
                            {{ $getNewsById->TransactionTitle }}
                        </h2>
                    </div>
                    <div class="pb-3 pt-2">
                        <h1 class="title" style="box-sizing: inherit; outline: none; margin: 20px 0px 15px; font-family: rsu, sans-serif; line-height: 40px; color: rgb(62, 69, 85); font-size: 36px; letter-spacing: 0.7px;">{!! $getNewsById->TransactionDetail !!}</h1>
                    </div>
                    <div class="pb-3 pt-2">
                        <label>เอกสารแนบไฟล์ : </label>
                        <a target="_blank" href="{{asset($getNewsById->FilePath) }}" download="{{$getNewsById->FileName}}">{{ $getNewsById->FileName }}</a>
                    </div>
                    <div class="d-flex flex-row pb-3 pt-2" style="justify-content: end;">
                        <span class="text-muted fs-xs opacity-70">
                            สร้างโดย คุณ {{ $getNewsById->firstName }} {{ $getNewsById->lastName }} วันที่ {{ $formattedDate }} น.
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2"></div>
    </div>



</body>
@endsection