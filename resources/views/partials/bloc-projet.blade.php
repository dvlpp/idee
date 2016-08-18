<article class="swiper-slide bloc projet {{ $ouvert?"ouvert":"" }} {{$ouvert&&$deplie?"deplie":""}}"
         data-visuelferme="{{ !$projet->is_mode_actu ? vignetteNB($projet->visuel, 600, 600) : "" }}"
         data-visuelouvert="{{ !$projet->is_mode_actu ? vignette($projet->visuel, 600, 600) : "" }}"
         data-couleur="{{ "#".$projet->couleur }}"
         style="{{ !$projet->is_mode_actu && $projet->visuel ? 'background-image:url('
            . ($ouvert ? vignette($projet->visuel, 600, 600) : vignetteNB($projet->visuel, 600, 600))
            . ')' : ($projet->is_mode_actu&&$ouvert ? 'background-color:#'.$projet->couleur : '') }}">

    <a class="action-pli icon-circle" href="{{ url("projet/".$projet->id."/".str_slug($projet->contenu->titre)) }}" data-titre="{{ $projet->contenu->titre }}">
        <span class="ouvrir icon-keyboard-arrow-down"></span>
        <span class="fermer icon-close"></span>
    </a>

    @if($projet->is_mode_actu)
        <h2 class="actu">{{ $projet->texte_actu }}</h2>
    @else
        <h1 class="hint">{{ $projet->numero }}</h1>
    @endif

    <div class="cartel">
        <h1>{{ $projet->contenu->titre }}</h1>
        {!! markdown($projet->contenu->chapo, $projet->couleur) !!}
    </div>

    <div class="fiche">

        <div class="row">
            <div class="col-sm-8">
                <h1>{{ $projet->contenu->titre }}</h1>

                <div class="lead">
                    {!! markdown($projet->contenu->chapo, $projet->couleur) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                {!! markdown($projet->contenu->texte, $projet->couleur) !!}
            </div>
            <div class="col-sm-4">
                @if(sizeof($projet->partenaires))
                    <div class="liste">
                        <p class="titre">Partenaires</p>
                        <ul class="list-unstyled">
                            @foreach($projet->partenaires as $partenaire)
                                <li>
                                    {!! $partenaire->url ? link_to($partenaire->url, $partenaire->nom, ["style"=>"color:#".$projet->couleur]) : $partenaire->nom !!}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(sizeof($projet->fichiers))
                    <div class="liste fichiers">
                        <p class="titre">Documents<br/>à télécharger</p>
                        <ul class="list-unstyled">
                            @foreach($projet->fichiers as $fichier)
                                <li>
                                    <a class="pdf" href="{{ route('dl', [$fichier->id, str_slug($fichier->titre, '_'), $fichier->fichier->fichier]) }}" style="color:#{{ $projet->couleur }}">
                                        {{ $fichier->titre }} ({{ $fichier->extension }})
                                    </a>
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
                           style="background-image:url({{ vignette($visuel->photo, 400, 300) }})"
                           alt="{{ $visuel->legende }}">
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