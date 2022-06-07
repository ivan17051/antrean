@extends('layouts.tvlayout')
@section('content')
<div style="height:calc(100vh - 81px);max-height:calc(100vh - 81px);" class="">
  <div id="viewantrian" style="height:calc(100% - 481px);">
    <div class="row">
      <div class="col-md-12 " id="barisbutton">
        <button type="button" class="btn btn-default" onclick="kembali();"><i class="fa fa-reply"></i></button>
        <button type="button" class="btn btn-default pull-right" id="tombolsuara" onclick="setsuara();"><i
            class="glyphicon glyphicon-volume-off"></i></button>
      </div>
    </div>
    <div class="row" style="padding: 12px 20px;">
      <div class="col-md-7">
        <img class="d-inline-block" src="{{asset('./img/pemkot.png')}}" alt="Logo" style="height:100px; margin-bottom:30px;">
        <div class="d-inline-block navbar-wrapper" style="">
          <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota Surabaya<br>
            <label class="text-secondary" id="namaunitkerja">Puskesmas</label>
          </h3>
        </div>
      </div>
      <div class="col-md-5 dateclock-container">
        <div class="bg-red">
          <h4 class="text-bold dateindo">Sabtu, 21-02-2022</h4>
          <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
            <h3 class="m-0 text-bold time"><span class="time__hours"></span> : <span class="time__min"></span> : <span
                class="time__sec"></span></h3>
          </div>
          <!-- <div class="icon">
                  <i class="ion ion-person-add"></i>
                  <i class="fa fa-arrow-circle-right"></i>
              </div> -->
        </div>
      </div>
    </div>

    <div class="row">
      @for($i=0;$i<3;$i++)
      <div class="col-md-4 my-poli-grid">
        <div class="box box-danger">
          <div class="policaption" style="font-size:50px;padding:10px;"> - </div>
          <div class="marquee-container">
            <div class="marquee" style="width:max-content;"></div>
          </div>
        </div>
        <div class="col-md-6" style="padding-left:0;">
          <div class="box box-danger bg-red text-center poli now" style="font-size:100px;max-height:210px;">-
          <p style="font-size:25px;padding-bottom:30px;overflow-x: hidden;white-space: nowrap;text-overflow: ellipsis;">-</p>
          </div>
        </div>
        <div class="col-md-6" style="padding-right:0;">
          <div class="antrianpoli box box-danger text-center  poli next" style="font-size:100px;">-<p
              style="font-size:25px;padding-bottom:30px;">-</p>
          </div>
        </div>
        <div class="row" style="padding: 220px 15px 0 15px">
          <div class="box m-0">
            <div class="box-body with-border p-0">
              <table class="table table-bordered m-0 font-large">
                <thead>
                  <tr class="bg-gray-light">
                    <th class="text-center" style="width: 15%">ANTREAN</th>
                    <th class="text-center">NAMA</th>
                    <th class="text-center" style="width: 18%">ESTIMASI</th>
                    <th class="text-center" style="width: 18%">STATUS</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
        <div class="row" style="padding: 0 15px 12px 15px;height: calc(100vh - 800px);">
          <div class="box antrean-poli-container" style="display: block;overflow: auto;height: 100%;">
            <div class="box-body p-0 ">
              <table class="table table-bordered m-0 font-large ">
                <tbody style="font-size: 24px;">
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      @endfor
    </div>
    <div class="row" style="padding: 12px 20px;">
      <div class="d-flex justify-content-center my-5">
          <h5 class="legend-item"><span class="warning" ></span>Hadir</h5>
          <h5 class="legend-item"><span class="danger" ></span>Batal</h5>
          <h5 class="legend-item"><span class="light" ></span>Belum Datang</h5>
          <h5 class="legend-item"><span class="success" ></span>Dilayani</h5>
          <h5 class="legend-item"><span class="info" ></span>Konsultasi/Penunjang</h5>
      </div>
    </div>
  </div>
@endsection

@section('jsx')
<script>
var ALLstreamnomor = [];
var listpasienNeedUpdate = true;

