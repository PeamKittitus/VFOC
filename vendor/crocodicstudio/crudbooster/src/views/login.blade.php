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
    <style type="text/css">
        .login-page,
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
            overflow-x: hidden;
            overflow-y: auto;
            font-family: 'Kanit', sans-serif;
        }

        img {
            vertical-align: middle;
            border-style: none;
        }
    </style>
</head>

<body class="login-page">
    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient"
        style="background-color: #FFFFFF; position: relative;">
        <div class="container p-0">
            <div style="display: flex; align-items: center;">
                <div style="flex: 1;">
                    <a href="javascript:void(0)">
                        <img src="/img/messageImage_1660636852495.jpg" style="width: 271px; padding: 1.5rem;">
                    </a>
                </div>
                <a href="/register" class="btn-link text-break btn btn-info hidden-sm-down"
                    style="background-color: #8dcde1; color: #000; margin-left: auto;">ลงทะเบียน</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0"
            style="padding-top: 1.5rem; padding-bottom: 1.5rem; overflow-x: hidden;">
            <div class="col-lg-6">
                <img src="/img/logo-login.png" class="img-responsive" width="480" style="position: relative;" />
            </div>
            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto login-box" style="margin-left:70px">
                <!-- <div class="login-logo">
        <a href="{{ url('/') }}">
            <img title='{!! Session::get('appname') == 'CRUDBooster' ? '<b>CRUD</b>Booster' : CRUDBooster::getSetting('appname') !!}'
                 src='{{ CRUDBooster::getSetting('logo') ? asset(CRUDBooster::getSetting('logo')) : asset('/img/messageImage_1660636852495.jpg') }}'
                 style='max-width: 100%;max-height:170px'/>
        </a>
    </div> -->
                <!-- /.login-logo -->
                <h2 class="text-dark text-center fw-300 mb-3 d-sm-block"
                    style="padding:1.5rem; font-family: 'Kanit', sans-serif;">เข้าสู่ระบบ</h2>
                <!-- <h3 class="text-dark text-center fw-300 mb-3 d-sm-block" >ระบบ e-Hr</h3> -->
                <div class="login-box-body" style="border-radius: 10px;">

                    @if (Session::get('message') != '')
                        <div class='alert alert-warning'>
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <!-- <p class='login-box-msg'>{{ cbLang('login_message') }}</p> -->
                    <form autocomplete='off' action="{{ route('postLogin') }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        @if (!empty(config('services.google')))
                            <div style="margin-bottom:10px" class='row'>
                                <div class='col-xs-12'>

                                    <a href='{{ route('redirect', 'google') }}'
                                        class="btn btn-primary btn-block btn-flat"><i class='fa fa-google'></i>
                                        Google Login</a>

                                    <hr>
                                </div>
                            </div>
                        @endif
                        <div>ชื่อผู้ใช้</div>
                        <div class="form-group has-feedback">
                            <input autocomplete='off' type="text" class="form-control" name='email' required
                                placeholder="Username" style="border-radius: 5px" />
                            <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        <div>รหัสผ่าน</div>
                        <div class="form-group has-feedback">
                            <input autocomplete='off' type="password" class="form-control" name='password' required
                                placeholder="Password" style="border-radius: 5px" />
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        </div>

                        <!-- <div class='row'>
                <div class='col-xs-12' align="right"><p style="padding:10px 0px 10px 0px"><a
                                href='{{ route('getForgot') }}'>{{ cbLang('click_here') }}</a></p></div>
            </div> -->

                        <div style="margin-bottom:10px" class='row'>
                            <div class='col-xs-12'>
                                <button type="submit" class="btn btn-primary btn-block btn-flat"
                                    style="height: 50px; border-radius: 5px; background-color:cadetblue"><i
                                        class='glyphicon glyphicon-user'></i> {{ cbLang('button_sign_in') }}</button>
                            </div>
                        </div>


                    </form>

                    <br />
                    <!--a href="#">I forgot my password</a-->

                </div><!-- /.login-box-body -->

            </div><!-- /.login-box -->
        </div>
    </div>
    <div class="container"
        style="display: flex; justify-content: center; align-items: center; flex-direction: column;">
        {{-- <div class="flex-row d-flex justify-content-between" style="padding:auto;  display: flex;
        justify-content: space-between;">
            <img src="/img/logo_DE.png" class="col img-responsive" width="100px"
                style="display: inline-block; padding-right: 10px;" />
            <div>
                <span class="col" style="font-size: 18px;">
                    โครงการที่ได้รับทุนสนับสนุน
                </span><br>
                <span class="col" style="font-size: 18px;">
                    จากกองทุนพัฒนาดิจิทัลเพื่อเศรษฐกิจและสังคม
                </span>
            </div>
        </div>

        <span class="col" style="color: white; padding:auto;">
            2565 © National Village and Urban Community fund Office
            <a href="http://www.villagefund.or.th/" class="text-white opacity-40 fw-500"
                title="www.villagefund.or.th" target="_blank">www.villagefund.or.th</a>
        </span> --}}
        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white" hight="100px">
            {{-- <img src="/img/DigitalFundLogo.png" style="width: 35%;" class="hidden-sm-down"> --}}
            <img src="/img/DigitalFundLogo.png" style="width: 80%;" class="hidden-sm-up">
            <br>
            2565 © National Village and Urban Community fund Office &nbsp; <a href="http://www.villagefund.or.th/"
                class="text-white opacity-40 fw-500" title="www.villagefund.or.th"
                target="_blank">www.villagefund.or.th</a>
        </div>

    </div>


    <!-- jQuery 2.2.3 -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <!-- Bootstrap 3.4.1 JS -->
    <script src="{{ asset('vendor/crudbooster/assets/adminlte/bootstrap/js/bootstrap.min.js') }}" type="text/javascript">
    </script>
</body>

</html>
