<article class="swiper-slide bloc page {{ $ouvert?"ouvert deplie":"" }}">
    <a class="action-pli icon-circle" href="{{ url("page/".$page->key) }}" data-titre="{{ $page->contenu->titre }}">
        <span class="ouvrir icon-keyboard-arrow-down"></span>
        <span class="fermer icon-close"></span>
    </a>

    <h1 class="hint">{{ $page->contenu->titre }}</h1>

    <div class="cartel"></div>

    <div class="fiche">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="hidden-xs">{{ $page->contenu->titre }}</h1>
                <div class="lead">
                    {!! markdown($page->contenu->chapo) !!}
                </div>
                {!! markdown($page->contenu->texte) !!}
            </div>
        </div>
    </div>
</article>