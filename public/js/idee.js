var couleurBlocFerme = $('.bloc:not(.ouvert):not(.ouverture)').css("background-color");

(function ( $ ) {

    $.fn.bloc = function() {

        return this.each(function() {

            /**
             * Ouverture d'un bloc
             */
            $(this).click(function(event) {

                if($(event.target).parents(".fiche").length) return true;

                event.preventDefault();

                if($(this).hasClass("ouvert") || $(this).hasClass("ouverture")) return false;

                $(".projet.ouvert").each(function() {
                    if($(this).data("visuelferme")) {
                        $(this).css("background-image", "url(" + $(this).data("visuelferme") + ")");
                    }
                    $(this).css("background-color", couleurBlocFerme);
                });

                // Passage visuel ouverture en couleur
                if($(this).data("visuelouvert")) {
                    $(this).css("background-image", "url(" + $(this).data("visuelouvert") + ")");
                }
                $(this).css("background-color", $(this).data("couleur"));

                // Fermeture du bloc ouvert
                $('.bloc.ouvert').removeClass("deplie").addClass("fermeture");

                // Ouverture...
                $(this).removeClass("deplie").addClass("ouverture");

                // Et scroll pendant l'ouverture
                scrollToBloc($(this), 400);
            });

            /**
             * Plier / déplier un bloc
             */
            $(this).find(".action-pli").click(function(event) {

                // if(isSmartphone()) return false;

                var $bloc = $(this).parents(".bloc");
                // var $horizontal = $bloc.parents(".horizontal");

                $(this).addClass("hidden");

                if($bloc.hasClass("deplie")) {
                    // On replie
                    $bloc.removeClass("deplie");

                } else {
                    // On déplie
                    $bloc.find(".fiche").hide();
                    $bloc.addClass("deplie");
                    $bloc.find(".fiche").fadeIn();
                    scrollToBloc($bloc, 0);

                    // Gestion history
                    window.history.pushState({foo:"bar"}, $(event.currentTarget).data("titre"), $(event.currentTarget).prop("href"));
                }

                $(this).removeClass("hidden");
            });

            /**
             * Une fois ouvert ou fermé (animation terminée) :
             */
            $(this).on("transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd", function(e) {

                // if(isSmartphone()) return false;

                if($(this).hasClass("ouverture")) {
                    $(this).removeClass("ouverture");
                    $(this).addClass("ouvert");

                }  else if($(this).hasClass("fermeture")) {
                    $(this).removeClass("fermeture ouvert ouverture deplie");
                }
            });

        });
    };

}( jQuery ));



function scrollToBloc($bloc, animationLength, callback) {
    if(!$bloc.length) return;

    $('body').animate(
        {'scrollTop': $bloc.offset().top},
        animationLength,
        callback
    );
}

$( document ).ready(function() {

    var MODE_LIGHTBOX = false;

    $(".bloc").bloc();

    scrollToBloc($(".bloc.ouvert"), 0);

    $('.imagelightbox').imageLightbox({
        allowedTypes: '',
        onLoadStart: function() { captionOff(); },
        onLoadEnd:	 function() { captionOn(); },
        onStart: function() { MODE_LIGHTBOX=true; overlayOn(); },
        onEnd: function() { captionOff(); overlayOff(); MODE_LIGHTBOX=false; }
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
    function overlayOn() {
        $( '<div id="imagelightbox-overlay"></div>' ).appendTo( 'body' );
    }
    function overlayOff() {
        $( '#imagelightbox-overlay' ).remove();
    }

    var $logo = $("header .logo .marque");
    window.setTimeout(function() {
        randomizeLogo(0);
    }, 3000);

    function randomizeLogo(posPrec) {
        var pos = posPrec;
        while(pos == posPrec) pos = Math.floor((Math.random() * 6)) * 25;

        var posPX = "-" + pos + "px";
        $logo.css("background-position", "center " + posPX);

        window.setTimeout(function() {
            randomizeLogo(pos);
        }, 3000);
    }

});


function isSmartphone() {
    return $("#XS:visible").length;
}
//# sourceMappingURL=idee.js.map
