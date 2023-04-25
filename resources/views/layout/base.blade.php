<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}{{ $color_scheme != 'default' ? ' ' . $color_scheme : '' }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('build/assets/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <link href="https://unpkg.com/tabulator-tables@4.8.1/dist/css/tabulator.min.css" rel="stylesheet">


    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@4.8.1/dist/js/tabulator.min.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('jquery.arabicKeyboard.css') }}"> -->
    <!-- <script type="text/javascript" src="{{ asset('jquery.arabicKeyboard.js') }}"></script> -->
    <link rel="stylesheet" type="text/css" href="http://www.arabic-keyboard.org/keyboard/keyboard.css">
    <script type="text/javascript" src="http://www.arabic-keyboard.org/keyboard/keyboard.js" charset="UTF-8"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js_scan/mrz-worker.bundle-min-wrapped.js') }}"></script>
    <script src="{{ asset('js_scan/demo.bundle-min.js') }}"></script>

    @yield('head')

    <!-- BEGIN: CSS Assets-->
    @vite('resources/css/app.css')
    <!-- END: CSS Assets-->


</head>
<!-- END: Head -->

@yield('body')
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js"></script>
@yield('jqscripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--These jQuery libraries for
    chosen need to be included-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.min.css" />
<!--These jQuery libraries for select2
        need to be included-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"> </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" />


<script src="https://cdn.jsdelivr.net/npm/virtual-keyboard/dist/js/jquery.keyboard.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/virtual-keyboard/dist/css/keyboard.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    jQuery(document).ready(function() {
        //Select2
        jQuery(".country").select2({

        });
        //Chosen
        jQuery(".country1").chosen({
            max_selected_options: 2,
        });
    });
</script>

</html>