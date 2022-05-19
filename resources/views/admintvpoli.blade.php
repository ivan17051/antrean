@extends('layouts.base')
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
                <button type="button" class="btn btn-link text-white" data-dismiss="modal">TUTUP</button>
            </div>
        </div>
    </div>
</div>
<header class="content__title">
    <h1>Admin TV Poli</h1>
    <small>
        <p class="time" id="date_time" style="margin-bottom: 0px!important; font-weight: 400; ">
            <span class="dateindo"></span>
            <span class="time__hours"></span>:<span class="time__min"></span>:<span class="time__sec"></span>
        </p>
    </small>

    <div class="actions">
        <!-- <a href="" class="actions__item zmdi zmdi-check-all"></a> -->
    </div>
</header>
<div class="row content__title">
    <div class="col-md-12">
        <h3>
            <span id="poli-title">POLI UMUM</span>&nbsp;&nbsp;
            <span ><button class="btn btn-light btn--icon" data-toggle="modal" data-target="#menu" style="font-size: large;"><i class="zmdi zmdi-more-vert"></i></button>
        </span></h3>
    </div>
</div>
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
                        <h4 class="card-title">dr. Kemal</h4>
                        <hr>
                        <div class="d-flex flex-row">
                            <div style="flex: 1">
                                <h6 class="text-secondary">Pasien:</h6>
                                <h6 class="text-secondary mb-3">7. Suherman</h6>
                            </div>
                            <div>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0 d-block" style="border: 1px solid;"><i class="zmdi zmdi-volume-up"></i></button>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0" style="border: 1px solid;"><i class="zmdi zmdi-assignment-check"></i></button>
                            </div>
                        </div>                        
                        <h6 class="text-secondary">Berikutnya:</h6>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" style="border: 1px solid var(--purple);" readonly value="10. Ahmad Sofyan">
                            <div class="input-group-append">
                                <button class="btn text-white bg-purple rounded-0 btn--icon-text "  style="border: 1px solid;"><i class="zmdi zmdi-forward"></i></button>
                            </div>
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
                        <h4 class="card-title">dr. Budi</h4>
                        <hr>
                        <div class="d-flex flex-row">
                            <div style="flex: 1">
                                <h6 class="text-secondary">Pasien:</h6>
                                <h6 class="text-secondary mb-3">8. Jaidi</h6>
                            </div>
                            <div>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0 d-block" style="border: 1px solid;"><i class="zmdi zmdi-volume-up"></i></button>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0" style="border: 1px solid;"><i class="zmdi zmdi-assignment-check"></i></button>
                            </div>
                        </div>                        
                        <h6 class="text-secondary">Berikutnya:</h6>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" style="border: 1px solid var(--purple);" readonly value="10. Ahmad Sofyan">
                            <div class="input-group-append">
                                <button class="btn text-white bg-purple rounded-0 btn--icon-text "  style="border: 1px solid;"><i class="zmdi zmdi-forward"></i></button>
                            </div>
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
                        <h4 class="card-title">dr. Paksi</h4>
                        <hr>
                        <div class="d-flex flex-row">
                            <div style="flex: 1">
                                <h6 class="text-secondary">Pasien:</h6>
                                <h6 class="text-secondary mb-3">9. Marno</h6>
                            </div>
                            <div>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0 d-block" style="border: 1px solid;"><i class="zmdi zmdi-volume-up"></i></button>
                                <button class="btn text-white bg-purple btn--icon-text mb-1 rounded-0" style="border: 1px solid;"><i class="zmdi zmdi-assignment-check"></i></button>
                            </div>
                        </div>                        
                        <h6 class="text-secondary">Berikutnya:</h6>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" style="border: 1px solid var(--purple);" readonly value="10. Ahmad Sofyan">
                            <div class="input-group-append">
                                <button class="btn text-white bg-purple rounded-0 btn--icon-text "  style="border: 1px solid;"><i class="zmdi zmdi-forward"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Antrian</h4>
                <table style="card-subtitle">
                    <tr><td style="width: 12em;">Pasien Terlayani</td><td>: -</td></tr>
                    <tr><td>Pasien Belum Terlayani</td><td>: -</td></tr>
                    <tr><td>Jumlah Antrian</td><td>: -</td></tr>
                </table>
                <br>
                <table class="table table-antrian mb-0">
                    <thead class="bg-purple text-white">
                    <tr>
                        <th>Antrian</th>
                        <th>Nama</th>
                        <th class="text-center">Status</th>
                        <th>Estimasi Masuk</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="dragdrop bg-warning">
                        <th scope="row">10</th>
                        <td>Ahmad Sofyan</td>
                        <td>Laboratorium</td>
                        <td>07:00</td>
                    </tr>
                    <tr class="bg-light">
                        <th scope="row">11</th>
                        <td>Rudi Hariyanto</td>
                        <td>Hadir</td>
                        <td>07:30</td>
                    </tr>
                    <tr class="dragdrop bg-warning">
                        <th scope="row">12</th>
                        <td>Sholeh Sholihun</td>
                        <td>Hadir</td>
                        <td>08:00</td>
                    </tr>
                    <tr  class="dragdrop bg-info text-white">
                        <th scope="row">6K</th>
                        <td>Supardi</td>
                        <td></td>
                        <td>08:30</td>
                    </tr>
                    <tr class="dragdrop bg-warning">
                        <th scope="row">13</th>
                        <td>Dewantari Putri A</td>
                        <td>Hadir</td>
                        <td>08:00</td>
                    </tr>
                    </tbody>
                </table>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center ">
                        <li class="page-item pagination-prev disabled"><a class="page-link" href="#"></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item pagination-next"><a class="page-link" href="#"></a></li>
                    </ul>
                </nav>
                <div class="d-flex justify-content-center my-5">
                    <h6 class="legend-item item-smaller"><span class="warning" ></span>Hadir</h6>
                    <h6 class="legend-item item-smaller"><span class="danger" ></span>Batal</h6>
                    <h6 class="legend-item item-smaller"><span class="light" ></span>Belum Datang</h6>
                    <h6 class="legend-item item-smaller"><span class="success" ></span>Dilayani</h6>
                    <h6 class="legend-item item-smaller"><span class="info" ></span>Konsultasi/Penunjang</h6>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsx')
<script>
function setpoli(id) {
    $('#poli-title').text('POLI '+id.toUpperCase())
    $('#menu').modal('hide');
}

$(function(){
    $('.dragdrop').draggable({
        revert: true,
        placeholder: true,
        droptarget: '.drop',
        drop: function(evt, droptarget) {
            let children = $(this).children();
            $('.drop').val(children[0].innerText+"."+children[1].innerText);
        }
    });
});
</script>
@endsection