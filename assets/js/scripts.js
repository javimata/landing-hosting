/**
 * Scripts base
 * Author Javi_Mata <javimata@gmail.com>
 */

(function ($) {
	
	$(document).ready(function(){

		var jam_gotop = $('body').data("gotop");
		var jam_popup = $('body').data("popup");
		var jam_particlesFooter = $('body').data("particles");

		AOS.init({
			easing: 'ease-out-back',
			duration: 1000,
			once: false
		});

		if ( $('.slide-logos').length > 0 ) {

			$('.slide-logos').on('init', function (event, slick) {
				$(this).fadeIn();
			});

			$('.slide-logos').slick({
				autoplay: true,
				slidesToShow: 6,
				slidesToScroll: 1,
				infinite: true,
				adaptiveHeight: false,
				centerMode: false,
				centerPadding: '60px',
				variableWidth: false,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 4
						}
					},
					{
						breakpoint: 480,
						settings: {
							arrows: false,
							centerMode: true,
							centerPadding: '40px',
							slidesToShow: 3
						}
					}
				]
			});
		}

		$('ul.menu-movil a').on('click', function(){
			$(".navbar-toggler").click();
		});

		$(".card-paquetes .card-header").matchHeight({
			byRow: false
		});

		$(".box-paquete-features").matchHeight({
			byRow: false
		});
		
		$(".box-paquete-notes").matchHeight({
			byRow: false
		});

		if ($('.floating').length > 0) {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$(".floating").addClass('sticky-top');
				} else {
					$(".floating").removeClass('sticky-top');
				}
			});
		}
		if ($('.floating-messenger').length > 0) {
			$(window).scroll(function () {
				if ($(this).scrollTop() > 100) {
					$(".floating-messenger").addClass('sticky-top');
				} else {
					$(".floating-messenger").removeClass('sticky-top');
				}
			});
		}

		// $("#popup_cotiza").modal();

		$("#popup_cotiza").on("show.bs.modal", function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var title = button.data("title")
				subtitle = button.data("subtitle");
			var modal = $(this);
			modal.find(".nombre-producto").empty().text(title);
			modal.find(".subtitle").empty().text(subtitle);
			modal.find('input#producto').attr("value",title);
			$.fancybox.close();
		});


		/**
         * Asigna una clase en base al tipo de enlace
         */
		$('a[href^=tel]').addClass("link-phone");
		$('a[href^=mailto]').addClass("link-email").attr("target", "_blank");
		$('a[href*="wa.me"]').addClass("link-whatsapp").attr("target", "_blank");
		$('a[href*="m.me"]').addClass("link-messenger").attr("target", "_blank");
		$('a[href*="maps.google"]').addClass("link-map").attr("target", "_blank");

		// Manejo de Eventos
		$('.link-phone').click(function () {
			if (typeof gtag == 'function') {
				gtag('event', 'click', { 'event_category': 'telefono', 'event_label': 'llamada' });
			};
			if (typeof ga == 'function') {
				ga('send', 'event', 'telefono', 'click', 'llamada');
			};
			if (typeof fbq == 'function') {
				fbq('track', 'Lead', { content_name: 'telefono' });
			};
		});

		$('.link-email').click(function () {
			if (typeof gtag == 'function') {
				gtag('event', 'click', { 'event_category': 'email', 'event_label': 'envio' });
			}
			if (typeof ga == 'function') {
				ga('send', 'event', 'email', 'click', 'envio');
			};
			if (typeof fbq == 'function') {
				fbq('track', 'Lead', { content_name: 'email' });
			};
		});

		$('.link-whatsapp').click(function () {
			if (typeof gtag == 'function') {
				gtag('event', 'click', { 'event_category': 'telefono', 'event_label': 'whatsapp' });
			}
			if (typeof ga == 'function') {
				ga('send', 'event', 'telefono', 'click', 'whatsapp');
			};
			if (typeof fbq == 'function') {
				fbq('track', 'Lead', { content_name: 'whatsapp' });
			};
		});

		$('.link-messenger').click(function () {
			if (typeof gtag == 'function') {
				gtag('event', 'click', { 'event_category': 'telefono', 'event_label': 'messenger' });
			}
			if (typeof ga == 'function') {
				ga('send', 'event', 'telefono', 'click', 'messenger');
			};
			if (typeof fbq == 'function') {
				fbq('track', 'Lead', { content_name: 'messenger' });
			};
		});


		$('.link-map').click(function () {
			if (typeof gtag == 'function') {
				gtag('event', 'click', { 'event_category': 'site', 'event_label': 'map' });
			}
			if (typeof ga == 'function') {
				ga('send', 'event', 'site', 'click', 'map');
			};
			if (typeof fbq == 'function') {
				fbq('track', 'Lead', { content_name: 'map' });
			};

		});


		/**
		 * Agrega el botón de regresar arriba
		 */
		if( jam_gotop == 1 ){
			$(window).scroll(function(){
				if($(this).scrollTop()>100){
					$('.scrollup').fadeIn();
				}else{
					$('.scrollup').fadeOut(400);
				}
			});
			$('.scrollup,.navbar-brand').click(function(){
				$("html, body").animate({scrollTop:0},600);
				return false;
			});
		};

		if ( jam_particlesFooter == 1 ) {
			particlesJS.load('particles-footer', 'assets/particlesfooter-config.json', function () { });
		};


		/**
		 * Agrega sticky
		*/
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('section#header').addClass("sticky");
			} else {
				$('section#header').removeClass("sticky");
			}
		});

		$('#navbarMain2').on('show.bs.collapse', function () {
			$('section#header').addClass("opened");
		});

		$('#navbarMain2').on('hidden.bs.collapse', function () {
			$('section#header').removeClass("opened");
		});
		
		/**
		 * Agrega la navegación scroll de una sola página
		 * Se deben agregar los enlaces con el hash # y el ID de la sección a enlazar
		 * las opciones .not son los negativos a agregar como enlaces de scroll
		 */
		$('a[href*="#"]')
			// Remove links that don't actually link to anything
			.not('[href="#"]')
			.not('[href="#0"]')
			.not('[data-toggle="collapse"]')
			.click(function(event) {
				// On-page links
				if (
				location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
				&& 
				location.hostname == this.hostname
				) {
				// Figure out element to scroll to
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
				// Does a scroll target exist?
				if (target.length) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					// var offsetpos = (target.offset().top - 290);
					// alert( target + offsetpos );
					$('html, body').animate({
					scrollTop: target.offset().top
					}, 1000, function() {
					// Callback after animation
					// Must change focus!
					var $target = $(target);
					//$target.focus();
					if ($target.is(":focus")) { // Checking if the target was focused
						return false;
					} else {
						$target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
					//$target.focus(); // Set focus again
					};
					});
				}
			}
		});

		/**
		 * Formularios
		 */
		$("form").on('submit',function(e){
			e.preventDefault();
			
			var $form     = $(this),
			    url       = $(this).attr("action"),
			    id        = $(this).attr("id"),
			    cajaError = $("#" + id + " .caja_error"),
			    errores   = 0;

			cajaError.empty().removeClass("alert alert-info");

			var datosForm = $form.serialize();

			if (errores!=1){

				$("#" + id + " button.btn").attr("disabled","disabled");

				$.ajax({ 
					method: "POST",
					url: url,
					data: datosForm + "&a=1&form="+id,
					dataType: "json",
					success: function( data ) {
						if (parseInt(data.respuesta)==1){
							cajaError.empty().addClass("alert alert-info").append(data.texto_respuesta);
							$("#" + id + " button.btn").removeAttr("disabled");
							$("#" + id)[0].reset();

							if (typeof gtag == 'function') {
								gtag('event', 'click', { 'event_category': 'formulario', 'event_label': id });
							};
							if (typeof ga == 'function') {
								ga('send', 'event', 'formulario', 'click', id);
							};
							if (typeof fbq == 'function') {
							}

						}else{
							alert(data.texto_respuesta);
							$("#" + id + " button.btn").removeAttr("disabled");
						};
					}
				});

				
			}else{
				$("#" + id + " button.btn").removeAttr("disabled");

			};

		});





		/**
		 * Crea y obtiene cookies
		 * Para crear una cookie se envía la siguiente información
		 * @param {string} cname Nombre de la cookie
		 * @param {string} cvalue Valor de la cookie a crear
		 * @param {number} exdays Dias de vida de la cookie
		 * 
		 * Para obtener una cookie se solicita por su nombre, ejemplo:
		 * getCookie("nombre")
		 */
		function setCookie(cname, cvalue, exdays) {
			var d = new Date();
			d.setTime(d.getTime() + (exdays * 60 * 1000));
			var expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return "";
		}


		/**
		 * Maneja el loading ocultandolo al terminar de cargar el sitio
		 */
		if ( $('.loading').length > 0 ) {
			$('.loading').delay(3000).fadeOut(1000, function(){
				$(this).remove();
			});
		}

	});

})(jQuery);
