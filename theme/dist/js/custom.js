function date_indo($elem) {
    date = new Date;
    year = date.getFullYear();
    month = date.getMonth();
    months = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    d = date.getDate();
    day = date.getDay();
    days = new Array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
    result = ''+days[day]+' '+d+' '+months[month]+' '+year;
    $elem.text(result);
}

function initSmoothScrolling(container,animationname){
    /*
    * @param {String} container Class or ID of the animation container
    * @param {String} animation Name of the animation, e.g. smoothscroll
    */
    var animationWidth = 0;	
    var slidesNumber = 0
    $('>div>div', container).each(function(){				
        animationWidth += $(this).outerWidth(false);	
        slidesNumber+=1;	
    });
    
    // detect number of visible slides
    var slidesVisible = $(container).width() / $('>div>div:first-of-type',container).outerWidth(false);	
    slidesVisible = Math.round(slidesVisible);

    if(slidesVisible >= slidesNumber ) return;

    // count slides to determine animation speed
    // var slidesNumber = $('>div>div', container).length;
    var speed = slidesNumber*7;
    
    // append the tail	
    $('>div>div',container).slice(0,slidesVisible+1).clone().appendTo($('>div',container));	

    //animation style
    var animation = `@keyframes ${animationname} { 
        0% { margin-left: 0px; } 
        100% { margin-left: -${animationWidth}px; } 
    } 
    ${container}{ 
        -webkit-animation: ${animationname} ${speed}s linear infinite; 
        -moz-animation: ${animationname} ${speed}s linear infinite; 
        -ms-animation: ${animationname} ${speed}s linear infinite; 
        -o-animation: ${animationname} ${speed}s linear infinite; 
        animation: ${animationname} ${speed}s linear infinite; 
    }`;
    
    // Insert styles to html
    $("<style type='text/css'>"+animation+"</style>").appendTo("head");	

    // // restart the animation (e.g. for safari & ie)	
    // var cl = $(container).attr("class");
    // $(container).removeClass(cl).animate({'nothing':null}, 1, function () {
    //     $(this).addClass(cl);
    // });
}

function createQRCode(nik, idcontainer = "qrcode"){
    const qrconfig={
        text: nik,
        width: 240,
        height: 240,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.M,
    }
    idcontainer
    document.getElementById("qrcode_nik").innerText = nik
    const container = document.getElementById(idcontainer)
    container.innerHTML = ''
    new QRCode(container, qrconfig)
}

$(document).ready(function () {
    if($('.dateindo')[0]){
        date_indo( $('.dateindo') );
    }

    /*------------------------------------------------
        Clock
    -------------------------------------------------*/
    if($('.time')[0]) {
        var newDate = new Date();
        newDate.setDate(newDate.getDate());

        setInterval( function() {
            var seconds = new Date().getSeconds();
            $('.time__sec').html(( seconds < 10 ? '0' : '' ) + seconds);
        },1000);

        setInterval( function() {
            var minutes = new Date().getMinutes();
            $('.time__min').html(( minutes < 10 ? '0' : '' ) + minutes);
        },1000);

        setInterval( function() {
            var hours = new Date().getHours();
            $('.time__hours').html(( hours < 10 ? '0' : '' ) + hours);
        }, 1000);
    }
});