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