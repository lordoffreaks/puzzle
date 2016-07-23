<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <title>Epic</title>

        <!-- build:css(build_local) css/vendor.css -->
        <!-- bower:css -->
        <link rel='stylesheet' href='/bower_components/formValidation/dist/css/formValidation.min.css' />
        <!-- endbower -->
        <!-- endbuild -->

        <!-- build:css(build_local) css/main.css -->
        <link rel="stylesheet" href="/css/main.css">
        <!-- endbuild -->

        <!-- build:js(build_local) js/vendor/modernizr.js -->

        <!-- endbuild -->

        <!-- Google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

        <!-- IE Fix for HTML5 Tags -->
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
        @yield('body')

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
    <script src="/bower_components/what-input/what-input.js"></script>
    <script src="/bower_components/get-size/get-size.js"></script>
    <script src="/bower_components/ev-emitter/ev-emitter.js"></script>
    <script src="/bower_components/desandro-matches-selector/matches-selector.js"></script>
    <script src="/bower_components/fizzy-ui-utils/utils.js"></script>
    <script src="/bower_components/outlayer/outlayer.js"></script>
    <script src="/bower_components/masonry/masonry.js"></script>
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:js(build_local) js/main.js -->
        <script type="text/javascript" src="/js/main.js"></script>
    <!-- endbuild -->
    </body>
</html>
