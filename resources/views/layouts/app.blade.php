<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="APP GESTION DES TICKETS DE TRANSPORT" name="description"/>
        <meta content="AJS" name="author"/>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">  

        <!-- vendor css -->
        <link href="{{ asset('lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet"/>
        <link href="{{ asset('lib/typicons.font/typicons.css') }}" rel="stylesheet"/>
        

        <!-- azia CSS -->
        <link href="{{ asset('css/azia.css') }}" rel="stylesheet"/>
        @stack('links')
        <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
        <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    </head>
    <body class="az-body az-dashboard-eight">
        <x-app-header></x-app-header>
        <x-app-navbar></x-app-navbar>
        
        {{ $slot }}

        <x-app-footer></x-app-footer>

        <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('lib/ionicons/ionicons.js') }}"></script>
    
        @stack('scripts')
    </body>
</html>
