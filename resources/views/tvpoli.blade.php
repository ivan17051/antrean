@extends('layouts.tvbase')
@section('content')
<div class="modal fade p-0" id="menu" tabindex="-1" style="display: none;" data-backdrop="static" aria-hidden="false">
    <div class="modal-dialog modal-lg" style="margin: 0;max-width: 100%;">
        <div class="modal-content bg-purple text-white">
            <div class="modal-header">
                <h4 class="modal-title pull-left text-white">PILIH POLI</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="menu-list-poli">
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('umum')">UMUM</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('gigi')">GIGI</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('kia')">KIA</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('gizi')">GIZI</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('sanitasi')">SANITASI</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('batra')">BATRA</button></div>
                    <div class="col-2 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('psikologi')">PSIKOLOGI</button></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<header class="content__title">
    <div class="row">
        <div class="col-md-6">
            <div class="navbar-wrapper" style="">
                <div class="navbar-minimize">
                </div>
                <img src="{{asset('public/img/pemkot.png')}}" alt="Logo" style="height:100px; margin-bottom:30px;">
                <h3 class="navbar-brand" style="padding-top:30px; padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota Surabaya<br>
                <label class="text-secondary" id="namaunitkerja" >Puskesmas Asemrowo</label></h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <h2 class="display-2 text-right fweight-400">Poli Umum</h2>
        </div>
    </div>
</header>
<div class="content__title" style="padding-top:0!important">
    <div class="d-flex justify-content-between align-items-center">
        <span class="nav-item">
            <div>
                <p id="date_time" style="margin-bottom: 0px!important; font-size: 20px; font-weight: 400; "></p>
            </div>
        </span>
        <div>
            <span class="nav-item">
                <button class="btn btn-light font-2c5rem"><i class="zmdi zmdi-volume-up"></i></button>
            </span>
            <span class="nav-item">
                <button class="btn btn-light font-2c5rem" data-toggle="modal" data-target="#menu" ><i class="zmdi zmdi-menu"></i></button>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4 tv-antrian">
        <div class="card">
            <div class="card-body bg-purple">
                <h2 class="text-white antrian-dokter text-center">dr. Kemal</h2>
            </div>
            <div class="card-body">
                <h4 class="antrian-nomor">1</h4>
                <h3 class="antrian-nama">Suherman</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 tv-antrian">
        <div class="card">
            <div class="card-body bg-purple">
                <h2 class="text-white antrian-dokter text-center">dr. Budi</h2>
            </div>
            <div class="card-body">
                <h4 class="antrian-nomor">2</h4>
                <h3 class="antrian-nama">Jaidi</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4 tv-antrian">
        <div class="card">
            <div class="card-body bg-purple">
                <h2 class="text-white antrian-dokter text-center">dr. Paksi</h2>
            </div>
            <div class="card-body">
                <h4 class="antrian-nomor">3</h4>
                <h3 class="antrian-nama">Marno</h3>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Antrian</h4>
                <h6 class="card-subtitle">Vestibulum purus quam scelerisque, mollis nonummy metus</h6>

            </div>
            <div class="card-body">
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama</th>
                        <th>Estimasi Masuk</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>07:00</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Judy</td>
                        <td>07:30</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>08:00</td>
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
function setpoli(id) {
    $('#menu').modal('hide');
}

function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    h = date.getHours();
    if(h<10)
    {
            h = "0"+h;
    }
    m = date.getMinutes();
    if(m<10)
    {
            m = "0"+m;
    }
    s = date.getSeconds();
    if(s<10)
    {
            s = "0"+s;
    }
    result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("'+id+'");','1000');
    return true;
}

$(function () {
    $('#menu').modal('show');
    date_time("date_time");
});
</script>
@endsection