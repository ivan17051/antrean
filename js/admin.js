var idbppoli;
var noantrian;
var tanggal, jambuka;
// var idunitkerja;

function getDataPoli(){
    // $('#listpoli').empty();
    $("#loading").show();
    $("#tombolnext").prop("disabled", true);
    idbppoli = $("#idbppoli").val();
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli, //'{{route('get-rek')}}',
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                let data = result.data[0];
                console.log(data);
                noantrian = data['noantrian'];
                tanggal = data['servesdate'];
                jambuka = data['jambuka'];
                $("#noantrian").html(data['noantrian']);
                $("#namapoli").html(data['nama']);
                $("#namapasien").html(data['pasien']);
            }
        });
        // reloadTable("#tbpasien");
    }
    $("#tombolnext").prop("disabled", false);
    $("#loading").hide();
}

function getDataPoli2(){
    $('#listpoli').empty();
    idbppoli = $("#idbppoli").val();
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli, //'{{route('get-rek')}}',
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                let data = result.data[0];
                console.log(data);
                noantrian = data['noantrian'];
                tanggal = data['servesdate'];
                jambuka = data['jambuka'];
                $('#listpoli').append('<div class="col-md-12">'+
                        '<div class="info-box">'+
                            '<span class="info-box-icon bg-aqua" id="nox">'+data['noantrian']+'</span>'+

                            '<div class="info-box-content">'+
                              '<span class="info-box-number">'+data['nama']+'</span>'+
                              '<span class="info-box-text">'+data['pasien']+'</span>'+
                              '<span>'+
                                // '<a class="btn btn-sm bg-aqua" onclick="prevno('+data['id']+');"><i class="fa fa-arrow-left"></i></a>&nbsp;'+
                                '<a class="btn btn-sm bg-aqua" onclick="nextno('+data['id']+');"><i class="fa fa-arrow-right"></i></a>&nbsp;'+
                                // '<a class="btn btn-sm bg-aqua" onclick="setno('+data['id']+');"><i class="fa fa-pencil"></i></a>'+
                              '</span>'+
                            '</div>'+
                         '</div>'+
                    '</div>'
                );
            }
        });
        reloadTable("#tbpasien");
    }
}

function prevno(){
    console.log('prev');
    nourut = nourut-1;
    $("#nox").html(nourut);
}

function nextno(){
    $("#loading").show();
    console.log('next');
    // nourut = nourut+1;
    // $("#nox").html(nourut);
    $.post(Settings.baseurl+'/layaniantrian', {tanggal:tanggal,idunitkerja:idunitkerja,pasiennoantrian:noantrian,idbppoli:idbppoli, '_token': Settings.token},function(respon){
        console.log(respon);
        // console.log(respon.data);
        // if (respon.meta) {
        //     if(respon.meta.code == 200){
        //         var data = respon.data;
        //         getDataPoli();
        //     } else if (respon.meta.code == 204) {
        //         toast("info", "Antrian Tidak Ditemukan");
        //     } else {
        //         toast("info", respon.meta.message);
        //     }
        // } else toast("warning", "Gagal Mendapatkan Data. Ulangi Kembali");
        if(respon == 1){
            getDataPoli();
        } else {
            toast("info", respon);
        }
    });
    $("#loading").hide();
    // reloadTable("#tbpasien");
}

function setno(){
    console.log('set');
}

$(function () {
    $(document).keydown(function(e){
        evt = e || window.event;
        var target = evt.target || evt.srcElement;
        if ( !/INPUT|TEXTAREA|SELECT|BUTTON/.test(target.nodeName) ) {
            if (e.keyCode==32 && e.ctrlKey){
                // toast('info',"ctrl+z detected!</p>");
                nextno();
            }
        }
    });

    $("#idbppoli").select2({
      placeholder: 'Pilih Poli',
      // allowClear: true
    });

    
    $("#idbppoli").val("1").trigger("change");
    idbppoli = $("#idbppoli").val();
    // $('#tbpasien').dataTable({
    //     ajax: {url:"getpasienpoli", data:function(d){d.idunitkerja = idunitkerja; d.idbppoli = idbppoli;}}, 
    //     // "sAjaxDataProp": "aData", 
    //     "iDisplayLength": 10,
    //     "aoColumns":[ 
    //         {"mDataProp": "NAMA_LGKP"},
    //         {"mDataProp": "jamestimasi"},
    //         {"mDataProp": "pasiennoantrian"},
    //     ],
    //     "order": [[2, "asc"]],
    //     "oLanguage": {
    //         "sSearch": "Pencarian: ", 
    //         "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
    //         "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
    //         "sInfoFiltered": "(di filter dari _MAX_ total data)"
    //     },      
    //     "bLengthChange" : false
    // });

    getDataPoli();
    // getPoliLain();
    // setInterval(function(){getNomor()}, 5000);
});

