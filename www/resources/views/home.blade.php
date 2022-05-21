@extends('layouts.mainlayout')

@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-body">
      	<table id="tbunitkerja" class="table datatable">
			<thead>
				<tr>
					<th width="5%">No</th>
					<th >Nama Unit Kerja</th>
					<th width="10%">Action</th>
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
function lihat(id){
 	window.location.href="{{url('/lihat/')}}"+"/"+id;
}

var col = [
    { data: 'nama', name: 'munitkerja.nama' },
    { data: 'action', name: 'action', orderable: false, searchable: false},
];

var order = [[0, 'asc']];

$(function(){
		// ssdatatable("#tbunitkerja", "getunitkerja", col, order);

		// $(id).dataTable({
	 //        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
	 //        "language": {
	 //            "aria": {
	 //                "sortAscending": ": activate to sort column ascending",
	 //                "sortDescending": ": activate to sort column descending"
	 //            },
	 //            "emptyTable": "No data available in table",
	 //            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
	 //            "infoEmpty": "No entries found",
	 //            "infoFiltered": "(filtered1 from _MAX_ total entries)",
	 //            "lengthMenu": "Show _MENU_ entries",
	 //            "search": "Search:",
	 //            "zeroRecords": "No matching records found"
	 //        },

	 //        "bStateSave": false, // save datatable state(pagination, sort, etc) in cookie.

	 //        processing: true,
	 //        serverSide: true,
	 //        ajax: url,
	 //        columns: col,
	 //        "lengthMenu": [
	 //            // [5, 15, 20, -1],
	 //            // [5, 15, 20, "All"] // change per page values here
	 //            [10, 25, 50, 100],
	 //            [10, 25, 50, 100]
	 //        ],
	 //        // set the initial value
	 //        "pageLength": 10,            
	 //        "pagingType": "full_numbers",
	 //        "language": {
	 //            "search": "search: ",
	 //            "lengthMenu": "  _MENU_ records",
	 //            "paginate": {
	 //                "previous":"Prev",
	 //                "next": "Next",
	 //                "last": "Last",
	 //                "first": "First"
	 //            }
	 //        },
	 //        "order": order // set first column as a default sort by asc
	 //    });

	$('#tbunitkerja').dataTable({
		"fnDrawCallback": function ( oSettings ) {
		  	if ( oSettings.bSorted || oSettings.bFiltered )
		  	{
		    	for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
		    	{
		      		$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
		    	}
			}
		},
      	ajax: "getunitkerja", 
      	// "sAjaxDataProp": "aData", 
      	"iDisplayLength": 10,
      	"aoColumns":[ 
          	{
            	"bSortable": false,
	            "mData": null,
	            "sTitle": "No",
          	},
          	{"mDataProp": "nama",  "sTitle": "Sarkes"},
          	{
            	"bSortable": false,
	            "mData": null,
	            "sTitle": ""
          	},
      	],
      	"aoColumnDefs": [ {
	      	"aTargets": [ 2 ],
	      	"mRender": function (data, type, row) { 
	      		return '<a href="javascript:void(0);"  title="Lihat Antrian" class="btn btn-primary" onclick="lihat(\''+row['noid']+'\');"><i class="fa fa-medkit"></i></a>&nbsp;<a href="{{url("admin")}}"  title="Admin" class="btn btn-primary"><i class="fa fa-gear"></i></a>'; 
	        }
   		}],
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