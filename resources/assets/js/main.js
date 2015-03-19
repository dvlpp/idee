$( document ).ready(function() {

    var MODE_LIGHTBOX = false;

    $(".bloc").bloc();

    scrollToBloc($(".bloc.ouvert"), 0);

    $(document).keyup(function(e) {

        if(MODE_LIGHTBOX) return;

        // ESC ou flèche haut
        if (e.keyCode == 27 || e.keyCode == 38) $(".bloc.ouvert.deplie .action-pli").click();

        // Flèche gauche
        else if (e.keyCode == 37) openPrev();

        // Flèche droite
        else if (e.keyCode == 39) openNext();

        // Flèche bas ou Enter
        else if (e.keyCode == 40 || e.keyCode == 13) {
            var $blocCourant = $(".bloc.ouvert");
            if( ! $blocCourant.hasClass("deplie")) {
                $blocCourant.find(".action-pli").click();
            }
        }

    });

    $("header .left").click(function() {
        openPrev();
    });

    $("header .right").click(function() {
        openNext();
    });

    var $instance = $('.imagelightbox').imageLightbox({
        allowedTypes: '',
        onStart: function() { MODE_LIGHTBOX=true; },
        onEnd: function() { MODE_LIGHTBOX=false; }
    });

    $('.horizontal').click(function() {
        if(MODE_LIGHTBOX) $instance.quitImageLightbox();
    });

    function openPrev()
    {
        var $blocCourant = $(".bloc.ouvert");
        var $blocDest = $blocCourant.prev(".bloc");
        openSibling($blocCourant, $blocDest);
    }

    function openNext()
    {
        var $blocCourant = $(".bloc.ouvert");
        var $blocDest = $blocCourant.next(".bloc");
        openSibling($blocCourant, $blocDest);
    }

    function openSibling($blocCourant, $blocDest)
    {
        if($blocDest.length)
        {
            if($blocCourant.hasClass("deplie")) $blocCourant.find(".action-pli").click();
            $blocDest.click();
        }
    }

});