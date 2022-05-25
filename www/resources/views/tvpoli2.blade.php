<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    TV Poli 2
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!-- Fonts and icons -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{asset('theme/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- CSS Files -->
  <link rel="stylesheet" href="{{asset('theme/assets/css/material-dashboard.css?v=2.2.2')}}"/>
  <link rel="stylesheet" href="{{asset('theme/plugins/bootstrap-toastr/toastr.min.css')}}"/>
  <!-- Sweetalert -->
  <link rel="stylesheet" href="{{asset('theme/plugins/sweetalert/sweetalert.css')}}"/>
  <style>
        .card.fill-height{
            height: calc(100% - 60px);
        }
        .header2{
            font-size:26px; margin-bottom:20px; font-weight:400;
        }
        .table tr[status]{
            color: white;
            box-shadow: rgb(209 209 209 / 28%) 0px -9px 1px -2px inset, rgb(209 209 209 / 28%) 0px 8px 1px -2px inset;
        }
        .table tr[status=active]{
            font-size: 32px;
            background: linear-gradient(90deg, #1bb822, #67cd6c);
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }
        .table tr[status=active] td{
            padding-top: 2rem!important;
            padding-bottom: 2rem!important;
        }
        .table tr[status=pending]{
            background: linear-gradient(60deg, #fb8c00, #f6af47, #fb8c00);
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }
        .table tr[status=late]{
            background: linear-gradient(60deg, #e53935, #ef5350, #e53935);
            background-size: 200% 200%;
            animation: gradient 3s ease infinite;
        }        
        .table tr td:first-child, .table tr th:first-child{
            text-align: center;
        }
        @keyframes gradient {
            0% {
                background-position: 200% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
  </style>
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
            <img src="{{asset('/img/pemkot.png')}}" alt="Logo" style="height:100px; margin-bottom:30px; padding-left:20px;">
            <p class="navbar-brand" style="padding-top:30px; font-weight:450;" href="{{url('/')}}">Dinas Kesehatan Kota Surabaya<br><label id="namaunitkerja" style="font-size:18px; font-weight:450;"></label></p>
          </div>
          
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <!-- untuk navbar kanan -->
                <div id="barisbutton">
                    <button type="button" class="btn btn-sm btn-dark btn-link" onclick="kembali();"><i class="fa fa-rotate-left"></i></button>
                    <button type="button" class="btn btn-sm btn-dark btn-link pull-right" id="tombolsuara" onclick="setsuara();" style="margin-right:20px;"></button>
                </div>
                <div id="date_time" style="margin-bottom: 20px; font-size: 20px; font-weight: 400; margin-right: 20px;"></div>
              </div>
            </form>
            <ul class="navbar-nav">
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div id="boxlistpoli">
            <div class="row" id="listpoli"></div>
        </div>
        <div id="viewantrian">
            
            <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                <div class="card fill-height">
                    <div class="card-header card-header-danger card-header-text">
                    <div class="card-text">
                        <h4 class="card-title" style="font-weight:450;">No. Antrian</h4>
                    </div>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h4 style="font-size:154px; font-weight:400; line-height:1;" id="listnomor"></h4>
                        <h2 id="listnomor_nama" ></h2>
                    </div>
                </div>
                </div>
                <div class="col-md-8">
                <div class="card fill-height">
                    <div class="card-header card-header-danger card-header-text">
                    <div class="card-text">
                        <h4 class="card-title" style="font-weight:450;">Poliklinik</h4>
                    </div>
                    </div>
                    <div class="card-body ">
                    
                        <h4 style="font-size:65px; margin-bottom:0; font-weight:400;" id="listpoliutama"></h4>
                        <table class="header2" id="listdokter"></table>
                        <p style="font-size:25px; margin-bottom:20px; font-weight:400;" id="listnomorberikut"></p>
                        <p style="font-size:25px; margin-bottom:20px; font-weight:400;" id="listestimasi"></p>                      
                    </div>
                </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-danger card-header-text">
                            <div class="card-text">
                                <h4 class="card-title" style="font-weight:450;">Pasien</h4>
                            </div>
                        </div>
                    <div class="card-body table-full-width">
                        <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>No</th>
                            <th>Nama Pasien</th>
                            <th>Keterangan</th>
                            </thead>
                            <tbody id="listpasienn">
                            
                            </tbody> 
                        </table>
                        </div>
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
    $('li a[href="' + action + '"]').parent().addClass('active');
    $('ul.treeview-menu a[href="' + action + '"]').parent().addClass('active');
    $('li ul a[href="' + action + '"]').parent().parent().parent().addClass('active');
    $('li ul a[href="' + action + '"]').parent().parent().parent().parent().parent().addClass('active');

    $(".date.date-picker").attr("autocomplete", "off");
    $(".date.date-picker input").attr("autocomplete", "off");

    $('#loading').hide();
});

var Settings = {
    token: "{{ csrf_token() }}",
    baseurl: "{{url('')}}"
}

var idunitkerja = "{{$d['idunitkerja']}}";
var suaraaktif = 0;
var nonow = 0;
var listpoli = [];

function setsuara(){
    if (suaraaktif == 1) {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-off">');
        localStorage.setItem("suaraantrian", 0);
        suaraaktif = 0;
    } else {
        // $("#tombolsuara").html('<i class="glyphicon glyphicon-volume-up">');
        localStorage.setItem("suaraantrian", 1);
        suaraaktif = 1;
    }
    settombolsuara();
    ceksuara();
}

function settombolsuara(){
    if (suaraaktif == 1) {
        $("#tombolsuara").html('<i class="fa fa-volume-off">');
    } else {
        $("#tombolsuara").html('<i class="fa fa-volume-slash">');
    }
}

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
            createlistmodal(data);
        },
        error: function (result) {
            // console.log(result.statusText);
        }
    }).done( () => {
        // console.table(listpoli)
    })
}

function createlistmodal(data){
    // $("#boxpoliantrian").empty()
    var i = 0;
    // console.log(data);
    var box = data.map(function (poli) {
        var x = $('<div class="col-md-6" style="margin-top:10px;">' +
            '<button type="button" class="btn btn-block btn-lg btn-danger buttonpoli" style="font-size: 32px;">' + poli.nama + '</button>' +
        '</div>');
        x.on('click' , function(){
            // namapoli = poli.nama
            setpoli(poli.id)
        });
        return x;
    })
    $("#listpoli").html('').append(box);
    // showmodalsetup();
}

function setpoli(id) {
    $("#loading").show();
    $("#boxlistpoli").hide('slow');
    $("#viewantrian").show('slow');
  
    listpoli[0] = id;
    // console.log(listpoli);
    getlistpoli();
    setTimeout(getNomor, 2000);
    setTimeout(getDokter, 2000);
    //setTimeout(getListPasien, 2000);
    setTimeout(ceksuara, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
    // setTimeout(getNomor, 2000);
    $("#loading").hide();
}

function kembali(){
    // $("#boxlistpoli").show('slow');
    // $("#viewantrian").hide('slow');
    location.reload();
}

function getlistpoli(){
    $('#listpoliutama').empty();
    // console.log(listpoli);
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getlistpoli',
            type: 'GET',
            data: {poli: listpoli},
            dataType: 'json',
            success: function (result) {
                var data = result.data;
                // console.log(data);
                for (i = 0; i < data.length; i++) {
                    $('#listnomor').append('<div id="poli'+data[i]['id']+'"></div>');
                    // $('#listnomor_nama').text(da)
                    $('#listpoliutama').append(data[i]['nama']);
                    // $('#listdokter').append('Dokter: <span id="dokter'+data[i]['id']+'" style="font-weight: bold;">-</span>');
                    $('#listnomorberikut').append('Nomor Berikutnya: <span id="polin'+data[i]['id']+'" style="font-weight: bold;">-</span>');
                    getDokter()
                    $('#listestimasi').append('Estimasi Jam Dilayani: <span id="estimasi'+data[i]['id']+'" style="font-weight: bold;">-</span>');
                    $("#listpasienn").attr('id', 'listpasien'+data[i]['id']);
                    // idbppoli.
                }
                
            },
            error: function(responsedata){
                var errors = responsedata.statusText;
                $('#loading').hide();
                toast("error", errors);
            }
        });
    }
}

function getDokter(){
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getdokter',
            type: 'GET',
            data: {poli: listpoli},
            dataType: 'json',
            success: function (result) {
                var datanow = result.data.dokter;
                let listdokterhtml = "";
                if (!datanow.length){
                    listdokterhtml="<tr><td></td><td><b>-</b></td></tr>";
                }
                for (i = 0; i < datanow.length; i++) {
                    if(i==0){
                        listdokterhtml+="<tr><td></td><td><b>"+datanow[i]['nakes']+"</b></td></tr>";
                    }else{
                        listdokterhtml+="<tr><td></td><td class=\"pt-3\"><b>"+datanow[i]['nakes']+"</b></td></tr>";
                    }
                }
                $('#listdokter').html(listdokterhtml)
            },
            
        });
    } 
}

function getListPasien(){
    // $("#loading").show();
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getlistpasien',
            type: 'GET',
            data: {poli: listpoli},
            dataType: 'json',
            success: function (result) {
                var datanow = result.data.listpasien;
                //console.log('asa'+nonow);
                for (i = 0; i < datanow.length; i++) {
					if(datanow[i]['pasiennoantrian']>=nonow){
                    //$("#listpasien"+datanow[i]['idbppoli']).append('<tr><td>'+datanow[i]['noantrian']+'</td><td>'+datanow[i]['text']+'</td><td>'+datanow[i]['iscall']+'</td></tr>');
					$("#listpasien"+datanow[i]['idbppoli']).append('<tr><td>'+datanow[i]['pasiennoantrian']+'</td><td>'+datanow[i]['NAMA_LGKP']+'</td><td>'+datanow[i]['tanggaleta']+'</td></tr>');
                    // DUMMY-CODE
                    //if (i==0) {
                    //    $("#listpasien"+datanow[i]['idbppoli']).append('<tr status="late"><td>'+datanow[i]['noantrian']+'</td><td>'+datanow[i]['text']+'</td><td>Terlambat</td></tr>');
                    //}else if (i==1) {
                    //    $("#listpasien"+datanow[i]['idbppoli']).append('<tr status="pending"><td>'+datanow[i]['noantrian']+'</td><td>'+datanow[i]['text']+'</td><td>Pending</td></tr>');
                    //}else if (i==2) {
                    //    $("#listpasien"+datanow[i]['idbppoli']).append('<tr status="active"><td>'+datanow[i]['noantrian']+'</td><td>'+datanow[i]['text']+'</td><td>Berlangsung</td></tr>');
                    //} else {
                    //    $("#listpasien"+datanow[i]['idbppoli']).append('<tr><td>'+datanow[i]['noantrian']+'</td><td>'+datanow[i]['text']+'</td><td>'+datanow[i]['iscall']+'</td></tr>');
                    //}
                    // End of DUMMY-CODE
					}
                }
            },
            complete:function(data){
                $("#listpasien"+datanow[i]['idbppoli']).clear();
               //setTimeout(getListPasien, 5000);
            }
        });
    } else {
        $("#listpasien"+datanow[i]['idbppoli']).clear();
        //setTimeout(getListPasien, 5000);
    }
    // $("#loading").hide();
}

