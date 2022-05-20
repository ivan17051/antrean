@extends('layouts.tvbase')
@section('content')
<header class="content__title">
    <div class="row">
        <div class="col-md-6">
            <div class="navbar-wrapper" style="">
                <img src="{{asset('public/img/pemkot.png')}}" alt="Logo" style="height:100px; ">
                <h3 class="navbar-brand" style="padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                    Surabaya<br>
                    <label class="text-secondary" id="namaunitkerja">{{$d['nama']}}</label>
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
function getPoliUtama(){
    $('#listpoliutama').empty();
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: '{{route("getlistpoli")}}',
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            var data = result.data;
        
            for (const d of data) {
                var templatepoli = document.getElementById("templatepoli").innerHTML;
                var polihtml = templatepoli.replace(/\{poli\}/, d['nama']);
                $('#listpoli').append(polihtml);
            }
            // Poli.push({ id: data[i].id, nama: data[i].nama, no: 0 });
            // }
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
    var data = JSON.parse(event.data);
    var datanow = data.now;
    console.log("datanow",datanow)
    // for (i = 0; i < datanow.length; i++) {
    //     if(datanow[i]['idbppoli']){
    //         var ip = Poli.findIndex(x => x.id === datanow[i]['idbppoli']);
    //         $("#poli"+datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
    //         $("#poli"+datanow[i]['idbppoli']).removeClass('bg-blue bg-red');
    //         if(ip !== -1){
    //             var bgcolor = (Poli[ip].no !== datanow[i]['noantrian']) ? 'bg-red' : 'bg-blue';
    //             $("#poli"+datanow[i]['idbppoli']).addClass(bgcolor);
    //             Poli[ip].no = datanow[i]['noantrian'];
    //         }
    //     }
    // }
    var datanext = data.next;
    // for (i = 0; i < datanext.length; i++) {
    //     $("#polin"+datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
    //     $("#estimasi"+datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
	// 	$("#jumlah"+datanext[i]['idbppoli']).html(datanext[i]['servesmax']);
    //     //$("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktunontindakan'] + ' menit');
    //     //$("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktutindakan']) + ' menit');
    // }
}

$(function () {
    getPoliUtama();
    initSmoothScrolling('.row-wrapper','smoothscroll');
    initSmoothScrolling('.row-wrapper2','smoothscroll2');
});
</script>
@endsection