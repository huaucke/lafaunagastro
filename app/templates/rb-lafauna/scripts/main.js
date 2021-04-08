jQuery(document).ready(function () {
  /*  
    //Letras https://textillate.js.org/
    jQuery('.tlt').textillate({ 
        in: { effect: 'splat' },
        out: { effect: 'fadeIn', sync: true },
        loop: true
    });
*/
  //    jQuery('*[rel=tooltip]').tooltip();

  // class x dispositivos
  if (window.matchMedia("only screen and (max-width: 768px)").matches) {
    console.log("movil");
    jQuery('body').addClass('movil');
  } else {
    if (window.matchMedia("only screen and (max-width: 1025px)").matches) {
      console.log("tablet");
      jQuery('body').addClass('tablet');
    } else {
      console.log("desktop");
      jQuery('body').addClass('desktop');
    }
  }
  // class x resolucion
  var jQuerywindow = jQuery(window),
    jQueryhtml = jQuery('.width');
  jQuerywindow.resize(function resize() {
    if (jQuerywindow.width() < 514) {
      return jQueryhtml.addClass('mobile');
    }
    jQueryhtml.removeClass('mobile');
  }).trigger('resize');

  //Isotope
  var $container = $('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows'
  });

  $container.imagesLoaded().progress(function () {
    $container.fadeIn(1000).isotope('layout');
  });

  //InfiniteScroll
  jQuery('.container').infiniteScroll({
    // options
    path: '.pagination_next',
    append: '.post',
    history: false,
  });


  //Slider
  jQuery('#slider-intro').owlCarousel({
    nav: true,
    items: 1,
    lazyLoad: true,
    loop: true,
    margin: 0,
    slideSpeed: 400,
    autoplay: false,
    paginationSpeed: 400
  });

  jQuery('.slider-items').owlCarousel({
    responsive: {
      // breakpoint from 0 up
      0: {
        items: 1,
        lazyLoad: true,
        loop: true,
        margin: 0,
        slideSpeed: 300,
        paginationSpeed: 400
      },
      // breakpoint from 768 up
      576: {
        items: 2,
      },
      // breakpoint from 768 up
      768: {
        items: 3,
      },
      // breakpoint from 768 up
      1080: {
        items: 4,
      },
      // breakpoint from 768 up
      1440: {
        items: 6,
      }
    }
  });

  // Social Share
  jQuery("#share").jsSocials({
    showLabel: false,
    showCount: false,
    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
  });


  //Bottones Search
  jQuery('.btn-search').on('click', function () {
    jQuery('#mod-finder').toggleClass('active');
  });
  jQuery('.btn-close').on('click', function () {
    //jQuery('#mod-finder').toggleClass('active');
    jQuery(this).parents().eq(1).toggleClass('active');
  });

  //Bottones experto
  jQuery('.btn-experto').on('click', function () {
    jQuery('#mod-experto').toggleClass('active');
  });

  //Botones Mailing (suscribir para descargar x email)
  jQuery('.btn-mailer').on('click', function () {
    jQuery('#mod-mailer').toggleClass('active');
  });
  jQuery('#mod-mailer .btn-close').on('click', function () {
    jQuery('#mod-mailer').toggleClass('active');
  });

  //Bottones del floater_banner
  jQuery('.btn-share').on('click', function () {
    jQuery('#mod-socialshare').toggleClass('active');
  });
  jQuery('.btn-contacto').on('click', function () {
    jQuery('#contact-panel').toggleClass('open');
  });
  jQuery('.btn-poll').on('click', function () {
    jQuery('#poll-panel').toggleClass('open');
  });
  jQuery('.btn-message').on('click', function () {
    jQuery('#mod-contactpanel').toggleClass('active');
  });

  //Contact panel
  jQuery('#btn-form-01').on('click', function () {
    jQuery('.form-01').removeClass('hidden');
    jQuery('.contact-menu').addClass('hidden');
    jQuery('.form-02').addClass('hidden');
    jQuery('.form-03').addClass('hidden');
  });
  jQuery('#btn-form-02').on('click', function () {
    jQuery('.form-02').removeClass('hidden');
    jQuery('.contact-menu').addClass('hidden');
    jQuery('.form-01').addClass('hidden');
    jQuery('.form-03').addClass('hidden');
  });
  jQuery('#btn-form-03').on('click', function () {
    jQuery('.form-03').removeClass('hidden');
    jQuery('.contact-menu').addClass('hidden');
    jQuery('.form-01').addClass('hidden');
    jQuery('.form-02').addClass('hidden');
  });
  jQuery('.btn-return').on('click', function () {
    jQuery('.contact-menu').removeClass('hidden');
    jQuery('.form-01').addClass('hidden');
    jQuery('.form-02').addClass('hidden');
    jQuery('.form-03').addClass('hidden');
  });

  //PopUp de cookies
  window.addEventListener("load", function () {
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "rgba(0,0,0,0.6)"
        },
        "button": {
          "background": "#6f42c1"
        }
      },
      "theme": "edgeless",
      "position": "bottom",
      "content": {
        "message": "Esta web releva datos estadísticos de su navegación en cumplimiento del RGPD de la UE. Si continúa navegando consideramos que acepta el uso de cookies.",
        "dismiss": "Si, continuar",
        "link": "Más Información.",
        "href": "/aviso-legal"
      }
    })
  });

  //ANIMACIONES
  // Ocultar Header con scrolldown
  var didScroll;
  var lastScrollTop = 250;
  var delta = 5;
  var navbarHeight = jQuery('header').outerHeight();

  jQuery(window).scroll(function (event) {
    didScroll = true;
  });
  setInterval(function () {
    if (didScroll) {
      hasScrolled();
      didScroll = false;
    }
  }, 250);

  //floater banner
  jQuery(document).ready(function ($) {
    var $banner = $('#flying'),
      $window = $(window);
    var $topDefault = parseFloat($banner.css('top'), 10);
    $window.on('scroll', function () {
      var $top = $(this).scrollTop();
      $banner.stop().animate({
        top: $top + $topDefault
      }, 1000, 'easeOutCirc');
    });
    var $wiBanner = $banner.outerWidth() * 2;

    function zindex(maxWidth) {
      if ($window.width() <= maxWidth + $wiBanner) {
        $banner.addClass('zindex');
      } else {
        $banner.removeClass('zindex');
      }
    }
  });
  //affix para barra header calculando altura del div anterior
  jQuery(".bar-prodmenu").sticky({
    topSpacing: 60
  });


  //Random de listados para banners
  jQuery(function () {
    var random = Math.floor(Math.random() * jQuery('.random-quote').length);
    jQuery('.random-quote').eq(random).show();
  });
  /*
      jQuery(window).scroll(function() {
          if (jQuery(document).height() <= (jQuery(window).height() + jQuery(window).scrollTop())) {
              //Bottom Reached
              jQuery('.mod-poll').addClass('open');
          }
      });
      
      */
  function hasScrolled() {
    var st = jQuery(this).scrollTop();
    // Make sure they scroll more than delta
    if (Math.abs(lastScrollTop - st) <= delta)
      return;
    // If they scrolled down and are past the navbar, add class .nav-up. This is necessary so you never see what is "behind" the navbar.
    if (st > lastScrollTop && st > navbarHeight) {
      // Scroll Down
      jQuery('body').removeClass('nav-down').addClass('nav-up');
      jQuery('#back-top').fadeIn();
      jQuery('.mod-poll').addClass('active');
    } else {
      // Scroll Up
      if (st + jQuery(window).height() < jQuery(document).height()) {
        jQuery('body').removeClass('nav-up').addClass('nav-down');
        jQuery('#back-top').fadeOut();
        jQuery('.mod-poll').removeClass('active');
      }
    }
    lastScrollTop = st;
  }

  jQuery('a[data-toggle=custom-modal]').click(function (e) {
    e.preventDefault();
    var targetId = jQuery(this).attr('data-target');
    jQuery(targetId).find('.modal-content').removeData().html('cargando....').load(jQuery(this).attr('href'));
    var modal = jQuery(targetId).modal({
      show: true,
      backdrop: 'static'
    });
    modal.on('hidden.bs.modal', function () {
      jQuery(this).find('.modal-content').html("");
    })
  });

  //Boton con scroll al href
  jQuery(".goto").click(function () {
    var addressValue = jQuery(this).attr("href");
    jQuery("html, body").animate({
      scrollTop: jQuery(addressValue).offset().top - 100
    }, 800);
  });
  //Boton al top del sitio
  jQuery('.btn-totop').click(function () {
    jQuery("html,body").animate({
      scrollTop: 0
    }, 800);
  });

  //lazyload
  jQuery(".lazy").lazyload({
    effect: 'fadeIn',
    effectTime: 500,
    threshold: 200
  });

  //btn video
  jQuery('.videohover').on('click', function () {
    var myPlayer = videojs('vid1');
    myPlayer.play();
    jQuery(this).hide();
  });
})

