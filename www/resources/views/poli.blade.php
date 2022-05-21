@extends('layouts.mainlayout2')

@section('content')
<style type="text/css">
	.box-info-number {
	    border-top-left-radius: 2px;
	    border-top-right-radius: 0;
	    border-bottom-right-radius: 0;
	    border-bottom-left-radius: 2px;
	    display: block;
	    float: left;
	    height: 180px;
	    width: 180px;
	    text-align: center;
	    font-size: 90px;
	    line-height: 180px;
	    background: rgba(0,0,0,0.2);
  	}

  	.box-info {
	    display: block;
	    min-height: 180px;
	    background: #fff;
	    width: 100%;
	    height: 100%;
	    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	    border-radius: 2px;
	    margin-bottom: 15px;
  	}

  	.box-info-content {
	    padding: 5px 10px;
	    margin-left: 180px;
  	}

  	.policaption {
  		display: block;
  		font-weight: bold;
  		font-size: 30px;
  	}

  	.pasiencaption {
		/*display: block;*/
		font-size: 24px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		vertical-align: middle;
	}

	.info-box {
	    display: block;
	    min-height: 60px;
	    background: #fff;
	    width: 100%;
	    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
	    border-radius: 2px;
	    margin-bottom: 15px;
	}

	.info-box-content2 {
	    padding: 5px 10px;
	    margin-left: 60px;
	}

	.info-box-icon2 {
	    border-top-left-radius: 2px;
	    border-top-right-radius: 0;
	    border-bottom-right-radius: 0;
	    border-bottom-left-radius: 2px;
	    display: block;
	    float: left;
	    height: 60px;
	    width: 60px;
	    text-align: center;
	    font-size: 30px;
	    line-height: 60px;
	    background: rgba(0,0,0,0.2);
	}

	.tombolaksi {
		width: 75px;
		font-size: 24px;
		margin-bottom: 5px;
		margin-right: 10px;
	}
</style>
<div id="boxlistpoli">
    <div class="row" id="listpoli"></div>
</div>
<div id="viewantrian">
	<div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="kembali();"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>
    <br>
	<div class="row">
		<div class="col-md-12">
		  	<div class="box box-primary">
		  		<div class="box-header">
		  			<div class="policaption" id="namapoli">Poli</div>
		  		</div>
		  		<div class="box-body">
		  			<div class="row">
				      <div class="col-md-4 col-sm-6 col-xs-12">
				        <div class="info-box2">
				          <span class="info-box-icon2 bg-green"><i class="fa fa-users"></i></span>
				          <div class="info-box-content2">
				            <span class="info-box-text">Jumlah Antrean</span>
				            <span class="info-box-number" id="maxantrian">0</span>
				          </div>
				        </div>
				      </div>
				      <div class="col-md-4 col-sm-6 col-xs-12">
				        <div class="info-box2">
				          <span class="info-box-icon2 bg-teal"><i class="fa fa-user"></i></span>
				          <div class="info-box-content2">
				            <span class="info-box-text">Nomor Berikutnya</span>
				            <span class="info-box-number" id="nextantrian">0</span>
				          </div>
				        </div>
				      </div>
				      <div class="col-md-4 col-sm-6 col-xs-12">
				        <div class="info-box2">
				          <span class="info-box-icon2 bg-red"><i class="fa fa-user"></i></span>
				          <div class="info-box-content2">
				            <span class="info-box-text">Sisa Antrean</span>
				            <span class="info-box-number" id="sisaantrian">0</span>
				          </div>
				        </div>
				      </div>
				    </div>
	          	</div>
	      		<div class="box-footer">
	            	<div class="row">
		  				<div class="col-md-12">
		  					<div> <span class="pasiencaption" id="namapasien">Pasien</span> &nbsp;&nbsp;&nbsp; <button type="button" onclick="getDataPoli()" class="btn btn-xs btn-default"><i class="fa fa-refresh"></i></button></div>
		  					<div class="box-info">
					            <span class="box-info-number bg-red" id="noantrian"></span>
					            <div class="box-info-content">
					            	
					              	<!-- <div class="pasiencaption" id="namapasien">Pasien</div> -->
					              	<!-- <span style="display: block;">
					              		<button class="btn btn-lg bg-red" onclick="nextno();" id="tombolnext" style="width: 75px; font-size: 30px;"><i class="fa fa-arrow-right"></i></button>
					              		<button class="btn btn-lg" onclick="recall();" id="tombolrecall" style="width: 75px; font-size: 30px; background-color: #ec3822 !important; color: #fff !important;"><i class="fa fa-volume-up"></i></button>
					              	</span> -->
					              	<div><button class="btn btn-lg bg-green tombolaksi" onclick="nextno(1);"><i class="fa fa-arrow-right"></i></button><span>Panggil</span></div>
					              	<div><button class="btn btn-lg bg-green tombolaksi" onclick="nextno(2);"><i class="fa  fa-arrow-circle-o-right"></i></button><span>Skip</span></div>
					              	<div><button class="btn btn-lg bg-green tombolaksi" onclick="recall();"><i class="fa fa-volume-up"></i></button><span>Panggil Ulang</span></div>
					            </div>
					         </div>
		  				</div>
		  			</div>
		  		</div>
		  	</div>
	  	</div>
	</div>
	<!-- <div class="row">
		<div class="col-md-12">
		  	<div class="box box-primary">
		  		<div class="box-header"></div>
		  		<div class="box-body">
	                
		  		</div>
		  	</div>
	  	</div>
	</div> -->
