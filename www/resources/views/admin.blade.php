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
		display: block;
		font-size: 36px;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
</style>
<div class="row">
	<div class="col-md-12">
	  	<div class="box box-primary">
	  		<div class="box-header"></div>
	  		<div class="box-body">
	  			<div class="row">
			      <div class="col-md-3 col-sm-6 col-xs-12">
			        <div class="info-box">
			          <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
			          <div class="info-box-content">
			            <span class="info-box-text">Total Data Antrean</span>
			            <span class="info-box-number" id="jumlahall">0 <small>Pasien</small></span>
			          </div>
			        </div>
			      </div>
			      <div class="col-md-3 col-sm-6 col-xs-12">
			        <div class="info-box">
			          <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
			          <div class="info-box-content">
			            <span class="info-box-text">Antrean Poli Umum</span>
			            <span class="info-box-number" id="jumlah1">0 <small>Pasien</small></span>
			          </div>
			        </div>
			      </div>

			      <!-- fix for small devices only -->
			      <div class="clearfix visible-sm-block"></div>

			      <div class="col-md-3 col-sm-6 col-xs-12">
			        <div class="info-box">
			          <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
			          <div class="info-box-content">
			            <span class="info-box-text">Antrean Poli Gigi</span>
			            <span class="info-box-number" id="jumlah2">0 <small>Pasien</small></span>
			          </div>
			        </div>
			      </div>
			      <div class="col-md-3 col-sm-6 col-xs-12">
			        <div class="info-box">
			          <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
			          <div class="info-box-content">
			            <span class="info-box-text">Antrean Poli KIA</span>
			            <span class="info-box-number" id="jumlah3">0 <small>Pasien</small></span>
			          </div>
			        </div>
			      </div>
			    </div>
          	</div>
      		<div class="box-footer">
                
	  		</div>
	  	</div>
  	</div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
var idunitkerja = "{{$d['idunitkerja']}}";

function getJumlahAntrian(){
    // $("#loading").show();
    $.ajax({
        url: Settings.baseurl+'/getrekappoli',
        type: 'GET',
        data: {idunitkerja: idunitkerja},
        dataType: 'json',
        success: function (result) {
            var data = result.data;
            
            for (i = 0; i < data.length; i++) {
                $("#jumlah"+data[i]['idbppoli']).html(data[i]['jumlahantrian']+' <small>Pasien</small></span>');
            }
            
        }
    });
    // $("#loading").hide();
}

$(function () {
	getJumlahAntrian();
});
</script>
<!-- <script type="text/javascript" src="{{asset('js/admin.js')}}"></script> -->
@stop