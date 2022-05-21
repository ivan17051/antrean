var idbppoli;
var tanggal;
var iscall = 0;
var timeout = 0;

function getPoliUtama() {
    $('#listpoliutama').empty();
    $.ajax({
        url: Settings.baseurl + '/getlistpoli/2/' + idunitkerja, //'{{route('get-rek')}}',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            console.log(data);
            for (i = 0; i < data.length; i++) {
                let color = (i % 2 == 0) ? 'aqua' : 'teal';
                $('#listpoliutama').append('<div class="col-md-6"><div class="box-info">' +
                    '<span class="box-info-number bg-' + color + '" id="poli' + data[i]['id'] + '">0</span>' +
                    '<div class="box-info-content">' +
                    '<span class="policaption">' + data[i]['nama'] + '</span>' +
                    '<span class="antrianpoli">Antrian berikutnya : <span id="polin' + data[i]['id'] + '" style="font-weight: bold;">-</span></span>' +
                    '<span class="antrianpoli">Estimasi jam dilayani : <span id="estimasi' + data[i]['id'] + '" style="font-weight: bold;">-</span></span>' +
                    '<span class="antrianpoli">Estimasi waktu tanpa tindakan : <span id="estimasilayanan' + data[i]['id'] + '" style="font-weight: bold;">-</span></span>' +
                    '<span class="antrianpoli">Estimasi waktu dengan tindakan : <span id="estimasilayanantindakan' + data[i]['id'] + '" style="font-weight: bold;">-</span></span>' +
                    // '<div class"gotodetail"><a href="#" onclick="detail('+idunitkerja+','+data[i]['id']+');">Lihat</a></div>'+
                    '</div>' +
                    '</div></div>'
                );
                // idbppoli.
            }
        }
    });
}

function getPoliUtamaold() {
    $('#listpoliutama').empty();
    $.ajax({
        url: Settings.baseurl + '/getlistpoli/2/' + idunitkerja, //'{{route('get-rek')}}',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let data = result.data;
            console.log(data);
            for (i = 0; i < data.length; i++) {
                $('#listpoliutama').append('<div class="col-md-4"><div class="box box-primary">' +
                    '<div class="box-header with-border headerpoli">' +
                    '<div class="policaption">' + data[i]['nama'] + '</div>' +
                    '</div>' +
                    '<div class="box-body">' +
                    '<a href="#" class="gotodetail" onclick="detail(' + data[i]['idunitkerja'] + ',' + data[i]['idpoli'] + ');">Lihat</a>' +
                    '<div class="antrianpoli">Antrian saat ini : <span id="poli' + data[i]['id'] + '" style="font-weight: bold;">0</span></div>' +
                    '<br>' +
                    '<div class="antrianpoli">Antrian berikutnya : <span id="polin' + data[i]['id'] + '" style="font-weight: bold;">0</span></div>' +
                    '<div class="antrianpoli">Estimasi layanan : <span id="estimasi' + data[i]['id'] + '" style="font-weight: bold;">07.30</span></div>' +
                    '</div>' +
                    '</div></div>'
                );
                // idbppoli.
            }
        }
    });
}

function getNomor() {
    // $("#loading").show();
    $.ajax({
        url: Settings.baseurl + '/getnomor/' + idunitkerja, //'{{route('get-rek')}}',
        type: 'GET',
        // data: {idunitkerja: 1},
        dataType: 'json',
        success: function (result) {
            let datanow = result.data.now;
            // console.log(data);
            for (i = 0; i < datanow.length; i++) {
                $("#poli" + datanow[i]['idbppoli']).html(datanow[i]['noantrian']);
            }
            let datanext = result.data.next;
            for (i = 0; i < datanext.length; i++) {
                $("#polin" + datanext[i]['idbppoli']).html(datanext[i]['noantrian']);
                $("#estimasi" + datanext[i]['idbppoli']).html(datanext[i]['jamestimasi']);
                $("#estimasilayanan" + datanext[i]['idbppoli']).html(datanext[i]['waktupelayanan'] + ' menit');
                $("#estimasilayanantindakan" + datanext[i]['idbppoli']).html(datanext[i]['waktupelayanantindakan'] + ' menit');
            }
        }
    });
    // $("#loading").hide();
}

