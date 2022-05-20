@extends('layouts.base')
@section('content')
<div id="modalkonfirm" class="modal fade" tabindex="-1" style="display:none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">Silahkan Konfirmasi Pilihan Anda</h5>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>NIK Pasien</label><br>
                                <input type="text" class="form-control" id="" name="nik" value="{{$pasien->nik}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nama Pasien</label><br>
                                <input type="text" class="form-control" id="" name="" value="{{$pasien->nama}}" readonly>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Pilihan Fasilitas Kesehatan</label><br>
                        <input type="text" class="form-control" id="" name="faskes" value="RS/PKM" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pilihan Poli</label><br>
                        <input type="text" class="form-control" id="" name="poli" value="POLI" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pilihan Tanggal Antrian</label><br>
                        <input type="text" class="form-control" id="" name="tanggal" value="" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer row">
                <div class="col">
                    <button type="button" class="btn btn-purple btn-block">Simpan</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Batal</button>
                </div>
                
            </div>
        </div>
    </div>

</div>
<header class="content__title">
    <h1>Pendaftaran Pasien Online</h1>
    <small>Selamat Datang di Aplikasi Pendaftaran Online!</small>

    <div class="actions">
        <a href="" class="actions__item zmdi zmdi-trending-up"></a>
        <a href="" class="actions__item zmdi zmdi-check-all"></a>

        <div class="dropdown actions__item">
            <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item">Refresh</a>
                <a href="" class="dropdown-item">Manage Widgets</a>
                <a href="" class="dropdown-item">Settings</a>
            </div>
        </div>
    </div>
</header>
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-body">
        <h4 class="card-title">Pilih Fasilitas Layanan Kesehatan</h4>
        <h6 class="card-subtitle">Silahkan Pilih Fasilitas Kesehatan yang Ingin Dituju.</h6>

        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                  <label>Pilih RS/Puskesmas</label><br>

                  <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" onchange="filterFaskesOnChange(this)">
                    <option value="" selected>-- Pilih --</option>
                    <option value="rs">Rumah Sakit</option>
                    <option value="pkm">Puskesmas</option>
                  </select>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group" id="faskes">
                  <label name='label'></label><br>

                  <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" name="idunitkerja" onchange="filterPoliOnChange(this)">
                    <option value="">-- Pilih --</option>  
                  </select>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group" id="poli">
                  <label>Pilih Poli</label><br>

                  <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" name="idbppoli" onchange="filterTanggalOnChange(this)">
                      <option value="">-- Pilih --</option>
                  </select>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4" id="calendar">
          <label>Pilih Tanggal</label><br>
              <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                  </div>
                  <input class="form-control date-picker flatpickr-input" type="text" name="tanggal" Placeholder="Pilih Tanggal" readonly onchange="filterAntrianOnChange(this)">
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group" id="kepesertaan">
                  <label>Pilih Kepesertaan</label><br>

                  <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" name="kepesertaan">
                      <option value="">-- Pilih --</option>
                      <option value="bpjs">BPJS</option>
                      <option value="umum">Umum</option>
                      <option value="lain">Asuransi Lain</option>
                  </select>
              </div>
          </div>
          <div class="col-md-4">
            <div id=antrian>
              <label>Jumlah Antrian:</label><br>
              <h5>20</h5>
            </div>
          </div>
      </div>
      <div class="btn btn-lg btn-block btn-purple">Simpan</div>     
    </div>

  </div>
</div>
@endsection

@section('jsx')

<script>
  $(document).ready(function() {
    $('.select2').select2();

    $('#faskes').attr('hidden', true);
    $('#poli').attr('hidden', true);
    $('#calendar').attr('hidden', true);
    $('#kepesertaan').attr('hidden', true);
    $('#antrian').attr('hidden', true);
  });

const puskesmas = @json($puskesmas);
const rs = @json($rs);
const poli = @json($poli);

const filterFaskesOnChange = async function(e){
    var val = e.value;
    var str = '<option value="" disabled selected>-- Pilih --</option>';
    
    var dt;
    if(val==='pkm'){ //puskesmas
        dt=puskesmas;
        $('label[name=label]').empty().html('Pilih Puskesmas');
        $('select[name=idunitkerja]').empty().html(puskesmas);
        $('#faskes').attr('hidden', false);
    }else if(val==='rs'){ //rumah sakit
        dt=rs;
        $('label[name=label]').empty().html('Pilih Rumah Sakit');
        $('select[name=idunitkerja]').empty().html(rs);
        $('#faskes').attr('hidden', false);
    }else{
        $('#faskes').attr('hidden', true);
        $('#poli').attr('hidden', true);
        $('#calendar').attr('hidden', true);
    }
    dt.forEach(e => {
        str+=`<option value="${e.noid}">${e.nama}</option>`;
    });
    $('select[name=idunitkerja]').empty().html(str);
}

const filterPoliOnChange = async function(e){
    var val = e.value;
    var str = '<option value="" disabled selected>-- Pilih --</option>';
    $('input[name=faskes]').attr('value', val);
    
    var dt;
    if(val){ //jika faskes sdh terisi
        dt=poli;
        $('select[name=idbppoli]').empty().html(poli);
        $('#poli').attr('hidden', false);
        $('#kepesertaan').attr('hidden', false);
    } else{
        $('#poli').attr('hidden', true);
        $('#kepesertaan').attr('hidden', false);
        $('#calendar').attr('hidden', true);
    }
    dt.forEach(e => {
        str+=`<option value="${e.noid}">${e.nama}</option>`;
    });
    $('select[name=idbppoli]').empty().html(str);
}

const filterTanggalOnChange = async function(e){
    var val = e.value;
    $('input[name=poli]').attr('value', val);
    var dt;
    if(val){ //jika poli sdh terisi
        $('#calendar').attr('hidden', false);
    } else{
        $('#calendar').attr('hidden', true);
    }
    
}

const filterAntrianOnChange = async function(e){
    var val = e.value;
    console.log(e);
    var dt;
    if(val){ //jika poli sdh terisi
        $('#antrian').attr('hidden', false);
    } else{
        $('#antrian').attr('hidden', true);
    }
    
}

function passData(e){
    var val = e.value;
    $('input[name=tanggal]').attr('value', val);
    
} 
</script>
@endsection