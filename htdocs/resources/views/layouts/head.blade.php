<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured can be used to build CRM, CMS, etc" name="description" />
<meta content="Josimar Silva" name="author" />
<link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">

<title>{{ config('app.name', 'Controle') }}</title>

<link href="{{ asset('css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet">

<!-- Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
<link href="{{ asset('css/icons.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/app-dark.min.css') }}" rel="stylesheet">
