<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.admin.head')
</head>
<body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
    <div id="app" class="wrapper">
        @include('layouts.admin.sidebar')

        <div class="content-page">
            <div class="content">
                @include('layouts.admin.nave')
                @yield('content')
                @include('layouts.admin.footer')
            </div>
        </div>
        @include('layouts.admin.otherbar')
    </div>
</body>
</html>
