function scrollToTop(duration) {
	const start = window.pageYOffset;
	const startTime = performance.now();

	function animateScroll(currentTime) {
		const elapsed = currentTime - startTime;
		const progress = Math.min(elapsed / duration, 1);
		const ease = 1 - Math.pow(1 - progress, 3);
		window.scrollTo(0, start * (1 - ease));

		if (progress < 1) {
			requestAnimationFrame(animateScroll);
		}
	}

	requestAnimationFrame(animateScroll);
}

document.addEventListener("DOMContentLoaded", function () {

	//Alerts
	const alerts = document.querySelectorAll(".alert");
	alerts.forEach(function (alert) {
		setTimeout(function () {
			alert.style.transition = "height 0.3s ease, opacity 0.5s ease";
			alert.style.height = "0";
			alert.style.opacity = "0";

			setTimeout(function () {
				if (alert.parentNode) {
					alert.parentNode.removeChild(alert);
				}
			}, 600);
		}, 2000);
	});

	//Scroll to Top
	const scrollBtn = document.querySelector('.scroll-top');

	scrollBtn.addEventListener('click', () => {
		scrollToTop(500);
	});

	window.addEventListener('scroll', () => {
		if (window.scrollY > 100) {
			scrollBtn.style.display = 'block';
		} else {
			scrollBtn.style.display = 'none';
		}
	});

	//Dashboard Forms
	const buttons = document.querySelectorAll('.form-toggle button');
	const forms = document.querySelectorAll('.form-container');

	const pathParts = window.location.pathname.split('/');
	const currentForm = pathParts[2] || 'orders';

	buttons.forEach(btn => {
		btn.classList.toggle('active', btn.dataset.form === currentForm);
	});

	forms.forEach(form => {
		form.classList.toggle('active', form.id === currentForm);
	});

	buttons.forEach(btn => {
		btn.addEventListener('click', () => {
			const form = btn.dataset.form;
			window.location.href = `/dashboard/${form}`;
		});
	});

});

AOS.init({

 	duration: 800,
 	easing: 'slide',
 	once: false
 });

jQuery(document).ready(function($) {

	"use strict";

	
	var siteMenuClone = function() {

		$('.js-clone-nav').each(function() {
			var $this = $(this);
			$this.clone().attr('class', 'site-nav-wrap').appendTo('.site-mobile-menu-body');
		});


		setTimeout(function() {
			
			var counter = 0;
      $('.site-mobile-menu .has-children').each(function(){
        var $this = $(this);
        
        $this.prepend('<span class="arrow-collapse collapsed">');

        $this.find('.arrow-collapse').attr({
          'data-toggle' : 'collapse',
          'data-target' : '#collapseItem' + counter,
        });

        $this.find('> ul').attr({
          'class' : 'collapse',
          'id' : 'collapseItem' + counter,
        });

        counter++;

      });

    }, 1000);

		$('body').on('click', '.arrow-collapse', function(e) {
      var $this = $(this);
      if ( $this.closest('li').find('.collapse').hasClass('show') ) {
        $this.removeClass('active');
      } else {
        $this.addClass('active');
      }
      e.preventDefault();  
      
    });

		$(window).resize(function() {
			var $this = $(this),
				w = $this.width();

			if ( w > 768 ) {
				if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
			}
		})

		$('body').on('click', '.js-menu-toggle', function(e) {
			var $this = $(this);
			e.preventDefault();

			if ( $('body').hasClass('offcanvas-menu') ) {
				$('body').removeClass('offcanvas-menu');
				$this.removeClass('active');
			} else {
				$('body').addClass('offcanvas-menu');
				$this.addClass('active');
			}
		}) 

		$(document).mouseup(function(e) {
	    var container = $(".site-mobile-menu");
	    if (!container.is(e.target) && container.has(e.target).length === 0) {
	      if ( $('body').hasClass('offcanvas-menu') ) {
					$('body').removeClass('offcanvas-menu');
				}
	    }
		});
	}; 
	siteMenuClone();

});