jQuery(window).on("load resize", function () {
  _winHeight = jQuery(window).height();
  _winwidth = jQuery(window).width();

  // Setting Height
  jQuery('.fullvh').css({
    'height': _winHeight * 1,
    'width': _winwidth * 1
  }); // 0.5 = 50%, 0.8 = 80%
  jQuery('.eightvh').css({
    'height': _winHeight * 0.8
  }); // 0.8 = 80%
  jQuery('.bannervh').css({
    'min-height': _winHeight * 0.6
  }); // 0.8 = 80%
  jQuery('.sixtyvh').css({
    'height': _winHeight * 0.6
  }); // 0.6 = 60%
  jQuery('.halfvh').css({
    'height': _winHeight * 0.5
  }); // 0.5 = 50%, 0.8 = 80%

  jQuery('.fourtyrvh').css({
    'height': _winHeight * 0.4
  }); // 0.4 = 40%
  jQuery('.quartervh').css({
    'height': _winHeight * 0.25
  }); // 0.25 = 25%
  jQuery('.fiftyvh').css({
    'height': _winHeight * 0.15
  }); // 0.15 = 15%
});




/*
        jQuery('.grid').masonry({
            itemSelector: '.grid-item', // use a separate class for itemSelector, other than .col-
            columnWidth: '.grid-sizer',
            percentPosition: true
        });

*/