function detail(idunit, idpoli) {
    window.location.href = Settings.baseurl + "/detail/" + idunit + "/" + idpoli;
}

//panggilansuara
function cekPanggilan() {
    if (iscall == 0) {
        $.get(Settings.baseurl + '/getpanggilanantrian', { tanggal: tanggal, idunitkerja: idunitkerja }, function (respon) {
            if (respon.data) {
                noantrian = respon.data.noantrian;
                idbppoli = respon.data.idbppoli;
                let idpanggilan = respon.data.id;
                sound(noantrian, idbppoli);
                setTimeout(function () { deletePanggilan(idpanggilan) }, 500);
            } else {
                // toast("info", respon);
            }
        });
    }
}

function deletePanggilan(id) {
    $.post(Settings.baseurl + '/deletepanggilanantrian/' + id, { '_token': Settings.token }, function (responsedata) { });
}

function sound(number, idbppoli) {
    timeout = 0;
    iscall = 1;
    let npoli = "intro";
    switch (parseInt(idbppoli)) {
        case 1:
            npoli = "umum";
            break;
        case 2:
            npoli = "gigi";
            break;
        case 3:
            npoli = "kia";
            break;
        case 4:
            npoli = "gizi";
            break;
        case 6:
            npoli = "anak";
            break;
        case 12:
            npoli = "mata";
            break;
        case 13:
            npoli = "paru";
            break;
        case 14:
            npoli = "sanitasi";
            break;
        case 15:
            npoli = "tumbuhkembang";
            break;
        case 16:
            npoli = "paliatif";
            break;
        case 18:
            npoli = "std";
            break;
        case 19:
            npoli = "batra";
            break;
        case 20:
            npoli = "ptrm";
            break;
        case 22:
            npoli = "psikologi";
            break;
        case 24:
            npoli = "spesialisgigi";
            break;
        case 25:
            npoli = "igd";
            break;
        case 31:
            npoli = "farmasi";
            break;
        case 35:
            npoli = "vct";
            break;
        case 39:
            npoli = "laboratorium";
            break;
        case 55:
            npoli = "lansia";
            break;
        case 59:
            npoli = "pkpr";
            break;
        case 62:
            npoli = "p2m";
            break;
    }
    // console.log(npoli);
    // ion.sound.play("intro");
    setTimeout(function () { ion.sound.play("poli") }, timeout += 500);
    setTimeout(function () { ion.sound.play(npoli) }, timeout += 600);
    setTimeout(function () { ion.sound.play("nomorantrian") }, timeout += 1000);
    suaranomor(number, timeout);

    // if (jenispx=='1') {
    //     jenispx="bpjs";
    // }
    // else{
    //     jenispx="umum";
    // }
    // setTimeout(function(){
    // ion.sound.play(jenispx)}, timeout+=1200);
    // setTimeout(function(){
    // ion.sound.play("B")}, timeout+=1500);
    setTimeout(function () { iscall = 0; }, 5000);
}

