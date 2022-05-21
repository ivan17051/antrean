@extends('layouts.base')
@section('content')
@include('components.cetakqrcode')
<header class="content__title">
    <h1>Rujukan Pasien</h1>
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
          <div class="row">
            <div class="col-12 d-flex">
              <div class="widget-search widget-search--inverse bg-purple" style="background-color:#d066e2;flex:1;">
                <i class="zmdi zmdi-search"></i>
                <input type="text" class="widget-search__input barcode-input text-left" maxlength="16" placeholder="Masukkan NIK">
                        
              </div>
              <button title="cetak QR Code" data-toggle="modal" data-target="#modal-qrcode"  onclick="createQRCode('3578272503990003')" class="ml-2 btn btn-purple btn--icon-text mb-1 rounded-0" style="border: 1px solid;height:54px;">
                <i class="zmdi zmdi-receipt"></i>
              </button>
            </div>
            
          </div>
          
      </div>     
    </div>

  </div>
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <label>NIK</label><br>
                <input class="form-control" type="text" value="3578200012120000" readonly>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Nama</label><br>
                <input class="form-control" type="text" value="Arya Wiguna" readonly>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <input class="form-control" type="text" value="L" readonly>
              </div>
          </div>
          <div class="col-md-2">
              <div class="form-group">
                <label>Tanggal Lahir</label><br>
                <input class="form-control" type="text" value="12-12-1970" readonly>
              </div>
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label><br>
                <input class="form-control" type="text" value="Jl. Jaksa Agung Suprapto No.10 Surabaya" readonly>
              </div>
          </div>

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