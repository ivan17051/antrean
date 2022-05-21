@extends('layouts.tvlayout')
@section('content')
<div style="height:calc(100vh - 81px);" class="d-flex flex-column">
<div class="row" style="padding: 12px 20px;">
    <div class="col-sm-7">
        <img class="d-inline-block" src="./img/pemkot.png" alt="Logo" style="height:100px; margin-bottom:30px;">
        <div class="d-inline-block navbar-wrapper" style="">
            <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                Surabaya<br>
                <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
            </h3>
        </div>
    </div>
    <div class="col-sm-5 dateclock-container">
        <div class="bg-red">
            <h4 class="text-bold dateindo">Sabtu, 21-02-2022</h4>
            <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
                <h3 class="m-0 text-bold time"><span class="time__hours"></span> : <span class="time__min"></span> :
                    <span class="time__sec"></span></h3>
            </div>
            <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
                <i class="fa fa-arrow-circle-right"></i>
            </div> -->
        </div>
    </div>
</div>
<div class="row" style="padding: 12px 20px;">
    <div class="box">
        <div class="box-header with-border bg-red text-center">
            <h3 class="box-title big-title">ANTREAN POLI</h3>
        </div>
    </div>
</div>
<div class="row flex-1 " style="padding: 12px 20px;">
    <div class="box h-100">
        <div class="box-body with-border p-0">
        
            <div class="col-sm-12 p-0">
                <table class="table table-bordered m-0 font-large">
                    <thead>
                        <tr class="bg-gray-light">
                            <th class="text-center" style="width: 15%">ANTRIAN</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center" style="width: 20%">POLI</th>
                            <th class="text-center" style="width: 10%">ESTIMASI</th>
                            <th class="text-center" style="width: 18%">STATUS</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-sm-12 p-0">
                <table class="table table-bordered m-0 font-large table-antrian-poli">
                    <tbody>
                        <tr class="my-bg-warning">
                            <td class="text-center" style="width: 15%">211</td>
                            <td class="text-center">AHMAD IRFAN RIFAI  SDR</td>
                            <td class="text-center" style="width: 20%">PENYAKIT DALAM</td>
                            <td class="text-center" style="width: 10%">10:11:46</td>
                            <td class="text-center" style="width: 18%">HADIR</td>
                        </tr>
                        <tr class="my-bg-success">
                            <td class="text-center" style="width: 15%">211</td>
                            <td class="text-center">AHMAD IRFAN RIFAI  SDR</td>
                            <td class="text-center" style="width: 20%">PENYAKIT DALAM</td>
                            <td class="text-center" style="width: 10%">10:11:46</td>
                            <td class="text-center" style="width: 18%">DILAYANI</td>
                        </tr>
                        <tr class="my-bg-info">
                            <td class="text-center" style="width: 15%">211</td>
                            <td class="text-center">AHMAD IRFAN RIFAI  SDR</td>
                            <td class="text-center" style="width: 20%">PENYAKIT DALAM</td>
                            <td class="text-center" style="width: 10%">10:11:46</td>
                            <td class="text-center" style="width: 18%">KONSUL/PENUNJANG</td>
                        </tr>
                        <tr class="my-bg-danger">
                            <td class="text-center" style="width: 15%">211</td>
                            <td class="text-center">AHMAD IRFAN RIFAI  SDR</td>
                            <td class="text-center" style="width: 20%">PENYAKIT DALAM</td>
                            <td class="text-center" style="width: 10%">10:11:46</td>
                            <td class="text-center" style="width: 18%">BATAL</td>
                        </tr>
                        <tr class="my-bg-light">
                            <td class="text-center" style="width: 15%">211</td>
                            <td class="text-center">AHMAD IRFAN RIFAI  SDR</td>
                            <td class="text-center" style="width: 20%">PENYAKIT DALAM</td>
                            <td class="text-center" style="width: 10%">10:11:46</td>
                            <td class="text-center" style="width: 18%">BELUM DATANG</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding: 12px 20px;">
    <div class="d-flex justify-content-center my-5">
        <h5 class="legend-item"><span class="warning" ></span>Hadir</h5>
        <h5 class="legend-item"><span class="danger" ></span>Batal</h5>
        <h5 class="legend-item"><span class="light" ></span>Belum Datang</h5>
        <h5 class="legend-item"><span class="success" ></span>Dilayani</h5>
        <h5 class="legend-item"><span class="info" ></span>Konsultasi/Penunjang</h5>
    </div>
</div>
</div>
@endsection
@section('jsx')
<script type="text/javascript">

</script>
@endsection