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
        <div class="box-header"></div>
        <div class="box-body">
          <div class="row" id="listpoli">
            <div class="col-md-12">
              <div class="info-box  bg-aqua">
                    <span class="info-box-icon">0</span>

                    <div class="info-box-content">
                      <span class="info-box-number">Poli</span>
                      <span class="info-box-text">Pasien</span>
                    </div>
                 </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <table class="table table-bordered table-striped" id="tbpasien">
                <thead>
                  <tr>
                    <th>Pasien</th>
                    <th>Estimasi Pelayanan</th>
                    <th style="width: 15%;">Nomor Antrian</th>
                  </tr>
                </thead>
                <tbody id="listpasien"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('ajax')
<script type="text/javascript">
    var idunitkerja = "{{$d['idunitkerja']}}";
    var idbppoli = "{{$d['idbppoli']}}";
</script>
<script type="text/javascript" src="{{asset('js/detail.js')}}"></script>
@stop