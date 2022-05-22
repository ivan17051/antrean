@extends('layouts.mainlayout2')

@section('content')
<style type="text/css">
	.box-info-number {
	    border-top-left-radius: 2px;
	    border-top-right-radius: 0;
	    border-bottom-right-radius: 0;
	    border-bottom-left-radius: 2px;
	    display: block;
	    float: left;
	    height: 180px;
	    width: 180px;
	    text-align: center;
	    font-size: 90px;
	    line-height: 180px;
	    background: rgba(0,0,0,0.2);
  	}

  	.box-info {
	    display: block;
	    min-height: 180px;
	    background: #fff;
	    width: 100%;
	    height: 100%;
	    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	    border-radius: 2px;
	    margin-bottom: 15px;
  	}

  	.box-info-content {
	    padding: 5px 10px;
	    margin-left: 180px;
  	}

  	.policaption {
  		display: block;
  		font-weight: bold;
  		font-size: 30px;
  	}

  	.pasiencaption {
		/*display: block;*/
		font-size: 24px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		vertical-align: middle;
	}

	.info-box {
	    display: block;
	    
	    background: #fff;
	    width: 100%;
	    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	    border-radius: 2px;
	    margin-bottom: 15px;
	}

	.info-box-content2 {
	    padding: 5px 10px;
	    margin-left: 60px;
	}

	.info-box-icon2 {
	    border-top-left-radius: 2px;
	    border-top-right-radius: 0;
	    border-bottom-right-radius: 0;
	    border-bottom-left-radius: 2px;
	    display: block;
	    float: left;
	    height: 60px;
	    width: 60px;
	    text-align: center;
	    font-size: 30px;
	    line-height: 60px;
	    background: rgba(0,0,0,0.2);
	}

	.tombolaksi {
		width: 75px;
		font-size: 24px;
		margin-bottom: 5px;
		margin-right: 10px;
	}
</style>
<div id="boxlistpoli">
  <div class="row" id="listpoli"></div>
