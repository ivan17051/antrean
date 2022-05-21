<aside class="sidebar">
    <div class="scrollbar-inner">
        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="public/demo/img/profile-pics/8.jpg" alt="">
                <div>
                    <div class="user__name">{{Auth::user()->username}}</div>
                    <div class="user__email">{{Auth::user()->email}}</div>
                </div>
            </div>

            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}">View Profile</a>
                <a class="dropdown-item" href="">Settings</a>
                
                <button class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

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