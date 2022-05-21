<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Antrean</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('theme/dist/css/skins/_all-skins.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{asset('theme/plugins/iCheck/all.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('theme/bower_components/select2/dist/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-toastr/toastr.min.css')}}"/>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style>
    #loading {
        background:rgba(181, 181, 181, 0.5) url("{{asset('img/loading-spinner-blue.gif')}}") no-repeat center center;
        height: 100%;
        width: 100%;
        position: fixed;
        z-index: 9999;
        display: none;
    }

    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url("{{asset('img/loading-spinner-blue.gif')}}") 50% 50% no-repeat rgb(249,249,249);
    }

    .thumbnail {
	   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);
	   transition: 0.3s;
	   /*min-width: 40%;*/
	   border-radius: 5px;
	   color: #3c8dbc;
	 }

	.thumbnail-description {
	   min-height: 40px;
	}

	.thumbnail:hover {
	   cursor: pointer;
	   box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 1);
	}
  </style>
</head>
<body class="hold-transition skin-blue">
<div class="loader"></div>
<div class="wrapper">
  	<div id="loading"></div>
  	<div class="content-wrapper" style="margin-left: 0;">
	    <!-- <section class="content-header">
	      	<h1>
	        	{{$d['title']}}
	        	<small>{{$d['subtitle']}}</small>
	      	</h1>
	    </section> -->

	    <section class="content">
			<div id="boxunitkerja">
			    <div class="box box-primary">
			    	<div class="box-header with-border">
			    		<!-- <div class="col-md-12"> -->
				    		<h3 class="box-title">Antrean Puskesmas</h3>
				    	<!-- </div> -->
			    	</div>
			      	<div class="box-body">
			      		<div class="row">
			      			<div class="col-md-12">
						      	<table id="tbunitkerja" class="table table-bordered datatable">
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
			</div>
			<div id="boxpoli">
				<div class="row">
			        <div class="col-md-12">
			            <button type="button" class="btn btn-primary" onclick="kembali();" style="width:100px;"><i class="fa fa-angle-left"></i> Kembali</button>
			        </div>
			    </div>
			    <br>
		    	<div class="box box-primary">
			    	<div class="box-header with-border">
				    	<h3 class="box-title" id="namaunit"></h3>
			    	</div>
		      		<div class="box-body">
		      			<div class="row">
	      					<div id="listpoli"></div>
		      			</div>
		      		</div>
		    	</div>
			</div>
		</section>
  	</div>
  	<footer class="main-footer" style="margin-left: 0;">
    	<div class="pull-right hidden-xs"><b>IT</b> Dinkes</div><strong>Copyright &copy; {{date('Y')}} Dinas Kesehatan Kota Surabaya
  	</footer>
</div>

<!-- jQuery 3 -->
<script src="{{asset('theme/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- <script src="{{asset('theme/plugins/jQuery/jQuery-2.1.3.min.js')}}"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('theme/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('theme/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{asset('theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('theme/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('theme/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('theme/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- iCheck 1.0.1 -->
<script src="{{asset('theme/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('theme/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
<script src="{{asset('theme/plugins/bootbox/bootbox.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('theme/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('theme/dist/js/demo.js')}}"></script>

<script src="{{asset('js/myapp.js?1')}}"></script>

<script>
	var idunitkerja;

    $(window).on('load', function(){
        $(".loader").fadeOut("slow");
    });

    var Settings = {
        // token: "{{ csrf_token() }}",
        baseurl: "{{url('')}}"
    }

    function kembali() {
    	$("#boxunitkerja").show('slow');
	 	$("#boxpoli").hide('slow');
    }

	function lihat(id, nama){
		idunitkerja = id;
		$("#namaunit").html(nama);
    	getnomor();
	 	$("#boxunitkerja").hide('slow');
	 	$("#boxpoli").show('slow');
	}

	function getnomor() {
		$("#loading").show();
		$("#listpoli").empty();
	    $.ajax({
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        url: Settings.baseurl+'/antreanpuskesmas',
	        type: 'POST',
	        data: {idunitkerja: idunitkerja},
	        dataType: 'json',
	        success: function (result) {
	            var datanow = result.data.now;
	            console.log(datanow);
	            for (i = 0; i < datanow.length; i++) {
	            	$("#listpoli").append('<div class="col-md-6 col-xs-12 text-center"><div class="thumbnail">' +
	            		'<div style="font-size: 48px;">' + datanow[i]['noantrian'] + '</div>' +
	            		'<div style="font-size:22px;">' + datanow[i]['bppoli'] + '</div>' +
	            	'</div></div>');
	            }
	        },
	        complete:function(data){
	        	// setTimeout(getNomor, 5000);
	        	$("#loading").hide();   
	        }
	    }).done(function() {
	    	// $("#loading").hide();
	    });
	}

	var col = [
	    { data: 'nama', name: 'munitkerja.nama' },
	    { data: 'action', name: 'action', orderable: false, searchable: false},
	];

	var order = [[0, 'asc']];

	$(function(){
		$('#boxpoli').hide();

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
		      		return '<button title="Lihat Antrian" class="btn btn-primary" onclick="lihat(\''+row['noid']+'\',\''+row['nama']+'\');"><i class="fa fa-search"></i></button>'; 
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
</body>
</html>