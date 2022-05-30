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
    <!-- <audio id="intro" src="{{asset('sound/male/intro.mp3')}}"></audio>
         <audio id="nomorantrian" src="{{asset('sound/male/nomorantrian.mp3')}}"></audio>
           <audio id="satu" src="{{asset('sound/male/satu.mp3')}}"></audio>
           <audio id="dua" src="{{asset('sound/male/dua.mp3')}}"></audio>
           <audio id="tiga" src="{{asset('sound/male/tiga.mp3')}}"></audio>
           <audio id="empat" src="{{asset('sound/male/empat.mp3')}}"></audio>
           <audio id="lima" src="{{asset('sound/male/lima.mp3')}}"></audio>
           <audio id="enam" src="{{asset('sound/male/enam.mp3')}}"></audio>
           <audio id="tujuh" src="{{asset('sound/male/tujuh.mp3')}}"></audio>
           <audio id="delapan" src="{{asset('sound/male/delapan.mp3')}}"></audio>
           <audio id="sembilan" src="{{asset('sound/male/sembilan.mp3')}}"></audio>
           <audio id="sepuluh" src="{{asset('sound/male/sepuluh.mp3')}}"></audio>
           <audio id="sebelas" src="{{asset('sound/male/sebelas.mp3')}}"></audio>
           <audio id="belas" src="{{asset('sound/male/belas.mp3')}}"></audio>
           <audio id="puluh" src="{{asset('sound/male/puluh.mp3')}}"></audio>
           <audio id="seratus" src="{{asset('sound/male/seratus.mp3')}}"></audio>
           <audio id="seribu" src="{{asset('sound/male/seribu.mp3')}}"></audio>
           <audio id="ratus" src="{{asset('sound/male/ratus.mp3')}}"></audio>
           <audio id="poli" src="{{asset('sound/male/poli.mp3')}}"></audio>
           <audio id="umum" src="{{asset('sound/male/umum.mp3')}}"></audio>
           <audio id="gigi" src="{{asset('sound/male/gigi.mp3')}}"></audio>
           <audio id="kia" src="{{asset('sound/male/kia.mp3')}}"></audio>
           <audio id="batra" src="{{asset('sound/male/batra.mp3')}}"></audio>
           <audio id="lansia" src="{{asset('sound/male/lansia.mp3')}}"></audio> -->
           
    <div class="loader"></div>
    <div class="wrapper">
        <div id="loading"></div>
        <div class="content-wrapper" style="margin-left: 0;">
            <!-- <section class="content-header">
                <h1>
                    {{$d['title']}}
                    <small>{{$d['subtitle']}}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section> -->

            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="boxheader">
                            <div class="col-md-4">
                                <img src="{{asset('/img/pemkot.png')}}" style="width: 100px;height: 90px;float: right;">
                            </div>
                            <div class="col-md-4">
                                <div class="title1">Dinas Kesehatan Kota Surabaya</div>
                                <div id="namaunitkerja" class="title2"></div>
                                <div id="alamatunitkerja" class="title3"></div>
                            </div>
                            <div class="col-md-4">
                                <img src="{{asset('/img/germas.jpeg')}}" style="width: 200px;height: 80px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-4">
                        <div class="boxpanggilan">
                            <div class="title1">Dinas Kesehatan Kota Surabaya</div>
                            <div id="namaunitkerja" class="title2"></div>
                            <div id="alamatunitkerja" class="title3"></div>
                            <div class="boxnomorpanggilan">
                                <div id="panggilannomor"></div>
                                <div id="panggilanpoli"></div>
                            </div>
                            <p id="date_time"></p>
                        </div>
                    </div> -->
                    <div class="col-md-12">
                        <div id="listpoliutama"></div>
                    </div>
                </div>
                <div class="row">
                    <div id="listpolilain"></div>
                </div>
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
<!-- <script src="{{asset('js/suaraantrian.js?1')}}"></script> -->

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

    var Settings = {
        token: "{{ csrf_token() }}",
        baseurl: "{{url('').'/'.app('request')->get('idunitkerja')}}"
    }
</script>

<script type="text/javascript">
var idunitkerja = "{{$d['idunitkerja']}}";

var idbppoli = 0;
var tanggal = 0;
// var iscall = 0;
var suaraaktif = 1;
var Poli = [];