var ALLantreanPoliState=[];
var intervalInstance = [];
var listpoli = [
  {"id": 19, "nama": "BATRA"},
  {"id": 2, "nama": "GIGI"},
  {"id": 22, "nama": "PSIKOLOGI"},
];
var $polis;

$(window).on('load', function(){
    $(".loader").fadeOut("slow");
});

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
    baseurl: "{{url('').'/'.app('request')->get('idunitkerja')}}",
    url: "{{url('')}}",
}

var idunitkerja = "{{$d['idunitkerja']}}";
var suaraaktif = 0;

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

function templatePasien(d){
    let datenow = new Date();
    let time = new Date(d.tanggaleta) 
    let minutesDifference = (datenow-time)/ (1000*60);
    let status, statusText;

    if(d.isdone){
        statusStyle = "my-bg-success"
        status = "Dilayani"
    }
    else if(d.isconsul){
        statusStyle = "my-bg-info"
        status = "Konsultasi/Penunjang"
    }
    else if(d.isconfirm){
        statusStyle = "my-bg-warning"
        status = "Hadir"
    }
    else if(minutesDifference > 30){       //telat >30 menit
        statusStyle = "my-bg-danger"
        status = "Batal"
    }else{
        statusStyle = "my-bg-light"
        status = "Belum Datang"
    }
    // iscall
    // isrecall
    // isserved
    // isskipped

    time = time.toLocaleTimeString('uk')
    return $('<tr class="'+statusStyle+'">'+
            '<td class="text-center" style="width: 15%; font-size:24px;">'+d.pasiennoantrian+'</td>'+
            '<td class="text-center" style="font-size:24px;">'+d.NAMA_LGKP+'</td>'+
            '<td class="text-center" style="width: 18%; font-size:24px;">'+time+'</td>'+
            '<td class="text-center" style="width: 18%; font-size:24px;">'+status+'</td>'+
            '</tr>');
}

