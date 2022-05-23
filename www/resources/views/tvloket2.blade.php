@extends('layouts.tvlayout')
@section('content')
<div style="height:calc(100vh - 81px);max-height:calc(100vh - 81px);" class="">
<div class="row" style="padding: 12px 20px;">
    <div class="col-sm-7">
        <img class="d-inline-block" src="./img/pemkot.png" alt="Logo" style="height:100px; margin-bottom:30px;">
        <div class="d-inline-block navbar-wrapper" style="">
            <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                Surabaya<br>
                <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
            </h3>
        </div>
    </div>
    <div class="col-sm-5 dateclock-container">
        <div class="bg-red">
            <h4 class="text-bold dateindo">Sabtu, 21-02-2022</h4>
            <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
                <h3 class="m-0 text-bold time"><span class="time__hours"></span> : <span class="time__min"></span> :
                    <span class="time__sec"></span></h3>
            </div>
            <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
                <i class="fa fa-arrow-circle-right"></i>
            </div> -->
        </div>
    </div>
</div>
<div class="row" style="padding: 12px 20px;">
    <div class="box">
        <div class="box-header with-border bg-red text-center">
            <h3 class="box-title big-title">ANTREAN POLI</h3>
        </div>
    </div>
</div>
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
<div class="row" style="padding: 0 20px 12px 20px;height: calc(100% - 410px);">
    <div class="box antrean-poli-container" style="display: block;overflow: auto;height: 100%;">
        <div class="box-body p-0 " >
            <table class="table table-bordered m-0 font-large ">
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
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
<script type="text/javascript">

var antreanPoliState={
    "container":null,
    "elemheight": null,
    "$bottomElem":null
};
var intervalInstance;
var idunitkerja = "{{$d['idunitkerja']}}";


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
        url: '{{route("get-pasien")}}',
        type: 'GET',
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

$(async function () {
    getDataUnitkerja();
    await getListPasien();
    antreanPoliState.container=$('.antrean-poli-container');

    setTimeout(function(){
        if(checkScrollCapability()){
            intervalInstance = setInterval(scrollLoop, 50, antreanPoliState.container[0], 2);
        }
    }, 1000)
});
</script>
@endsection