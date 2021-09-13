<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title') - DSD</title>

<!-- Fontfaces CSS-->
<link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
{{-- <link rel="stylesheet" href="//cdn.materialdesignicons.com/3.2.89/css/materialdesignicons.min.css"> --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

<!-- Bootstrap CSS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Vendor CSS-->
<link href="{{ asset('vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
<link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">

<style>
.pace { -webkit-pointer-events: none; pointer-events: none; -webkit-user-select: none; -moz-user-select: none; user-select:
none; } .pace-inactive { display: none; } .pace .pace-progress { background: #29d; position: fixed; z-index: 2000; top: 0;
right: 100%; width: 100%; height: 2px; } .pace .pace-progress-inner { display: block; position: absolute; right: 0px; width:
100px; height: 100%; box-shadow: 0 0 10px #29d, 0 0 5px #29d; opacity: 1.0; -webkit-transform: rotate(3deg) translate(0px,
-4px); -moz-transform: rotate(3deg) translate(0px, -4px); -ms-transform: rotate(3deg) translate(0px, -4px); -o-transform:
rotate(3deg) translate(0px, -4px); transform: rotate(3deg) translate(0px, -4px); } .pace .pace-activity { display: block;
position: fixed; z-index: 2000; top: 15px; right: 15px; width: 14px; height: 14px; border: solid 2px transparent; border-top-color:
#29d; border-left-color: #29d; border-radius: 10px; -webkit-animation: pace-spinner 400ms linear infinite; -moz-animation:
pace-spinner 400ms linear infinite; -ms-animation: pace-spinner 400ms linear infinite; -o-animation: pace-spinner 400ms linear
infinite; animation: pace-spinner 400ms linear infinite; } @-webkit-keyframes pace-spinner { 0% { -webkit-transform: rotate(0deg);
transform: rotate(0deg); } 100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); } } @-moz-keyframes pace-spinner
{ 0% { -moz-transform: rotate(0deg); transform: rotate(0deg); } 100% { -moz-transform: rotate(360deg); transform: rotate(360deg);
} } @-o-keyframes pace-spinner { 0% { -o-transform: rotate(0deg); transform: rotate(0deg); } 100% { -o-transform: rotate(360deg);
transform: rotate(360deg); } } @-ms-keyframes pace-spinner { 0% { -ms-transform: rotate(0deg); transform: rotate(0deg); }
100% { -ms-transform: rotate(360deg); transform: rotate(360deg); } } @keyframes pace-spinner { 0% { transform: rotate(0deg);
transform: rotate(0deg); } 100% { transform: rotate(360deg); transform: rotate(360deg); } }
</style>

<script src="{{ asset('js/pace.js') }}"></script>
