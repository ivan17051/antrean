@extends('layouts.base')
@section('content')
<header class="content__title">
    <h1>Admin TV Poli</h1>
    <small>Welcome to the unique Material Design admin web app experience!</small>

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
    <div class="col-md-6">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="float-right"> 
                            <div class="text-center"><i class="zmdi zmdi-time"></i></div>
                            <h6>08:00</h6> 
                        </span>
                        <h4 class="card-title">dr. Kemal Pahlevi</h4>
                        <h6 class="text-secondary">menangani pasien:</h6>
                        <h6 class="text-secondary">12. Aldo</h6>
                        <hr>
                        <div class="d-block text-right">
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-assignment-check"></i> Selesai</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-volume-up"></i> Panggil</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-forward"></i> Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="float-right"> 
                            <div class="text-center"><i class="zmdi zmdi-time"></i></div>
                            <h6>07:50</h6> 
                        </span>
                        <h4 class="card-title">dr. Sigit Purnomo</h4>
                        <h6 class="text-secondary">menangani pasien:</h6>
                        <h6 class="text-secondary">11. Bambang</h6>
                        <hr>
                        <div class="d-block text-right">
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-assignment-check"></i> Selesai</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-volume-up"></i> Panggil</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-forward"></i> Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <span class="float-right"> 
                            <div class="text-center"><i class="zmdi zmdi-time"></i></div>
                            <h6>08:05</h6> 
                        </span>
                        <h4 class="card-title">dr. Ashil Muzzakki</h4>
                        <h6 class="text-secondary">menangani pasien:</h6>
                        <h6 class="text-secondary">13. Andini</h6>
                        <hr>
                        <div class="d-block text-right">
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-assignment-check"></i> Selesai</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-volume-up"></i> Panggil</button>
                            <button class="btn text-white bg-purple btn--icon-text mb-1"><i class="zmdi zmdi-forward"></i> Berikutnya</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sales Statistics</h4>
                <h6 class="card-subtitle">Vestibulum purus quam scelerisque, mollis nonummy metus</h6>

                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama</th>
                        <th>Estimasi Masuk</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>07:00</td>
                        <td>Laboratorium</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Judy</td>
                        <td>07:30</td>
                        <td>Hadir</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>08:00</td>
                        <td>Hadir</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Deni</td>
                        <td>08:30</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsx')
<script>
    
</script>
@endsection