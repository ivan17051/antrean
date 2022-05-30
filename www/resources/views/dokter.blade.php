@extends('layouts.mainlayout2')

@section('content')
<style>
    #tbdokter tr td{
        vertical-align: middle;
    }
</style>
<div id="form" hidden>
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-primary" onclick="vc.back();"><i class="fa fa-angle-left"></i> Kembali</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-6">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Dokter</h3>
                </div>
                <form role="form" method="post" action="">
                    {{ csrf_field() }}
                    <div class="box-body">
					<div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" name="nik" id="nik" placeholder="NIK" required>
                    </div>
                    <div class="form-group">
                        <label for="nakes">Nama Nakes</label>
                        <input type="text" class="form-control" name="nakes" id="nakes" placeholder="Nama Nakes" required>
                    </div>
                    <div class="form-group">
                        <label>Poli</label>
                        <select class="form-control" name="idbppoli" id="idbppoli" required>
                            <option></option>
                    		@foreach($d['listpoli'] as $row)
                    		<option value="{{$row->idbppoli}}">{{$row->policaption}}</option>
                    		@endforeach
                            <option value="31">FARMASI</option>
                            <option value="39">LABORATORIUM</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jamawal">Jam Awal</label>
                                <input type="time" class="form-control" name="jamawal" id="jamawal" placeholder="00:00" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jamakhir">Jam Akhir</label>
                                <input type="time" class="form-control" name="jamakhir" id="jamakhir" placeholder="00:00" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="isavailable" id="isavailable" checked> <b>Ada</b>
                        </label>
                    </div>
                
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="isdokter" id="isdokter" checked> <b>Dokter</b> <i>*Harap dicentang untuk menampilkan pada TV Poli</i>
                        </label>
                    </div>
                        
                    </div>

                    <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="box" id="viewdata">
    <div class="box-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="box-title">Data Nakes</h3>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary" onclick="openTambah()">Tambah</button>
            </div>
        </div>
    </div>

    <div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row">
                <div class="col-sm-12">
                    <table id="tbdokter" class="table table-bordered table-striped dataTable" role="grid">
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('ajax')
<script type="text/javascript">
    var idunitkerja = "{{$d['idunitkerja']}}";
    var oTable;

    window.vc = {
        previous: [],
        active: null,
        setActive(id){
            let elem = $(id);
            if(!elem.length) return;
            if(this.active){
                $(this.active).hide('slow');
                this.previous.push(this.active);
                elem.show('slow');
            }else{
                elem.show();
            }
            this.active=id;
        },
        back(){
            if(!this.previous.length) return;
            let id = this.previous.pop();
            $(id).show('slow');
            $(this.active).hide('slow');
            this.active=id;
        }
    }

    window.getFormData = function($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    function openTambah(){
        $('#form form').attr('action','{{route("dokter.storeupdate", ["idunitkerja"=>app("request")->get("idunitkerja")])}}')
		$('#nik').val('')
        $('#nakes').val('')
        $('#idbppoli').val('')
        $('#jamawal').val('08:00')
        $('#jamakhir').val('16:00')
        $('#isavailable').prop('checked', true)
        $('#isdokter').prop('checked', true)
        vc.setActive('#form')
    }

    function openEdit(self, noid){
        var tr = $(self).closest('tr');
        var sData = oTable.fnGetData( tr);
        
        $('#form form').attr('action','{{route("dokter.storeupdate", ["idunitkerja"=>app("request")->get("idunitkerja")])}}/'+sData['noid'])
		$('#nik').val(sData['nik'])
        $('#nakes').val(sData['nakes'])
        $('#idbppoli').val(sData['idbppoli'])
        $('#jamawal').val(sData['jamawal'])
        $('#jamakhir').val(sData['jamakhir'])
        $('#isavailable').prop('checked', sData['isavailable'])
        $('#isdokter').prop('checked', sData['isdokter'])
        vc.setActive('#form')
    }

    function showTable(){
        if ($.fn.dataTable.isDataTable('#tbdokter') ) {
            $('#tbdokter').DataTable().clear();
            $('#tbdokter').DataTable().destroy();
            $('#tbdokter').empty();
        }

        oTable = $('#tbdokter').dataTable({
            "sAjaxSource": '{{route("dokter.show", ["idunitkerja"=>app("request")->get("idunitkerja")])}}', 
            "iDisplayLength": 50,
            "bProcessing": true,
            "aoColumns": [
                { "mData": "namapoli", "sTitle": "Poli" },
				{ "mData": "nik", "sTitle": "NIK" },
                { "mData": "nakes", "sTitle": "Nakes" },
                { "mData": "jamawal", "sTitle": "Jam Awal" },
                { "mData": "jamakhir", "sTitle": "Jam Akhir" },
                { "mData": "isavailable", "sTitle": "Ada" , 
                    "mRender": function ( data, type, full ) {
                        return data ? '<a href="javascript:void(0)" class="text-success"><i class="fa fa-check"></i></a>' : 
                                        '<a href="javascript:void(0)" class="text-danger"><i class="fa fa-times"></i></a>';
                    }
                },
                { "mData": "isdokter", "sTitle": "Dokter" , 
                    "mRender": function ( data, type, full ) {
                        return data ? '<a href="javascript:void(0)" class="text-success"><i class="fa fa-check"></i></a>' : 
                                        '<a href="javascript:void(0)" class="text-danger"><i class="fa fa-times"></i></a>';
                    }
                },
                { "mData": "null", "sTitle": "Aksi" , 
                    "mRender": function ( data, type, full ) {
                        return '<button onclick="openEdit(this,'+full['noid']+')" class="text-success btn"><i class="fa fa-edit"></i> edit</button>'
                    }
                },
            ],
            "sAjaxDataProp": "",       //path ke array datanya
            "oLanguage": {
                "sSearch": "Pencarian: ", 
                "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                "sInfoFiltered": "(di filter dari _MAX_ total data)"
            },      
            "bLengthChange" : true,
        });
    }


    $(function(){
        vc.setActive('#viewdata');
        showTable();

        $('#form').submit(function(e){
            $("#loading").show();

            e.preventDefault();
            var form = $(e.target);
            var actionUrl = form.attr('action');
            let formdata = getFormData(form);
            console.log(formdata)
            
            $.ajax({
                type: "POST",
                url: actionUrl,
                data: formdata,
                success: async function(data){
                    vc.back();
                    await new Promise(resolve => setTimeout(resolve, 1000));
                    showTable();
                    $("#loading").hide();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    $("#loading").hide();
                }
            });
        });
    })
</script>
@stop