@extends('layouts.mainlayout2')

@section('content')
<div class="modal fade" id="modal-konfirmasi-panggil" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Yakin ingin memanggil <strong class="nama">NAMA</strong></h4>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          <input type="hidden" name="pasiennoantrian">
          <button type="button" class="btn btn-default batal" data-dismiss="modal">TIDAK</button>
          <button type="submit" class="btn btn-success">YA</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-konfirmasi-selesai" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pilih Aksi</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <select name="pasiennoantrian" class="form-control" style="width: 100%;" required>
            <option></option>
          </select>
        </div>
        <div class="form-group">
          <label for="tipe1">SELESAI</label>
          <div class="iradio checked">
            <input type="radio" name="tipe" id="tipe1"  value="SELESAI" checked>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="tipe2">KE FARMASI</label>
          <div class="iradio checked">
            <input type="radio" name="tipe" id="tipe2" value="FARMASI"  >
          </div>
        </div>
        <div class="form-group">
          <label for="tipe3">KE LAB</label>
          <div class="iradio checked">
            <input type="radio" name="tipe" id="tipe3" value="LAB"  >
          </div>
        </div> -->
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default batal" data-dismiss="modal">BATAL</button>
          <button type="submit" class="btn btn-success">LAKUKAN</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-rujukan" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Rujuk Internal Pasien</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <select name="pasiennoantrian" class="form-control" style="width: 100%;" required onchange="setPoliRujukanBalik(event)">
            <option></option>
          </select>
        </div>
        <div class="form-group">
          <label for="">Poli Rujuk Balik</label>
          <select name="polirujukan" class="form-control" style="width: 100%;" required readonly>
            <option></option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-default batal" data-dismiss="modal">BATAL</button>
          <button type="submit" class="btn btn-success">RUJUK</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal modal-dialog-centered fade" id="modal-next-or-skip" style="display: none;">
  <div class="modal-dialog" style="width:fit-content;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title">Pilih Aksi</h4>
      </div>
      <div class="modal-body text-center">
          <button type="button" class="btn btn-warning btn-lg" onclick="nextno(2);"><i
            class="fa  fa-arrow-circle-o-right"></i> Skip</button>
          <button type="button" class="btn btn-primary btn-lg" onclick="nextno();"><i class="fa fa-arrow-right"></i>
            Berikutnya</button>
      </div>
    </div>
  </div>
