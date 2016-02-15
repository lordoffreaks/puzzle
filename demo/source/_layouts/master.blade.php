<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <!-- build:css(build_local) css/vendor.css -->
        <!-- bower:css -->

        <!-- endbower -->
        <!-- endbuild -->

        <!-- build:css(build_local) css/main.css -->
        <link rel="stylesheet" href="/css/main.css">
        <!-- endbuild -->

        <!-- build:js(build_local) js/vendor/modernizr.js -->

        <!-- endbuild -->
    </head>
    <body>
        @include('_layouts.header')
        @yield('body')

    <!-- build:js(build_local) js/vendor.js -->
    <!-- bower:js -->

    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js(build_local) js/main.js -->
        <script type="text/javascript" src="/js/main.js"></script>
    <!-- endbuild -->
    </body>
</html>
