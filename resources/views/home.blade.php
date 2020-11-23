@extends('layout')


@section('content')
    <div class="row">
        @foreach($mainPages as $page)
            <div class="col-sm-6">
                @include("partials/bloc-page")
            </div>
        @endforeach
    </div>

    @if(config('idee.shop.active'))
        <article class="page">
            <div class="fiche">
                <h1 style="margin-bottom: 2rem">{{ config('idee.shop.title') }}</h1>

                <a class="btn btn-block btn-primary btn-lg text-uppercase" href="/boutique">Accéder à la boutique</a>
            </div>
        </article>
    @endif

    <div class="mb-gutter">
        @foreach($projets as $projet)
            @include("partials/bloc-projet", ["projet" => $projet, "ouvert"=>$projet->id==$bloc, "deplie"=>$deplie])
        @endforeach
    </div>

    <div class="row">
        @foreach($pages as $page)
            <div class="col-sm-6">
                @include("partials/bloc-page")
            </div>
        @endforeach
    </div>
@endsection