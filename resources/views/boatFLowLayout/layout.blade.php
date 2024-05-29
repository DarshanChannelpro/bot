<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <title>{{ config('app.name','WhatsappCloud Api') }}</title> -->
        <title>ChatBoat | Whatsapp business automation</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('custom/css/boatFlowStyle.css') }}" rel="stylesheet">
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.css'>
        <script src='https://cdn.jsdelivr.net/gh/jerosoler/Drawflow/dist/drawflow.min.js'></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @yield('head')
    
        <!-- RTL and Commmon ( Phone ) -->
        @include('layouts.rtl')

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon _1.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon _1.png">
        <!-- Custom CSS defined by admin -->
        <link type="text/css" href="{{ asset('byadmin') }}/front.css" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
      <body>
         {{-- @include('header.botflow') --}}
         @yield('content')
        </section>
        {{-- @include('wpbox::landing.partials.footer') --}}
    </body>
</html>