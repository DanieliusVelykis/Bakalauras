<div class="header">
            <div class="navBar">
                <ul>
                    <li><div class="navItem"><a href="/">PASLAUGOS</a></div></li>
                    <li><div class="navItem"><a href="/about">APIE</a></div> </li>
                    <li><div class="navItem login"><a href="/feedback">ATSILIEPIMAI</a></div> </li>
                    @auth
                    @if(auth()->check() && auth()->user()->role=="Fotografas")
                    <li><div class="navItem login"><a href="{{route('users')}}">VARTOTOJAI</a></div> </li>
                    <li><div class="navItem login"><a href="/upcoming-events">BŪSIMI VIZITAI</a></div> </li>
                    <li><div class="navItem login"><a href="/done-events">ATLIKTI DARBAI</a></div> </li>
                    <li><div class="navItem login"><a href="/worker-services">PAP. PASLAUGOS</a></div> </li>
                    @endif
                    @if(auth()->check() && auth()->user()->role=="Vartotojas")
                    <li><div class="navItem login"><a href="/done-events-specific/{{ auth()->user()->id }}">MANO VIZITAI</a></div> </li>
                    @endif
                    @if(auth()->check() && auth()->user()->role=="Darbuotojas")
                    <li><div class="navItem login"><a href="/worker-services">PAP. PASLAUGOS</a></div> </li>
                    <li><div class="navItem login"><a href="/upcoming-events">BŪSIMI VIZITAI</a></div> </li>
                    <li><div class="navItem login"><a href="/done-events">ATLIKTI DARBAI</a></div> </li>
                    @endif
                    <li><div class="navItem login"><a href="{{route('logout')}}">ATSIJUNGTI</a></div> </li>
                    @else
                    <li><div class="navItem login"><a href="/login">PRISIJUNGTI</a></div> </li>
                    <li><div class="navItem register"><a href="/registration">REGISTRUOTIS</a></div> </li>
                    @endauth
                </ul>
            </div>
            @auth
                    <div class="navItem loggedInfo"><a href="{{route('logout')}}">@auth{{auth()->user()->name}}@endauth</a></div>
            @endauth
        </div>