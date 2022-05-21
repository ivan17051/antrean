@extends('layouts.mainlayout2')

@section('content')
<div class="row" id="boxdataunitpoli">
  <!-- left column -->
  <div class="col-md-12">
    <!-- general form elements -->
    <div class="box box-primary">
      <div class="box-body">
      	<table id="tbpoliunit" class="table datatable">
        </table>
      </div>
    </div>
  </div>
</div>

<div id="boxunitpoli" class="row" style="display: block;">
  <div class="col-md-12">
    <div class="box box-info">
      <div class="box-header with-border">
      <h3 class="box-title">Poli/Klinik <span id="namapoli"></span></h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" onclick="kembali();" data-hover="tooltip" data-original-title="Back">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-reply fa-stack-1x fa-inverse"></i>
            </span>
          </button>
          <button class="btn btn-box-tool" data-widget="maximize" data-hover="tooltip" data-original-title="Maximaze">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-expand fa-stack-1x fa-inverse"></i>
            </span>
          </button>
          <button class="btn btn-box-tool" data-widget="collapse" data-hover="tooltip" data-original-title="Collapse Expand">
            <span class="fa-stack fa-lg">
              <i class="fa fa-circle fa-stack-2x"></i>
              <i class="fa fa-unsorted fa-stack-1x fa-inverse"></i>
            </span>
          </button>
        </div>
      </div>
      <div class="box-body">
        <form id="frmdataunitpoli" name="frmdataunitpoli" action="#">
          {{ csrf_field() }}
          <input type="hidden" id="noid" name="noid" >
          <input type="hidden" id="idbppoli" name="idbppoli">
          <div class="form-group col-xs-12 col-sm-6">
            <label aria-checked="false">
              <input type="checkbox" id="isactive" name="isactive" value="1"> Status 
            </label> 
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <label aria-checked="false">
              <input type="checkbox" id="isdirectqueue" name="isdirectqueue" value="1"> Antrian 
            </label> 
          </div> 
          <div class="form-group col-xs-12 col-sm-12">
            <label for="nourut">No Urut</label>
            <input type="text" class="form-control input-sm" id="nourut" name="nourut" maxlength="undefined" placeholder="No Urut"> 
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka01">Jam Buka Antrian (Senin)</label>    
            <div class="input-group date" id="jambuka01">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-time"></i>
              </div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka01" name="jambuka01">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup01">Jam Tutup Antrian (Senin)</label>
            <div class="input-group date" id="jamtutup01">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-time"></i>
              </div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup01" name="jamtutup01">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan01">Jam Tutup Layanan (Senin)</label>
            <div class="input-group date" id="jamlayanan01">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-time"></i>
              </div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan01" name="jamlayanan01">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka02">Jam Buka Antrian (Selasa)</label>
            <div class="input-group date" id="jambuka02">
              <div class="input-group-addon">
                <i class="glyphicon glyphicon-time"></i>
              </div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka02" name="jambuka02">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup02">Jam Tutup Antrian (Selasa)</label>
            <div class="input-group date" id="jamtutup02">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup02" name="jamtutup02">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan02">Jam Tutup Layanan (Selasa)</label>
            <div class="input-group date" id="jamlayanan02">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan02" name="jamlayanan02">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka03">Jam Buka Antrian (Rabu)</label>
            <div class="input-group date" id="jambuka03">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka03" name="jambuka03">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup03">Jam Tutup Antrian (Rabu)</label>
            <div class="input-group date" id="jamtutup03">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup03" name="jamtutup03">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan03">Jam Tutup Layanan (Rabu)</label>
            <div class="input-group date" id="jamlayanan03">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan03" name="jamlayanan03">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka04">Jam Buka Antrian (Kamis)</label>
            <div class="input-group date" id="jambuka04">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka04" name="jambuka04">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup04">Jam Tutup Antrian (Kamis)</label>
            <div class="input-group date" id="jamtutup04">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup04" name="jamtutup04">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan04">Jam Tutup Layanan (Kamis)</label>
            <div class="input-group date" id="jamlayanan04">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan04" name="jamlayanan04">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka05">Jam Buka Antrian (Jum at)</label>
            <div class="input-group date" id="jambuka05">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka05" name="jambuka05">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup05">Jam Tutup Antrian (Jum at)</label>
            <div class="input-group date" id="jamtutup05">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup05" name="jamtutup05">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan05">Jam Tutup Layanan (Jum at)</label>
            <div class="input-group date" id="jamlayanan05">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan05" name="jamlayanan05">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jambuka06">Jam Buka Antrian (Sabtu)</label>
            <div class="input-group date" id="jambuka06">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jambuka06" name="jambuka06">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamtutup06">Jam Tutup Antrian (Sabtu)</label>
            <div class="input-group date" id="jamtutup06">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamtutup06" name="jamtutup06">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-4">
            <label for="jamlayanan06">Jam Tutup Layanan (Sabtu)</label>
            <div class="input-group date" id="jamlayanan06">
              <div class="input-group-addon"><i class="glyphicon glyphicon-time"></i></div>
              <input type="text" class="form-control input-sm" alt="timepicker" id="jamlayanan06" name="jamlayanan06">
            </div>
          </div>
          <div class="form-group col-xs-12 col-sm-12">
            <label for="maxquota">Maximun Antrian per Hari</label>
            <input type="text" class="form-control input-sm" id="maxquota" name="maxquota" maxlength="undefined" placeholder="Kuota">
          </div>
          <div class="form-group col-xs-12 col-sm-12">
            <label for="noserver">Jumlah Nakes Dalam Poli/Klinik</label>
            <input type="text" class="form-control input-sm" id="noserver" name="noserver" maxlength="undefined" placeholder="Jumlah Nakes">
          </div>
          <div class="form-group col-xs-12 col-sm-12">
            <label for="avgservice">Rata-Rata Pelayanan Dalam Detik</label>
            <input type="text" class="form-control input-sm" id="avgservice" name="avgservice" maxlength="undefined" placeholder="Rata-Rata Pelayanan">
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <button type="button" id="null" name="null" class="btn btn-primary btn-block" onclick="simpan();"><i class="fa fa-sign-in"></i>&nbsp;Simpan</button>
          </div>
          <div class="form-group col-xs-12 col-sm-6">
            <button type="button" class="btn btn-danger btn-block" onclick="kembali();"><i class="fa fa-times"></i>&nbsp;Batal</button>
          </div>
        </form>
      </div>
      <div class="box-footer no-border">&nbsp;</div>
    </div>
  </div>
</div>
@endsection

@section('ajax')
<script type="text/javascript" src="{{asset('js/setpoli.js')}}"></script>
@stop