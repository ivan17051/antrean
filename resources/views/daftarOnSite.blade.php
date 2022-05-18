@extends('layouts.tvbase')
@section('content')
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
                <button class="btn btn-block btn-primary btn-daftar">{{$unit->nama}}</button>
              </div>
            @endforeach
          </div>
          <div class="row">
            <div class="col-12">
              <div id="calendar"></div>
              
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