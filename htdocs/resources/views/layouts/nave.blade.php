<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="{{ asset('assets/img/navbar-logo.svg') }}" alt="" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                @if(($showServices ?? 'true') == 'true')
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#services">Services</a></li>
                @endif
                @if(($showPortfolio ?? 'true') == 'true')
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">{{$nomePortfolio ?? 'Portfolio'}}</a></li>
                @endif
                @if(($showSobre ?? 'true') == 'true')
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
                @endif
                @if(($showTime ?? 'true') == 'true')
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#team">Team</a></li>
                @endif
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Panel</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">{{ Auth::user()->name }}</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('controle.logout') }}</a></li>
                        <form id="logout-form" action="{{route('logout')}}" method="post" style="display:none">
                            @csrf
                        </form>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('login') }}">{{__('controle.login')}}</a></li>
                        @if (Route::has('register'))
                            <li class="nav-item"><a class="nav-link" href="{{ url('register') }}">@lang('controle.register')</a></li>
                        @endif
                    @endauth
                @endif
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('lang')}}">@lang('controle.lang')</a></li>
                @if(($showContato ?? 'true') == 'true')
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contact</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
