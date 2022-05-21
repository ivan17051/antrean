@extends('layouts.mainlayout')

@section('content')
<style type="text/css">
  .policaption{
    display: block;
    font-weight: bold;
    font-size: 24px;
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
    height: 150px;
    width: 150px;
    text-align: center;
    font-size: 75px;
    line-height: 150px;
    background: rgba(0,0,0,0.2);
  }

  .box-info {
    display: block;
    min-height: 150px;
    background: #fff;
    width: 100%;
    height: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    border-radius: 2px;
    margin-bottom: 15px;
  }

  .box-info-content {
    padding: 5px 10px;
    margin-left: 150px;
  }

  .bg-genap {
    background-color: #00c0ef !important;
    color: #fff;
  }
  /*.headerpoli{
    text-align: center;
  }
  .headerpoli, .policaption{
    font-weight: bold;
    font-size: 32pt;
  }
  .antrianpoli {
    font-size: 20pt;
    text-align: center;
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
    margin-right: 15px;*/

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
    margin-bottom: 25px;
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
    margin-top: -50px;
    color: #ffffff;
  }
}
</style>

<div class="row">
  <div class="col-md-4">
    <div class="boxpanggilan">
      <div class="title1">Dinas Kesehatan Kota Surabaya</div>
      <div id="namaunitkerja" class="title2"></div>
      <p id="alamatunitkerja" class="title3"></p>
      <div class="boxnomorpanggilan">
        <div id="panggilannomor">0</div>
        <div id="panggilanpoli">POLI</div>
      </div>
      <p id="date_time"></p>
    </div>
  </div>
  <div class="col-md-8">
    <div id="listpoliutama"></div>
  </div>
</div>
<div class="row">
  <div id="listpolilain"></div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
var idunitkerja = "{{$d['idunitkerja']}}";

var videoSource = new Array();
videoSource[0] = "{{asset('img/video.mp4')}}";
// videoSource[1] = "{{asset('img/video2.mp4')}}";
var video_index     = 0;
var video_player    = null;

function onVideoEnded(){
    console.log("video ended");
    if(video_index < videoSource.length - 1){
        video_index++;
    }
    else{
        video_index = 0;
    }
    video_player.setAttribute("src", videoSource[video_index]);
    video_player.play();
}
function onload(){
    console.log("body loaded");
    video_player = document.getElementById("myvideo");
    video_player.setAttribute("src", videoSource[video_index]);
    video_player.play();
}

var idbppoli;
var tanggal;
var iscall = 0;
var timeout = 0;

function getPoliUtama(){
    $('#listpoliutama').empty();
    $.ajax({
        url: Settings.baseurl+'/getlistpoli/2/'+idunitkerja,
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            console.log(data);
            for (i = 0; i < data.length; i++) {
                let color = (i%2 == 0) ? 'aqua' : 'teal';
                $('#listpoliutama').append('<div class="col-md-6"><div class="box-info">'+
                    '<span class="box-info-number bg-'+color+'" id="poli'+data[i]['id']+'">0</span>'+
                    '<div class="box-info-content">'+
                        '<span class="policaption">'+data[i]['nama']+'</span>'+
                        '<span class="antrianpoli">Antrian berikutnya : <span id="polin'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        '<span class="antrianpoli">Est. waktu tanpa tindakan : <span id="estimasilayanan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        '<span class="antrianpoli">Est. waktu dengan tindakan : <span id="estimasilayanantindakan'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        // '<div class"gotodetail"><a href="#" onclick="detail('+idunitkerja+','+data[i]['id']+');">Lihat</a></div>'+
                    '</div>'+
                    '</div></div>'
                );
                // idbppoli.
            }
        }
    });
}

function getPoliUtamaold(){
    $('#listpoliutama').empty();
    $.ajax({
        url: Settings.baseurl+'/getlistpoli/2/'+idunitkerja,
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            console.log(data);
            for (i = 0; i < data.length; i++) {
                $('#listpoliutama').append('<div class="col-md-4"><div class="box box-primary">'+
                    '<div class="box-header with-border headerpoli">'+
                    '<div class="policaption">'+data[i]['nama']+'</div>'+
                    '</div>'+
                    '<div class="box-body">'+
                    '<a href="#" class="gotodetail" onclick="detail('+data[i]['idunitkerja']+','+data[i]['idpoli']+');">Lihat</a>'+
                    '<div class="antrianpoli">Antrian saat ini : <span id="poli'+data[i]['id']+'" style="font-weight: bold;">0</span></div>'+
                    '<br>'+
                    '<div class="antrianpoli">Antrian berikutnya : <span id="polin'+data[i]['id']+'" style="font-weight: bold;">0</span></div>'+
                    '<div class="antrianpoli">Estimasi layanan : <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">07.30</span></div>'+
                    '</div>'+
                    '</div></div>'
                );
                // idbppoli.
            }
        }
    });
}

