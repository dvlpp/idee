<article class="page">

    <div class="fiche">

        <h1>{{ $page->contenu->titre }}</h1>
        <div class="lead">
            {!! markdown($page->contenu->chapo) !!}
        </div>
        
        @if($page->visuel)
            <img src="{{ vignette($page->visuel, 655) }}" alt="{{ e($page->contenu->titre) }}" style="margin-bottom: 20px;" class="img-responsive">
        @endif

        {!! markdown($page->contenu->texte) !!}

        @if($page->texte2)
            <hr/>
            {!! markdown($page->texte2) !!}
        @endif

    </div>
</article>