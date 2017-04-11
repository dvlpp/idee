<article class="page">

    <div class="fiche">

        <h1>{{ $page->contenu->titre }}</h1>
        <div class="lead">
            {!! markdown($page->contenu->chapo) !!}
        </div>

        {!! markdown($page->contenu->texte) !!}

        @if($page->texte2)
            <hr/>
            {!! markdown($page->texte2) !!}
        @endif

    </div>
</article>