function getListPasien(idpoli, $tbodypasien){
    return $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("get-pasien-local", ["idunitkerja"=>app("request")->get("idunitkerja")])}}',
        type: 'GET',
        data:{
            poli: [idpoli],
        },
        dataType: 'json',
        success: function (result) {
            $tbodypasien.empty()
            if(result.data){
                var data = result.data;
                for (const d of data.listpasien) {
                    $tbodypasien.append(templatePasien(d));
                } 
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

function scrollLoop(dom, step, antreanPoliState)
{
    if(antreanPoliState.container.scrollTop() > antreanPoliState.$bottomElem[0].offsetTop + antreanPoliState.$bottomElem[0].offsetHeight){
        antreanPoliState.container[0].scroll(0,0)
    }
    dom.scrollBy(0,step);
}

function checkScrollCapability(antreanPoliState )
{
    let elemheight = antreanPoliState.container.find('tr:first').height();
    antreanPoliState.elemheight = elemheight;
    let slidesVisible = antreanPoliState.container.outerHeight() / elemheight;
    antreanPoliState.$bottomElem = antreanPoliState.container.find('tr:last');

    if( slidesVisible < antreanPoliState.container.find('tr').length){
        antreanPoliState.container.find('tr').slice(0, Math.ceil(slidesVisible)).clone().appendTo(antreanPoliState.container.find('tbody'));	
        return true;
    }
    return false;
}

function getDokter(idbppoli, $poli){
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: Settings.baseurl+'/getdokter',
      type: 'GET',
      data: {poli: [idbppoli]},
      dataType: 'json',
      success: function (result) {
          var datanow = result.data.dokter;
          let listdokterhtml = "";
          if (!datanow.length){
              listdokterhtml="<tr><td></td><td><b>-</b></td></tr>";
          }
          for (i = 0; i < datanow.length; i++) {
              if(i==0){
                  if(datanow[i]['isavailable']==1){
                      listdokterhtml += '<span style="color:#00a65a;">' + datanow[i]['nakes'] + '/Ada</span>';
                  } else {
                      listdokterhtml += '<span style="color:#dd4b39;">' + datanow[i]['nakes'] + '/Tidak Ada</span>';
                  }
                  
              }else{
                  if(datanow[i]['isavailable']==1){
                      listdokterhtml+=' - <span style="color:#00a65a;">' + datanow[i]['nakes'] + '/Ada</span>';
                  } else {
                      listdokterhtml+=' - <span style="color:#dd4b39;">' + datanow[i]['nakes'] + '/Tidak Ada</span>';
                  }
                  
              }
          }
          $poli.find('.marquee').html(listdokterhtml)
      },
      
  });
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

function ceksuara(idbppoli){
    // $("#loading").show();
    if(suaraaktif == 1) {
        cekPanggilan([idbppoli]);
        console.log("suaraon");
    } else {
        console.log("suaraoff");
        // setTimeout(ceksuara, 3000);
    }
}

function getNomor(idbppoli, $poli, index){
    if(ALLstreamnomor[index]) streamnomor.close();
    ALLstreamnomor[index] = new EventSource('{{route("getnomorslocal", ["idunitkerja"=>app("request")->get("idunitkerja")])}}?poli[]='+idbppoli);

    let streamnomor = ALLstreamnomor[index];

    streamnomor.addEventListener('lost',function(e){
      toast("error", "Connection Lost, Retry in 3 Seconds.");
    }); 

    streamnomor.onmessage = async function(event){
        var data = JSON.parse(event.data)
        var datanow = data.now
        var datanext = data.next
        let noantrian, nama;
        
        let $elements = $(".poli"+datanow[0]['idbppoli']);

        const searchPasien = function(nomor){
            return data.pasien.find(obj => {
                return obj.pasiennoantrian == nomor
            })
        }

        for (i = 0; i < datanow.length; i++) {
          if(datanow[i]['noantrian'] == 0) nama='-'
          else nama = searchPasien(datanow[i]['noantrian']).NAMA_LGKP
          noantrian = datanow[i]['noantrian']
          $poli.find('.now').html(noantrian+'<p class="antrianpolinama" style="font-size:30px;padding-bottom:30px;padding-left:10px;">'+nama+'</p>');
        }

        for (i = 0; i < datanext.length; i++) {
          noantrian = datanext[i]['noantrian']
          nama = searchPasien(noantrian).NAMA_LGKP
          $poli.find('.next').html(noantrian+'<p class="antrianpolinama" style="font-size:30px;padding-bottom:30px;padding-left:10px;">'+nama+'</p>');
        }
    }
}

async function loopRequestPasien(index){
    let antreanPoliState = ALLantreanPoliState[index];
    let poli = listpoli[index];
    let $poli = $($polis[index]);

    if(intervalInstance[index]) clearInterval(intervalInstance[index]); 

    let $tbodypasien = $poli.find('tbody');

    await getListPasien(poli.id, $tbodypasien);
    antreanPoliState.container = $poli.find('.antrean-poli-container');
    $poli.find('.policaption').text(poli.nama);

    setTimeout(function(){
        if(checkScrollCapability(antreanPoliState)){
            intervalInstance[index] = setInterval(scrollLoop, 50, antreanPoliState.container[0], 2, antreanPoliState);
        }
        getDokter(poli.id, $poli)
    }, 1000)
}

function controlLoopRequestPasien(){
    for (let i = 0; i < listpoli.length; i++) {
        setTimeout(() => {
            loopRequestPasien(i);   
        }, i*200);
    }
}

$(async function () {
  $polis = $('.my-poli-grid');

  //init data antrean 
  for (let i = 0; i < listpoli.length; i++) {
    ALLantreanPoliState.push({
        "container":null,
        "elemheight": null,
        "$bottomElem":null
    });
    intervalInstance.push(null)
    ALLstreamnomor.push(null)
    getNomor(listpoli[i].id, $($polis[i]), i)
  }

  getDataUnitkerja();
  date_time("date_time");
  
  // getpoliaktif();

  // if(localStorage.getItem("suaraantrian") !== null){
  //     suaraaktif = localStorage.getItem("suaraantrian");
  //     settombolsuara();
  // }

  controlLoopRequestPasien();

  setInterval(controlLoopRequestPasien, 60000);
});

</script>
@endsection