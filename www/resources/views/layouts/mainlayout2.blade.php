<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>Antrean</title>
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
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('theme/plugins/iCheck/all.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="{{asset('theme/plugins/timepicker/bootstrap-timepicker.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('theme/plugins/select2/select2.css')}}">
  <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-toastr/toastr.min.css')}}"/>

  <!-- custom -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/custom.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
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
  </style>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="loader"></div>
<div id="loading"></div>
<div class="wrapper">
  @include('layouts.header')
  @include('layouts.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{$d['title']}}
        <small>{{$d['subtitle']}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{$d['title']}}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>IT</b> Dinkes
    </div>
    <strong>Copyright &copy; {{date('Y')}} Dinas Kesehatan Kota Surabaya
  </footer>

</div>
<!-- ./wrapper -->

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
<!-- daterangepicker -->
<script src="{{asset('theme/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('theme/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('theme/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('theme/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('theme/plugins/select2/select2.full.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('theme/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('theme/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('theme/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('theme/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('theme/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('theme/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
<script src="{{asset('theme/plugins/bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('theme/plugins/ionsound/ion.sound.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('theme/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('theme/dist/js/demo.js')}}"></script>

<script src="{{asset('js/myapp.js')}}"></script>
<script src="{{asset('theme/dist/js/custom.js')}}"></script>

<script>
    $(window).on('load', function(){
        $(".loader").fadeOut("slow");
    });

    // $(window).load(function(){
    //     $(".loader").fadeOut("slow");
    // });

    $(document).ready(function () {
        var url = document.URL;
        // alert(url);
        var segments = url.split('/');
        var action = segments[4].replace('#', '');
        // alert(action)
        if (action == "") {
            action = url;
        }
        // alert(action);
        // Will only work if string in href matches with location
        $('li a[href="' + action + '"]').parent().addClass('active');
        $('ul.treeview-menu a[href="' + action + '"]').parent().addClass('active');
        $('li ul a[href="' + action + '"]').parent().parent().parent().addClass('active');
        $('li ul a[href="' + action + '"]').parent().parent().parent().parent().parent().addClass('active');

        $(".date.date-picker").attr("autocomplete", "off");
        $(".date.date-picker input").attr("autocomplete", "off");

        $('#loading').hide();
    });

    function logout(){
      bootbox.confirm("Logout dari aplikasi?", function(result){
        if (result == true) {
          // console.log("logout");
          location = "{{route('logout')}}";
        }
      })
    }

    var Settings = {
        token: "{{ csrf_token() }}",
        baseurl: "{{url('')}}"
    }
</script>
@yield('ajax')
</body>
</html>