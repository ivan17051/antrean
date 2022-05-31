var iscall = 0;
var timeout = 0;

//panggilansuara
function cekPanggilan(poli){
    // console.log(suaraaktif);
    if (iscall == 0 && suaraaktif == 1) {
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: Settings.baseurl+'/getpanggilanantrian',
            type: 'GET',
            data: {poli: poli},
            dataType: 'json',
            success: function(respon){
                if(respon.data){
                    noantrian = respon.data.noantrian;
                    idbppoli = respon.data.idbppoli;
                    namapoli = respon.data.namapoli;
                    $("#panggilannomor").html(noantrian);
                    $("#panggilanpoli").html("POLI "+namapoli);
                    var idpanggilan = respon.data.id;
                    sound(noantrian, idbppoli);
                    salert(namapoli,noantrian);
                    setTimeout(cekPanggilan, 8000, poli);
                    setTimeout(function(){deletePanggilan(idpanggilan)}, 500);
                } else {
                    setTimeout(cekPanggilan, 2000, poli);
                    // console.log('kosong');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                toast("error", textStatus);
                setTimeout(cekPanggilan, 2000, poli);
            },
            complete:function(data){
               // setTimeout(cekPanggilan, 6000);
            }
        }).fail(function (jqXHR, textStatus, error) {
            // Handle error here
            toast("error", textStatus);
            setTimeout(cekPanggilan, 2000, poli);
        });
    }
}

function deletePanggilan(id){
    $.get(Settings.baseurl+'/deletepanggilanantrian/'+id, {}, function(responsedata){});
}

function sound(number,idbppoli){
    timeout = 0;
    iscall = 1;
    var npoli = "intro";
    switch(parseInt(idbppoli)){
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
        case 48:
            npoli = "hamil";
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
        case 0:
            npoli = "loket";
            break;
    }
    // console.log(npoli);
    playsound("intro");
    //setTimeout(function(){playsound("poli")}, timeout+=800);
    setTimeout(function(){playsound("poli")}, timeout+=4800);
    setTimeout(function(){playsound(npoli)}, timeout+=1000);
    setTimeout(function(){playsound("nomorantrian")}, timeout+=1700);
    suaranomor(number,timeout);
    
    setTimeout(function(){iscall = 0;}, 5000); 
}

function suaranomor(number,timeout){
    var arr_number = [
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
        "sebelas"
    ];

    if(number<12){
        setTimeout(function(){
            playsound(arr_number[number])
        }, timeout+=1500);
    } else if(number<20){
        number=(number-10);
        setTimeout(function(){ playsound(arr_number[number])}, timeout+=1500);
        setTimeout(function(){ playsound("belas")}, timeout+=1000);
    } else if(number<100){
        number1=parseInt(number/10);
        setTimeout(function(){ playsound(arr_number[number1])}, timeout+=1500);
        setTimeout(function(){ playsound("puluh")}, timeout+=1000);
        number2=number%10;
        setTimeout(function(){ playsound(arr_number[number2])}, timeout+=800);
    } else if(number<200){
        setTimeout(function(){ playsound("seratus")}, timeout+=1500);
        number=number-100;
        suaranomor(number,timeout);
    } else if(number<1000){
        numberratus=parseInt(number/100);
        if((number%100)<=0){
            setTimeout(function(){ playsound(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ playsound("ratus")}, timeout+=500);
        } else if((number%100)<12){
            setTimeout(function(){ playsound(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ playsound("ratus")}, timeout+=500);
            setTimeout(function(){ playsound(arr_number[number%100])}, timeout+=500);
        } else if((number%100)<20){
            number=((number%100)-10);
            setTimeout(function(){ playsound(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ playsound("ratus")}, timeout+=500);
            setTimeout(function(){ playsound(arr_number[number])}, timeout+=500);
            setTimeout(function(){ playsound("belas")}, timeout+=500);
        } else if((number%100)<100){
            number1=parseInt((number%100)/10);
            setTimeout(function(){ playsound(arr_number[numberratus])}, timeout+=1000);
            setTimeout(function(){ playsound("ratus")}, timeout+=700);
            setTimeout(function(){ playsound(arr_number[number1])}, timeout+=700);
            setTimeout(function(){ playsound("puluh")}, timeout+=500);
            number2=(number%100)%10;
            setTimeout(function(){ playsound(arr_number[number2])}, timeout+=500);
        }
    } else if(number<2000){
        setTimeout(function(){ playsound("seribu")}, timeout+=1000);
        number=number-1000;
        suaranomor(number,timeout);
    } else {
        setTimeout(function(){ playsound("selanjutnya")}, timeout+=1000);
    }
    // alert(number);
}

var currentSound = {};

function playsound(audiourl){
    currentSound = document.createElement('audio');
    if (currentSound.canPlayType){
        currentSound.setAttribute('src', Settings.url+'/sound/male/low/'+audiourl+'.mp3');
        currentSound.setAttribute('type', 'audio/mpeg');
        currentSound.load();
        currentSound.addEventListener('ended', function() {
            // this.play();
        }, false);
        // currentSound.pause();
        // currentSound.currentTime=0;
        currentSound.play();
        // return currentSound;
    }
}

function salert(namapoli, noantrian){
    var el = document.createElement('div');
    el.setAttribute('class', 'boxnomorpanggilan');
    
    var pn = document.createElement('div'),
    tn = document.createTextNode(noantrian);
    pn.setAttribute('id', 'panggilannomor');
    pn.appendChild(tn);

    var pp = document.createElement('div'),
    tp = document.createTextNode('Poli '+namapoli);
    pp.setAttribute('id', 'panggilanpoli');
    pp.appendChild(tp);

    el.appendChild(pn);
    el.appendChild(pp);

    swal({
        // title: "POLI "+namapoli,
        content: {
            element: el,
        },
        button: false,
        timer: 10000,
        background: '#333',
    });
}