function suaranomor(number, timeout) {
    arr_number = [
        "0",
        "satu",
        "dua",
        "tiga",
        "empat",
        "lima",
        "enam",
        "tujuh",
        "delapan",
        "sembilan",
        "sepuluh",
        "sebelas"];

    if (number < 12) {
        setTimeout(function () {
            ion.sound.play(arr_number[number])
        }, timeout += 1000);
    } else if (number < 20) {
        number = (number - 10);
        setTimeout(function () { ion.sound.play(arr_number[number]) }, timeout += 1000);
        setTimeout(function () { ion.sound.play("belas") }, timeout += 500);
    } else if (number < 100) {
        number1 = parseInt(number / 10);
        setTimeout(function () { ion.sound.play(arr_number[number1]) }, timeout += 1000);
        setTimeout(function () { ion.sound.play("puluh") }, timeout += 500);
        number2 = number % 10;
        setTimeout(function () { ion.sound.play(arr_number[number2]) }, timeout += 500);
    } else if (number < 200) {
        setTimeout(function () { ion.sound.play("seratus") }, timeout += 1000);
        number = number - 100;
        suaranomor(number, timeout);
    } else if (number < 1000) {
        numberratus = parseInt(number / 100);
        if ((number % 100) <= 0) {
            setTimeout(function () { ion.sound.play(arr_number[numberratus]) }, timeout += 1000);
            setTimeout(function () { ion.sound.play("ratus") }, timeout += 500);
        } else if ((number % 100) < 12) {
            setTimeout(function () { ion.sound.play(arr_number[numberratus]) }, timeout += 1000);
            setTimeout(function () { ion.sound.play("ratus") }, timeout += 500);
            setTimeout(function () { ion.sound.play(arr_number[number % 100]) }, timeout += 500);
        } else if ((number % 100) < 20) {
            number = ((number % 100) - 10);
            setTimeout(function () { ion.sound.play(arr_number[numberratus]) }, timeout += 1000);
            setTimeout(function () { ion.sound.play("ratus") }, timeout += 500);
            setTimeout(function () { ion.sound.play(arr_number[number]) }, timeout += 500);
            setTimeout(function () { ion.sound.play("belas") }, timeout += 500);
        } else if ((number % 100) < 100) {
            number1 = parseInt((number % 100) / 10);
            setTimeout(function () { ion.sound.play(arr_number[numberratus]) }, timeout += 1000);
            setTimeout(function () { ion.sound.play("ratus") }, timeout += 700);
            setTimeout(function () { ion.sound.play(arr_number[number1]) }, timeout += 700);
            setTimeout(function () { ion.sound.play("puluh") }, timeout += 500);
            number2 = (number % 100) % 10;
            setTimeout(function () { ion.sound.play(arr_number[number2]) }, timeout += 500);
        }
    } else if (number < 2000) {
        setTimeout(function () { ion.sound.play("seribu") }, timeout += 1000);
        number = number - 1000;
        suaranomor(number, timeout);
    } else {
        setTimeout(function () { ion.sound.play("selanjutnya") }, timeout += 1000);
    }
}

$(function () {
    getPoliUtama();

    ion.sound({
        sounds: [
            { name: "intro" },
            { name: "nomorantrian" },
            { name: "satu" },
            { name: "dua" },
            { name: "tiga" },
            { name: "empat" },
            { name: "lima" },
            { name: "enam" },
            { name: "tujuh" },
            { name: "delapan" },
            { name: "sembilan" },
            { name: "sepuluh" },
            { name: "sebelas" },
            { name: "belas" },
            { name: "puluh" },
            { name: "seratus" },
            { name: "seribu" },
            { name: "ratus" },
            { name: "poli" },
            { name: "umum" },
            { name: "gigi" },
            { name: "kia" },
            { name: "batra" },
            { name: "lansia" },
            { name: "sanitasi" },
            { name: "psikologi" },
            { name: "farmasi" },
            { name: "loket" },
            { name: "laboratorium" },
            { name: "kasir" },
            { name: "gizi" },
            { name: "anak" },
            { name: "p2m" },
            { name: "hamil" },
            { name: "igd" },
            { name: "pkpr" },
            { name: "vct" },
            { name: "tumbuhkembang" },
            { name: "spesialisgigi" },
            { name: "mata" },
            { name: "paliatif" },
            { name: "paru" },
            { name: "ptrm" },
            { name: "std" },
        ],
        path: Settings.baseurl + '/sound/male/',
        preload: true,
        multiplay: false
    });

    // getPoliLain();
    setInterval(function () { getNomor() }, 5000);

    setInterval(function () { cekPanggilan() }, 1000);
});

