<!DOCTYPE html>
<!--
* @version v2.0.1
* @link https://alsyedstore.com
* Copyright (c) 2020 
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Al-Syed POS">
    <meta name="author" content="Saad">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Al-Syed POS</title>
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('assets/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('assets/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('assets/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('assets/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('assets/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('assets/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('../assets/favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('assets/favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/flag-icon.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"> <!-- icons -->
    <link href="{{ asset('css/simple-line-icons.min.css') }}" rel="stylesheet"> <!-- icons -->
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
    <link href="{{ asset('css/jquery-ui.css') }}" rel = "stylesheet">
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/mydatatables.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/dataTables.bootstrap.min.css') }}" rel="stylesheet"> --}}
    <!-- Main styles for this application-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
    {{-- <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script> --}}

    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
    {{-- <style>
      @font-face {
        font-family: 'DIGITAL';
        src: url('https://cssdeck.com/uploads/resources/fonts/digii/DS-DIGII.TTF');
      }

      html {
        height: 100%;
        background: radial-gradient(#000, #555);
      }

      .digital-clock {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 200px;
        height: 60px;
        color: #ffffff;
        border: 2px solid #999;
        border-radius: 4px;
        text-align: center;
        font: 50px/60px 'DIGITAL', Helvetica;
        background: linear-gradient(90deg, #000, #555);
      }

    </style> --}}
    
  </head>



  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-md" id="sidebar">

      @include('dashboard.shared.nav-builder')

      @include('dashboard.shared.header')

      <div class="c-body">
        <main class="c-main-pos">

          @yield('content') 

        </main>
        {{-- @include('dashboard.shared.footer') --}}
      </div>
    </div>



    <!-- CoreUI and necessary plugins-->
    {{-- <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script> --}}
    <script src="{{ asset('js/coreui.bundle.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
    <script src="{{ asset('js/select2.js') }}"></script>

    {{-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script> --}}
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.2/handlebars.js"></script> --}}
    <script src="{{ asset('js/mydatatables.js') }}"></script>

    <script>
      $(document).ready(function() {
        clockUpdate();
        setInterval(clockUpdate, 1000);
      })

      function clockUpdate() {
        var date = new Date();
        $('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});
        function addZero(x) {
          if (x < 10) {
            return x = '0' + x;
          } else {
            return x;
          }
        }

        function twelveHour(x) {
          if (x > 12) {
            return x = x - 12;
          } else if (x == 0) {
            return x = 12;
          } else {
            return x;
          }
        }

        var h = addZero(twelveHour(date.getHours()));
        var m = addZero(date.getMinutes());
        var s = addZero(date.getSeconds());

        $('.digital-clock').text(h + ':' + m + ':' + s)
      }
    </script>
    @yield('javascript')
  </body>
</html>
