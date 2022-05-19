@extends('layouts.tvbase')
@section('content')
<header class="content__title">
    <div class="row">
        <div class="col-md-6">
            <div class="navbar-wrapper" style="">
                <img src="{{asset('public/img/pemkot.png')}}" alt="Logo" style="height:100px; ">
                <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                    Surabaya<br>
                    <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
                </h3>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <div class="text-right fweight-400">
                <p class="time" id="date_time" style="margin-bottom: 0px!important; font-size: 20px; ">
                    <span class="dateindo"></span>
                    <span class="time__hours"></span>:<span class="time__min"></span>:<span class="time__sec"></span>
                </p>
            </div>
        </div>
    </div>
</header>
<div class="row">
    @php
    $poli = ['UMUM', 'KIA', 'GIGI', 'GIZI', 'SANITASI', 'BATRA', 'PSIKOLOGI'];
    @endphp
    @foreach($poli as $i)
    <div class="col-md-4 tv-antrian">
        <div class="card flex-row">
            <div class="bg-purple d-inline-block position-relative" style="width: 37%;">
                <div class="" style="padding-top: 100%;">

                </div>
                <h2 class="centered-elem display-3 text-white"><strong>1</strong></h2>
            </div>
            <div class="d-flex flex-column justify-content-center" style="padding: 12px;width:63%;">
                <h4 class="font-2c25rem">{{$i}}</h4>
                <h5 class="card-text text-secondary">Nomor berikutnya : -</h5>
                <h5 class="card-text text-secondary">Estimasi jam dilayani : -</h5>
                <h5 class="card-text text-secondary">Jumlah antrean : -</h5>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection

@section('jsx')
<script>
    $(function () {
        initSmoothScrolling('.row-wrapper','smoothscroll');
        initSmoothScrolling('.row-wrapper2','smoothscroll2');
    });
</script>
@endsection