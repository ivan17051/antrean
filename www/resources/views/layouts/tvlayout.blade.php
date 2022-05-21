<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Antrean</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('theme/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('theme/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('theme/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('theme/dist/css/skins/_all-skins.min.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-toastr/toastr.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('theme/plugins/sweetalert/sweetalert.css')}}"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- jQuery 3 -->
    <script src="{{asset('theme/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- <script src="{{asset('theme/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('theme/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('theme/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- datepicker -->
    <script src="{{asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('theme/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
    <script src="{{asset('theme/plugins/ionsound/ion.sound.min.js')}}"></script>
    <script src="{{asset('theme/plugins/sweetalert/sweetalert.min.js')}}"></script>


    <style type="text/css">
        #loading {
            background:rgba(181, 181, 181, 0.5) url("{{asset('img/loading-spinner-blue.gif')}}") no-repeat center center;
            height: 100%;
            width: 100%;
            position: fixed;
            z-index: 9999;
            display: none;
        }

        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{asset('img/loading-spinner-blue.gif')}}") 50% 50% no-repeat rgb(249,249,249);
        }

        .policaption{
            display: block;
            font-weight: bold;
            font-size: 32px;
        }

        .antrianpoli {
            font-size: 16px;
            display: block;
        }
        .policaption2{
            font-weight: bold;
            font-size: 18pt;
        }
        .antrianpoli2 {
            font-size: 12pt;
            text-align: center;
        }
        .gotodetail {
            position:absolute;
            bottom:0;
            right:0;
            margin-bottom: 5px;
            margin-right: 15px;
            display: block;
            float: right;
        }

        .box-info-poli {
            padding: 5px 10px;
        }

        .box-info-number {
            border-top-left-radius: 2px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 2px;
            display: block;
            float: left;
            height: 160px;
            width: 160px;
            text-align: center;
            font-size: 100px;
            line-height: 160px;
            background: rgba(0,0,0,0.2);
        }

        .box-info {
            display: block;
            min-height: 160px;
            background: #fff;
            width: 100%;
            height: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 2px;
            margin-bottom: 15px;
        }

        .box-info-content {
            padding: 5px 10px;
            margin-left: 160px;
        }

        .bg-genap {
            background-color: #00c0ef !important;
            color: #fff;
        }

        .boxpanggilan {
            /*padding: 7% auto;*/
            /*min-height: : 600px;*/
            display: block;
            background: #fff;
            width: 100%;
            height: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 2px;
            margin-bottom: 15px;
        }

        .boxpanggilan .title1 {
            padding-top: 20px;
            font-size: 24px;
            font-weight: 400;
            text-align: center;
        }

        .boxpanggilan .title2 {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        .boxpanggilan .title3 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .boxpanggilan #date_time {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 25px 0;
        }

        .boxnomorpanggilan {
            background-color: #333333 !important;
            /*padding-bottom: 50px;*/
            height: 415px;
        }

        .boxnomorpanggilan #panggilannomor {
            font-size: 200px;
            font-weight: bold;
            text-align: center;
            display: block;
            padding: 0 !important;
            color: #ffffff;
        }

        .boxnomorpanggilan #panggilanpoli {
            font-size: 75px;
            font-weight: bold;
            text-align: center;
            display: block;
            /*margin-top: -50px;*/
            color: #ffffff;
        }

        .boxheader {
            /*padding: 7% auto;*/
            /*min-height: : 600px;*/
            display: block;
            /*background: #fff;*/
            width: 100%;
            height: 100%;
            /*box-shadow: 0 1px 1px rgba(0,0,0,0.1);*/
            border-radius: 2px;
            margin-bottom: 15px;
        }

        .boxheader .title1 {
            /*padding-top: 20px;*/
            font-size: 18px;
            font-weight: 400;
            text-align: center;
        }

        .boxheader .title2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
        }

        .boxheader .title3 {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            /*margin-bottom: 10px;*/
        }
    </style>
</head>
<body class="hold-transition skin-blue">
    <div class="loader"></div>
    <div class="wrapper">
        <div id="loading"></div>
        <div class="content-wrapper" style="margin-left: 0;">

            <section class="content">

            @yield('content')

            </section>
        </div>
        <footer class="main-footer" style="margin-left: 0;">
            <div class="pull-right hidden-xs" id="date_time">
                <b>IT</b> Dinkes
            </div>
            <strong>Copyright &copy; {{date('Y')}} Dinas Kesehatan Kota Surabaya
        </footer>

    </div>

<!-- AdminLTE App -->
<script src="{{asset('theme/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('theme/dist/js/demo.js')}}"></script>

<script src="{{asset('js/myapp.js?1')}}"></script>
<script src="{{asset('js/suaraantrian.js?2')}}"></script>

<script>
    $(window).on('load', function(){
        $(".loader").fadeOut("slow");
    });
    
    $(document).ready(function () {
        $('#loading').hide();
    });

    var Settings = {
        token: "{{ csrf_token() }}",
        baseurl: "{{url('')}}"
    }
</script>

@yield('jsx')
</body>
</html>