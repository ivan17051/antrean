var idbppoli = [];
// var idunitkerja;

function getPoliUtama(){
    $('#listpoliutama').empty();
    $.ajax({
        url: Settings.baseurl+'/getlistpoli/1/'+idunitkerja, //'{{route('get-rek')}}',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            console.log(data);
            for (i = 0; i < data.length; i++) {
                $('#listpoliutama').append('<div class="box box-primary">'+
                    '<div class="box-header with-border headerpoli">'+
                    '<div class="policaption">'+data[i]['nama']+'</div>'+
                    '</div>'+
                    '<div class="box-body">'+
                    '<a href="#" class="gotodetail" onclick="detail('+data[i]['id']+');">Lihat</a>'+
                    '<div class="antrianpoli"><div id="poli'+data[i]['id']+'">0</div></div>'+
                    '</div>'+
                    '</div>'
                );
                // idbppoli.
            }
        }
    });
}

function getPoliLain(){
    $('#listpolilain').empty();
    $.ajax({
        url: Settings.baseurl+'/getlistpoli/2/'+idunitkerja,
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            let colmd = 1;
            console.log(data);
            if (data.length) {
                if (data.length < 5 ) {
                    colmd = 12/data.length;
                } else {
                    colmd = 2;
                }
            }
            for (i = 0; i < data.length; i++) {
                $('#listpolilain').append('<div class="col-md-'+colmd+'"><div class="box box-primary">'+
                    '<div class="box-header with-border headerpoli">'+
                    '<div class="policaption2">'+data[i]['nama']+'</div>'+
                    '</div>'+
                    '<div class="box-body">'+
                    '<a href="#" class="gotodetail" onclick="detail('+data[i]['id']+');">Lihat</a>'+
                    '<div class="antrianpoli2"><div id="poli'+data[i]['id']+'">0</div></div>'+
                    '</div>'+
                    '</div></div>'
                );
            }
        }
    });
}

function getNomor(){
    // $("#loading").show();
    $.ajax({
        url: Settings.baseurl+'/getnomor/'+idunitkerja, //'{{route('get-rek')}}',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            // console.log(data);
            for (i = 0; i < data.length; i++) {
                $("#poli"+data[i]['idpoli']).html(data[i]['noantrian']);
            }
        }
    });
    // $("#loading").hide();
}

function detail(id){
    window.location.href = Settings.baseurl+"/detail/"+id;
}

$(function () {
    getPoliUtama();
    getPoliLain();
    setInterval(function(){getNomor()}, 5000);
});

