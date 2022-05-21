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
<div class="row" id="boxdata">
	<div class="col-md-12">
		<div class="box box-primary">
	  		<div class="box-header">
	  			<div class="row">
	  				<div class="col-sm-2">
		            	<select name="idbppoli" id="idbppoli" class="form-control" style="width: 100%;">
                    		<option></option>
                    		@foreach($d['listpoli'] as $row)
                    		<option value="{{$row->idbppoli}}">{{$row->policaption}}</option>
                    		@endforeach
                    	</select>
                    </div>
                </div>
	  		</div>
	  		<div class="box-body">
				<table class="table table-bordered table-striped" id="tbpasien">
					<thead>
						<tr>
							<th>Pasien</th>
							<th>Poli</th>
							<th style="width: 15%;">Nomor Antrian</th>
							<th>Tujuan</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="listpasien"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="row" id="boxriwayat">
	<div class="col-md-12">
		<div class="box box-primary">
	  		<div class="box-header">
	  			<h6>&nbsp;</h6>
	  			<div class="pull-right box-tools">
                	<button type="button" class="btn btn-box-tool" onclick="kembali();"><i class="fa fa-reply"></i></button>
          		</div>
	  		</div>
	  		<div class="box-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Poli</th>
							<th>Jam</th>
						</tr>
					</thead>
					<tbody id="detailriwayat"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
    var idunitkerja = "{{$d['idunitkerja']}}";
    
</script>
<script type="text/javascript" src="{{asset('js/kasir.js')}}"></script>
@stop