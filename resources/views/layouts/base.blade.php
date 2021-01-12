<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="keywords" content="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-signin-client_id" content="223987454895-f8bpnb8hcn1t372b71grkhg5t0qbrf95.apps.googleusercontent.com">
    <meta name="description" content="#">
    @yield('title')
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
    <link rel="apple-touch-icon-precomposed" href="#">
    <link rel="icon" href="{{asset('public/img/favicon23.png')}}" sizes="16x16 32x32" type="image/png">
    {{-- <link rel="shortcut icon" href="#"> --}}
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link href="{{ asset('css/app.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/owl.theme.green.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/simplePagination.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css"/>


    @stack('styles')
    <!-- place -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY&callback=initAutocomplete&libraries=places&v=weekly"
      defer
    ></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{asset('public/footer/css/theme-1.css')}}">
<style> 
 .buttons{
   width: 100px;
   height: 30px;
color: white;
background-color: #FF1493;
border: 1px solid #FF1493;
 }
 .fa-fw {
  color: black;
}
</style>
</head>

<body >
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0" nonce="xr8tfU4w"></script>
@yield('body')

@stack('modals')
<!-- footer -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.42&key=AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY&libraries=geometry,places"></script>
<script src="{{asset('js/jquery-1.12.4.min.js')}}"></script>
<script src="{{ asset('js/app.bundle.js') }}"></script>
<script src="{{ asset('public/js/pagination.js') }}"></script>
<script>
  var startTime='';
  var endTime='';  
</script>
@stack('scripts')
</body>
</html>