<article class="bloc projet {{ $ouvert?"ouvert":"" }} {{$ouvert&&$deplie?"deplie":""}}"
         data-visuelferme="{{ !$projet->is_mode_actu ? vignetteNB($projet->visuel, 1200) : "" }}"
         data-visuelouvert="{{ !$projet->is_mode_actu ? vignette($projet->visuel, 1200) : "" }}"
         data-couleur="{{ "#".$projet->couleur }}"
         style="{{ !$projet->is_mode_actu && $projet->visuel ? 'background-image:url('
            . ($ouvert ? vignette($projet->visuel, 1200) : vignetteNB($projet->visuel, 1200))
            . ')' : ($projet->is_mode_actu&&$ouvert ? 'background-color:#'.$projet->couleur : '') }}">

    @if($projet->is_mode_actu)
        <h2 class="actu">{{ $projet->texte_actu }}</h2>
    @else
        <h1 class="hint">{{ $projet->numero }}</h1>
    @endif

    <div class="fiche">

        <div class="cartel">
            <h1>{{ $projet->contenu->titre }}</h1>

            <a class="action-pli" href="{{ url("projet/".$projet->id."/".str_slug($projet->contenu->titre)) }}" data-titre="{{ $projet->contenu->titre }}">
                <span class="ouvrir icon-keyboard-arrow-down"></span>
                <span class="fermer icon-close"></span>
            </a>
        </div>

        <div class="content">

            <div class="row">
                <div class="col-sm-8">
                    @if($projet->contenu->chapo)
                        <div class="lead">
                            {!! markdown($projet->contenu->chapo, $projet->couleur) !!}
                        </div>
                    @endif
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
                                    @if($fichier->fichier)
                                        <li>
                                            <a class="pdf" href="{{ route('dl', [$fichier->id, str_slug($fichier->titre, '_'), $fichier->fichier->fichier]) }}" style="color:#{{ $projet->couleur }}">
                                                {{ $fichier->titre }} ({{ $fichier->extension }})
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            @if(sizeof($projet->visuels))
                <div class="row half-half-gutter photos">
                    @foreach($projet->visuels as $k => $visuel)
                        @if($visuel->photo)
                            <div class="col-lg-4 col-xs-6">
                                <a href="{{ vignette($visuel->photo, 800, 800) }}"
                                   class="imagelightbox"
                                   style="background-image:url({{ vignette($visuel->photo, 400, 300) }})"
                                   title="{{ $visuel->objet . ($visuel->designer ? ' ©'.$visuel->designer : '') }} <br> {{ $visuel->legende }}">
                                    @if($visuel->objet || $visuel->designer)
                                        <span class="legende">
                                            {{ $visuel->objet }}
                                            @if($visuel->designer)
                                                ©{{ $visuel->designer }}
                                            @endif
                                        </span>
                                    @endif
                                </a>
                            </div>

                            @if($k+1%2==0)
                                <div class="clearfix"></div>
                            @endif
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</article>