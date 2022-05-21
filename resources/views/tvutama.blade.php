@extends('layouts.tvbase')
@section('content')
<header class="content__title">
    <div class="row">
        <div class="col-md-5">
            <div class="navbar-wrapper" style="">
                <img src="{{asset('public/img/pemkot.png')}}" alt="Logo" style="height:100px; margin-bottom:30px;">
                <h3 class="navbar-brand" style="padding-top:30px;padding-left: 32px;" href="{{url('/')}}">Dinas Kesehatan Kota
                    Surabaya<br>
                    <label class="text-secondary" id="namaunitkerja">Puskesmas Asemrowo</label>
                </h3>
            </div>
        </div>
        <div class="col-md-7 d-flex justify-content-end align-items-center">
            <div class="btn-group-vertical">
                <button class="btn btn-outline-dark" style="font-size:20px;border:0;"><i class="zmdi zmdi-volume-up"></i></button>
                <button class="btn btn-outline-dark" style="font-size:20px;margin-bottom:25px;border:0;" data-toggle="modal" data-target="#menu" ><i class="zmdi zmdi-menu"></i></button>
            </div>
            <div class="widget-time bg-purple">
                <div class="time">
                    <span class="dateindo" style="font-size:15px;"></span>
                    <span class="time__hours" style="font-size:20px;">12</span>
                    <span class="time__min" style="font-size:20px;">46</span>
                    <span class="time__sec" style="font-size:20px;">14</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="row" style="flex:1;">
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body d-flex flex-column" id="waiting-pasien">
                <h4 class="card-title font-1c5rem" >Pasien Belum Datang</h4>
                <div class="font-large" style="flex: auto;display: block;height: 0;">
                    <div class="tr-mimic text-white bg-purple">
                        <h6 style="margin-bottom: 8px;" >Antrian</h6>
                        <h6 >Nama</h6>
                        <h6 >Keterangan</h6>
                    </div>
                    <div class="scrollbar-inner tbody-mimic height-full border-purple" id="pasien" style="overflow-y: scroll;" >
                    </div>
                </div>
                <!-- <table class="table table-antrian mb-0 table-block h-100" style="font-size: large;" id="pasien">
                    <thead class="bg-purple text-white">
                    <tr>
                        
                        
                        
                    </tr>
                    </thead>
                    <tbody style="height: calc(100% - 54px)">
                    </tbody>
                </table> -->
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title font-1c5rem" >Dokter Jaga</h4>
                <table class="table table-antrian mb-0" style="font-size: large;" id="dokter">
                    <thead class="bg-purple text-white">
                    <tr>
                        <th style="width: unset;">Nama Dokter</th>
                        <th style="width: 0%;">Poliklinik</th>
                        <th>Jam Pelayanan</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jsx')
<script>
    function setDokter(){
        let data = [['dr. Kemal', 'UMUM', '07:30 - 14:00'],
        ['dr. Budi', 'UMUM', '07:30 - 14:00'],
        ['dr. Paksi', 'UMUM', '07:30 - 14:00']]


        let htmlstr = ''
        for(let d of data){
            htmlstr += '<tr><td scope="row">'+d[0]+'</td>'+
                '<td>'+d[1]+'</td>'+
                '<td>'+d[2]+'</td></tr>';
        }

        $('#dokter tbody').html(htmlstr)
    }

    const allpasien = [
        ['27','Joanne Dominguez'],
        ['28','Conrad Baker'],
        ['29','Magdalena Casey'],
        ['30','Fionnuala Hicks'],
        ['31','Salim Rosales'],
        ['32','Cinar Beech'],
        ['33','Ayra Martin'],
        ['34','Elias Pearson'],
        ['35','Marian David'],
        ['36','Theodore Denton'],
        ['37','Jakob Walton'],
        ['38','Isma Allison'],
        ['39','Reagan Bernal'],
        ['40','Sanjay Beck'],
        ['41','Martyna Lord'],
        ['42','Anja Gray'],
        ['43','Daniele Arnold'],
        ['44','Zena Legge'],
        ['45','Jaye Chen'],
        ['46','Courteney Fulton'],
        ['47','Letitia Rahman'],
        ['48','Anya Black'],
        ['49','Matteo Mcdaniel'],
        ['50','Aayan Blackmore'],
        ['51','Stanley Appleton'],
        ['52','Antoinette Enriquez'],
        ['53','Jason Suarez'],
        ['54','Pola Mercado'],
        ['55','Iolo King'],
        ['56','Anisa Neal'],
        ['57','Rees Lacey'],
        ['58','Debra Keller'],
        ['59','Adriana Crowther'],
        ['60','Isaac Mccray'],
        ['61','Lily-May Shea'],
        ['62','Anand Partridge'],
        ['63','Maverick Raymond'],
        ['64','Ffion Lucero'],
        ['65','Kaiden Holloway'],
        ['66','Floyd Ball'],
        ['67','Manahil Crossley'],
        ['68','Oran Berger'],
        ['69','Eva-Rose Nolan'],
        ['70','Randy Roth'],
        ['71','India Caldwell'],
        ['72','Ilayda Crouch'],
        ['73','Olivia-Mae Best'],
        ['74','Chad Hoffman'],
        ['75','Lizzie Hogan'],
        ['76','Ellie Wheeler'],
    ]

    function setPasien(){

        let htmlstr = ''
        for (const pasien of allpasien) {
            htmlstr += '<div class="tr-mimic ">'+
                    '<p>'+pasien[0]+'</p>'+
                    '<p>'+pasien[1]+'</p>'+
                    '<p>-</p>'+
                '</div>';
        }

        $('#pasien').html(htmlstr)
    }

    $(function () {
        setDokter()
        setPasien()

        var $scrollcontainer = $($('#waiting-pasien .tbody-mimic')[1]);
        var allpasienElem = $scrollcontainer.find('.tr-mimic');
        var allpasienElem_length = allpasienElem.length;
        var lastbound = allpasienElem[allpasienElem_length-2].offsetTop - $scrollcontainer.innerHeight();

        var index=0;
        var interval = setInterval(function() { 
            let posY = allpasienElem[index].offsetTop;
            $scrollcontainer.scrollTop(posY)
            if(index < allpasienElem_length-1 ||  posY < lastbound) index++;
            else index=0;
        }, 1000);

    });
</script>
@endsection