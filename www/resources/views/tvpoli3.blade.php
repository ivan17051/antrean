@extends('layouts.tvlayout')
@section('content')
<div style="height:calc(100vh - 81px);max-height:calc(100vh - 81px);" class="">
<div id="boxlistpoli">
    <div class="row" id="listpoli"></div>
</div>
<div id="viewantrian" style="height:calc(100% - 481px);">
    <div class="row">
        <div class="col-md-12 " id="barisbutton">
            <button type="button" class="btn btn-default" onclick="kembali();"><i class="fa fa-reply"></i></button>
            <button type="button" class="btn btn-default pull-right" id="tombolsuara" onclick="setsuara();"><i class="glyphicon glyphicon-volume-off"></i></button>
        </div>
    </div>
    <div class="row" style="padding: 12px 20px;">
      <div class="col-md-7">
          <img class="d-inline-block" src="{{asset('./img/pemkot.png')}}" alt="Logo" style="height:100px; margin-bottom:30px;">
          <div class="d-inline-block navbar-wrapper" style="">
              <h3 class="navbar-brand" style="padding-left: 32px;">Dinas Kesehatan Kota Surabaya<br>
                  <label class="text-secondary" id="namaunitkerja">Puskesmas</label>
              </h3>
          </div>
      </div>
      <div class="col-md-5 dateclock-container" >
          <div class="bg-red">
              <h4 class="text-bold dateindo" >Sabtu, 21-02-2022</h4>
              <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
                  <h3 class="m-0 text-bold time" ><span class="time__hours"></span> : <span class="time__min"></span> : <span class="time__sec"></span></h3>
              </div>
              <!-- <div class="icon">
                  <i class="ion ion-person-add"></i>
                  <i class="fa fa-arrow-circle-right"></i>
              </div> -->
          </div>
      </div>
  </div>

    <!-- <div class="row"> -->
        <!-- <div class="col-md-12"> -->
            <div id="listpoliutama" style="margin-top: 20px;"></div>
        <!-- </div> -->
    <!-- </div> -->
    <div class="row" style="padding: 12px 20px 0 20px">
      <div class="box m-0">
          <div class="box-body with-border p-0">
              <table class="table table-bordered m-0 font-large">
                  <thead>
                      <tr class="bg-gray-light">
                        <th class="text-center" style="width: 15%">ANTREAN</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center" style="width: 20%">POLI</th>
                        <th class="text-center" style="width: 10%">ESTIMASI</th>
                        <th class="text-center" style="width: 18%">STATUS</th>
                      </tr>
                  </thead>
              </table>
          </div>
      </div>
  </div>
  <div class="row" style="padding: 0 20px 12px 20px;height: calc(100% - 310px);">
      <div class="box antrean-poli-container" style="display: block;overflow: hidden;height: 100%;">
          <div class="box-body p-0 " >
              <table class="table table-bordered m-0 font-large ">
                  <tbody style="font-size: 24px;">
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="row" style="padding: 12px 20px;">
      <div class="d-flex justify-content-center my-5">
          <h4 class="legend-item"><span class="warning" ></span>Hadir</h4>
          <h4 class="legend-item"><span class="danger" ></span>Batal</h4>
          <h4 class="legend-item"><span class="light" ></span>Belum Datang</h4>
          <h4 class="legend-item"><span class="success" ></span>Dilayani</h4>
          <h4 class="legend-item"><span class="info" ></span>Konsultasi/Penunjang</h4>
      </div>
  </div>
  </div>
</div>
</div>
@endsection

@section('jsx')
<script>
var streamnomor;
var antreanPoliState={
    "container":null,
    "elemheight": null,
    "$bottomElem":null
};
var intervalInstance;

$(window).on('load', function(){
    $(".loader").fadeOut("slow");
});

var antreanPoliState={
    "container":null,
    "elemheight": null,
    "$bottomElem":null
};
var intervalInstance;

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

var listpoli = [];

