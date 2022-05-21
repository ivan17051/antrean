<aside class="sidebar">
    <div class="scrollbar-inner">

        <ul class="navigation">
            <li class="navigation__active"><a href="{{url('/home')}}"><i class="zmdi zmdi-home"></i> Beranda</a></li>
            @if(Auth::user()->idpasien)
            <li><a href="{{url('/daftar')}}"><i class="zmdi zmdi-calendar"></i> Pendaftaran (Pasien)</a></li>
            @elseif(Auth::user()->idunitkerja)
            <li class="navigation__sub">
                <a href=""><i class="zmdi zmdi-collection-text"></i> Pendaftaran (Faskes)</a>

                <ul>
                    <li><a href="{{url('/daftaronsite')}}">On Site</a></li>
                    <li><a href="{{url('/daftarbarcode')}}">Barcode</a></li>
                </ul>
            </li>

            <li><a href="{{url('/resume')}}"><i class="zmdi zmdi-calendar"></i> Resume Medis</a></li>

            <li class="navigation__sub">
                <a href=""><i class="zmdi zmdi-settings"></i> Pengaturan</a>

                <ul>
                    <li><a href="{{url('/nakes')}}">Nakes</a></li>
                    <li><a href="{{url('/poli')}}">Poli</a></li>
                </ul>
            </li>

            <li class="navigation__sub">
                <a href=""><i class="zmdi zmdi-tv"></i> TV</a>

                <ul>
                    <li><a href="{{url('/tvutama')}}">TV Utama</a></li>
                    <li><a href="{{url('/admintvpoli')}}">Admin TV Poli</a></li>
                    <li><a href="{{url('/tv')}}">TV Non Panggilan</a></li>
                    <li><a href="{{url('/tvpoli')}}">TV Poli</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</aside>