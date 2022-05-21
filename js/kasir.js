var idbppoli = 0;
var noantrian;
var tanggal, jambuka;

function kasir(noid, idbppoli, idunitkerja, pasiennoantrian, tanggal, idtujuan){
    // toast("info", "pasien hadir di kasir dan kemudian pulang");
    $('#loading').show();
    $.ajax({
        type : "POST",
        url : Settings.baseurl+'/addhistory/3',
        data: {noid:noid,tanggal:tanggal,idunitkerja:idunitkerja,pasiennoantrian:pasiennoantrian,idbppoli:idbppoli, idtujuan: idtujuan, '_token': Settings.token},
        timeout : 10000,
        // dataType: "json",
        error: function(responsedata){
            var errors = responsedata.statusText;
            console.log(errors);
            // console.log(responsedata);
            $('#loading').hide();
            toast('error', errors);
        },
        success: function(responsedata){                      
            if (responsedata== "1") {
                // reloadTable('#tbpeserta');
                toast('success', 'Simpan Data Sukses');
                // kembali();
            } else if (responsedata=="2"){
                // reloadTable('#tbpeserta');
                toast('success', 'Update Data Sukses');
                // kembali();
            } else {
                toast('error', responsedata);
            }
        }
    }).done(function(){
        $('#loading').hide();
    });
}

function apotek(){
    toast("info", "pasien hadir di kasir dan kemudian menuju apotek");
}

function lab(){
    toast("info", "pasien hadir di kasir dan kemudian menuju laboratorium");
}

function riwayat(noid, idbppoli, idunitkerja, pasiennoantrian, tanggal, idtujuan){
    $("#detailriwayat").empty();
    $("#loading").show();
    $.ajax({
        url: 'getriwayat',
        type: 'POST',
        data: {noid:noid,tanggal:tanggal,idunitkerja:idunitkerja,pasiennoantrian:pasiennoantrian,idbppoli:idbppoli, '_token': Settings.token},
        dataType: 'json',
        success: function (result) {
            for (i = 0; i < result.data.length; i++) {
                $('#detailriwayat').append('<tr>' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + result.data[i]['nama'] + '</td>' +
                    '<td>' + result.data[i]['bppoli'] + '</td>' +
                    '<td>' + result.data[i]['jam'] + '</td>' +
                '</tr>');
            }
        }
    }).done(function(){
        $("#boxdata").hide('slow');
        $("#boxriwayat").show("slow");
        $('#loading').hide();
    });
}

function kembali(){
    $("#boxdata").show('slow');
    $("#boxriwayat").hide("slow");
}

$(function () {
    $("#boxriwayat").hide();

    $("#idbppoli").select2({
      placeholder: 'Semua Poli',
      allowClear: true
    });

    
    // $("#idbppoli").val("1").trigger("change");
    // idbppoli = $("#idbppoli").val();
    $('#tbpasien').dataTable({
        ajax: {url:"getpasienpoli", data:function(d){d.idunitkerja = idunitkerja; d.idbppoli = idbppoli; d.idpolireq = 9999;}}, 
        // "sAjaxDataProp": "aData",
        processing: true,
        "iDisplayLength": 10,
        "aoColumns":[ 
            {"mDataProp": "NAMA_LGKP"},
            {"mDataProp": "bppoli"},
            {"mDataProp": "pasiennoantrian"},
        ],
        "aoColumnDefs": [
            {
                "aTargets": [ 3 ],
                "mRender": function (data, type, row) { 
                    return '<a href="javascript:void(0);"  title="Ambil Antrian" class="btn btn-sm btn-primary" onclick="pulang(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\',0);">Pulang</a>&nbsp;&nbsp;<a href="javascript:void(0);"  title="Ambil Antrian" class="btn btn-sm btn-primary" onclick="kasir(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\',31);">Apotek</a>&nbsp;&nbsp;<a href="javascript:void(0);"  title="Ambil Antrian" class="btn btn-sm btn-primary" onclick="kasir(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\',39);");">Lab</a>'; 
                }
            }, {
                "aTargets": [ 4 ],
                "mRender": function (data, type, row) { 
                    return '<a href="javascript:void(0);"  title="History"  onclick="riwayat(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\',0);" class="ui-tooltip fa fa-clipboard" style="font-size: 20px;"></a>'; 
                }
            }
        ],
        "order": [[2, "asc"]],
        "oLanguage": {
            "sSearch": "Pencarian: ", 
            "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
            "sInfoFiltered": "(di filter dari _MAX_ total data)"
        },      
        "bLengthChange" : true
    });

    $("#idbppoli").change(function(){
      idbppoli = $(this).val();
      reloadTable("#tbpasien");
    });
});

