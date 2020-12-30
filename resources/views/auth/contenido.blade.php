<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Login_v3/images/icons/favicon.ico"/>
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/animate/animate.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/select2/select2.min.css">
    <!--===============================================================================================-->	
        <link rel="stylesheet" type="text/css" href="Login_v3/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="Login_v3/css/util.css">
        <link rel="stylesheet" type="text/css" href="Login_v3/css/main.css">
        <link rel="stylesheet" href="css/template.css">
    <!--===============================================================================================-->
</head>
<body>
    <div id="app">
            @yield('login')
    </div>
    <!--===============================================================================================-->
	<script src="Login_v3/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/vendor/bootstrap/js/popper.js"></script>
        <script src="Login_v3/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/vendor/daterangepicker/moment.min.js"></script>
        <script src="Login_v3/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
        <script src="Login_v3/js/main.js"></script>
</body>
</html>

