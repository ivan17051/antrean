@extends('layouts.tvbase')
@section('content')
<div class="modal fade p-0" id="menu" tabindex="-1" style="display: none;" data-backdrop="static" aria-hidden="false">
    <div class="modal-dialog modal-lg" style="margin: 0;max-width: 100%;">
        <div class="modal-content bg-purple text-white" style="height:100vh;">
            <div class="modal-header">
                <h4 class="modal-title pull-left text-white">PILIH POLI</h4>
            </div>
            <div class="modal-body">
                <div class="row" id="menu-list-poli">
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('umum')">UMUM</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('gigi')">GIGI</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('kia')">KIA</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('gizi')">GIZI</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('sanitasi')">SANITASI</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('batra')">BATRA</button></div>
                    <div class="col-3 item-poli"><button type="button" class="btn btn-light btn--raised btn-lg" onclick="setpoli('psikologi')">PSIKOLOGI</button></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link text-white" data-dismiss="modal">TUTUP</button>
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
            <!-- <h2 class="display-2 text-right fweight-400">Poli Umum</h2> -->
            
                <button class="btn btn-light font-2c5rem"><i class="zmdi zmdi-volume-up"></i></button>
            
                <button class="btn btn-light font-2c5rem" data-toggle="modal" data-target="#menu" ><i class="zmdi zmdi-menu"></i></button>
            
            <div class="widget-time bg-purple">
                <div class="time">
                    <span class="dateindo" style="font-size:15px;"></span>
                    <span class="time__hours" style="font-size:20px;">12</span>
                    <span class="time__min" style="font-size:20px;">46</span>
                    <span class="time__sec" style="font-size:20px;">14</span>
                </div>
            </div>
            
        </div>
    </div>
</header>
<div class="content__title" style="padding-top:0!important">
    <div class="d-flex justify-content-between align-items-center">
        <!-- <span class="nav-item">
            <div>
                <p class="time" id="date_time" style="margin-bottom: 0px!important; font-size: 20px; font-weight: 400; ">
                    <span class="dateindo"></span>
                    <span class="time__hours"></span>:<span class="time__min"></span>:<span class="time__sec"></span>
                </p>
            </div>
        </span> -->
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
                <h2 class="text-white antrian-dokter text-center">POLI UMUM</h2>
            </div>
            <div class="card-body">
                <h4 class="antrian-nomor">7</h4>
                <h3 class="antrian-nama">Suherman</h3>
            </div>
        </div>
    </div>
    <div class="col-md-8 tv-antrian">
        <div class="card" style="height:calc(100% - 31.05px);">
            <div class="card-body " >
                <!-- <h2 class="pull-left font-2c5rem">Poli Umum</h2> -->
                <table class="font-1c5rem" style="font-size: larger;font-weight: 500;">
                    <tr><td style="width: 12em;">Pasien Terlayani</td><td>: -</td></tr>
                    <tr><td>Pasien Belum Terlayani</td><td>: -</td></tr>
                    <tr><td>Jumlah Antrian</td><td>: -</td></tr>
                </table>
                <table class="font-1c5rem" style="font-size: larger;font-weight: 500;">
                    <tr><td style="width: 12em;">Dokter</td><td>: dr. Abdul</td></tr>
                    <tr><td></td><td>: dr. Ashil</td></tr>
                    <tr><td></td><td>: dr. Sairul</td></tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-antrian mb-0" style="font-size: large;">
                            <thead class="bg-purple text-white">
                            <tr>
                                <th>Antrian</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Estimasi Masuk</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<10;$i++)
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-antrian mb-0" style="font-size: large;">
                            <thead class="bg-purple text-white">
                            <tr>
                                <th>Antrian</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Estimasi Masuk</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i=0;$i<10;$i++)
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                            </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="d-flex justify-content-center my-5">
                    <h5 class="legend-item"><span class="warning" ></span>Hadir</h5>
                    <h5 class="legend-item"><span class="danger" ></span>Batal</h5>
                    <h5 class="legend-item"><span class="light" ></span>Belum Datang</h5>
                    <h5 class="legend-item"><span class="success" ></span>Dilayani</h5>
                    <h5 class="legend-item"><span class="info" ></span>Konsultasi/Penunjang</h5>
                </div>
            </div>
            <marquee class="marquee-tvpoli bg-light py-2" >&vert;&nbsp;&nbsp; HUBUNGI PETUGAS APABILA TERDAPAT KENDALA 🙏 &nbsp;&nbsp;&vert;</marquee>
        </div>
    </div>
</div>

@endsection

@section('jsx')
<script>
const data = [
    ["10", "Ahmad Sofyan", "07:40", "warning"],
    ["11", "Rudi Hariyanto", "08:15", "light"],
    ["12", "Sholeh Sholihun", "08:30", "warning"],
    ["6K", "Supardi", "08:45", "info"],
    ["13", "Dewantari Putri A", "09:00", "warning"],
    ["14", "Fauzi", "-", "danger"],
    ["15", "Bambang Juwadi", "09:15", "warning"],
    ["16", "Soleman", "09:30", "light"],
];

function setpoli(id) {
    $('#menu').modal('hide');
}

$(function () {
    $('#menu').modal('show');

    //dummy
    const tr = $('.table-antrian tbody tr');
    if(tr){
        for(var i in data){
            let d = data[i]
            let $elem = $(tr[i]);
            let status=""
            
            if(d[3] == "warning") status = "Hadir";
            else if(d[3] == "danger") status = "Batal";
            else if(d[3] == "light") status = "Belum Datang";
            else if(d[3] == "success") status = "Dilayani";
            else if(d[3] == "info") status = "Konsultasi/Penunjang";

            $elem.html("<td>"+d[0]+"</td><td>"+d[1]+"</td><td>"+status+"</td><td>"+d[2]+"</td>")
            if(d[3]!=="light"){
                let elem_class = "bg-"+d[3] + (d[3]!=="warning" ? " text-white" : "")
                $elem.addClass(elem_class);
            }
        }
    }
});
</script>
@endsection