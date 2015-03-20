(function ( $ ) {

    $.fn.bloc = function() {

        return this.each(function() {

            /**
             * Ouverture d'un bloc
             */
            $(this).click(function(event) {

                if(isSmartphone()) return true;

                if($(event.target).hasClass("imagelightbox")) return true;

                if($(this).hasClass("ouvert") || $(this).hasClass("ouverture")) return false;

                if($(this).hasClass("projet"))
                {
                    // Cas projet : gestion passage visuel en couleur
                    $(this).css("background-image", "url(" + $(this).data("visuelouvert") + ")");
                }

                // Fermeture du bloc ouvert
                $('.bloc.ouvert').each(function() {
                    $(this).addClass("fermeture");
                });

                // Ouverture...
                $(this).addClass("ouverture");

            });

            /**
             * Plier / déplier un bloc
             */
            $(this).find(".action-pli").click(function(event) {

                if(isSmartphone()) return false;

                var $bloc = $(this).parent(".bloc");
                var $horizontal = $bloc.parents(".horizontal");

                if($bloc.hasClass("deplie"))
                {
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
                    $bloc.find(".fiche").hide();
                    $bloc.addClass("deplie");
                    $bloc.find(".fiche").fadeIn();
                    scrollToBloc($bloc, 0);
                    $horizontal.addClass("verouille");

                    // Gestion history
                    window.history.pushState({foo:"bar"}, $(event.currentTarget).data("titre"), $(event.currentTarget).prop("href"));
                }
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

                    scrollToBloc($(this), 800);
                }
                else if($(this).hasClass("fermeture"))
                {
                    var $horizontal = $(this).parents(".horizontal");
                    $horizontal.removeClass("verouille");

                    $(this).removeClass("fermeture ouvert ouverture deplie");

                    if($(this).hasClass("projet"))
                    {
                        // Cas projet : gestion passage visuel en NB
                        $(this).css("background-image", "url(" + $(this).data("visuelferme") + ")");
                    }
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
        bordBloc += $(this).outerWidth();
    });

    var largeurBloc = $bloc.outerWidth();
    var largeurFenetre = $(window).width();

    $horizontal.animate(
        {'scrollLeft': bordBloc - ((largeurFenetre-largeurBloc)/2)},
        animationLength,
        callback
    );
}

function isSmartphone()
{
    return $("#XS:visible").length;
}