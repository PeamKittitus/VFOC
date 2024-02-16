<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ cbLang('page_title_login') }} : {{ Session::get('appname') }}</title>
    <meta name='generator' content='CRUDBooster' />
    <meta name='robots' content='noindex,nofollow' />
    <link rel="shortcut icon" href="{{ CRUDBooster::getSetting('favicon') ? asset(CRUDBooster::getSetting('favicon')) : asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- support rtl-->
    @if (in_array(App::getLocale(), ['ar', 'fa']))
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link href="{{ asset('vendor/crudbooster/assets/rtl.css') }}" rel="stylesheet" type="text/css" />
    @endif

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- font kanit -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap');
    </style>
    <!-- end font kanit -->
    <link rel='stylesheet' href='{{ asset('vendor/crudbooster/assets/css/main.css') }}' />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <style type="text/css">
        .register-page {

            /* background: {{ CRUDBooster::getSetting('login_background_color') ?: '#9ed8e1' }} url('{{ CRUDBooster::getSetting('login_background_image') ? asset(CRUDBooster::getSetting('login_background_image')) : asset('vendor/crudbooster/assets/bg_blur3.jpg') }}'); */
            color: {
                    {
                    CRUDBooster: :getSetting("login_font_color")?:'#ffffff'
                }
            }

            !important;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            background-color: #9ed8e1;
        }

        .login-box,
        .register-box {
            margin: 2% auto;
        }

        .login-box-body {
            /* box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.8); */
            background: rgba(255, 255, 255, 0.9);

            color: {
                    {
                    CRUDBooster: :getSetting("login_font_color")?:'#666666'
                }
            }

            !important;
        }

        html,
        body {
            font-family: 'Kanit', sans-serif !important;
        }

        .kanit-font {
            font-family: 'Kanit', sans-serif !important;
        }

        a:link {
            color: #B0E4EF;
            text-decoration: none;
        }

        a:visited {
            color: #B0E4EF;
            text-decoration: none;
        }

        a:hover {
            color: #B0E4EF;
            text-decoration: none;
        }

        a:active {
            color: #B0E4EF;
            text-decoration: none;
        }

        .header-icon:not(.btn)[data-toggle="dropdown"] {}

        .header-icon:not(.btn) {
            min-width: 3.125rem;
            text-align: center;
            overflow: visible;
        }

        .header-icon:not(.btn) .profile-image {
            width: 3rem;
            height: auto;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        /* CSS HEADER */

        @media only screen and (max-width: 992px) .page-wrapper .page-header {
            padding: 0 1.5rem;
            width: 100%;
            border-bottom: 1px solid rgba(0, 0, 0, 0.09);
        }

        .page-header {
            background-color: #fff;
            -webkit-box-shadow: 0px 0px 28px 0px rgba(86, 61, 124, 0.13);
            box-shadow: 0px 0px 28px 0px rgba(86, 61, 124, 0.13);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            height: 4.125rem;
            position: relative;
            z-index: 1000;
            -webkit-box-ordinal-group: 2;
            -ms-flex-order: 1;
            order: 1;
            justify-content: space-between;
            margin: 0 0 20px 0;
        }

        .subheader-title {
            font-size: 1.375rem;
            font-weight: 500;
            color: #505050;
            text-shadow: #fff 0 1px;
            margin: 0;
            -webkit-box-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .fw-700 {
            font-weight: 400 !important;
            font-family: 'Kanit', sans-serif !important;
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -0.75rem;
            margin-left: -0.75rem;
            justify-content: center;
            margin-bottom: 15px;
        }

        .mb-0,
        .my-0 {
            margin-bottom: 10px !important;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: 1.3;
            font-weight: 400;
        }

        .card {
            border-radius: 10px;

        }


        /* CSS Dropdown */

        .dropdown-header.bg-trans-gradient {
            padding: 1.25rem 1.5rem;
        }

        .bg-trans-gradient {
            background: linear-gradient(250deg, #039dab, #9ed8e1);
        }

        .rounded-top {
            border-radius: 4px 4px 0 0;
        }

        .pb-4,
        .py-4 {
            padding-bottom: 1.5rem !important;
        }

        .pt-4,
        .py-4 {
            padding-top: 1.5rem !important;
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

        .rounded-top {
            border-top-left-radius: 4px !important;
            border-top-right-radius: 4px !important;
        }

        .dropdown-header {
            display: block;
            padding: 0.3125rem 1.5rem;
            margin-bottom: 0;
            font-size: 0.75rem;
            color: #868e96;
            white-space: nowrap;
        }

        .user-profile-container {
            position: relative;
            display: inline-block;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            animation: fadeInUp 0.3s ease-in-out;
            padding: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-menu .dropdown-item {
            font-weight: 400;
            cursor: pointer;
        }

        a:link {
            color: #B0E4EF;
            text-decoration: none;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.75rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }

        .color-white {
            color: #fff;
        }

        .info-card-text {
            font-size: 0.875rem;
            display: inline-block;
            vertical-align: middle;
            font-weight: 500;
            line-height: 1.35;
        }

        .profile-image {
            width: 3.125rem;
            height: 3.125rem;
        }

        .align-items-center {
            -webkit-box-align: center !important;
            -ms-flex-align: center !important;
            align-items: center !important;
        }

        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid #f3f3f3;
        }
    </style>
</head>


<div class="page-wrapper ">
    <div class="page-inner">
        <div class="page-content-wrapper">
            <header class="page-header" role="banner" style="background-color: #B0E4EF ; height: 70px; padding-left: 15px ;padding-right: 15px"">
                <div class=" hidden-md-down dropdown-icon-menu">
                <img src="/img/villagefund_1.png" alt="กองทุนหมู่บ้าน (สทบ.)" width="50%" height="auto" aria-roledescription="logo">
        </div>
        <div class="ml-auto d-flex justify-content-between">
            <div class="user-profile-container dropdown">
                <a href="#" data-toggle="dropdown" title="Email" class="header-icon d-flex align-items-center justify-content-center ml-2" aria-expanded="false">
                    <img src="/img/avatars/user-avatar-vfoc.png" class="profile-image rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-animated dropdown-lg dropdown-menu-right" style="width: 300px;">
                    <!-- Dropdown content -->
                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                            <span class="mr-2" style="margin-right: 10px">
                                <img src="/img/avatars/user-avatar-vfoc.png" class="rounded-circle profile-image">
                            </span>
                            <div class="info-card-text">
                                <div class="fs-lg text-truncate text-truncate-lg">Firstname Last</div>
                                <span class="text-truncate text-truncate-md opacity-80">Email</span>
                            </div>
                        </div>
                    </div>
                    <a href="/Home/ProfileData" class="dropdown-item" style="margin: 10px">
                        <span data-i18n="drpdwn.settings">แก้ไขข้อมูลส่วนตัว</span>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a href="#" class="dropdown-item" data-action="app-fullscreen" style="margin: 10px">
                        <span data-i18n="drpdwn.fullscreen">แสดงเติมจอ</span>
                        <i class="float-right text-muted fw-n" style="float: right !important; padding-right: 15px">F11</i>
                    </a>
                    <div class="dropdown-divider m-0"></div>
                    <a class="dropdown-item fw-500 pt-3 pb-3" href="/Identity/Account/Logout?returnUrl=%2F" style="margin: 10px">
                        <span data-i18n="drpdwn.page-logout">ออกจากระบบ</span>
                        <span class="float-right fw-n"></span>
                    </a>
                </div>
            </div>
        </div>
        </header>

        <main id="js-page-content" role="main" class="page-content ">
            <div class="row mt-6 mb-6">
                <h1 class="subheader-title text-center col-lg-12 kanit-font">
                    <span class="font-weight-bold" style="font-size: 2.2rem">ระบบจัดการ
                        โครงการบริหารกองทุนหมู่บ้านและชุมชนเมืองด้วยระบบเทคโนโลยีสารสนเทศ (VFOC Platform)</span>
                </h1>
                <h4 class="text-center col-lg-12 mt-3 kanit-font">
                    <span class="font-weight-bold" style="font-size: 1.8rem">ระบบบริหารจัดการข้อมูลและการจัดเก็บของกองทุนหมู่บ้านและชุมชนเมืองในรูปแบบแพลตฟอร์มเดียวกัน
                        ซึ่งโครงการได้ออกแบบให้เป็น "VFOC Platform" โดยจะเชื่อมโยงไปยังทุกระบบ</span>
                </h4>
            </div>
            <div class="row col-lg-12" id="menuContainer"></div>
        </main>

    </div>
</div>
</div>
<script src="{{ asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
</script>
<script>
    // Function to fetch data from the API endpoint
    function fetchMenus() {
        // Make an Ajax request to your API endpoint
        $.ajax({
            url: 'getMenus',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.api_status == 1) {
                    buildMenuHtml(data.data);
                }
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Function to build HTML based on the fetched data
    function buildMenuHtml(menuData) {
        var menuContainer = $('#menuContainer');

        // Iterate through the data and build HTML
        $.each(menuData, function(index, item) {
            var menuItemHtml = '';

            // Use the data from each menu item
            var linkAttribute = (item.IsLink === 1) ? `href="${item.PathLink}" data-id="${item.id}"` : `href="${item.PathLink}"`;
            var imgSrc = item.ImageMenu;
            var menuName = item.name;
            if (item.IsLink === 1) {
                menuItemHtml = `
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a data-id="${item.id}" class='activeToken'>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4" style="background-color: #B0E4EF;">
                                            <img src="${imgSrc}" class="img-responsive" style="width:100%">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ${menuName}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                `;
            } else {
                menuItemHtml = `
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a ${linkAttribute}>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4" style="background-color: #B0E4EF;">
                                            <img src="${imgSrc}" class="img-responsive" style="width:100%">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ${menuName}
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                `;
            }
            // Append the built HTML to the container
            menuContainer.append(menuItemHtml);
        });
        // Add click event listener
        $('.activeToken').on('click', function() {
            var MenuId = $(this).data('id');
            var formData = new FormData();
            formData.append('MenuId', MenuId);
            $.ajax({
                url: 'RedirectToOutSite',
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.valid == 1){
                        window.open(data.data, '_blank');
                    }
                },
                error: function(error) {
                    console.error('Error fetching data:', error);
                }
            });
        });

    }

    // Call
    fetchMenus();
</script>
</body>

</html>