function getPoliUtama(){
    $('#listpoliutama').empty();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/getlistpoli',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            var data = result.data;
            // console.log(data);
            // Poli = data;
            for (i = 0; i < data.length; i++) {
                var color = (i%2 == 0) ? 'red' : 'red';
                $('#listpoliutama').append('<div class="col-md-4"><div class="box-info">'+
                    '<span class="box-info-number bg-'+color+'" id="poli'+data[i]['id']+'">0</span>'+
                    '<div class="box-info-content">'+
                        '<span class="policaption">'+data[i]['nama']+'</span>'+
                        '<span class="antrianpoli">Nomor berikutnya : <span id="polin'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
						'<span class="antrianpoli">Jumlah antrean : <span id="jumlah'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        //'<span class="antrianpoli">Est. waktu dengan tindakan : <span id="estimasilayanantindakan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        //'<span class="antrianpoli">Est. waktu tanpa tindakan : <span id="estimasilayanan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        // '<div class"gotodetail"><a href="#" onclick="detail('+idunitkerja+','+data[i]['id']+');">Lihat</a></div>'+
                    '</div>'+
                    '</div></div>'
                );
                // idbppoli.
                Poli.push({ id: data[i].id, nama: data[i].nama, no: 0 });
            }
        },
        error: function(responsedata){
            var errors = responsedata.statusText;
            $('#loading').hide();
            toast("error", errors);
        }
    });

}

var streamnomor = new EventSource(Settings.baseurl+'/getnomorstream');

streamnomor.onmessage = function(event){
    // console.log(event.data);
    var data = JSON.parse(event.data);
    // console.log(data);
    var datanow = data.now;
    // console.log(data);
    for (i = 0; i < datanow.length; i++) {
        if(datanow[i]['idbppoli']){
            var ip = Poli.findIndex(x => x.id === datanow[i]['idbppoli']);
            $("#poli"+datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
            $("#poli"+datanow[i]['idbppoli']).removeClass('bg-blue bg-red');
            if(ip !== -1){
                var bgcolor = (Poli[ip].no !== datanow[i]['noantrian']) ? 'bg-red' : 'bg-blue';
                $("#poli"+datanow[i]['idbppoli']).addClass(bgcolor);
                Poli[ip].no = datanow[i]['noantrian'];
            }
        }
    }
    var datanext = data.next;
    for (i = 0; i < datanext.length; i++) {
        $("#polin"+datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
        $("#estimasi"+datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
		$("#jumlah"+datanext[i]['idbppoli']).html(datanext[i]['servesmax']);
        //$("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktunontindakan'] + ' menit');
        //$("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktutindakan']) + ' menit');
    }
}

function getNomor(){
    // $("#loading").show();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/getnomor',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            var datanow = result.data.now;
            // console.log(data);
            for (i = 0; i < datanow.length; i++) {
                $("#poli"+datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
            }
            var datanext = result.data.next;
            for (i = 0; i < datanext.length; i++) {
                $("#polin"+datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
                $("#estimasi"+datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
				$("#jumlah"+datanext[i]['idbppoli']).html(datanext[i]['servesmax']);
                //$("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktunontindakan'] + ' menit');
                //$("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktutindakan']) + ' menit');
            }
        },
        complete:function(data){
           setTimeout(getNomor, 5000);
        }
    });
    // $("#loading").hide();
}

// var streampanggilan = new EventSource(Settings.baseurl+'/getpanggilanantrianstream');

// streampanggilan.onmessage = function(event){
//     if (iscall == 0 && suaraaktif == 1) {
//         if(event.data){
//             var result = JSON.parse(event.data);
//             if(result){
//                 noantrian = result.noantrian;
//                 idbppoli = result.idbppoli;
//                 namapoli = result.namapoli;
//                 $("#panggilannomor").html(noantrian);
//                 $("#panggilanpoli").html("POLI "+namapoli);
//                 var idpanggilan = result.id;
//                 sound(noantrian, idbppoli);
//                 salert(namapoli,noantrian);
//                 setTimeout(function(){deletePanggilan(idpanggilan)}, 500);
//             } else {
//                 console.log('kosong');
//             }
//         }
//     }
// }

function getDataUnitkerja(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/getdataunitkerja',
        type: 'GET',
        data: {idunitkerja:idunitkerja},
        dataType: 'json',
        success: function (result) {
            if(result.data){
                var du = result.data;
                $("#namaunitkerja").html(du.nama);
                $("#alamatunitkerja").html(du.alamat1);
            } else {
                // toast("info", respon);
            }
        },
        error: function(responsedata){
            var errors = responsedata.statusText;
            $('#loading').hide();
            toast("error", errors);
        }
    });
}

function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    h = date.getHours();
    if(h<10)
    {
            h = "0"+h;
    }
    m = date.getMinutes();
    if(m<10)
    {
            m = "0"+m;
    }
    s = date.getSeconds();
    if(s<10)
    {
            s = "0"+s;
    }
    result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("'+id+'");','1000');
    return true;
}

$(function () {
  getDataUnitkerja();
  date_time("date_time");
  getPoliUtama();

  // setTimeout(getNomor, 2000);
  // setTimeout(cekPanggilan, 2000);
});

</script>
</body>
</html>