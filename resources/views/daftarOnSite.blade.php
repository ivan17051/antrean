@extends('layouts.tvbase')
@section('content')
<div id="modalkonfirm" class="modal fade" tabindex="-1" style="display:none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">Silahkan Konfirmasi Pilihan Anda Dengan Scan Barcode</h5>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group form-group--float">
                        <input type="text" class="form-control" style="letter-spacing:5px;" id="nik" name="nik" maxlength="16">
                        <label>NIK</label>
                      <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas Kesehatan</label>
                        <input type="text" class="form-control" id="" name="faskes" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pilihan Poli</label>
                        <input type="text" class="form-control" id="" name="poli" value="" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" id="" name="tanggal" value="" readonly>
                    </div>
                </form>
            </div>
            <div class="row modal-footer ">
                <div class="col">
                    <button type="button" class="btn btn-purple btn-block">Simpan</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Tutup</button>
                </div>
                
            </div>
        </div>
    </div>

</div>
<header class="content__title">
    <h1>Pendaftaran Pasien On Site</h1>
    <small>Selamat Datang di Aplikasi Pendaftaran On Site!</small>

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
          <h4 class="card-title">Pilih Poli</h4>
          <h6 class="card-subtitle">Silahkan Pilih Poli yang Ingin Dituju.</h6>

          <div class="row">
            @foreach($poli as $unit)
              <div class="col-md-3" style="margin-bottom:5px;">
                <button class="btn btn-block btn-purple btn-daftar" value="{{$unit->noid}}" onclick="passData(this)">{{$unit->policaption}}</button>
              </div>
            @endforeach
          </div>
          
      </div>     
    </div>

  </div>
</div>
@endsection

@section('jsx')
<script>
  function passData(e){
    var val = e.value;
    var datenow = new Date();
    var tanggal = datenow.getFullYear()+'-'+datenow.getMonth()+'-'+datenow.getDate();
    $('input[name=tanggal]').attr('value', tanggal);
    $('input[name=faskes]').attr('value', '{{Auth::user()->idunitkerja}}');
    $('input[name=poli]').attr('value', val);
    
    console.log($('input[name=nik]'));
    $input = $("#modalkonfirm").find("input[name='nik']");
    $('#modalkonfirm').on('shown.bs.modal', function (e) {
       $input.focus();
    }).modal('show');
  } 
  
</script>
@endsection