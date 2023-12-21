<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>{{ cbLang('page_title_login') }} : {{ Session::get('appname') }}</title>
    <meta name='generator' content='CRUDBooster' />
    <meta name='robots' content='noindex,nofollow' />
    <link rel="shortcut icon"
        href="{{ CRUDBooster::getSetting('favicon') ? asset(CRUDBooster::getSetting('favicon')) : asset('vendor/crudbooster/assets/logo_crudbooster.png') }}">

    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset('vendor/crudbooster/assets/adminlte/dist/css/AdminLTE.min.css') }}" rel="stylesheet"
        type="text/css" />

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
        .card{
            border-radius: 10px;

        }


        /* CSS Dropdown */
    </style>
</head>


<div class="page-wrapper ">
    <div class="page-inner">
        <div class="page-content-wrapper">
            <header class="page-header" role="banner"
                style="background-color: #B0E4EF ; height: 70px; padding-left: 15px ;padding-right: 15px"">
                <div class="hidden-md-down dropdown-icon-menu">
                    <img src="/img/villagefund_1.png" alt="กองทุนหมู่บ้าน (สทบ.)" width="50%" height="auto"
                        aria-roledescription="logo">
                </div>
                <div class="ml-auto d-flex justify-content-between">
                    <div class="user-profile-container dropdown">
                        <a href="#" data-toggle="dropdown" title="Email"
                            class="header-icon d-flex align-items-center justify-content-center ml-2"
                            aria-expanded="false">
                            <img src="/img/avatars/user-avatar-vfoc.png" class="profile-image rounded-circle">
                        </a>
                        <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                            <!-- Dropdown content -->
                            <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                    <span class="mr-2">
                                        <img src="/img/demo/avatars/user-avatar-vfoc.png"
                                            class="rounded-circle profile-image">
                                    </span>
                                    <div class="info-card-text">
                                        <div class="fs-lg text-truncate text-truncate-lg">Firstname Last</div>
                                        <span class="text-truncate text-truncate-md opacity-80">Email</span>
                                    </div>
                                </div>
                            </div>
                            <a href="/Home/ProfileData" class="dropdown-item">
                                <span data-i18n="drpdwn.settings"> แก้ไขข้อมูลส่วนตัว</span>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                <span data-i18n="drpdwn.fullscreen"> แสดงเติมจอ</span>
                                <i class="float-right text-muted fw-n">F11</i>
                            </a>
                            <div class="dropdown-divider m-0"></div>
                            <a class="dropdown-item fw-500 pt-3 pb-3" href="/Identity/Account/Logout?returnUrl=%2F">
                                <span data-i18n="drpdwn.page-logout"> ออกจากระบบ</span>
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
                        <span
                            class="font-weight-bold" style="font-size: 1.8rem">ระบบบริหารจัดการข้อมูลและการจัดเก็บของกองทุนหมู่บ้านและชุมชนเมืองในรูปแบบแพลตฟอร์มเดียวกัน
                            ซึ่งโครงการได้ออกแบบให้เป็น "VFOC Platform" โดยจะเชื่อมโยงไปยังทุกระบบ</span>
                    </h4>
                </div>

                {{-- <div class="row col-lg-12">
                    @{
                    foreach (var item in Model.OrderBy(o => o.Id))
                    {
                    if (item.IsLink == true)
                    {
                    <div class="col-lg-@colposter col-xl-@colposter mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: @colorbg">
                            <a href="javascript:void(0)" class="activeToken" data-menuid="@item.Id">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: @colorbg;">

                                            <img src="@item.ImageMenu" class="img-responsive" style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:@colorbg">
                                            <h1 class="mb-0 fw-700" style="font-size:@fontsizing;color:#039dab">
                                                @item.MenuName</h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    }
                    else
                    {
                    <div class="col-lg-@colposter col-xl-@colposter mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: @colorbg">
                            <a href="@item.PathLink">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: @colorbg;">

                                            <img src="@item.ImageMenu" class="img-responsive" style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:@colorbg">
                                            <h1 class="mb-0 fw-700" style="font-size:@fontsizing;color:#039dab">
                                                @item.MenuName </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    }

                    }
                    }         
                </div> --}}

                <div class="row col-lg-12">
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="/Home/Index">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/Dashboard.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                รายงานสรุปภาพรวม </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="javascript:void(0)" class="activeToken" data-menuid="2">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eOffice.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบงานสารบรรณ</h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="/ElectronicProjects/Index">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eProject.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบยื่นขอโครงการ </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="/EAccount/Index">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eAccount.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบบริหารงบประมาณ </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="/Villages/VillageIndex">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eRegister.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบบริหารสมาชิก </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="/NewsLatter/IndexAll">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eCommunication.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบสื่อสารสมาชิก </h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-3 mb-1">
                        <div class="card p-1 rounded-plus" style="background-color: #B0E4EF">
                            <a href="javascript:void(0)" class="activeToken" data-menuid="53">
                                <div class="row ">
                                    <div class="col-lg-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center p-4"
                                            style="background-color: #B0E4EF;">

                                            <img src="/img/backgrounds/eHR.png" class="img-responsive"
                                                style="width:100%">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-center py-3" style="background-color:#B0E4EF">
                                            <h1 class="mb-0 fw-700" style="font-size:3rem;color:#039dab">
                                                ระบบทรัพยากรบุคคล</h1>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

            </main>

        </div>
    </div>
</div>

<!-- jQuery 2.2.3 -->
<script src="{{ asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.4.1 JS -->
<script src="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
</script>
</body>

</html>
