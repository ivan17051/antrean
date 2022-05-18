@extends('layouts.base')
@section('content')
<header class="content__title">
    <h1>Pendaftaran Pasien Online</h1>
    <small>Selamat Datang di Aplikasi Pendaftaran Online!</small>

    <div class="actions">
        <a href="" class="actions__item zmdi zmdi-trending-up"></a>
        <a href="" class="actions__item zmdi zmdi-check-all"></a>

        <div class="dropdown actions__item">
            <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="" class="dropdown-item">Refresh</a>
                <a href="" class="dropdown-item">Manage Widgets</a>
                <a href="" class="dropdown-item">Settings</a>
            </div>
        </div>
    </div>
</header>
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-body">
          <h4 class="card-title">Pilih Fasilitas Layanan Kesehatan</h4>
          <h6 class="card-subtitle">Silahkan Pilih Fasilitas Kesehatan yang Ingin Dituju.</h6>

          <div class="row">
              <div class="col-md-4">
                  <div class="form-group">
                      <label>Pilih RS/Puskesmas</label><br>

                      <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" onchange="filterFaskesOnChange(this)">
                        <option value="">-- Pilih --</option>
                        <option value="rs">Rumah Sakit</option>
                        <option value="pkm">Puskesmas</option>
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group" id="faskes">
                      <label name='label'></label><br>

                      <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" name="idunitkerja" onchange="filterPoliOnChange(this)">
                        <option value="">-- Pilih --</option>  
                      </select>
                  </div>
              </div>
              <div class="col-md-4">
                  <div class="form-group" id="poli">
                      <label>Pilih Poli</label><br>

                      <select class="select2 select2-hidden-accessible" style="width:100%;" tabindex="-1" aria-hidden="true" name="idbppoli" onchange="filterTanggalOnChange(this)">
                          <option value="">-- Pilih --</option>
                      </select>
                  </div>
              </div>

          </div>
          <div class="row">
            <div class="col-12">
              <div id="calendar"></div>
              
            </div>
          </div>
      </div>     
    </div>

  </div>
</div>
@endsection

@section('jsx')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2();

    $('#faskes').attr('hidden', true);
    $('#poli').attr('hidden', true);
    $('#calendar').attr('hidden', true);
  });
  
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      locale: 'id',
      initialView: 'dayGridMonth',
      dateClick: function(info) {
        alert('a day has been clicked!'+info.dateStr);
      }
    });
    calendar.render();
  });

const puskesmas = @json($puskesmas);
const rs = @json($rs);
const poli = @json($poli);

const filterFaskesOnChange = async function(e){
    var val = e.value;
    var str = '<option value="" disabled selected>-- Pilih --</option>';
    
    var dt;
    if(val==='pkm'){ //puskesmas
        dt=puskesmas;
        $('label[name=label]').empty().html('Pilih Puskesmas');
        $('select[name=idunitkerja]').empty().html(puskesmas);
        $('#faskes').attr('hidden', false);
    }else if(val==='rs'){ //rumah sakit
        dt=rs;
        $('label[name=label]').empty().html('Pilih Rumah Sakit');
        $('select[name=idunitkerja]').empty().html(rs);
        $('#faskes').attr('hidden', false);
    }else{
        $('#faskes').attr('hidden', true);
    }
    dt.forEach(e => {
        str+=`<option value="${e.id}">${e.nama}</option>`;
    });
    $('select[name=idunitkerja]').empty().html(str);
}

const filterPoliOnChange = async function(e){
    var val = e.value;
    var str = '<option value="" disabled selected>-- Pilih --</option>';
    
    var dt;
    if(val){ //jika faskes sdh terisi
        dt=poli;
        $('select[name=idbppoli]').empty().html(poli);
        $('#poli').attr('hidden', false);
    } else{
        $('#poli').attr('hidden', true);
    }
    dt.forEach(e => {
        str+=`<option value="${e.id}">${e.nama}</option>`;
    });
    $('select[name=idbppoli]').empty().html(str);
}

const filterTanggalOnChange = async function(e){
    var val = e.value;
    
    var dt;
    if(val){ //jika poli sdh terisi
        $('#calendar').attr('hidden', false);
    } else{
        $('#calendar').attr('hidden', true);
    }
    
}
</script>
@endsection