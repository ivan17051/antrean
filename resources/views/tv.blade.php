@extends('layouts.tvbase')
@section('content')
<header class="content__title">
    <div class="row">
        <div class="col-md-5">
            <div class="navbar-wrapper" style="">
                <img src="{{asset('public/img/pemkot.png')}}" alt="Logo" style="height:100px;margin-bottom:30px;">
                <h3 class="navbar-brand" style="padding-top:30px;padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                    Surabaya<br>
                    <label class="text-secondary" id="namaunitkerja">{{$d['nama']}}</label>
                </h3>
            </div>
        </div>
        <div class="col-md-7 d-flex justify-content-end align-items-center">
            <!-- <div class="btn-group-vertical">
                <button class="btn btn-outline-dark" style="font-size:20px;border:0;"><i class="zmdi zmdi-volume-up"></i></button>
                <button class="btn btn-outline-dark" style="font-size:20px;margin-bottom:25px;border:0;" data-toggle="modal" data-target="#menu" ><i class="zmdi zmdi-menu"></i></button>
            </div> -->
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
<div class="row" id="listpoli">
    
</div>
@endsection

@section('jsx')
<script type="text/template" id="templatepoli">
<div class="col-md-4 tv-antrian">
    <div class="card flex-row">
        <div class="bg-purple d-inline-block position-relative" style="width: 37%;">
            <div class="" style="padding-top: 100%;">
            </div>
            <h2 class="centered-elem display-3 text-white antrian-current"><strong>0</strong></h2>
        </div>
        <div class="d-flex flex-column justify-content-center" style="padding: 12px;width:63%;">
            <h4 class="font-2c25rem antrian-poli">{poli}</h4>
            <h5 class="card-text text-secondary antrian-next">Nomor berikutnya : <span class="antrian-next">-</span></h5>
            <h5 class="card-text text-secondary antrian-time-est">Estimasi jam dilayani : <span class="antrian-time-est">-</span></h5>
            <h5 class="card-text text-secondary antrian-total">Jumlah antrean : <span class="antrian-total">-</span></h5>
        </div>
    </div>
</div>
</script>
<script>
var $elements;
function getPoliUtama(){
    $('#listpoliutama').empty();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("getlistpoli")}}',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var data = result.data;
            $elements = {};
            for (const d of data) {
                var templatepoli = document.getElementById("templatepoli").innerHTML;
                var polihtml = templatepoli.replace(/\{poli\}/, d['nama']);
                var $poli = $(polihtml);
                $('#listpoli').append($poli);
                $elements[d.id] = $poli;
            }
        },
        error: function(responsedata){
            var errors = responsedata.statusText;
            $('#loading').hide();
            toast("error", errors);
        }
    });

}

var streamnomor = new EventSource('{{route("getnomorstream")}}');

streamnomor.onmessage = function(event){
    if(!$elements) return;

    var data = JSON.parse(event.data)
    console.log(data)
    var datanow = data.now
    var datanext = data.next

    for (const i in datanow) {
        let idpoli = datanext[i]['idbppoli']
        let $poli = $elements[idpoli]

        if (datanow[i]['idbppoli']) {
            $poli.find('.antrian-current').text(datanow[i]['noantrian'])
            $poli.find('.antrian-next').text(datanext[i]['noantrian'])
            $poli.find('.antrian-time-est').text(datanext[i]['jamestimasi'])
            $poli.find('.antrian-total').text(datanext[i]['servesmax'])
        }
    }
}

$(function () {
    getPoliUtama();
    // initSmoothScrolling('.row-wrapper','smoothscroll');
    // initSmoothScrolling('.row-wrapper2','smoothscroll2');
});
</script>
@endsection