jQuery(function($) {
	"use strict"
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
  jQuerywindow.on ('resize', function resize() {
    if (jQuerywindow.width() < 514) {
      return jQueryhtml.addClass('mobile');
    }
    jQueryhtml.removeClass('mobile');
  }).trigger('resize');

  //iframe 
  jQuery("#tenedor").contents().find(".a.submit.btn.black.big.button--callToAction.button--uppercase").css('background-color', 'red');

  //Scroll arriba abajo
  var position = jQuery(window).scrollTop(); 
  // should start at 0
  jQuery(window).on ('scroll', function() {
      var scroll = $(window).scrollTop();
      if(scroll > position) {
        jQuery('body').removeClass('nav-down').addClass('nav-up');
      } else {
        jQuery('body').removeClass('nav-up').addClass('nav-down');
      }
      position = scroll;
  });

  //scrollspy
  var menu = document.querySelector('#mainmenu');
    scrollSpy(menu);

  //Isotope
  var $container = jQuery('.grid').isotope({
    itemSelector: '.grid-item',
    layoutMode: 'fitRows'
  });
  $container.imagesLoaded().progress(function () {
    $container.fadeIn(1000).isotope('layout');
  });
    

  //Accordion
  var acc = document.getElementsByClassName("accordion-button");
  var i;
  for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
      this.classList.toggle("active");
      var panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
      } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
      }
    });
  }
  

  //Bottones toggle 
  jQuery('.btn-toggle').on('click', function () {
    jQuery(this).parents().eq(`alergenos`).addClass('213');
    jQuery(this).parent().toggleClass('show');
  });
  jQuery('.btn-close').on('click', function () {
    jQuery(this).parents().eq(2).toggleClass('show');
  });
  jQuery('.btn-acceslogin').on('click', function () {
    jQuery(this).parent().toggleClass('show');
  });
  jQuery('.btn-whatsapp').on('click', function () {
    jQuery(this).parent().toggleClass('show');
    jQuery('.chat-content').addClass('atended');
  });
  jQuery('.closechat').on('click', function () {
    jQuery('.mod-whatsapp').toggleClass('show');
  });
  jQuery('.open-contacto').on('click', function () {
    jQuery(this).toggleClass('active');
    jQuery('body').toggleClass('contacto-active');
  });
  jQuery('.panel .btn-close').on('click', function () {
    jQuery('body').removeClass('contacto-active');
    jQuery('.open-contacto').removeClass('active');
  });

  //Bottones del floater_banner
  jQuery('.btn-share').on('click', function () {
    jQuery('#mod-socialshare').toggleClass('active');
  });
  jQuery('a[data-toggle=custom-modal]').on ('click', function (e) {
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
  jQuery('.scrollto').on('click', function () {
    var addressValue = jQuery(this).attr("href");
    jQuery("html, body").animate( {
      scrollTop: jQuery(addressValue).offset().top - 100},
      300);
  });
  //Boton al top del sitio
  jQuery('.btn-totop').on('click', function () {
    jQuery("html,body").animate({
      scrollTop: 0
    }, 300);
  });

  
  //floater banner
  /*  jQuery(document).on('ready', function (e) {
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
  */
 
  /*
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
          "message": "Utilizamos cookies propias y de terceros para realizar el análisis de la navegación de los usuarios y mejorar nuestros servicios. Si continúa navegando, consideramos que acepta su uso.",
          "dismiss": "Si, continuar",
          "link": "Más Información.",
          "href": "/politica-de-cookies"
        }
      })
    });
  */


  /*  
    //Letras https://textillate.js.org/
    jQuery('.tlt').textillate({ 
        in: { effect: 'splat' },
        out: { effect: 'fadeIn', sync: true },
        loop: true
    });
*/
  //    jQuery('*[rel=tooltip]').tooltip();

  //InfiniteScroll
  /*
  jQuery('.container').infiniteScroll({
    // options
    path: '.pagination_next',
    append: '.post',
    history: false,
  });*/


  //Slider
  /*
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
  */


  /*
  // Social Share
  jQuery("#share").jsSocials({
    showLabel: false,
    showCount: false,
    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
  });*/

  /*
  //affix para barra header calculando altura del div anterior
  jQuery(".bar-prodmenu").sticky({
    topSpacing: 60
  });
  */

  /*
      jQuery(window).scroll(function() {
          if (jQuery(document).height() <= (jQuery(window).height() + jQuery(window).scrollTop())) {
              //Bottom Reached
              jQuery('.mod-poll').addClass('open');
          }
      });
  
      

  //Random de listados para banners
  jQuery(function () {
    var random = Math.floor(Math.random() * jQuery('.random-quote').length);
    jQuery('.random-quote').eq(random).show();
  });

      */


  //lazyload
  /*
  jQuery(".lazy").lazyload({
    effect: 'fadeIn',
    effectTime: 500,
    threshold: 200
  });*/

  //btn video
  /*
  jQuery('.videohover').on('click', function () {
    var myPlayer = videojs('vid1');
    myPlayer.play();
    jQuery(this).hide();
  });*/
});

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