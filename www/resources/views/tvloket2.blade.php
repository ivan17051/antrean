@extends('layouts.tvlayout')
@section('content')
<div class="row" style="padding: 12px 20px;">
    <div class="col-md-7">
        <img class="d-inline-block" src="./img/pemkot.png" alt="Logo" style="height:100px; margin-bottom:30px;">
        <div class="d-inline-block navbar-wrapper" style="">
            <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                Surabaya<br>
                <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
            </h3>
        </div>
    </div>
    <div class="col-md-5 dateclock-container" >
        <div class="bg-red">
            <h4 class="text-bold dateindo" >Sabtu, 21-02-2022</h4>
            <div class="inner bg-darker text-center p-12px " style="border-radius: 12px;">
                <h3 class="m-o text-bold time" ><span class="time__hours"></span> : <span class="time__min"></span> : <span class="time__sec"></span></h3>
            </div>
            <!-- <div class="icon">
                <i class="ion ion-person-add"></i>
                <i class="fa fa-arrow-circle-right"></i>
            </div> -->
        </div>
    </div>
</div>
@endsection
@section('jsx')
<script type="text/javascript">

</script>
@endsection