<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="google-site-verification" content="6NuAYWzkXvDCxUhW-O54r4VgalhrEWdG1ByevCurrX0" />

    <meta name="description" content="IDeE - Innovation, Design et Expériences - association des designers d'Alsace" />

    <title>IDeE - Innovation, Design et Expériences - association des designers d'Alsace</title>

    <base href="{{ url() }}">

    <link href='http://fonts.googleapis.com/css?family=Raleway:100,600' rel='stylesheet' type='text/css'>
    <link href="{{ elixir("css/app.css") }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<header>
    <div class="logo">
        <span class="baseline">Innovation Design et Expériences</span>
        <div class="marque">
            <img src="/css/img/logo.png" class="img-responsive" />
        </div>
    </div>

</header>

<div class="container">

    @foreach($projets as $projet)
        @include("partials/bloc-projet", ["projet" => $projet, "ouvert"=>$projet->id==$bloc, "deplie"=>$deplie])
    @endforeach

    <div class="row">

        @foreach($pages as $page)
            <div class="col-sm-6">
                @include("partials/bloc-page")
            </div>
        @endforeach

    </div>

</div>

<footer></footer>

<div id="XS" class="visible-xs"></div>

@section("scripts")
    <script src="{{ url("/js/vendor.js") }}"></script>
    <script src="{{ elixir("js/idee.js") }}"></script>
@show

</body>
</html>
