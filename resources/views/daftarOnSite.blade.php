@extends('layouts.tvbase')
@section('content')
<div id="modalkonfirm" class="modal fade" tabindex="-1" style="display:none;" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title pull-left">Konfirmasi</h5>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group form-group--float">
                        <input type="text" class="form-control" id="" name="" autofocus>
                        <label>NIK</label>
                      <i class="form-group__bar"></i>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="" name="faskes" value="RS/PKM" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="" name="poli" value="POLI" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="" name="tanggal" value="" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link">Simpan</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
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
                <button class="btn btn-block btn-primary btn-daftar" data-toggle="modal" data-target="#modalkonfirm">{{$unit->nama}}</button>
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
  
</script>
@endsection