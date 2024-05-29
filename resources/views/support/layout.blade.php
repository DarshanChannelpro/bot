<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <title>{{ config('app.name','WhatsappCloud Api') }}</title> -->
        <title>ChatBoat | whatsapp business automation</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
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
      <body>
        @include('header.common')
         @yield('content')
        {{-- <section class="relative  mx-auto w-full max-w-7xl text-gray-900">
            
        @include('privacy-policy.container.termAndCondtion') --}}
        </section>
        @include('wpbox::landing.partials.footer')
    </body>
</html>