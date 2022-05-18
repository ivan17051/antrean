@extends('layouts.base')
@section('content')
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
          <h4 class="card-title">Rujukan Pasien</h4>
          <h6 class="card-subtitle">Silahkan Isi No Rujukan.</h6>
          <div class="row">
            <div class="col-12">
              <div class="search-inner" style="background-color:#d066e2;">
                
                <input type="text" class="search__text" placeholder="Masukkan NIK">
                        <i class="zmdi zmdi-search search__helper" data-ma-action="search-close" style="margin-left:15px;"></i>
              </div>
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