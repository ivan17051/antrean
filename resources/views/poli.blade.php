@extends('layouts.base')
@section('content')
<header class="content__title">
    <h1>Pengaturan Poli</h1>
    <small>Menu untuk mengatur layanan poli</small>
</header>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jam Layanan 1</h4>

                <div class="">
                    <div class="form-group d-inline-block">
                        <label>Jam Buka</label>
                        <input type="time"  name="jambuka" class="form-control" placeholder="XX:XX">
                    </div>
                    <div class="form-group d-inline-block">
                        <label>Jam Tutup</label>
                        <input type="time"  name="jamtutup" class="form-control" placeholder="XX:XX">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Jam Layanan 2</h4>

                <div class="">
                    <div class="form-group d-inline-block">
                        <label>Jam Buka</label>
                        <input type="time"  name="jambuka" class="form-control" placeholder="XX:XX">
                    </div>
                    <div class="form-group d-inline-block">
                        <label>Jam Tutup</label>
                        <input type="time"  name="jamtutup" class="form-control" placeholder="XX:XX">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="mydatatable">
                    <thead>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('jsx')
<script>
    $(function(){
        $("#mydatatable").DataTable({
            stateSave: true,
            processing: true,
            serverSide: false,
            lengthChange: false,
            ajax: {dataSrc: "", type: "GET", url: '{{route("poli.getall")}}', data:{'_token':@json(csrf_token())}},
            columns: [
                { data:'idbppoli', title:'ID Poli'},
                { data:'policaption', title:'Poli/Klinik'},
                { data:'maxquota', title:'Kuota'},
                // { data:'isactive', title:'Status', render: function(e,d,row){
                //     return '<a class="btn btn-sm btn-outline-success"><i class="bi bi-card-list"></i></a>'
                // } },
            ],
            initComplete: function(settings, data){
                console.log(data)
            }
        });
    })
    
</script>
@endsection