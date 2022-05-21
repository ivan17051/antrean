<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    TV Utama
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('theme/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset('theme/assets/css/material-dashboard.css?v=2.2.2')}}" />
  <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-toastr/toastr.min.css')}}" />
  <!-- Sweetalert -->
  <link rel="stylesheet" href="{{asset('theme/plugins/sweetalert/sweetalert.css')}}" />
</head>

<body class="">
  <div class="wrapper ">
    <div id="loading"></div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper" style="">
            <div class="navbar-minimize">
            </div>
            <img src="{{asset('/img/pemkot.png')}}" alt="Logo"
              style="height:100px; margin-bottom:30px; padding-left:20px;">
            <p class="navbar-brand" style="padding-top:30px; font-weight:450;" href="{{url('/')}}">Dinas Kesehatan Kota
              Surabaya<br><label id="namaunitkerja" style="font-size:18px; font-weight:450;"></label></p>
          </div>

          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <!-- untuk navbar kanan -->
                <div id="date_time" style="margin-bottom: 20px; font-size: 20px; font-weight: 400; margin-right: 20px;">
                </div>
              </div>
            </form>
            <ul class="navbar-nav">

            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-5">
              <div class="card " style="height:calc(100% - 60px);">
                <div class="card-header card-header-danger card-header-text">
                  <div class="card-text">
                    <h4 class="card-title" style="font-weight:450;">Pasien Belum Datang</h4>
                  </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive" style="overflow-y:scroll;height:1000px;display:block;overflow-y:hidden;">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>No</th>
                        <th>Nama Pasien</th>
                        <th>Keterangan</th>
                      </thead>
                      <tbody id="listpasien">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card " style="height:calc(100% - 60px);">
                <div class="card-header card-header-danger card-header-text">
                  <div class="card-text">
                    <h4 class="card-title" style="font-weight:450;">Dokter Jaga</h4>
                  </div>
                </div>
                <div class="card-body ">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Nama Dokter</th>
                        <th>Poliklinik</th>
                        <th>Jam Pelayanan</th>
                      </thead>
                      <tbody id="listdokter">

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="copyright float-left">
            Copyright &copy;
            <script>
              document.write(new Date().getFullYear())
            </script> Dinas Kesehatan Kota Surabaya

          </nav>
          <div class="copyright float-right">
            <!-- footer kanan -->
          </div>
        </div>
      </footer>
    </div>
  </div>

<!--   Core JS Files   -->
<script src="{{asset('theme/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('theme/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('theme/assets/js/core/bootstrap-material-design.min.js')}}"></script>
<script src="{{asset('theme/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<!--  Plugin TV Poli -->
<script src="{{asset('js/myapp.js')}}"></script>
<script src="{{asset('js/suaraantrian.js')}}"></script>
<script src="{{asset('theme/plugins/bootstrap-toastr/toastr.min.js')}}"></script>
<script src="{{asset('theme/plugins/ionsound/ion.sound.min.js')}}"></script>
<script src="{{asset('theme/plugins/sweetalert/sweetalert.min.js')}}"></script>
<script>
$(document).ready(function () {
    var url = document.URL;
    // alert(url);
    var segments = url.split('/');
    var action = segments[4].replace('#', '');
    // alert(action)
    if (action == "") {
        action = url;
    }
    // alert(action);
    // Will only work if string in href matches with location
    // $('li a[href="' + action + '"]').parent().addClass('active');
    // $('ul.treeview-menu a[href="' + action + '"]').parent().addClass('active');
    // $('li ul a[href="' + action + '"]').parent().parent().parent().addClass('active');
    // $('li ul a[href="' + action + '"]').parent().parent().parent().parent().parent().addClass('active');

    // $(".date.date-picker").attr("autocomplete", "off");
    // $(".date.date-picker input").attr("autocomplete", "off");
    // getlistpoli();
    $('#loading').hide();
});

var Settings = {
    token: "{{ csrf_token() }}",
    baseurl: "{{url('')}}"
}

var idunitkerja = "{{$d['idunitkerja']}}";
var suaraaktif = 0;

var listpoli = [];

function getpoliaktif(){
    $.ajax({
        type: 'GET',
        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
        url: Settings.baseurl+'/getlistpoli',
        // data: { idshift: idshift },
        dataType: 'json',
        async: false,
        success: function (result) {
            var data = result.data;
            // createlistmodal(data);
        },
        error: function (result) {
            // console.log(result.statusText);
        }
    }).done( () => {
        // console.table(listpoli)
    })
}


function kembali(){
    // $("#boxlistpoli").show('slow');
    // $("#viewantrian").hide('slow');
    location.reload();
}

var $el = $(".table-responsive");
function anim() {
  var st = $el.scrollTop();
  var sb = $el.prop("scrollHeight")-$el.innerHeight();
  $el.animate({scrollTop: st<sb/2 ? sb : 0}, 15000, anim);
}
function stop(){
  $el.stop();
}
anim();
// $el.hover(stop, anim);

function getDokter(){
  $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: Settings.baseurl+'/getdokter',
      type: 'GET',
      data: '',
      dataType: 'json',
      success: function (result) {
          var datanow = result.data.dokter;
          // console.log('data'+data);
          for (i = 0; i < datanow.length; i++) {
              $("#listdokter").append('<tr><td>'+datanow[i]['nakes']+'</td><td>'+datanow[i]['namapoli']+'</td><td>'+datanow[i]['jamawal']+' - '+datanow[i]['jamakhir']+'</td></tr>');
          }
      },
      complete:function(data){
          $("#listdokter").clear();
          setTimeout(getDokter, 5000);
      }
  });
}

