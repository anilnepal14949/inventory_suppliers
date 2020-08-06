<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Accounting System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Simple Accounting software with stock and purchase information and ledger generation.">
    <meta name="author" content="Anil Nepal">

    <!-- The styles -->
	<link id="bs-css" href="{{asset('public/css/bootstrap-slate.min.css')}}" rel="stylesheet">
    <link id="bs-css" href="{{asset('public/css/bootstrap-cerulean.min.css')}}" rel="stylesheet">

    <link href="{{ asset('public/css/charisma-app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/bower_components/fullcalendar/dist/fullcalendar.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/bower_components/fullcalendar/dist/fullcalendar.print.css') }}" rel='stylesheet' media='print'>
    <link href="{{ asset('public/bower_components/chosen/chosen.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/bower_components/colorbox/example3/colorbox.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/bower_components/responsive-tables/responsive-tables.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/jquery.noty.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/noty_theme_default.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/elfinder.min.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/elfinder.theme.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/jquery.iphone.toggle.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/uploadify.css') }}" rel='stylesheet'>
    <link href="{{ asset('public/css/animate.min.css') }}" rel='stylesheet'>

    <!-- jQuery -->
    <script src="{{asset('public/bower_components/jquery/jquery.min.js')}}"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}">

</head>

<body>
	@yield('mainContent')

<!-- external javascript -->

<script src="{{asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- library for cookie management -->
<script src="{{asset('public/js/jquery.cookie.js')}}"></script>
<!-- calender plugin -->
<script src="{{asset('public/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('public/bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<!-- data table plugin -->
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>

<!-- select or dropdown enhancer -->
<script src="{{asset('public/bower_components/chosen/chosen.jquery.min.js')}}"></script>
<!-- plugin for gallery image view -->
<script src="{{asset('public/bower_components/colorbox/jquery.colorbox-min.js')}}"></script>
<!-- notification plugin -->
<script src="{{asset('public/js/jquery.noty.js')}}"></script>
<!-- library for making tables responsive -->
<script src="{{asset('public/bower_components/responsive-tables/responsive-tables.js')}}"></script>
<!-- tour plugin -->
<script src="{{asset('public/bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js')}}"></script>
<!-- star rating plugin -->
<script src="{{asset('public/js/jquery.raty.min.js')}}"></script>
<!-- for iOS style toggle switch -->
<script src="{{asset('public/js/jquery.iphone.toggle.js')}}"></script>
<!-- autogrowing textarea plugin -->
<script src="{{asset('public/js/jquery.autogrow-textarea.js')}}"></script>
<!-- multiple file upload plugin -->
<script src="{{asset('public/js/jquery.uploadify-3.1.min.js')}}"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="{{asset('public/js/jquery.history.js')}}"></script>
<!-- application script for Charisma demo -->
<script src="{{asset('public/js/charisma.js')}}"></script>


</body>
</html>