</div>
@endsection

@section('ajax')
<script type="text/javascript">
var idunitkerja = "{{$d['idunitkerja']}}";
var idbppoli;
var noantrian;
var textpanggilan;
var timeout=0;
var gate=0;

function distombol(time){
    $(".tombolaksi").prop("disabled", true);
    setTimeout(function(){$(".tombolaksi").prop("disabled", false);}, time);
}

function getpoliaktif(){
    $.ajax({
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: Settings.baseurl+'/getlistpoli',
        // data: { idshift: idshift },
        dataType: 'json',
        async: false,
        success: function (result) {
            var data = result.data;
            createlistpoli(data);
        },
        error: function (result) {
            console.log(result.statusText);
        }
    }).done( () => {
        // console.table(listpoli)
    })
}

function createlistpoli(data){
    // $("#boxpoliantrian").empty()
    var i = 0;
    console.log(data);
    var box = data.map(function (poli) {
        var x = $('<div class="col-md-6" style="margin-top:10px;">' +
            '<button type="button" class="btn btn-block btn-lg btn-danger buttonpoli" style="font-size: 32px;">' + poli.nama + '</button>' +
        '</div>');
        x.on('click' , function(){
            // namapoli = poli.nama
            setpoli(poli.id)
        });
        return x;
    })
    $("#listpoli").html('').append(box);
    // showmodalsetup();
}

function setpoli(id) {
    $("#loading").show();
    $("#boxlistpoli").hide('slow');
    $("#viewantrian").show('slow');
  
    idbppoli = id;
    // setTimeout(getNomor, 2000);
    getDataPoli();
    $("#loading").hide();
}

function kembali(){
    $("#boxlistpoli").show('slow');
    $("#viewantrian").hide('slow');
}

function getDataPoli(){
    // $('#listpoli').empty();
    $("#loading").show();
    // $("#tombolnext").prop("disabled", true);
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli,
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                var data = result.data[0];
                console.log(data);
                noantrian = data['noantrian'];
                textpanggilan = data['pasien'];
                var maxantrian = data['servesmax'];
                $("#noantrian").html(data['noantrian']);
                $("#namapoli").html(data['nama']);
                $("#namapasien").html(data['pasien']);
                $("#maxantrian").html(maxantrian);
                $("#nextantrian").html(noantrian + 1);
                $("#sisaantrian").html(maxantrian - noantrian);
                // sound(noantrian, idbppoli);
            }
        });
        // reloadTable("#tbpasien");
    }
    // $("#tombolnext").prop("disabled", false);
    $("#loading").hide();
}

function nextno(tipe){
    if(tipe == 1) distombol(2500);
    else distombol(1700);

    $("#loading").show();
    // console.log('next');
    $.ajax({
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/layaniantrian',
        type: 'POST',
        data: {idunitkerja:idunitkerja,pasiennoantrian:noantrian,idbppoli:idbppoli, tipe:tipe},
        success: function(respon){
	        // console.log(respon);
	        if(respon == 1){
	            // getDataPoli();
	            // setTimeout(function(){addantriansuara(noantrian, idbppoli)}, timeout+=500);
				toast("info", "Call");
	        } else {
	            toast("info", respon);
	        }
	    },
	    error: function(XMLHttpRequest, textStatus, errorThrown) { 
            toast("error", textStatus);
            setTimeout(getDataPoli, 1000);
        },
        complete:function(data){
           setTimeout(getDataPoli, 1000);
        }
    });
    $("#loading").hide();
}

function recall(){
    // toast('info', 'panggil ulang');
    distombol(2500);
    // sound(noantrian, idbppoli);
	toast("info", "Recall");
    if (noantrian) {
        addantriansuara(noantrian, idbppoli, textpanggilan);
    }
}

function addantriansuara(noantrian, idbppoli, text){
     $.ajax({
    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    	url: Settings.baseurl+'/addantriansuara',
    	type: 'POST',
    	data: {idunitkerja:idunitkerja,pasiennoantrian:noantrian,idbppoli:idbppoli, text:text},
    	success: function(respon){console.log(respon)},
    });
}

$(function () {
    $(document).keydown(function(e){
        evt = e || window.event;
        var target = evt.target || evt.srcElement;
        if ( !/INPUT|TEXTAREA|SELECT|BUTTON/.test(target.nodeName) ) {
            if (e.keyCode==49 || e.keyCode==97){
                console.log('next');
            } else if (e.keyCode==50 || e.keyCode==98){
                console.log('recall');
            }
        }
    });

    $("#viewantrian").hide();

    getpoliaktif();

    // $("#idbppoli").select2({
    //   placeholder: 'Pilih Poli',
    //   // allowClear: true
    // });

    // $("#idbppoli").change(function(){
    //   idbppoli = $(this).val();
    //   getDataPoli();
    // });
    
    // $("#idbppoli").val("1").trigger("change");
    // idbppoli = $("#idbppoli").val();

    // getDataPoli();
    // setInterval(function(){getNomor()}, 5000);
});
</script>
<!-- <script type="text/javascript" src="{{asset('js/poli.js')}}"></script> -->
@stop