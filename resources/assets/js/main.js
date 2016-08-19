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
        onLoadStart: function() { captionOff(); },
        onLoadEnd:	 function() { captionOn(); },
        onStart: function() { MODE_LIGHTBOX=true; },
        onEnd: function() { captionOff(); MODE_LIGHTBOX=false; }
    });

    $('.horizontal').click(function() {
        if(MODE_LIGHTBOX) $instance.quitImageLightbox();
    });

    function captionOn() {
        var description = $('a[href="' + $( '#imagelightbox' ).attr( 'src' ) + '"]').attr('title');
        if(description.length > 0) {
            $('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body');
        }
    }
    function captionOff() {
        $('#imagelightbox-caption').remove();
    }

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

    var $logo = $("header .logo .marque");
    window.setTimeout(function() {
        randomizeLogo(0);
    }, 3000);

    function randomizeLogo(posPrec)
    {
        var pos = posPrec;
        while(pos == posPrec) pos = Math.floor((Math.random() * 6)) * 25;

        var posPX = "-" + pos + "px";
        $logo.css("background-position", "center " + posPX);

        window.setTimeout(function() {
            randomizeLogo(pos);
        }, 3000);
    }

    var swiper;

    handleSwiper();

    if(isSmartphone()) {
        swiper.slideTo($(".bloc.ouvert").index());
    }

    $(window).resize(function() {
        handleSwiper();
    });

    function handleSwiper()
    {
        if(isSmartphone())
        {
            $("#swiper-css").attr("href", "/css/swiper.css");

            //$('.mur').css('width', $(window).width());

            $('.mur .bloc.projet').each(function() {
                $(this).css("background-image", "url(" + $(this).data("visuelouvert") + ")");
            });

            swiper = new Swiper(
                '.horizontal', {
                    spaceBetween: 0,
                    initialSlide: $(".bloc.ouvert").index(),
                    threshold: 20
                }
            );

        }
        else if (swiper)
        {
            swiper.destroy();
            swiper = undefined;

            $('.mur').removeProp('style');
            $('.mur .bloc').css('width', '');

            $('.mur .bloc.projet').each(function() {
                $(this).css("background-image", "url(" + $(this).data("visuelferme") + ")");
            });

            $("#swiper-css").attr("href", "/css/empty.css");
        }
    }

});


function isSmartphone()
{
    return $("#XS:visible").length;
}