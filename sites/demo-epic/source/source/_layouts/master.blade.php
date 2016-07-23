<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">

        <!-- build:css(build_local) css/vendor.css -->
        <!-- bower:css -->
        <link rel="stylesheet" href="/bower_components/formValidation/dist/css/formValidation.min.css" />
        <!-- endbower -->
        <!-- endbuild -->

        <!-- build:css(build_local) css/main.css -->
        <link rel="stylesheet" href="/css/main.css">
        <!-- endbuild -->

        <!-- build:js(build_local) js/vendor/modernizr.js -->

        <!-- endbuild -->

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        @include('_layouts.navigation')
        @include('_layouts.header')
        @yield('body')
        @include('_layouts.footer')

    <!-- build:js(build_local) js/vendor.js -->
    <!-- bower:js -->
    <script src="/bower_components/modernizr/modernizr.js"></script>
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/formValidation/dist/js/formValidation.min.js"></script>
    <script src="/bower_components/formValidation/dist/js/framework/bootstrap.min.js"></script>
    <script src="/bower_components/formValidation/dist/js/framework/foundation.min.js"></script>
    <script src="/bower_components/formValidation/dist/js/framework/pure.min.js"></script>
    <script src="/bower_components/formValidation/dist/js/framework/semantic.min.js"></script>
    <script src="/bower_components/formValidation/dist/js/framework/uikit.min.js"></script>
    <script src="/bower_components/jquery.easing/js/jquery.easing.js"></script>
    <script src="/bower_components/scrollup/dist/jquery.scrollUp.min.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js(build_local) js/main.js -->
        <script type="text/javascript" src="/js/form.js"></script>
        <script type="text/javascript" src="/js/main.js"></script>
    <!-- endbuild -->
    </body>
</html>
