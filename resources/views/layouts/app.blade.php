<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .pointer {cursor: pointer;}
        
        /* Firefox */
        input[type=number] {
            -moz-appearance:textfield;
        }
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url("{{ asset('/images/3.gif')}}") 50% 50% no-repeat rgb(249,249,249) ;
            opacity: .8;
            background-size:120px 120px;
        }
        @media (min-width: 768px) {
            .modal-xl {
                width: 100%;
                max-width:1700px;
            }
        }
        body {
            background-image: url("{{ asset('login_css/images/bg.png')}}");
            background-size: cover!important;
            background-position: center!important;
            min-height: 100vh!important;
        }
    </style>
    	<link rel="stylesheet" href="{{ asset('login_css/css/style.css') }}">
</head>
<body>
    <div id = "myDiv" style="display:none;" class="loader">
    </div>
    <div id="app">
      
        <main class="py-4">
            @yield('content')
        </main>
    </div>
      <script type='text/javascript'>
        function show()
        {
            document.getElementById("myDiv").style.display="block";
        }
      </script>

      <script src="{{ asset('js/all-1.0.0.js') }}"></script>

      <script src="{{ asset('login_css/js/jquery.min.js') }}"></script>
	  <script src="{{ asset('login_css/js/popper.js') }}"></script>
	  <script src="{{ asset('login_css/js/bootstrap.min.js') }}"></script>
	  <script src="{{ asset('login_css/js/main.js') }}"></script>
</body>
</html>