</div>
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
    background: rgba(0, 0, 0, 0.2);
  }

  .box-info {
    display: block;
    min-height: 180px;
    background: #fff;
    width: 100%;
    height: 100%;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
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
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
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
    background: rgba(0, 0, 0, 0.2);
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
          <div class="d-flex">
            <div class="form-group flex-0" style="flex-basis: 160px;">
              <!-- select poli -->
              <select id="listpoliselect" class="form-control" >
                <option></option>
              </select>
              <!-- end select poli -->
            </div>
            <span class="flex-1" style="padding-left:12px">
              <button class="btn btn-success " onclick="setpoli()"><i class="fa fa-refresh"></i> Tampilkan</button>
            </span>
          </div>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-md-5">
              <div> <span class="pasiencaption" id="namapasien">Pasien</span> &nbsp;&nbsp;&nbsp; <button type="button"
                  onclick="setpoli()" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button></div>
              <div class="box-info">
                <span class="box-info-number bg-red" id="noantrian"></span>
                <div class="box-info-content">

                  <div class="btn-group-vertical btn-group-lg" role="group">
                    <button type="button" class="btn btn-primary" onclick="nextno();"><i class="fa fa-arrow-right"></i>
                        Berikutnya</button>
                    <!-- <button type="button" class="btn btn-warning" onclick="nextno(2);"><i
                        class="fa  fa-arrow-circle-o-right"></i> Skip</button> -->
                    <button type="button" id="btnrujukbalik" class="btn btn-info" onclick="beforePanggilBerikutnya(true);"><i class="fa fa-arrow-right"></i>
                      Rujuk Balik</button>
                    <button type="button" class="btn btn-primary" onclick="beforePanggilBerikutnya();"><i class="fa fa-arrow-right"></i>
                      Aksi Lain</button>
                    <button type="button" class="btn btn-secondary" onclick="recall();"><i class="fa fa-volume-up"></i>
                      Ulang</button>
                  </div>

                  <!-- <div class="btn-group-vertical btn-group-lg" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-success"><i class="fa fa-check"></i> Hadir</button>
                    <button type="button" class="btn btn-danger"><i class="fa  fa-times"></i> Tidak</button>
                  </div> -->
                </div>
              </div>

              <!-- Tabel Pasien Skip & Pelayanan -->
              <!-- <div class="nav-tabs-custom">
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
                      <div class="box antrean-poli-container konsul"
                        style="display: block;overflow: auto;height: 100%;">
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
              </div> -->

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
  var timeout = 0;
  var gate = 0;

  function distombol(time) {
    $(".tombolaksi").prop("disabled", true);
    setTimeout(function () {
      $(".tombolaksi").prop("disabled", false);
    }, time);
  }

  function getpoliaktif() {
    $.ajax({
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
      },
      url: Settings.baseurl + '/getlistpoli',
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
    }).done(() => {
      // console.table(listpoli)
    })
  }

  function createlistpoli(data) {
    // $("#boxpoliantrian").empty()
    var i = 0;
    // console.log(data);
    var box = data.map(function (poli) {
      var x = $('<div class="col-md-6" style="margin-top:10px;">' +
        '<button type="button" class="btn btn-block btn-lg btn-danger buttonpoli" style="font-size: 32px;">' +
        poli.nama + '</button>' +
        '</div>');
      x.on('click', function () {
        // namapoli = poli.nama
        setpoli(poli.id)
        if(poli.id == 31) {
          $('#btnrujukbalik').hide();
        }
      });
      return x;
    })
    $("#listpoli").html('').append(box);

    // showmodalsetup();
  }

  function createlistpoliselect(data){
    $("#listpoliselect").select2({
      placeholder: 'Pilih Poli',
      allowClear: true
    });
    var options = $('#listpoliselect');
    $.each(data, function() {
      options.append($("<option />").val(this.id).text(this.nama));
    });
    $('#listpoliselect').val(null).trigger("change");

    setDropDownListPoliRujukan(data)
    // $('#listpoliselect').change(function(){
    //   setpoli(this.value)
    // })
  }

  function setpoli() {
    $("#loading").show();
    $("#boxlistpoli").hide('slow');
    $("#viewantrian").show('slow');

    idbppoli = $("#listpoliselect").val();
    if(idbppoli == ""){ 
      alert('Pilih poli terlebih dahulu!')
      $("#loading").hide();
      return
    }
    // setTimeout(getNomor, 2000);
    getDataPoli();
    getListPasien();
    // getListPasienSkip();
    // getListPasienKonsul();
    $("#loading").hide();
  }

  function kembali() {
    $("#boxlistpoli").show('slow');
    $("#viewantrian").hide('slow');
  }

  function syncPoli($polis){
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: Settings.baseurl + '/syncpoli',
      type: 'POST',
      data: {
        'poli[]': $polis
      },
      dataType: 'json',
      success: function (result) {
        console.log('sync',result);
        // var data = result.data[0];
        // sound(noantrian, idbppoli);
      }
    });
  }

  function getDataPoli() {
    // $('#listpoli').empty();
    $("#loading").show();
    // $("#tombolnext").prop("disabled", true);
    if (idbppoli) {
      $.ajax({
        url: Settings.baseurl + '/getdatapoli/' + idbppoli,
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

  function nextno(tipe, pasiennoantrian=null) {
    $('#modal-next-or-skip').modal('hide')

    if (tipe == 1) distombol(2500);
    else distombol(1700);

    $("#loading").show();
    // console.log('next');
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: Settings.baseurl + '/layaniantrian',
      type: 'POST',
      data: {
        idunitkerja: idunitkerja,
        pasiennoantrian: pasiennoantrian || noantrian,
        idbppoli: idbppoli,
        tipe: tipe
      },
      success: function (respon) {
        // console.log(respon);
        if (respon == 1) {
          // getDataPoli();
          // setTimeout(function(){addantriansuara(noantrian, idbppoli)}, timeout+=500);
          toast("info", "Call");
          toast("success", "Berhasil");
        } else {
          toast("info", respon);
        }
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toast("error", textStatus);
        setTimeout(getDataPoli, 1000);
      },
      complete: function (data) {
        setTimeout(getDataPoli, 1000);
        getListPasien();
        // getListPasienSkip();
        // getListPasienKonsul();
      }
    });
    $("#loading").hide();
  }

  function recall() {
    // toast('info', 'panggil ulang');
    distombol(2500);
    // sound(noantrian, idbppoli);
    toast("info", "Recall");
    if (noantrian) {
      addantriansuara(noantrian, idbppoli, textpanggilan);
    }
  }

  function addantriansuara(noantrian, idbppoli, text) {
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: Settings.baseurl + '/addantriansuara',
      type: 'POST',
      data: {
        idunitkerja: idunitkerja,
        pasiennoantrian: noantrian,
        idbppoli: idbppoli,
        text: text
      },
      success: function (respon) {
        console.log(respon)
      },
    });
  }

  function templatePasien(d) {
    let datenow = new Date();
    let time = new Date(d.tanggaleta)
    let minutesDifference = (datenow - time) / (1000 * 60);
    let status, statusText;

    if (d.isdone) {
      statusStyle = "my-bg-success"
      status = "Dilayani"
    } else if (d.isconsul) {
      statusStyle = "my-bg-info"
      status = "Konsultasi/Penunjang"
    } else if (d.isconfirm) {
      statusStyle = "my-bg-warning"
      status = "Hadir"
    } else if (minutesDifference > 30) { //telat >30 menit
      statusStyle = "my-bg-danger"
      status = "Batal"
    } else {
      statusStyle = "my-bg-light"
      status = "Belum Datang"
    }
    // iscall
    // isrecall
    // isserved
    // isskipped

    time = time.toLocaleTimeString('uk')
    return $('<tr class="' + statusStyle + '">' +
      '<td class="text-center" style="width: 15%">' + d.pasiennoantrian + '</td>' +
      '<td class="text-center">' + d.NAMA_LGKP + '</td>' +
      '<td class="text-center" style="width: 20%">' + time + '</td>' +
      '<td class="text-center" style="width: 18%">' + status + '</td>' +
      '</tr>');
  }

  function templatePasienSkip(d) {
    return $('<tr>' +
      '<td class="text-center" style="width: 15%">' + d.pasiennoantrian + '</td>' +
      '<td class="text-center">' + d.NAMA_LGKP + '</td>' +
      '<td class="text-center" style="width: 20%"><button class="btn btn-info" onclick="recallSkipKonsul('+d.pasiennoantrian+',\''+d.NAMA_LGKP+'\')"><i class="fa fa-arrow-right"></i></button></td>' +
      '</tr>');
  }

  function templatePasienKonsul(d) {
    return $('<tr>' +
      '<td class="text-center" style="width: 15%">' + d.pasiennoantrian + '</td>' +
      '<td class="text-center">' + d.NAMA_LGKP + '</td>' +
      '<td class="text-center" style="width: 20%"><button class="btn btn-info" onclick="recallSkipKonsul('+d.pasiennoantrian+',\''+d.NAMA_LGKP+'\')"><i class="fa fa-arrow-right"></i></button></td>' +
      '</tr>');
  }

  function getListPasien() {
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("get-pasien", ["idunitkerja"=>app("request")->get("idunitkerja")])}}',
      type: 'GET',
      data: {
        'poli[]': idbppoli,
        // where: 'AND isdone=0 AND isconsul=0 ',
      },
      dataType: 'json',
      success: function (result) {
        let $tbodypasien = $('.antrean-poli-container.original table tbody')
        $tbodypasien.empty()
        if (result.data) {
          var data = result.data;
          for (const d of data.listpasien) {
            $tbodypasien.append(templatePasien(d));
          }
        } else {
          // toast("info", respon);
        }
      },
      error: function (responsedata) {
        var errors = responsedata.statusText;
        $('#loading').hide();
        toast("error", errors);
      }
    });
  }

  function getListPasienSkip() {
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("get-pasien", ["idunitkerja"=>app("request")->get("idunitkerja")])}}',
      type: 'GET',
      data: {
        'poli[]': idbppoli,
        where: 'AND isskipped=1 AND isrecall=0  AND isdone=0 ',
      },
      dataType: 'json',
      success: function (result) {
        let $tbodypasien = $('.antrean-poli-container.skip table tbody')
        $tbodypasien.empty()
        if (result.data) {
          var data = result.data;
          for (const d of data.listpasien) {
            $tbodypasien.append(templatePasienSkip(d));
          }
        } else {
          // toast("info", respon);
        }
      },
      error: function (responsedata) {
        var errors = responsedata.statusText;
        $('#loading').hide();
        toast("error", errors);
      }
    });
  }

  function getListPasienKonsul() {
    return $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: '{{route("get-pasien", ["idunitkerja"=>app("request")->get("idunitkerja")])}}',
      type: 'GET',
      data: {
        'poli[]': idbppoli,
        where: 'AND isconsul=1 AND isrecall=0  AND isdone=0 ',
      },
      dataType: 'json',
      success: function (result) {
        let $tbodypasien = $('.antrean-poli-container.konsul table tbody')
        $tbodypasien.empty()
        if (result.data) {
          var data = result.data;
          for (const d of data.listpasien) {
            $tbodypasien.append(templatePasienKonsul(d));
          }
        } else {
          // toast("info", respon);
        }
      },
      error: function (responsedata) {
        var errors = responsedata.statusText;
        $('#loading').hide();
        toast("error", errors);
      }
    });
  }

  function recallSkipKonsul(pasiennoantrian, nama){
    let $modal = $('#modal-konfirmasi-panggil')
    $modal.find('[name=pasiennoantrian]').val(pasiennoantrian)
    $modal.find('.nama').text(nama)
    $modal.modal('show')

    $modal.find('form').submit(function(e) {
      $('#loading').show();

      event.preventDefault();
      let param = $(this).serialize()
      console.log(param)
      //continue with ajax request
      $.ajax({
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          url: '{{route("layanikembali", ["idunitkerja"=>app("request")->get("idunitkerja")])}}?'+param,
          data: {
            'poli[]': idbppoli,
          },
          type: 'POST',
          dataType: 'json',
          success: function (result) {
              console.log(result);
              toast("success", 'Memanggil '+nama);
          },
          error: function(responsedata){
              var errors = responsedata.statusText;
              $('#loading').hide();
              toast("error", errors);
          },
          complete: function(){
            $modal.modal('hide')
            $('#loading').hide();
          }
      }); 
      $(this).unbind('submit');
    });
  }

  function getPasienSedangDiperiksa(){
    return $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: '{{route("get-pasien", ["idunitkerja"=>app("request")->get("idunitkerja")])}}',
      type: 'GET',
      data: {
        'poli[]': idbppoli,
        where: 'AND ((iscall=1 AND isdone=0 AND isconsul=0 AND isskipped=0) OR (isrecall=1 AND isskipped=1 AND isdone=0) OR (isrecall=1 AND isconsul=1 AND isdone=0)) ',
      },
      dataType: 'json'
    }); 
  }

  async function beforePanggilBerikutnya(isRujukan=false){
    $('#loading').show();
    let $modal;

    if(isRujukan) $modal = $('#modal-rujukan');
    else $modal = $('#modal-konfirmasi-selesai');

    try {
      const res = await getPasienSedangDiperiksa();

      let $pasienSelect2 = $modal.find('[name=pasiennoantrian]')
      $pasienSelect2.empty()
      $pasienSelect2.select2({
        placeholder: 'Pasien',
        allowClear: true
      });
      
      var data = res.data;
      
      if(data.listpasien.length == 0){
        // nextno(1)
        toast("info","Tidak ada pasien di ruangan.")
        $('#loading').hide();
        return
      }

      for (const d of data.listpasien) {
        let $option = $("<option />")
        $option.val(d.pasiennoantrian).text(d.NAMA_LGKP)
        $option[0].dataset.idbppoliasal = d.idbppoliasal
        $option[0].dataset.poliasal = d.poliasal
        $pasienSelect2.append($option);
      }
      $pasienSelect2.val(null).trigger("change");
      
      $modal.modal('show')

      if(isRujukan){
        // ON SUBMIT UNTUK RUJUKAN
        $modal.find('form').submit(function(e) {
          event.preventDefault();
          let param = getFormData($(this))

          if(param.polirujukan == idbppoli){
            alert("Poli tidak boleh sama.");
            return;
          }

          goToPoliRujukan($(this).serialize(), param.pasiennoantrian);

          $modal.modal('hide')
          $(this).unbind('submit');
        });
      }else{
        // ON SUBMIT 
        $modal.find('form').submit(function(e) {
          event.preventDefault();
          let param = getFormData($(this))

          if(param.tipe == 'SELESAI'){
            nextno(1, param.pasiennoantrian)
          }else{
            goToFarmasiLab($(this).serialize(), param.pasiennoantrian);
          }

          $modal.modal('hide')
          $(this).unbind('submit');
        });
      }
      
    } catch(errors) {
      toast("error", errors);
    }
    $('#loading').hide();
  }

  function goToFarmasiLab(param, pasiennoantrian){
    $('#loading').show();
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: '{{route("gotofarmasilab", ["idunitkerja"=>app("request")->get("idunitkerja")])}}?'+param,
      type: 'POST',
      data: {
        'poli[]': idbppoli,

      },
      dataType: 'json',
      success: function (result) {
        toast("success", 'Berhasil');
      },
      error: function(responsedata){
          var errors = responsedata.statusText;
          toast("error", errors);
      },
      complete: function(){
        $('#loading').hide();
      }
    }); 
  }

  function goToPoliRujukan(param, pasiennoantrian){
    $('#loading').show();
    $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: '{{route("gotopolirujukan", ["idunitkerja"=>app("request")->get("idunitkerja")])}}?'+param,
      type: 'POST',
      data: {
        'poli[]': idbppoli,
      },
      dataType: 'json',
      success: function (result) {
        toast("success", 'Berhasil');
      },
      error: function(responsedata){
          var errors = responsedata.statusText;
          toast("error", errors);
      },
      complete: function(){
        $('#loading').hide();
      }
    }); 
  }

  function setPoliRujukanBalik(event){
    let $poliSelect = $('[name=polirujukan]')
    let $selected = $(event.target).find(":selected")[0]

    $poliSelect.empty()

    if(!$selected) return;

    let idpoli = $selected.dataset.idbppoliasal
    let namapoli = $selected.dataset.poliasal

    $poliSelect.append($("<option />").val(idpoli).text(namapoli));
    $poliSelect.val(idpoli).trigger("change");
    $poliSelect.attr('readonly',true)
  }

  $(function () {
    $(document).keydown(function (e) {
      evt = e || window.event;
      var target = evt.target || evt.srcElement;
      if (!/INPUT|TEXTAREA|SELECT|BUTTON/.test(target.nodeName)) {
        if (e.keyCode == 49 || e.keyCode == 97) {
          console.log('next');
        } else if (e.keyCode == 50 || e.keyCode == 98) {
          console.log('recall');
        }
      }
    });

    $("#boxlistpoli").hide();

    var listpoli = <?php echo json_encode($d['listpoli']); ?>;
    // createlistpoli(listpoli);
    createlistpoliselect(listpoli)

    // getpoliaktif();

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