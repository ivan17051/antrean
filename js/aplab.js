var idbppoli;
var noantrian;
var tanggal, jambuka;

function selesai(noid, idbppoli, idunitkerja, pasiennoantrian, tanggal){
    // toast("info", "pasien hadir di kasir dan kemudian pulang");
    $('#loading').show();
    $.ajax({
        type : "POST",
        url : Settings.baseurl+'/addhistory/4',
        data: {noid:noid,tanggal:tanggal,idunitkerja:idunitkerja,pasiennoantrian:pasiennoantrian,idbppoli:idbppoli, idasal: 31, '_token': Settings.token},
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

$(function () {
    $("#idbppoli").select2({
      placeholder: 'Pilih Poli',
      // allowClear: true
    });

    
    $("#idbppoli").val("1").trigger("change");
    idbppoli = $("#idbppoli").val();
    $('#tbpasien').dataTable({
        ajax: {url:"getpasienpoli", data:function(d){d.idunitkerja = idunitkerja; d.idbppoli = 0; d.idpolireq = 31;}}, 
        // "sAjaxDataProp": "aData",
        processing: true,
        "iDisplayLength": 10,
        "aoColumns":[ 
            {"mDataProp": "NAMA_LGKP"},
            {"mDataProp": "bppoli"},
            {"mDataProp": "pasiennoantrian"},
        ],
        "aoColumnDefs": [ {
            "aTargets": [ 3 ],
            "mRender": function (data, type, row) { 
                return '<a href="javascript:void(0);"  title="Ambil Antrian" class="btn btn-sm btn-primary" onclick="selesai(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\');">Selesai</a>'; 
            }
        }],
        "order": [[2, "asc"]],
        "oLanguage": {
            "sSearch": "Pencarian: ", 
            "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
            "sInfoFiltered": "(di filter dari _MAX_ total data)"
        },      
        "bLengthChange" : true
    });
});

