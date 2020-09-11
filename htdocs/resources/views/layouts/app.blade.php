<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div id="app" class="wrapper">
        @include('layouts.sidebar')

        <div class="content-page">
            <div class="content">
                @include('layouts.nave')
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
        @include('layouts.otherbar')
    </div>
</body>
</html>
