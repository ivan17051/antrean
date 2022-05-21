  var url;
  var tampil = (function(id){
    $('#loading').show();
    reloadTable("#tbpoliunit");
    $('#loading').hide();
  });


  var edit = (function(idbppoli,nama){
    $('#boxunitpoli').show('slow');  
    $('#boxdataunitpoli').hide('slow');   
    $('#namapoli').text(nama);
    $.getJSON(Settings.baseurl+'/getdetailpoliunit',{idbppoli:idbppoli},function (json){
        ambilform('#frmdataunitpoli', (json));
    });    
    url = Settings.base_url+"index.php/unitkerjapoli/edit";
  });

  var simpan = (function(){
    var str = serialform('#frmdataunitpoli');
    myAjax.getAjax({
      spinner : '#loading',
      url     : 'ssetpoli',
      data    : str,
      success : function(responsedata){
        if(responsedata=="1"){
          toast("info", "Simpan Data Berhasil");
          kembali();
          tampil();
        } else{
          toast("warning", responsedata);
        }
      }
    });
  });

  var kembali =(function(){
   $('#boxunitpoli').hide('slow');  
   $('#boxdataunitpoli').show('slow');
  });


  $(function(){  
  	$('#boxunitpoli').hide();	

    $('#tbpoliunit').dataTable({  
        "bProcessing": true,
        "sAjaxSource": Settings.baseurl+"/getpoliunit",
        "sAjaxDataProp": "aData", 
        "iDisplayLength": 10,
        "aoColumns":[
          {"mDataProp": "nourut",  "sTitle": "No","bSortable": false,"sWidth": "10%"},
          {"mDataProp": "kode",  "sTitle": "Kode","bSortable": false,"sWidth": "10%"},
          {"mDataProp": "nama",  "sTitle": "Poli/Klinik","bSortable": false},
          {"mDataProp": "maxquota",  "sTitle": "Kuota","bSortable": false},
          {"mDataProp": "isdirectqueue",  "sTitle": "Antrian","bSortable": false,"sWidth": "10%",
            "mRender": function(data, type, row) {
               if(row.isdirectqueue=='1'){
                return '<span class="label label-success">Active</span>';
               }
               else{
                return '<span class="label label-danger">Not</span>';
               }
             }
          },
          {"mDataProp": "isactive",  "sTitle": "Status","bSortable": false,"sWidth": "10%",
            "mRender": function(data, type, row) {
               if(row.isactive=='1'){
                return '<span class="label label-success">Active</span>';
               }
               else{
                return '<span class="label label-danger">Not</span>';
               }
             }
          },
          {"bSortable": false,"mData": null,"sTitle": "","sWidth": "6%",
            "mRender": function(data,type,row) {
              return '<a href="javascript:void(0);" title="Edit data" onclick="edit(\''+row.idbppoli+'\',\''+row.nama+'\');" class="ui-tooltip fa fa-pencil" style="font-size: 25px;"></a> ';
            }
          }
        ],
        "oLanguage": {
          // "sProcessing": "<img style='position:relative;bottom:-12px;' src="+Settings.base_url+"assets/dist/img/page-processing.gif>",
          "sSearch": "Pencarian: ", 
          "sZeroRecords": "Data Kosong",
          "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
          "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
          "sInfoFiltered": "(di filter dari _MAX_ total data)"
        },  
        "aLengthMenu": [[10, 25, 50, 100 , -1], [5, 10, 25, 50, 100]],
        "bLengthChange" : false,
        "bAutoWidth": false
    });  

  });