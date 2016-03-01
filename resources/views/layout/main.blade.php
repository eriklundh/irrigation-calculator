<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="icon" href="../../favicon.ico">-->

    <title>Irrigation Calculator</title>

    <!-- Bootstrap core CSS -->
<!--    <link href="{{-- asset('css/bootstrap.min.css') --}}" rel="stylesheet">-->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootswatch.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    @yield('css')

</head>

<body>

    @include('components.nav')

    @if(Session::has('global'))
        <div class="container">
            <div class="row">
                <br>
                <div class="col-md-6 col-md-offset-3 center notification">{{ Session::get('global') }}</div>
            </div>
        </div>
    @endif

    @yield('jumbotron')

    @yield('container')

    <!-- Main jumbotron for a primary marketing message or call to action -->
<!--    <div class="jumbotron">-->
<!--        <div class="container">-->
<!--            <h1>Hello, world!</h1>-->
<!--            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>-->
<!--            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more raquo;</a></p>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="container">-->
        <!-- Example row of columns -->
<!--        <div class="row">-->
<!--            <div class="col-md-4">-->
<!--                <h2>Heading</h2>-->
<!--                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <h2>Heading</h2>-->
<!--                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--                <h2>Heading</h2>-->
<!--                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
<!--                <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <hr>-->
<!---->
<!--        <footer>-->
<!--            <p>&copy; Company 2014</p>-->
<!--        </footer>-->
<!--    </div> --><!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-filestyle.min.js') }}"> </script>
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ asset('js/ie10-viewport-bug-workaround.js') }}"></script>

</body>

</html>
