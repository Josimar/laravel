<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body id="page-top">
    @php
        $showServices = ($showServices ?? 'false');
        $showPortfolio = ($showPortfolio ?? 'false');
        $showSobre = ($showSobre ?? 'false');
        $showTime = ($showTime ?? 'false');
        $showClientes = ($showClientes ?? 'false');
        $showContato = ($showContato ?? 'false');
    @endphp

    @if(($showNave ?? 'true') == 'true')
        @include('layouts.nave')
    @endif
    @if(($showMasterhead ?? 'true') == 'true')
        @include('layouts.masterhead')
    @endif

    @yield('content')

    @if(($showServices ?? 'false') == 'true')
        @include('layouts.services')
    @endif
    @if(($showPortfolio ?? 'false') == 'true')
        @include('layouts.portfolio')
    @endif
    @if(($showSobre ?? 'false') == 'true')
        @include('layouts.sobre')
    @endif
    @if(($showTime ?? 'false') == 'true')
        @include('layouts.time')
    @endif
    @if(($showClientes ?? 'false') == 'true')
        @include('layouts.clientes')
    @endif
    @if(($showContato ?? 'false') == 'true')
        @include('layouts.contato')
    @endif
    @if(($showModal ?? 'false') == 'true')
        @include('layouts.modal')
    @endif
    @include('layouts.footer')
</body>
</html>
