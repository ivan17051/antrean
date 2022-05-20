@extends('layouts.tvbase')
@section('content')
<header class="content__title">
    <h1>Pendaftaran Pasien Barcode</h1>
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
    <div class="card text-center" style="height:60vh;">

      <div class="card-body">
          <h4 class="card-title">Check In Pasien</h4>
          <h6 class="card-subtitle">Silahkan Scan Barcode Anda.</h6>

          <div class="row">
              <div class="col-md-3">
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                      <input class="form-control barcode-input" type="text" autofocus maxlength="16">
                  </div>
              </div>
              <div class="col-md-3">
              </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div id="notif">
                <div class="alert alert-success">
                  <h4 class="alert-heading">Well done!</h4>
                  <p class="mb-0">Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                </div>
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