function getListPasien(){
  $.ajax({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
      url: Settings.baseurl+'/getlistpasien',
      type: 'GET',
      data: '',
      dataType: 'json',
      success: function (result) {
          var datanow = result.data.listpasien;
          // console.log('pasien:'+datanow.length);
          for (i = 0; i < 50; i++) {
              $("#listpasien").append('<tr><td>'+datanow[i]['pasiennoantrian']+'</td><td>'+datanow[i]['NAMA_LGKP']+'</td><td>'+datanow[i]['tanggaleta']+'</td></tr>');
          }
      },
      complete:function(data){
          $("#listpasien").clear();
          setTimeout(getListPasien, 5000);
      }
  });
}

function getDataUnitkerja(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: Settings.baseurl+'/getdataunitkerja',
        type: 'GET',
        data: {idunitkerja:idunitkerja},
        dataType: 'json',
        success: function (result) {
            if(result.data){
                var du = result.data;
                $("#namaunitkerja").html(du.nama);
                $("#alamatunitkerja").html(du.alamat1);
            } else {
                // toast("info", respon);
            }
        },
        error: function(responsedata){
            var errors = responsedata.statusText;
            $('#loading').hide();
            toast("error", errors);
        }
    });
}

function date_time(id) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    h = date.getHours();
    if(h<10)
    {
            h = "0"+h;
    }
    m = date.getMinutes();
    if(m<10)
    {
            m = "0"+m;
    }
    s = date.getSeconds();
    if(s<10)
    {
            s = "0"+s;
    }
    result = ''+days[day]+' '+d+' '+months[month]+' '+year+' '+h+':'+m+':'+s;
    document.getElementById(id).innerHTML = result;
    setTimeout('date_time("'+id+'");','1000');
    return true;
}

function ceksetuppoli(){
    if(listpoli === undefined || listpoli.length == 0) {
        console.log("empty");
        getpoliaktif();
    } else {
        getlistpoli();
    }
}

$(function () {

    getDataUnitkerja();
    date_time("date_time");
    // getPoliUtama();
    // getpoliaktif();
    getDokter();
    getListPasien();

    // setTimeout(getNomor, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
});
</script>
</body>

</html>