function getNomor(){
    // $("#loading").show();
    $.ajax({
        url: Settings.baseurl+'/getnomor/'+idunitkerja,
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let datanow = result.data.now;
            // console.log(data);
            for (i = 0; i < datanow.length; i++) {
                $("#poli"+datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
            }
            let datanext = result.data.next;
            for (i = 0; i < datanext.length; i++) {
                $("#polin"+datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
                $("#estimasi"+datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
                $("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktupelayanan'] + ' menit');
                $("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktupelayanan'])+5 + ' menit');
            }
        }
    });
    // $("#loading").hide();
}

function detail(idunit,idpoli){
    window.location.href = Settings.baseurl+"/detail/"+idunit+"/"+idpoli;
}

//panggilansuara
function cekPanggilan(){
    if (iscall == 0) {
        $.get(Settings.baseurl+'/getpanggilanantrian', {tanggal:tanggal,idunitkerja:idunitkerja},function(respon){
            if(respon.data){
                noantrian = respon.data.noantrian;
                idbppoli = respon.data.idbppoli;
                namapoli = respon.data.namapoli;
                $("#panggilannomor").html(noantrian);
                $("#panggilanpoli").html("POLI "+namapoli);
                let idpanggilan = respon.data.id;
                sound(noantrian, idbppoli);
                setTimeout(function(){deletePanggilan(idpanggilan)}, 500);
            } else {
                // toast("info", respon);
            }
        });
    }
}

function deletePanggilan(id){
    $.post(Settings.baseurl+'/deletepanggilanantrian/'+id, {'_token': Settings.token}, function(responsedata){});
}

function sound(number,idbppoli){
    timeout = 0;
    iscall = 1;
    let npoli = "intro";
    switch(parseInt(idbppoli)){
        case 1:
            npoli = "umum";
            break;
        case 2:
            npoli = "gigi";
            break;
        case 3:
             npoli = "kia";
            break;
        case 4:
            npoli = "gizi";
            break;
        case 6:
            npoli = "anak";
            break;
        case 12:
            npoli = "mata";
            break;
        case 13:
            npoli = "paru";
            break;
        case 14:
             npoli = "sanitasi";
            break;
        case 15:
            npoli = "tumbuhkembang";
            break;
        case 16:
            npoli = "paliatif";
            break;
        case 18:
            npoli = "std";
            break;
        case 19:
            npoli = "batra";
            break;
        case 20:
             npoli = "ptrm";
            break;
        case 22:
            npoli = "psikologi";
            break;
        case 24:
            npoli = "spesialisgigi";
            break;
        case 25:
            npoli = "igd";
            break;
        case 31:
            npoli = "farmasi";
            break;
        case 35:
            npoli = "vct";
            break;
        case 39:
            npoli = "laboratorium";
            break;
        case 55:
             npoli = "lansia";
            break;
        case 59:
            npoli = "pkpr";
            break;
        case 62:
            npoli = "p2m";
            break;
    }
    // console.log(npoli);
    // ion.sound.play("intro");
    setTimeout(function(){ion.sound.play("poli")}, timeout+=500);
    setTimeout(function(){ion.sound.play(npoli)}, timeout+=600);
    setTimeout(function(){ion.sound.play("nomorantrian")}, timeout+=1000);
    suaranomor(number,timeout);
    
    // if (jenispx=='1') {
    //     jenispx="bpjs";
    // }
    // else{
    //     jenispx="umum";
    // }
    // setTimeout(function(){
    // ion.sound.play(jenispx)}, timeout+=1200);
    // setTimeout(function(){
    // ion.sound.play("B")}, timeout+=1500);
    setTimeout(function(){iscall = 0;}, 5000); 
}

function suaranomor(number,timeout){
    arr_number = [
    "0",
    "satu",
    "dua",
    "tiga",
    "empat",
    "lima",
    "enam",
    "tujuh",
    "delapan",
    "sembilan",
    "sepuluh",
    "sebelas"];

    if(number<12){
        setTimeout(function(){
        ion.sound.play(arr_number[number])}, timeout+=1000);
    } else if(number<20){
        number=(number-10);
        setTimeout(function(){ ion.sound.play(arr_number[number])}, timeout+=1000);
        setTimeout(function(){ ion.sound.play("belas")}, timeout+=500);
    } else if(number<100){
        number1=parseInt(number/10);
        setTimeout(function(){ ion.sound.play(arr_number[number1])}, timeout+=1000);
        setTimeout(function(){ ion.sound.play("puluh")}, timeout+=500);
        number2=number%10;
        setTimeout(function(){ ion.sound.play(arr_number[number2])}, timeout+=500);
    } else if(number<200){
        setTimeout(function(){ ion.sound.play("seratus")}, timeout+=1000);
        number=number-100;
        suaranomor(number,timeout);
    } else if(number<1000){
        numberratus=parseInt(number/100);
        if((number%100)<=0){
            setTimeout(function(){ ion.sound.play(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ ion.sound.play("ratus")}, timeout+=500);
        } else if((number%100)<12){
            setTimeout(function(){ ion.sound.play(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ ion.sound.play("ratus")}, timeout+=500);
            setTimeout(function(){ ion.sound.play(arr_number[number%100])}, timeout+=500);
        } else if((number%100)<20){
            number=((number%100)-10);
            setTimeout(function(){ ion.sound.play(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ ion.sound.play("ratus")}, timeout+=500);
            setTimeout(function(){ ion.sound.play(arr_number[number])}, timeout+=500);
            setTimeout(function(){ ion.sound.play("belas")}, timeout+=500);
        } else if((number%100)<100){
            number1=parseInt((number%100)/10);
            setTimeout(function(){ ion.sound.play(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ ion.sound.play("ratus")}, timeout+=700);
            setTimeout(function(){ ion.sound.play(arr_number[number1])}, timeout+=700);
            setTimeout(function(){ ion.sound.play("puluh")}, timeout+=500);
            number2=(number%100)%10;
            setTimeout(function(){ ion.sound.play(arr_number[number2])}, timeout+=500);
        }
    } else if(number<2000){
        setTimeout(function(){ ion.sound.play("seribu")}, timeout+=1000);
        number=number-1000;
        suaranomor(number,timeout);
    } else {
        setTimeout(function(){ ion.sound.play("selanjutnya")}, timeout+=1000);
    }
}

function getDataUnitkerja(){
    if (iscall == 0) {
        $.get(Settings.baseurl+'/getdataunitkerja', {idunitkerja:idunitkerja},function(respon){
            if(respon.data){
                let du = respon.data;
                $("#namaunitkerja").html(du.nama);
                $("#alamatunitkerja").html(du.alamat1);
            } else {
                // toast("info", respon);
            }
        });
    }
}

function date_time(id) {
        date = new Date;
        year = date.getFullYear();
        month = date.getMonth();
        months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        d = date.getDate();
        day = date.getDay();
        days = new Array('Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
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

  ion.sound({
      sounds: [
          {name: "intro"},
          {name: "nomorantrian"},
          {name: "satu"},
          {name: "dua"},
          {name: "tiga"},
          {name: "empat"},
          {name: "lima"},
          {name: "enam"},
          {name: "tujuh"},
          {name: "delapan"},
          {name: "sembilan"},
          {name: "sepuluh"},
          {name: "sebelas"},
          {name: "belas"},
          {name: "puluh"},
          {name: "seratus"},
          {name: "seribu"},
          {name: "ratus"},
          {name: "poli"},
          {name: "umum"},
          {name: "gigi"},
          {name: "kia"},
          {name: "batra"},
          {name: "lansia"},
          {name: "sanitasi"},
          {name: "psikologi"},
          {name: "farmasi"},
          {name: "loket"},
          {name: "laboratorium"},
          {name: "kasir"},
          {name: "gizi"},
          {name: "anak"},
          {name: "p2m"},
          {name: "hamil"},
          {name: "igd"},
          {name: "pkpr"},
          {name: "vct"},
          {name: "tumbuhkembang"},
          {name: "spesialisgigi"},
          {name: "mata"},
          {name: "paliatif"},
          {name: "paru"},
          {name: "ptrm"},
          {name: "std"},
      ],
      path: Settings.baseurl+'/sound/male/',
      preload: true,
      multiplay: false
  });

  // getPoliLain();
  setInterval(function(){getNomor()}, 5000);

  setInterval(function(){cekPanggilan()}, 1000);
});

</script>
<!-- <script type="text/javascript" src="{{asset('js/lihat.js')}}"></script> -->
@stop