var noantrian;
var tanggal, jambuka;
// var idunitkerja;

function getDataPoli(){
    $('#listpoli').empty();
    // idbppoli = $("#idbppoli").val();
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli, //'{{route('get-rek')}}',
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                let data = result.data[0];
                console.log(data);
                // noantrian = data['noantrian'];
                // tanggal = data['servesdate'];
                // jambuka = data['jambuka'];
                $('#listpoli').append('<div class="col-md-12">'+
                        '<div class="info-box">'+
                            '<span class="info-box-icon bg-aqua" id="noantrian">'+data['noantrian']+'</span>'+

                            '<div class="info-box-content">'+
                              '<span class="info-box-number">'+data['nama']+'</span>'+
                              '<span class="info-box-text" id"namapasien">'+data['pasien']+'</span>'+
                            '</div>'+
                         '</div>'+
                    '</div>'
                );
            }
        });
        reloadTable("#tbpasien");
    }
}

function getDataPoli2(){
    // $('#listpoli').empty();
    // idbppoli = $("#idbppoli").val();
    if (idbppoli) {
        $.ajax({
            url: Settings.baseurl+'/getdatapoli/'+idunitkerja+'/'+idbppoli, //'{{route('get-rek')}}',
            type: 'GET',
            // data: {idunitkerja: 1},
            dataType: 'json',
            success: function (result) {
                let data = result.data[0];
                console.log(data);
                $("#noantrian").html(data['noantrian']);
                $("#namapasien").html(data['pasien']);
            }
        });
        reloadTable("#tbpasien");
    }
}

$(function () {
    
    $('#tbpasien').dataTable({
        ajax: {url:Settings.baseurl+"/getpasienpoli", data:function(d){d.idunitkerja = idunitkerja; d.idbppoli = idbppoli;}}, 
        // "sAjaxDataProp": "aData", 
        "iDisplayLength": 10,
        "aoColumns":[ 
            {"mDataProp": "NAMA_LGKP"},
            {"mDataProp": "jamestimasi"},
            {"mDataProp": "pasiennoantrian"},
        ],
        "order": [[2, "asc"]],
        "oLanguage": {
            "sSearch": "Pencarian: ", 
            "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
            "sInfoFiltered": "(di filter dari _MAX_ total data)"
        },      
        "bLengthChange" : false
    });

    getDataPoli();
    setInterval(function(){getDataPoli2()}, 5000);
    // getPoliLain();
    // setInterval(function(){getNomor()}, 5000);
});

