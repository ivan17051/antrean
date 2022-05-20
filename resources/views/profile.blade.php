@extends('layouts.base')
@section('content')
@include('components.cetakqrcode')
<header class="content__title">
    <h1>Profil</h1>
    <small>Selamat Datang di Aplikasi Pendaftaran Online!</small>

    <div class="actions">
        <a href="" class="actions__item zmdi zmdi-trending-up"></a>
        <a href="" class="actions__item zmdi zmdi-check-all"></a>
    </div>
</header>
<div class="row flex-sm-column-reverse flex-md-row">
  <div class="col-lg-5 col-md-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Profil Pengguna</h4>
        <div class="form-group">
          <label>NIK</label><br>
          <input class="form-control" type="text" value="3578200012120000" readonly>
        </div>
        <div class="form-group">
          <label>Nama</label><br>
          <input class="form-control" type="text" value="Arya Wiguna" readonly>
        </div>
        <div class="form-group">
          <label>Email</label><br>
          <input class="form-control" type="email" value="arya@wiguna.com" readonly>
        </div>
        <div class="form-group">
          <label>Telepon</label><br>
          <input class="form-control" type="text" value="0895361609011" readonly>
        </div>
        <div class="form-group">
          <label>Password</label><br>
          <input class="form-control" type="password" value="0924380942" readonly>
        </div>
        <div class="form-group">
          <label>Jenis Kelamin</label><br>
          <input class="form-control" type="text" value="L" readonly>
        </div>
        <div class="form-group">
          <label>Tanggal Lahir</label><br>
          <input class="form-control" type="text" value="12-12-1970" readonly>
        </div>
        <div class="form-group">
          <label>Alamat</label><br>
          <input class="form-control" type="text" value="Jl. Jaksa Agung Suprapto No.10 Surabaya" readonly>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">QR Code Pengguna</h4>
          <div class="imgblock text-center" data-toggle="modal" data-target="#modal-qrcode" >
            <div class="qr" id="qrcode2"></div>
            <h3 class="mt-2">357827250399</h3>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('jsx')
<script>
  createQRCode('05111740000032')
  createQRCode('05111740000032', 'qrcode2')
</script>
@endsection