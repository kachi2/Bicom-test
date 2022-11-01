<!DOCTYPE html>
<html lang="zxx" class="js">
<head>
    <meta charset="utf-8">
    <meta name="author" content="">
    <meta name="viewport" content="">
    <meta name="keywords" content="">
    <meta name="description" content=".">
 <!-- Fav Icon  -->
    <link rel="shortcut icon" href="/fav.png">
    <!-- Page Title  -->
    <title> {{config('app.name')}}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{asset('/asset/css/dashlite.css?ver=2.2.0 ')}}">
    <link id="skin-default" rel="stylesheet" href="{{asset('/assets/css/theme.css?ver=2.2.0 ')}}">
</head>
@include('partials.navbar')
@include('partials.sidebar')
@yield('content')
 <script src="{{asset('/asset/js/bundle.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/scripts.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/charts/chart-crypto.js?ver=2.2.0')}}"></script>
     <script src="{{asset('/asset/js/charts/gd-default.js?ver=2.2.0')}}"></script>
    <script src="{{asset('/asset/js/charts/gd-analytics.js?ver=2.2.0 ')}}"></script>
    <script src="{{asset('/asset/js/libs/jqvmap.js?ver=2.2.0 ')}}"></script>
    @yield('scripts')
    
</body>

</html>