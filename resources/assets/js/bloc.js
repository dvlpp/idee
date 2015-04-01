var largeurBlocFerme = parseInt($('.bloc:not(.ouvert):not(.ouverture)').css("width"));
var largeurBlocOuvert = parseInt($('.bloc.ouvert').css("width"));
var couleurBlocFerme = $('.bloc:not(.ouvert):not(.ouverture)').css("background-color");

(function ( $ ) {

    $.fn.bloc = function() {

        return this.each(function() {

            /**
             * Ouverture d'un bloc
             */
            $(this).click(function(event) {

                if(isSmartphone()) return true;

                if($(event.target).parents(".fiche").length) return true;

                if($(this).hasClass("ouvert") || $(this).hasClass("ouverture")) return false;

                $(".projet.ouvert").each(function() {
                    if($(this).data("visuelferme"))
                    {
                        $(this).css("background-image", "url(" + $(this).data("visuelferme") + ")");
                    }
                    $(this).css("background-color", couleurBlocFerme);
                });

                if($(this).hasClass("projet"))
                {
                    // Cas projet : passage visuel ouverture en couleur
                    if($(this).data("visuelouvert"))
                    {
                        $(this).css("background-image", "url(" + $(this).data("visuelouvert") + ")");
                    }
                    $(this).css("background-color", $(this).data("couleur"));
                }

                // Fermeture du bloc ouvert
                $('.bloc.ouvert').each(function() {
                    $(this).addClass("fermeture");
                });

                // Ouverture...
                $(this).addClass("ouverture");

                // Et scroll pendant l'ouverture
                scrollToBloc($(this), 800);

            });

            /**
             * Plier / déplier un bloc
             */
            $(this).find(".action-pli").click(function(event) {

                if(isSmartphone()) return false;

                var $bloc = $(this).parent(".bloc");
                var $horizontal = $bloc.parents(".horizontal");

                $(this).addClass("hidden");

                if($bloc.hasClass("deplie"))
                {
                    // On replie
                    $bloc.removeClass("deplie");
                    $horizontal.removeClass("verouille");

                    if($bloc.hasClass("page"))
                    {
                        // Page : pas d'état "ouvert"
                        $bloc.addClass("fermeture");
                    }
                }
                else
                {
                    // On déplie
                    $bloc.find(".fiche").hide();
                    $bloc.addClass("deplie");
                    $bloc.find(".fiche").fadeIn();
                    scrollToBloc($bloc, 0);
                    $horizontal.addClass("verouille");

                    // Gestion history
                    window.history.pushState({foo:"bar"}, $(event.currentTarget).data("titre"), $(event.currentTarget).prop("href"));
                }

                $(this).removeClass("hidden");
            });

            /**
             * Une fois ouvert ou fermé (animation terminée) :
             */
            $(this).on("transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd", function() {

                if(isSmartphone()) return false;

                if($(this).hasClass("ouverture"))
                {
                    $(this).removeClass("ouverture");
                    $(this).addClass("ouvert");

                    if($(this).hasClass("page"))
                    {
                        // Page : pas d'état "ouvert"
                        $(this).find(".action-pli").click();
                    }
                }

                else if($(this).hasClass("fermeture"))
                {
                    var $horizontal = $(this).parents(".horizontal");
                    $horizontal.removeClass("verouille");

                    $(this).removeClass("fermeture ouvert ouverture deplie");
                }
            });

        });
    };

}( jQuery ));



function scrollToBloc($bloc, animationLength, callback)
{
    var $horizontal = $(".horizontal");
    var bordBloc = parseInt($horizontal.find(".mur").css("border-left-width"));

    $bloc.prevAll(".bloc").each(function() {
        bordBloc += largeurBlocFerme;
    });

    var largeurFenetre = $(window).width();

    $horizontal.animate(
        {'scrollLeft': bordBloc - ((largeurFenetre-largeurBlocOuvert)/2)},
        animationLength,
        callback
    );
}
