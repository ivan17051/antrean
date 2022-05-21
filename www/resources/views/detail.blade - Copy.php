@extends('layouts.mainlayout')

@section('content')
<style type="text/css">
  .headerpoli{
    text-align: center;
  }
  .headerpoli, .policaption{
    font-weight: bold;
    font-size: 32pt;
  }
  .antrianpoli {
    font-size: 20pt;
    text-align: center;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border headerpoli">
        <div class="policaption"></div>
      </div>
      <div class="box-body">
        <div class="antrianpoli">Antrian saat ini : <span id="poli" style="font-weight: bold;">0</span></div>
        <br>
        <div class="antrianpoli">Antrian berikutnya : <span id="polin" style="font-weight: bold;">0</span></div>
        <div class="antrianpoli">Estimasi layanan : <span id="estimasi" style="font-weight: bold;">07.30</span></div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-body">
      	<table id="tbantrian" class="table datatable">
    			<thead>
    				<tr>
    					<th width="15%">No Antrian</th>
    					<th >Pasien</th>
    				</tr>
    			</thead>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
$(function(){
	// ssdatatable("#tbantrian", "getunitkerja", col, order);
  $('#tbantrian').dataTable({
    "fnDrawCallback": function ( oSettings ) {
        if ( oSettings.bSorted || oSettings.bFiltered )
        {
          for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
          {
              $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
          }
      }
    },
    ajax: Settings.baseurl+"/getunitkerja", 
    // "sAjaxDataProp": "aData", 
    "iDisplayLength": 10,
    "aoColumns":[ 
        {
          "bSortable": false,
          "mData": null,
          "sTitle": "No",
        },
        {"mDataProp": "nama"},
    ],
    "oLanguage": {
      "sSearch": "Pencarian: ", 
      "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
      "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
      "sInfoFiltered": "(di filter dari _MAX_ total data)"
    },      
    "bLengthChange" : false
  });
});
</script>
@stop