function setsuara(){
    if (suaraaktif == 1) {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-off">');
        sessionStorage.setItem("suaraantrian", 0);
        suaraaktif = 0;
    } else {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-up">');
        sessionStorage.setItem("suaraantrian", 1);
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
    console.log('link: '+Settings.baseurl+'/getlistpoli');
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
    // console.log(data);
    data.push({nama:'LABORATORIUM',id:39})
    data.push({nama:'FARMASI',id:31})

    var box = data.map(function (poli) {
        var x = $('<div class="col-md-6" style="margin-top:10px;">' +
            '<button type="button" class="btn btn-block btn-lg btn-danger buttonpoli" style="font-size: 32px;">' + poli.nama + '</button>' +
        '</div>');
        x.on('click' , function(){
            // namapoli = poli.nama
            setpoli(poli.id, poli.nama)
        });
        return x;
    })
    $("#listpoli").html('').append(box);
    // showmodalsetup();
}

async function setpoli(id, nama) {
    if(streamnomor) streamnomor.close()
    $("#loading").show();
    $("#boxlistpoli").hide();
    $("#viewantrian").show('slow');
    
    listpoli[0] = id;
    await getlistpoli(id, nama);
    setTimeout(ceksuara, 2000);

    sessionStorage.setItem("setpoli", id+','+nama);
    
    getDokter();
    getNomor();

    loopRequestPasien();

    setInterval(loopRequestPasien, 60000);

    // setTimeout(getDokter, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
    // setTimeout(getNomor, 2000);
    $("#loading").hide();
}

function kembali(){
    // $("#boxlistpoli").show('slow');
    // $("#viewantrian").hide('slow');
    sessionStorage.removeItem("setpoli");
    location.reload();
}

function getlistpoli(idbppoli, nama){
    $('#listpoliutama').empty();

    if(nama !== 'LABORATORIUM' && nama !== 'FARMASI') nama='POLI '+nama;
    
    $('#listpoliutama').append('<div class="row"><div class="col-md-4">'+
        '<div class="box box-danger bg-red text-center poli'+idbppoli+'" style="font-size:200px;" >-<p style="font-size:50px;padding-bottom:50px;">-</p></div>'+
        '</div>'+
        '<div class="col-md-8">'+
        '<div class="box box-danger">'+
            '<div class="policaption" style="font-size:70px;padding:10px;">'+nama+'</div>'+
            '<div class="marquee-container"><div id="marquee" style="width:max-content;"></div></div>'+
        '</div><div class="row"><div class="col-md-4">'+
            '<div class="antrianpoli box box-danger text-center  poli'+idbppoli+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">-</p></div>'+
            '</div><div class="col-md-4">'+
            '<div class="antrianpoli box box-danger text-center  poli'+idbppoli+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">-</p></div>'+
            '</div><div class="col-md-4">'+
            '<div class="antrianpoli box box-danger text-center  poli'+idbppoli+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">-</p></div>'+
            '</div><div class="col-md-4">'+
        //     '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi'+idbppoli+'" style="font-weight: bold;">-</span></span>'+
        // '</div>'+
        '</div></div>'
    );
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
            '<td class="text-center" style="width: 15%">'+d.pasiennoantrian+'</td>'+
            '<td class="text-center">'+d.NAMA_LGKP+'</td>'+
            '<td class="text-center" style="width: 20%">'+d.poli+'</td>'+
            '<td class="text-center" style="width: 10%">'+time+'</td>'+
            '<td class="text-center" style="width: 18%">'+status+'</td>'+
            '</tr>');
}
function getListPasien(){
    return $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/getlistpasien?poli[]='+listpoli,
        type: 'GET',
        data: {poli: listpoli},
        dataType: 'json',
        success: function (result) {
            let $tbodypasien = $('.antrean-poli-container table tbody')
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

function scrollLoop(dom, step)
{
    if(antreanPoliState.container.scrollTop() > antreanPoliState.$bottomElem[0].offsetTop + antreanPoliState.$bottomElem[0].offsetHeight){
        antreanPoliState.container[0].scroll(0,0)
    }
    dom.scrollBy(0,step);
}

function checkScrollCapability()
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

function getDokter(){
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getdokter',
            type: 'GET',
            data: {poli: listpoli},
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
                $('#marquee').html(listdokterhtml)
            },
            
        });
    } 
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

    if(sessionStorage.suaraantrian==1){
        suaraaktif = sessionStorage.getItem("suaraantrian");
        settombolsuara();
    }
    if(sessionStorage.setpoli){
        var poli = sessionStorage.getItem('setpoli').split(',');
        setpoli(parseInt(poli[0]), poli[1]);
    }

});

function getNomor(){
    if(streamnomor) streamnomor.close();
    streamnomor = new EventSource('getnomorstream?poli[]='+listpoli);

    streamnomor.addEventListener('lost',function(e){
      toast("error", "Connection Lost, Retry in 3 Seconds.");
    }); 

    streamnomor.onmessage = async function(event){
        // if(!$elements) return;
    
        var data = JSON.parse(event.data)
        // console.log(data);
        var datanow = data.now
        var datanext = data.next
        let nama, noantrian;

        const searchPasien = function(nomor){
            return data.pasien.find(obj => {
                return obj.pasiennoantrian == nomor
            })
        }
        
        let $elements = $(".poli"+datanow[0]['idbppoli']);
        let antriannow = 0;

        for (i = 0; i < datanow.length; i++) {
            if(datanow[i]['noantrian'] == 0) nama='-'
            else nama = searchPasien(datanow[i]['noantrian']).NAMA_LGKP
            antriannow = datanow[i]['noantrian']
            noantrian = datanow[i]['noantrian']
            $($elements[0]).html(noantrian+'<p class="antrianpolinama" style="font-size:30px;padding-bottom:30px;padding-left:10px;">'+nama+'</p>');
        }
        for (i = 1; i < 4; i++) {       //karena menampilkan tiga antrian berikutnya
            try {
                noantrian = '-'
                nama = '-'
                if(datanext.length && i < data.pasien.length){       
                    noantrian = antriannow+i 
                    nama = searchPasien(antriannow+i ).NAMA_LGKP
                }
                $($elements[i]).html(noantrian+'<p class="antrianpolinama" style="font-size:30px;padding-bottom:30px;padding-left:10px;">'+nama+'</p>');   
            } catch (error) {
                
            }
        }

    }
}

async function loopRequestPasien(){

    if(intervalInstance) clearInterval(intervalInstance); 

    await getListPasien();
    antreanPoliState.container=$('.antrean-poli-container');

    setTimeout(function(){
        if(checkScrollCapability()){
            intervalInstance = setInterval(scrollLoop, 50, antreanPoliState.container[0], 2);
        }
    }, 1000)
}

</script>
@endsection