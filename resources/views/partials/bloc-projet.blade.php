<article class="swiper-slide bloc projet {{ $ouvert?"ouvert":"" }} {{$ouvert&&$deplie?"deplie":""}}"
         data-visuelferme="{{ vignetteNB($projet->visuel, 600, 600) }}"
         data-visuelouvert="{{ vignette($projet->visuel, 600, 600) }}"
         style="{{ $projet->visuel ? 'background-image:url('
            . ($ouvert ? vignette($projet->visuel, 600, 600) : vignetteNB($projet->visuel, 600, 600))
            . ')' : '' }}">

    <a class="action-pli icon-circle" href="{{ url("projet/".$projet->id."/".str_slug($projet->contenu->titre)) }}" data-titre="{{ $projet->contenu->titre }}">
        <span class="ouvrir icon-keyboard-arrow-down"></span>
        <span class="fermer icon-close"></span>
    </a>

    <h1 class="hint">{{ $no }}</h1>

    <div class="cartel">
        <h1>{{ $projet->contenu->titre }}</h1>
        {!! markdown($projet->contenu->chapo) !!}
    </div>

    <div class="fiche">

        <div class="row">
            <div class="col-sm-8">
                <h1>{{ $projet->contenu->titre }}</h1>

                <div class="lead">
                    {!! markdown($projet->contenu->chapo) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                {!! markdown($projet->contenu->texte) !!}
            </div>
            <div class="col-sm-4">
                @if(sizeof($projet->partenaires))
                    <div class="partenaires">
                        <p class="titre">Partenaires</p>
                        <ul class="list-unstyled">
                            @foreach($projet->partenaires as $partenaire)
                                <li>
                                    {!! $partenaire->url ? link_to($partenaire->url, $partenaire->nom) : $partenaire->nom !!}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if(sizeof($projet->visuels))
            <div class="row half-half-gutter photos">
                @foreach($projet->visuels as $k => $visuel)
                    <div class="col-xs-6">
                        <a href="{{ vignette($visuel->photo, 800, 800) }}"
                           class="imagelightbox"
                           style="background-image:url({{ vignette($visuel->photo, 400, 300) }})">
                        </a>
                    </div>

                    @if($k+1%2==0)
                        <div class="clearfix"></div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>

</article>