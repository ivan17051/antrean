<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Antrean | Dinas Kesehatan Surabaya</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('theme/plugins/iCheck/square/blue.css')}}">
  <link rel="stylesheet" href="{{asset('theme/plugins/select2/select2.css')}}">
  <link rel="stylesheet" href="{{asset('theme/dist/css/skins/_all-skins.min.css')}}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  
  <!-- /.login-logo -->
  <div class="login-box-body">
    <div class="login-logo" style="margin-bottom: 5px;">
      <b>Admin</b>Antrean
    </div>
    <!-- <p class="login-box-msg">Sign in to start your session</p> -->
    
    <!-- <form action="" autocomplete="off" method="get"> -->
      <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
      
      <div class="form-group">
        <select name="idunitkerja" id="idunitkerja" class="form-control" style="width: 100%;">
          <option></option>
        </select>
      </div>
      <!-- <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" name="username" placeholder="Username">
          <div class="input-group-addon">
            <i class="fa fa-user"></i>
          </div>
        </div>
      </div> -->
      <div class="form-group has-feedback">
        <div class="input-group">
          <input type="password" class="form-control" id="password" placeholder="Password">
          <div class="input-group-addon">
            <i class="fa fa-lock"></i>
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" id="btnlogin" onclick="login()" class="btn btn-danger btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
    <!-- </form> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('theme/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('theme/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('theme/plugins/select2/select2.full.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('theme/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('theme/dist/js/demo.js')}}"></script>
<script>
  var d=[{"id":42,"name":"Puskesmas Asemrowo"},{"id":148,"name":"Puskesmas Balas Klumprik"},{"id":41,"name":"Puskesmas Balongsari"},{"id":103,"name":"Puskesmas Bangkingan"},{"id":79,"name":"Puskesmas Banyu Urip"},{"id":44,"name":"Puskesmas Benowo"},{"id":122,"name":"Puskesmas Bulak Banteng"},{"id":51,"name":"Puskesmas Dr. Soetomo"},{"id":85,"name":"Puskesmas Dukuh Kupang"},{"id":61,"name":"Puskesmas Dupak"},{"id":67,"name":"Puskesmas Gading"},{"id":87,"name":"Puskesmas Gayungan"},{"id":53,"name":"Puskesmas Gundih"},{"id":73,"name":"Puskesmas Gunung Anyar"},{"id":81,"name":"Puskesmas Jagir"},{"id":88,"name":"Puskesmas Jemursari"},{"id":45,"name":"Puskesmas Jeruk"},{"id":138,"name":"Puskesmas Kalijudan"},{"id":70,"name":"Puskesmas Kalirungkut"},{"id":90,"name":"Puskesmas Kebonsari"},{"id":50,"name":"Puskesmas Kedungdoro"},{"id":84,"name":"Puskesmas Kedurus"},{"id":62,"name":"Puskesmas Kenjeran"},{"id":135,"name":"Puskesmas Keputih"},{"id":49,"name":"Puskesmas Ketabang"},{"id":75,"name":"Puskesmas Klampis Ngasem"},{"id":60,"name":"Puskesmas Krembangan Selatan"},{"id":46,"name":"Puskesmas Lidah Kulon"},{"id":47,"name":"Puskesmas Lontar"},{"id":104,"name":"Puskesmas Made"},{"id":40,"name":"Puskesmas Manukan Kulon"},{"id":71,"name":"Puskesmas Medokan Ayu"},{"id":74,"name":"Puskesmas Menur"},{"id":69,"name":"Puskesmas Mojo"},{"id":117,"name":"Puskesmas Moro Krembangan "},{"id":76,"name":"Puskesmas Mulyorejo"},{"id":83,"name":"Puskesmas Ngagel Rejo"},{"id":66,"name":"Puskesmas Pacarkeling"},{"id":80,"name":"Puskesmas Pakis"},{"id":57,"name":"Puskesmas Pegirian"},{"id":48,"name":"Puskesmas Peneleh"},{"id":56,"name":"Puskesmas Perak Timur"},{"id":68,"name":"Puskesmas Pucangsewu"},{"id":78,"name":"Puskesmas Putat Jaya"},{"id":65,"name":"Puskesmas Rangkah"},{"id":77,"name":"Puskesmas Sawahan"},{"id":984,"name":"Puskesmas Sawah Pulo"},{"id":43,"name":"Puskesmas Sememi"},{"id":89,"name":"Puskesmas Sidosermo"},{"id":58,"name":"Puskesmas Sidotopo"},{"id":64,"name":"Puskesmas Sidotopo Wetan"},{"id":55,"name":"Puskesmas Simolawang"},{"id":39,"name":"Puskesmas Simomulyo"},{"id":151,"name":"Puskesmas Siwalankerto"},{"id":54,"name":"Puskesmas Tambakrejo"},{"id":121,"name":"Puskesmas Tambak Wedi"},{"id":63,"name":"Puskesmas Tanah Kali Kedinding"},{"id":38,"name":"Puskesmas Tanjungsari"},{"id":52,"name":"Puskesmas Tembok Dukuh"},{"id":72,"name":"Puskesmas Tenggilis"},{"id":86,"name":"Puskesmas Wiyung"},{"id":82,"name":"Puskesmas Wonokromo"},{"id":59,"name":"Puskesmas Wonokusumo"},{"id":34,"name":"Laboratorium Kesehatan Daerah"}];

  $(function () {
    $("#idunitkerja").select2({
      placeholder: 'Unitkerja',
      allowClear: true
    });
    var options = $('#idunitkerja');
    $.each(d, function() {
      options.append($("<option />").val(this.id).text(this.name));
    });
    $('#idunitkerja').val(null).trigger("change");
  });

  function login(){
    if($('#password').val()==1){
      var link = '{{url('')}}/'+$('#idunitkerja').val();
      window.location.href = link;
    }
    
  }
</script>
</body>
</html>
