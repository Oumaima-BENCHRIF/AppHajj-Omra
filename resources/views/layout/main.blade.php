@extends('../layout/base')

@section('body')
    <body class="py-5">
        @yield('content')
        @include('../layout/components/dark-mode-switcher')
        @include('../layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        @vite('resources/js/app.js')
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection
