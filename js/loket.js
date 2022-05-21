var idbppoli = 0;
var noantrian;
var tanggal, jambuka;

function hadir(noid, idbppoli, idunitkerja, pasiennoantrian, tanggal){
    // toast("info", "pasien hadir di loket");
    $("#loading").show();
    console.log('next');
    // nourut = nourut+1;
    // $("#nox").html(nourut);
    $.post(Settings.baseurl+'/addhistory/1', {noid:noid,tanggal:tanggal,idunitkerja:idunitkerja,pasiennoantrian:pasiennoantrian,idbppoli:idbppoli, '_token': Settings.token},function(respon){
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
            reloadTable("#tbpasien");
        } else {
            toast("info", respon);
        }
    });
    $("#loading").hide();
}

$(function () {
    $("#idbppoli").select2({
      placeholder: 'Semua Poli',
      allowClear: true
    });

    
    // $("#idbppoli").val("1").trigger("change");
    // idbppoli = $("#idbppoli").val();
    $('#tbpasien').dataTable({
        ajax: {url:"getpasienpoli", data:function(d){d.idunitkerja = idunitkerja; d.idbppoli = idbppoli; d.idpolireq = 0;}}, 
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
                return '<a href="javascript:void(0);"  title="Ambil Antrian" class="btn btn-primary" onclick="hadir(\''+row['noid']+'\',\''+row['idbppoli']+'\',\''+row['idunitkerja']+'\',\''+row['pasiennoantrian']+'\',\''+row['tanggallayanan']+'\');">Hadir</a>'; 
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

    $("#idbppoli").change(function(){
      idbppoli = $(this).val();
      reloadTable("#tbpasien");
    });
});

