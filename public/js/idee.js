function scrollToBloc(e,i,t){var o=$(".horizontal"),s=parseInt(o.find(".mur").css("border-left-width"));e.prevAll(".bloc").each(function(){s+=$(this).outerWidth()});var a=e.outerWidth(),l=$(window).width();o.animate({scrollLeft:s-(l-a)/2},i,t)}!function(e){e.fn.bloc=function(){return this.each(function(){e(this).click(function(i){return e(i.target).hasClass("imagelightbox")?!0:e(this).hasClass("ouvert")||e(this).hasClass("ouverture")?!1:(e(this).hasClass("projet")&&e(this).css("background-image","url("+e(this).data("visuelouvert")+")"),e(".bloc.ouvert").each(function(){e(this).addClass("fermeture")}),void e(this).addClass("ouverture"))}),e(this).find(".action-pli").click(function(i){var t=e(this).parent(".bloc"),o=t.parents(".horizontal");t.hasClass("deplie")?(t.removeClass("deplie"),o.removeClass("verouille"),t.hasClass("page")&&t.addClass("fermeture")):(t.find(".fiche").hide(),t.addClass("deplie"),t.find(".fiche").fadeIn(),scrollToBloc(t,0),o.addClass("verouille"),window.history.pushState({foo:"bar"},e(i.currentTarget).data("titre"),e(i.currentTarget).prop("href")))}),e(this).on("transitionend MSTransitionEnd webkitTransitionEnd oTransitionEnd",function(){if(e(this).hasClass("ouverture"))e(this).removeClass("ouverture"),e(this).addClass("ouvert"),e(this).hasClass("page")&&e(this).find(".action-pli").click(),scrollToBloc(e(this),800);else if(e(this).hasClass("fermeture")){var i=e(this).parents(".horizontal");i.removeClass("verouille"),e(this).removeClass("fermeture ouvert ouverture deplie"),e(this).hasClass("projet")&&e(this).css("background-image","url("+e(this).data("visuelferme")+")")}})})}}(jQuery),$(document).ready(function(){function e(){var e=$(".bloc.ouvert"),i=e.prev(".bloc");t(e,i)}function i(){var e=$(".bloc.ouvert"),i=e.next(".bloc");t(e,i)}function t(e,i){i.length&&(e.hasClass("deplie")&&e.find(".action-pli").click(),i.click())}var o=!1;$(".bloc").bloc(),scrollToBloc($(".bloc.ouvert"),0),$(document).keyup(function(t){if(!o)if(27==t.keyCode||38==t.keyCode)$(".bloc.ouvert.deplie .action-pli").click();else if(37==t.keyCode)e();else if(39==t.keyCode)i();else if(40==t.keyCode||13==t.keyCode){var s=$(".bloc.ouvert");s.hasClass("deplie")||s.find(".action-pli").click()}}),$("header .left").click(function(){e()}),$("header .right").click(function(){i()});var s=$(".imagelightbox").imageLightbox({allowedTypes:"",onStart:function(){o=!0},onEnd:function(){o=!1}});$(".horizontal").click(function(){o&&s.quitImageLightbox()})});