function getNomor(){
    // $("#loading").show();
    if(listpoli !== undefined && listpoli.length) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getnomor',
            type: 'GET',
            data: {poli: listpoli},
            dataType: 'json',
            success: function (result) {
                var panggilanAntrian = result.data.panggilanantrian;
                $('#listnomor_nama').text( (panggilanAntrian) ? panggilanAntrian.text : "" )

                var datanow = result.data.now;
                for (i = 0; i < datanow.length; i++) {
                    $("#poli"+datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
					nonow = datanow[i]['noantrian'];
                }
				getListPasien();
                var datanext = result.data.next;
                for (i = 0; i < datanext.length; i++) {
                    $("#polin"+datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
                    $("#estimasi"+datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
                    //$("#estimasilayanan"+datanext[i]['idbppoli']).html(datanext[i]['waktunontindakan'] + ' menit');
                    //$("#estimasilayanantindakan"+datanext[i]['idbppoli']).html(parseInt(datanext[i]['waktutindakan']) + ' menit');
                }
            },
            complete:function(data){
               setTimeout(getNomor, 5000);
            }
        });
    } else {
        setTimeout(getNomor, 5000);
    }
    // $("#loading").hide();
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
    // if (iscall == 0) {
    //     $.get(Settings.baseurl+'/getdataunitkerja', {idunitkerja:idunitkerja},function(respon){
    //         if(respon.data){
    //             var du = respon.data;
    //             $("#namaunitkerja").html(du.nama);
    //             $("#alamatunitkerja").html(du.alamat1);
    //         } else {
    //             // toast("info", respon);
    //         }
    //     });
    // }
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

function ceksuara(){
    // $("#loading").show();
    if(listpoli !== undefined && listpoli.length && suaraaktif == 1) {
        cekPanggilan(listpoli);
        console.log("suaraon");
    } else {
        console.log("suaraoff");
        // setTimeout(ceksuara, 3000);
    }
}

$(function () {
    $("#viewantrian").hide();
    getDataUnitkerja();
    date_time("date_time");
    // getPoliUtama();
    getpoliaktif();

    if(localStorage.getItem("suaraantrian") !== null){
        suaraaktif = localStorage.getItem("suaraantrian");
        settombolsuara();
    }

    // ceksetuppoli();

    // setTimeout(getNomor, 2000);
    // setTimeout(cekPanggilan, 2000, listpoli);
});
  </script>
</body>

</html>
