<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IDeE - Innovation, Design et Expériences</title>

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
    <a class="icon-circle left">
        <span class="icon-keyboard-arrow-left"></span>
    </a>

    <a class="icon-circle right">
        <span class="icon-keyboard-arrow-right"></span>
    </a>

    <div class="logo">
        <span class="baseline">Innovation Design et Expérience</span>
        <div><img src="/css/img/logo.png" width="78"></div>
    </div>

</header>

<div class="horizontal {{$deplie?"verouille":""}}">
    <div class="mur">

        @foreach($pages as $page)
            @include("partials/bloc-page", ["page"=>$page, "ouvert"=>$page->key==$bloc])
        @endforeach

        @foreach($projets as $i => $projet)
            @include("partials/bloc-projet", ["no"=>$i+1, "projet" => $projet, "ouvert"=>$projet->id==$bloc, "deplie"=>$deplie])
        @endforeach

    </div>
</div>

@section("scripts")
    <script src="{{ url("/js/vendor.js") }}"></script>
    <script src="{{ elixir("js/idee.js") }}"></script>
@show


</body>
</html>
