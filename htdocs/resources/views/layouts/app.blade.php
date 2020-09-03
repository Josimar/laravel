<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="hold-transition sidebar-mini">
    <div id="app" class="wrapper">
        @include('layouts.nave')
        
        @include('layouts.sidebar')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