</div>
<div id="viewantrian">
  <div class="row">
    <div class="col-md-12">
      <button type="button" class="btn btn-primary" onclick="kembali();"><i class="fa fa-angle-left"></i>
        Kembali</button>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header">
          <div class="policaption" id="namapoli">Poli</div>
        </div>
        <div class="box-body">
        <div class="row">
            <div class="col-md-5">
              <div> <span class="pasiencaption" id="namapasien">Pasien</span> &nbsp;&nbsp;&nbsp; <button type="button"
                  onclick="getDataPoli()" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button></div>
              <div class="box-info">
                <span class="box-info-number bg-red" id="noantrian"></span>
                <div class="box-info-content">

                <div class="btn-group-vertical btn-group-lg" role="group">
                  <button type="button" class="btn btn-primary" onclick="nextno(1);"><i class="fa fa-arrow-right"></i> Panggil</button>
                  <button type="button" class="btn btn-warning" onclick="nextno(2);"><i class="fa  fa-arrow-circle-o-right"></i> Skip</button>
                  <button type="button" class="btn btn-secondary" onclick="recall();"><i class="fa fa-volume-up"></i> Ulang</button>
                </div>

                <div class="btn-group-vertical btn-group-lg" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Hadir</button>
                  <button type="button" class="btn btn-danger"><i class="fa  fa-times"></i> Tidak</button>
                </div>

                  <!-- <div><button class="btn btn-lg bg-green tombolaksi" onclick="nextno(1);"><i
                        class="fa fa-arrow-right"></i></button><span>Panggil</span></div>
                  <div><button class="btn btn-lg bg-green tombolaksi" onclick="nextno(2);"><i
                        class="fa  fa-arrow-circle-o-right"></i></button><span>Skip</span></div>
                  <div><button class="btn btn-lg bg-green tombolaksi" onclick="recall();"><i
                        class="fa fa-volume-up"></i></button><span>Panggil Ulang</span></div> -->
                </div>
              </div>

              <!-- Tabel Pasien Skip & Pelayanan -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Pasien Skip</a></li>
                  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Pasien Konsul</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <div class="row" style="padding: 0 10px;">
                      <div class="box m-0">
                        <div class="box-body with-border p-0">
                          <table class="table table-bordered m-0">
                            <thead>
                              <tr class="bg-gray-light">
                                <th class="text-center" style="width: 15%">ANTREAN</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center" style="width: 20%">AKSI</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="padding: 0 20px 12px 20px;height: calc(100% - 410px);">
                      <div class="box antrean-poli-container skip" style="display: block;overflow: auto;height: 100%;">
                        <div class="box-body p-0 ">
                          <table class="table table-bordered m-0">
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="tab_2">
                    <div class="row" style="padding: 0 10px;">
                      <div class="box m-0">
                        <div class="box-body with-border p-0">
                          <table class="table table-bordered m-0">
                            <thead>
                              <tr class="bg-gray-light">
                                <th class="text-center" style="width: 15%">ANTREAN</th>
                                <th class="text-center">NAMA</th>
                                <th class="text-center" style="width: 20%">AKSI</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="row" style="padding: 0 20px 12px 20px;height: calc(100% - 410px);">
                      <div class="box antrean-poli-container konsul" style="display: block;overflow: auto;height: 100%;">
                        <div class="box-body p-0 ">
                          <table class="table table-bordered m-0">
                            <tbody>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
            <div class="col-md-7">
              <div class="row">
                <div class="col-md-4">
                  <div class="info-box bg-aqua text-center" style="height:100%;">
                    <div class="info-box-content" style="margin:0;">
                      <span class="info-box-text">Jumlah Antrean</span>
                      <span class="info-box-number" id="maxantrian" style="font-size:25px;">41,410</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box bg-teal text-center" style="height:100%;">
                    <div class="info-box-content" style="margin:0;">
                      <span class="info-box-text">Nomor Berikutnya</span>
                      <span class="info-box-number" id="nextantrian" style="font-size:25px;">41,410</span>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="info-box bg-red text-center" style="height:100%">
                    <div class="info-box-content" style="margin:0;">
                      <span class="info-box-text">Sisa Antrean</span>
                      <span class="info-box-number" id="sisaantrian" style="font-size:25px;">41,410</span>
                    </div>
                  </div>
                </div>
              </div>
                <!-- Tabel List Pasien -->
                <div class="row">
                  <div class="col-md-12">
                    <div class="box m-0">
                      <div class="box-body with-border p-0">
                        <table class="table table-bordered m-0">
                          <thead>
                            <tr class="bg-gray-light">
                              <th class="text-center" style="width: 15%">ANTREAN</th>
                              <th class="text-center">NAMA</th>
                              <th class="text-center" style="width: 10%">ESTIMASI</th>
                              <th class="text-center" style="width: 20%">STATUS</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="padding: 0 30px 12px 30px;height: calc(100% - 410px);">
                    <div class="box antrean-poli-container original" style="display: block;overflow: auto;height: 100%;">
                      <div class="box-body p-0 ">
                        <table class="table table-bordered m-0">
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="padding: 12px 20px;">
                    <div class="d-flex justify-content-center my-5" style="flex-wrap: wrap;">
                      <h5 class="legend-item"><span class="warning"></span>Hadir</h5>
                      <h5 class="legend-item"><span class="danger"></span>Batal</h5>
                      <h5 class="legend-item"><span class="light"></span>Belum Datang</h5>
                      <h5 class="legend-item"><span class="success"></span>Dilayani</h5>
                      <h5 class="legend-item"><span class="info"></span>Konsultasi/Penunjang</h5>
                    </div>
                  </div>
                </div>
                
                
              
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  <!-- <div class="row">
		<div class="col-md-12">
		  	<div class="box box-primary">
		  		<div class="box-header"></div>
		  		<div class="box-body">
	                
		  		</div>
		  	</div>
	  	</div>
	</div> -->
</div>
@endsection

@section('ajax')
<script type="text/javascript">
var idunitkerja = "{{$d['idunitkerja']}}";
var idbppoli;
var noantrian;
var textpanggilan;
var timeout=0;
var gate=0;

function distombol(time){
    $(".tombolaksi").prop("disabled", true);
    setTimeout(function(){$(".tombolaksi").prop("disabled", false);}, time);
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
            createlistpoli(data);
        },
        error: function (result) {
            console.log(result.statusText);
        }
    }).done( () => {
        // console.table(listpoli)
    })
}

function createlistpoli(data){
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
  
    idbppoli = id;
    // setTimeout(getNomor, 2000);
    getDataPoli();
    getListPasien();
    getListPasienSkip();
    getListPasienKonsul();
    $("#loading").hide();
}

function kembali(){
    $("#boxlistpoli").show('slow');
    $("#viewantrian").hide('slow');
}

function getDataPoli(){
    // $('#listpoli').empty();
    $("#loading").show();
    // $("#tombolnext").prop("disabled", true);
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli,
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                var data = result.data[0];
                console.log(data);
                noantrian = data['noantrian'];
                textpanggilan = data['pasien'];
                var maxantrian = data['servesmax'];
                $("#noantrian").html(data['noantrian']);
                $("#namapoli").html(data['nama']);
                $("#namapasien").html(data['pasien']);
                $("#maxantrian").html(maxantrian);
                $("#nextantrian").html(noantrian + 1);
                $("#sisaantrian").html(maxantrian - noantrian);
                // sound(noantrian, idbppoli);
            }
        });
        // reloadTable("#tbpasien");
    }
    // $("#tombolnext").prop("disabled", false);
    $("#loading").hide();
}

