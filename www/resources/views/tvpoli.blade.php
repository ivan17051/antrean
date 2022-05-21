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
            font-size: 48px;
        }

        .antrianpoli {
            font-size: 28px;
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
            height: 250px;
            width: 250px;
            text-align: center;
            font-size: 225px;
            line-height: 250px;
            background: rgba(0,0,0,0.2);
        }

        .box-info {
            display: block;
            min-height: 250px;
            background: #fff;
            width: 100%;
            height: 100%;
            box-shadow: 0 1px 1px rgba(0,0,0,0.1);
            border-radius: 2px;
            margin-bottom: 15px;
        }

        .box-info-content {
            padding: 5px 10px;
            margin-left: 250px;
            height: 250px;
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
            font-size: 32px;
            font-weight: 400;
            text-align: center;
        }

        .boxheader .title2 {
            font-size: 42px;
            font-weight: bold;
            text-align: center;
        }

        .boxheader .title3 {
            font-size: 24px;
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
                <div id="boxlistpoli">
                    <div class="row" id="listpoli"></div>
                </div>
                <div id="viewantrian">
                    <div class="row">
                        <div class="col-md-12 " id="barisbutton">
                            <button type="button" class="btn btn-default" onclick="kembali();"><i class="fa fa-reply"></i></button>
                            <button type="button" class="btn btn-default pull-right" id="tombolsuara" onclick="setsuara();"><i class="glyphicon glyphicon-volume-off"></i></button>
                        </div>
                    </div>
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
                        <!-- <div class="col-md-12"> -->
                            <div id="listpoliutama" style="margin-top: 20px;"></div>
                        <!-- </div> -->
                    </div>
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

<script src="{{asset('js/myapp.js')}}"></script>
<script src="{{asset('js/suaraantrian.js')}}"></script>

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
    baseurl: "{{url('')}}"
}

var idunitkerja = "{{$d['idunitkerja']}}";
var suaraaktif = 0;

var listpoli = [];

function setsuara(){
    if (suaraaktif == 1) {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-off">');
        localStorage.setItem("suaraantrian", 0);
        suaraaktif = 0;
    } else {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-up">');
        localStorage.setItem("suaraantrian", 1);
        suaraaktif = 1;
    }
    settombolsuara();
    ceksuara();
}

function settombolsuara(){
    if (suaraaktif == 1) {
        $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-up">');
    } else {
        $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-off">');
    }
}

function getpoliaktif(){
    $.ajax({
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: Settings.baseurl+'/getlistpoli',
        // data: { idshift: idshift },
        dataType: 'json',
        async: false,
        success: function (result) {
            var data = result.data;
            createlistmodal(data);
        },
        error: function (result) {
            console.log(result.statusText);
        }
    }).done( () => {
        // console.table(listpoli)
    })
}

function createlistmodal(data){
    // $("#boxpoliantrian").empty()
    var i = 0;
    console.log(data);
    var box = data.map(function (poli) {
        var x = $('<div class="col-md-6" style="margin-top:10px;">' +
            '<button type="button" class="btn btn-block btn-lg btn-danger buttonpoli" style="font-size: 32px;">' + poli.nama + '</button>' +
        '</div>');
        x.on('click' , function(){
            // namapoli = poli.nama
            setpoli(poli.id)
        });
        return x;
    })
    $("#listpoli").html('').append(box);
    // showmodalsetup();
}

function setpoli(id) {
    $("#loading").show();
    $("#boxlistpoli").hide('slow');
    $("#viewantrian").show('slow');
  
    listpoli[0] = id;
    console.log(listpoli);
    getlistpoli();
    setTimeout(getNomor, 2000);
    setTimeout(ceksuara, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
    // setTimeout(getNomor, 2000);
    $("#loading").hide();
}

function kembali(){
    // $("#boxlistpoli").show('slow');
    // $("#viewantrian").hide('slow');
    location.reload();
}

function getlistpoli(){
    $('#listpoliutama').empty();
    console.log(listpoli);
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getlistpoli',
            type: 'GET',
            data: {poli: listpoli},
            dataType: 'json',
            success: function (result) {
                var data = result.data;
                console.log(data);
                for (i = 0; i < data.length; i++) {
                    var color = (i%2 == 0) ? 'red' : 'red';
                    $('#listpoliutama').append('<div class="col-md-8 col-md-offset-2"><div class="box-info">'+
                        '<span class="box-info-number bg-'+color+'" id="poli'+data[i]['id']+'"></span>'+
                        '<div class="box-info-content">'+
                            '<span class="policaption">'+data[i]['nama']+'</span>'+
                            '<span class="antrianpoli">Nomor berikutnya : <span id="polin'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                            '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                            //'<span class="antrianpoli">Est. waktu dengan tindakan : <span id="estimasilayanantindakan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                            //'<span class="antrianpoli">Est. waktu tanpa tindakan : <span id="estimasilayanan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                            // '<div class"gotodetail"><a href="#" onclick="detail('+idunitkerja+','+data[i]['id']+');">Lihat</a></div>'+
                        '</div>'+
                        '</div></div>'
                    );
                    // idbppoli.
                }
            },
            error: function(responsedata){
                var errors = responsedata.statusText;
                $('#loading').hide();
                toast("error", errors);
            }
        });
    }
}

function getNomor(){
    // $("#loading").show();
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getnomor',
            type: 'GET',
            data: {poli: listpoli},
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
                    //$("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktunontindakan'] + ' menit');
                    //$("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktutindakan']) + ' menit');
                }
            },
            complete:function(data){
               setTimeout(getNomor, 5000);
            }
        });
    } else {
        setTimeout(getNomor, 5000);
    }
    // $("#loading").hide();
}

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
    // if (iscall == 0) {
    //     $.get(Settings.baseurl+'/getdataunitkerja', {idunitkerja:idunitkerja},function(respon){
    //         if(respon.data){
    //             var du = respon.data;
    //             $("#namaunitkerja").html(du.nama);
    //             $("#alamatunitkerja").html(du.alamat1);
    //         } else {
    //             // toast("info", respon);
    //         }
    //     });
    // }
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

function ceksetuppoli(){
    if(listpoli === undefined || listpoli.length == 0) {
        console.log("empty");
        getpoliaktif();
    } else {
        getlistpoli();
    }
}

function ceksuara(){
    // $("#loading").show();
    if(listpoli !== undefined && listpoli.length && suaraaktif == 1) {
        cekPanggilan(listpoli);
        console.log("suaraon");
    } else {
        console.log("suaraoff");
        // setTimeout(ceksuara, 3000);
    }
}

$(function () {
    $("#viewantrian").hide();
    getDataUnitkerja();
    date_time("date_time");
    // getPoliUtama();
    getpoliaktif();

    if(localStorage.getItem("suaraantrian") !== null){
        suaraaktif = localStorage.getItem("suaraantrian");
        settombolsuara();
    }

    // ceksetuppoli();

    // setTimeout(getNomor, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
});

</script>
</body>
</html>