/*
//mostrar botonera fixed cuando baja el scroll
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() < 400) {
            jQuery('.flygroup').fadeOut();
        }
        else {
            jQuery('.flygroup').fadeIn();
        }
    });
*/

/*
 // varios
    
    jQuery("#email-contacto").html("info" + "@" + "RIOBABEL" + ".es");
    jQuery(".cliente").html("RIOBABEL");
    jQuery(".year").text((new Date).getFullYear());
    jQuery('.inputs label').useAsPlaceholder();
*/

//menu
/*        jQuery('.dropdown-toggle').dropdown('toggle')
 */

/*
        jQuery(".btn-goto").click(function (e) {
            jQuery("#contact-panel").removeClass("open");
            jQuery("html, body").animate({scrollTop: 0}, 1600);
            return false;
        });

-*/


// jQuery('a.btn-menu').on('click',function(e){
//     console.log('no cierra');
//     e.preventDefault();
// });

//affix para barra header calculando altura del div anterior
/*
    jQuery('.banner-menu').affix({
        offset: {
            top: jQuery('#intro').height()
        }
    });*/

//On click video
/*
    jQuery('div.video').on('click', function (e) {
        jQuery('.videolabel').hide();
        jQuery(this).find('iframe')[0].src += '&autoplay=1';
    });
    jQuery('.hover-video').on('click', function () {
        var myPlayer = videojs('vid1');
        myPlayer.play();
        jQuery(this).hide();
    });*/

/*
        // Hide Contact and cita previa alert message
        jQuery('#alert-message').hide();
        // Success contact form message
        function success() {
            jQuery('#alert-message').show().removeClass('error-message').addClass('success-message').html('<div class="message"><h4>Mensaje enviado correctamente.<small>Le contactaremos a la brevedad. Muchas gracias</small></h4></div>');
            jQuery('.form-group').hide();
            jQuery('.submit-form').hide();
            return;
        }*/
/*
        // Error contact form message
        function error() {
            return jQuery('#alert-message').show().removeClass('sucess-message').addClass('error-message').html('<div class="message"><h4>Error al enviar <small>el mensaje, vuelva a intentarlo por favor.</small></h4></div>');
        }*/
/*
        // CITA PREVIA SEND
        jQuery('#citaPrevia').submit(function () {
            event.preventDefault();
            var form = jQuery(this);
            console.log('form',form.toString());
            jQuery.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
            }).done(function (data) {
                if (data.success) {
                    success();
                    form[0].reset();
                } else {
                    error();
                }
            }).fail(function (data) {
                error();
            });
        });*/
/*
        // CONTACT SEND
        jQuery('#contact').submit(function () {
            event.preventDefault();
            var form = jQuery(this);
            jQuery.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize()
            }).done(function (data) {
                if (data.success) {
                    success();
                    form[0].reset();
                } else {
                    error();
                }
            }).fail(function (data) {
                error();
            });
        });*/