function nextno(tipe){
    if(tipe == 1) distombol(2500);
    else distombol(1700);

    $("#loading").show();
    // console.log('next');
    $.ajax({
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/layaniantrian',
        type: 'POST',
        data: {idunitkerja:idunitkerja,pasiennoantrian:noantrian,idbppoli:idbppoli, tipe:tipe},
        success: function(respon){
	        // console.log(respon);
	        if(respon == 1){
	            // getDataPoli();
	            // setTimeout(function(){addantriansuara(noantrian, idbppoli)}, timeout+=500);
				toast("info", "Call");
	        } else {
	            toast("info", respon);
	        }
	    },
	    error: function(XMLHttpRequest, textStatus, errorThrown) { 
            toast("error", textStatus);
            setTimeout(getDataPoli, 1000);
        },
        complete:function(data){
           setTimeout(getDataPoli, 1000);
           getListPasien();
           getListPasienSkip();
           getListPasienKonsul();
        }
    });
    $("#loading").hide();
}

function recall(){
    // toast('info', 'panggil ulang');
    distombol(2500);
    // sound(noantrian, idbppoli);
	toast("info", "Recall");
    if (noantrian) {
        addantriansuara(noantrian, idbppoli, textpanggilan);
    }
}

function addantriansuara(noantrian, idbppoli, text){
     $.ajax({
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	url: Settings.baseurl+'/addantriansuara',
    	type: 'POST',
    	data: {idunitkerja:idunitkerja,pasiennoantrian:noantrian,idbppoli:idbppoli, text:text},
    	success: function(respon){console.log(respon)},
    });
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
                '<td class="text-center" style="width: 20%">'+time+'</td>'+
                '<td class="text-center" style="width: 18%">'+status+'</td>'+
            '</tr>');
}

function templatePasienSkip(d){
  return $('<tr>'+
      '<td class="text-center" style="width: 15%">'+d.pasiennoantrian+'</td>'+
      '<td class="text-center">'+d.NAMA_LGKP+'</td>'+
      '<td class="text-center" style="width: 20%"><button class="btn btn-info"><i class="fa fa-arrow-right"></i></button></td>'+
  '</tr>');
}

function templatePasienKonsul(d){
  return $('<tr>'+
      '<td class="text-center" style="width: 15%">'+d.pasiennoantrian+'</td>'+
      '<td class="text-center">'+d.NAMA_LGKP+'</td>'+
      '<td class="text-center" style="width: 20%"><button class="btn btn-info"><i class="fa fa-arrow-right"></i></button></td>'+
  '</tr>');
}

function getListPasien(){
    return $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("get-pasien")}}',
        type: 'GET',
        data: {
          'poli[]': idbppoli, 
          limit:10,
          where: 'AND iscall=1 ',
        },
        dataType: 'json',
        success: function (result) {
            let $tbodypasien = $('.antrean-poli-container.original table tbody')
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

function getListPasienSkip(){
    return $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("get-pasien")}}',
        type: 'GET',
        data: {
          'poli[]': idbppoli, 
          where: 'AND isskipped=1 AND isrecall=0  AND isdone=0 ',
        },
        dataType: 'json',
        success: function (result) {
            let $tbodypasien = $('.antrean-poli-container.skip table tbody')
            $tbodypasien.empty()
            if(result.data){
                var data = result.data;
                for (const d of data.listpasien) {
                    $tbodypasien.append(templatePasienSkip(d));
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

function getListPasienKonsul(){
    return $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("get-pasien")}}',
        type: 'GET',
        data: {
          'poli[]': idbppoli, 
          where: 'AND isconsul=1 AND isrecall=0  AND isdone=0 ',
        },
        dataType: 'json',
        success: function (result) {
            let $tbodypasien = $('.antrean-poli-container.konsul table tbody')
            $tbodypasien.empty()
            if(result.data){
                var data = result.data;
                for (const d of data.listpasien) {
                    $tbodypasien.append(templatePasienKonsul(d));
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

$(function () {
    $(document).keydown(function(e){
        evt = e || window.event;
        var target = evt.target || evt.srcElement;
        if ( !/INPUT|TEXTAREA|SELECT|BUTTON/.test(target.nodeName) ) {
            if (e.keyCode==49 || e.keyCode==97){
                console.log('next');
            } else if (e.keyCode==50 || e.keyCode==98){
                console.log('recall');
            }
        }
    });

    $("#viewantrian").hide();

    getpoliaktif();

    // $("#idbppoli").select2({
    //   placeholder: 'Pilih Poli',
    //   // allowClear: true
    // });

    // $("#idbppoli").change(function(){
    //   idbppoli = $(this).val();
    //   getDataPoli();
    // });
    
    // $("#idbppoli").val("1").trigger("change");
    // idbppoli = $("#idbppoli").val();

    // getDataPoli();
    // setInterval(function(){getNomor()}, 5000);
});
</script>
<!-- <script type="text/javascript" src="{{asset('js/poli.js')}}"></script> -->
@stop