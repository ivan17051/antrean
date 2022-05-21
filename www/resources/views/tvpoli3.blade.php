@extends('layouts.tvlayout')
@section('content')

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
    <div class="row" style="padding: 12px 20px;">
      <div class="col-md-7">
          <img class="d-inline-block" src="./img/pemkot.png" alt="Logo" style="height:100px; margin-bottom:30px;">
          <div class="d-inline-block navbar-wrapper" style="">
              <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota Surabaya<br>
                  <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
              </h3>
          </div>
      </div>
      <div class="col-md-5 dateclock-container" >
          <div class="bg-red">
              <h4 class="text-bold dateindo" >Sabtu, 21-02-2022</h4>
              <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
                  <h3 class="m-o text-bold time" ><span class="time__hours"></span> : <span class="time__min"></span> : <span class="time__sec"></span></h3>
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
    <div class="row">
      <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header">
            <h3 class="box-title" style="font-size:18px;">Pasien Terdaftar</h3>
          </div>

          <div class="box-body no-padding">
            <table class="table table-striped" style="font-size:16px;">
              <tbody>
                <tr>
                  <th style="width: 100px">No. Antrian</th>
                  <th>Nama</th>
                  <th>Estimasi</th>
                  <th style="width: 150px">Keterangan</th>
                </tr>
                @php
                $coba = ['','','','','','','','','','','','','','','','','','','','']
                @endphp
                @foreach($coba as $unit)
                <tr>
                  <td>10</td>
                  <td>Abdul Jagakarto</td>
                  <td>11.12</td>
                  <td>Hadir</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('jsx')
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
                    $('#listpoliutama').append('<div class="row"><div class="col-md-4">'+
                        '<div class="box box-danger bg-red text-center" style="font-size:200px;" id="poli'+data[i]['id']+'">100<p style="font-size:50px;padding-bottom:50px;">Adam Rahmat</p></div>'+
                        '</div>'+
                        '<div class="col-md-8">'+
                        '<div class="box box-danger" style="height:50%;">'+
                            '<div class="policaption" style="font-size:70px;padding:10px;"> POLI '+data[i]['nama']+'</div>'+
                        '</div><div class="row"><div class="col-md-4">'+
                            '<div class="antrianpoli box box-danger text-center" id="polin'+data[i]['id']+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">Adam Rahmat</p></div>'+
                            '</div><div class="col-md-4">'+
                            '<div class="antrianpoli box box-danger text-center" id="polin'+data[i]['id']+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">Adam Rahmat</p></div>'+
                            '</div><div class="col-md-4">'+
                            '<div class="antrianpoli box box-danger text-center" id="polin'+data[i]['id']+'" style="font-size:100px;">-<p style="font-size:30px;padding-bottom:30px;">Adam Rahmat</p></div>'+
                            '</div><div class="col-md-4">'+
                        //     '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">-</span></span>'+
                        // '</div>'+
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
@endsection