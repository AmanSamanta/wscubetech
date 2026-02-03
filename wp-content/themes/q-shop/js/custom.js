jQuery(document).ready(function ($) {

	"use strict";

	// Mobile Menu Toggle
	$('.mobile-menu-icon').on('click', function (e) {
		e.preventDefault();
		var $menu = $('#mobile-menu');
		var isExpanded = $(this).attr('aria-expanded') === 'true';
		$(this).attr('aria-expanded', !isExpanded);
		$menu.toggleClass('active');
		$('.mobile-menu-overlay').toggleClass('active');
		$('body').toggleClass('menu-open');
	});

	// Close menu when clicking overlay or close button
	$('.mobile-menu-overlay, .mobile-menu-close').on('click', function () {
		$('.mobile-menu, .mobile-menu-overlay, body').removeClass('active menu-open');
	});

	// Close menu with escape key
	$(document).on('keydown', function (e) {
		if (e.key === 'Escape' && $('.mobile-menu').hasClass('active')) {
			$('.mobile-menu-icon').click().focus();
		}
	});

	// Mobile Menu Dropdown
	$('.mobile-menu .menu-item-has-children > a').on('click', function (e) {
		e.preventDefault();
		$(this).parent().toggleClass('active');
		$(this).next('.sub-menu').slideToggle();
	});

	// Masonry

	var wrapperWidth = $('.wrapper').width();

	if ($('.masonry-posts').length) {

		if (wrapperWidth == 1400) {

			var $grid = $('.masonry-posts').masonry({
				itemSelector: 'article.medium-post',
				columnWidth: 437,
				gutter: 44
			});

		} else if (wrapperWidth == 1200) {

			var $grid = $('.masonry-posts').masonry({
				itemSelector: 'article.medium-post',
				columnWidth: 374,
				gutter: 39
			});

		} else if (wrapperWidth == 960) {

			var $grid = $('.masonry-posts').masonry({
				itemSelector: 'article.medium-post',
				columnWidth: 296,
				gutter: 36
			});

		} else if (wrapperWidth == 700) {

			var $grid = $('.masonry-posts').masonry({
				itemSelector: 'article.medium-post',
				columnWidth: 214,
				gutter: 29
			});

		}

		if (wrapperWidth > 320) {

			if (typeof $grid.imagesLoaded === 'function') {
				$grid.imagesLoaded().progress(function () {
					$grid.masonry('layout');
				});
			} else {
				$grid.masonry('layout');
			}

		}

		// Masonry On Browser Resize
		$(window).resize(masonResize);

		function masonResize() {

			var wrapperWidth = $('.wrapper').width();
			var $grid;

			if (wrapperWidth == 1400) {

				$grid = $('.masonry-posts').masonry({
					itemSelector: 'article.medium-post',
					columnWidth: 437,
					gutter: 44
				});

			} else if (wrapperWidth == 1200) {

				$grid = $('.masonry-posts').masonry({
					itemSelector: 'article.medium-post',
					columnWidth: 374,
					gutter: 39
				});

			} else if (wrapperWidth == 960) {

				$grid = $('.masonry-posts').masonry({
					itemSelector: 'article.medium-post',
					columnWidth: 296,
					gutter: 36
				});

			} else if (wrapperWidth == 700) {

				$grid = $('.masonry-posts').masonry({
					itemSelector: 'article.medium-post',
					columnWidth: 214,
					gutter: 29
				});

			}

			if (wrapperWidth > 320 && $grid && typeof $grid.imagesLoaded === 'function') {

				$grid.imagesLoaded().progress(function () {
					$grid.masonry('layout');
				});

			}

		}

	}

	// Wrap last word of page heading in thin-text span

	$('.main-page-heading, .section-title h2').each(function () {
		$(this).addClass('w-thin-text');
		var text = $(this).text().trim().split(' ');
		if (text.length > 0) {
			var lastWord = text.pop();
			text.push('<span>' + lastWord + '</span>');
			$(this).html(text.join(' '));
		}
	});

	// Wrap second word of hero heading in span

	$('.hero-text h1').each(function () {
		var words = $(this).text().trim().split(' ');
		if (words.length > 1) {
			words[1] = '<span>' + words[1] + '</span>';
			$(this).html(words.join(' '));
		}
	});

	// Toggle Hidden Sidebars

	$(document).on('click', '.add-to-cart-btn a', function (e) {
		e.preventDefault();
		$('#cart-sidebar').addClass('show-sidebar');
		$('#body-overlay-wrap').addClass('body-overlay');
		$('body').css('overflow', 'hidden');
	});

	// Open cart sidebar after AJAX add to cart

	$(document.body).on('added_to_cart', function () {
		$('#cart-sidebar').addClass('show-sidebar');
		$('#body-overlay-wrap').addClass('body-overlay');
		$('body').css('overflow', 'hidden');
	});

	$('#body-overlay-wrap').on('click', function () {
		$('#cart-sidebar').removeClass('show-sidebar');
		$('#body-overlay-wrap').removeClass('body-overlay');
		$('body').css('overflow', 'visible');
	});

	// Modal Form

	$('.sign-in-li').on('click', function () {
		$(this).toggleClass('form-closed');
		$(this).toggleClass('form-open');
		$('.modal-login-form').toggleClass('show-form');
	});

	// Sticky Header / Sidebar

	var wrapperWidth = $('.wrapper').width();

	if ($('.sticky-header').length) {

		if (wrapperWidth > 1000) {
			var lastScrollTop = 0;

			$(window).on('scroll', function () {
				var currentScroll = $(this).scrollTop();
				if (currentScroll < lastScrollTop && currentScroll > 200) {
					$('#main-header').addClass('stick-it');
				} else {
					$('#main-header').removeClass('stick-it');
				}
				lastScrollTop = currentScroll;
			});

		}

		$('.sidebar-wrap').addClass('header-sticking');

	}

	// Mobile Nav
	$('#menu-icon').on('click', function () {
		$('#main-nav').slideToggle(250);
	});

	$(window).resize(function () {
		var w = $(window).width();
		var navDisplay = $('#main-nav');
		if (w > 1010 && navDisplay.is(':hidden')) {
			navDisplay.removeAttr('style');
		}
	});

	$('#main-nav .menu-item-has-children, #hidden-sidebar .menu-item-has-children').append('<span class="menu-arrow"></span>');

	$('.menu-arrow').on('click', function () {
		$(this).toggleClass('menu-children-visible').closest('li').toggleClass('menu-children-visible');
	});

	// Toggle Hidden Sidebar

	$('#hidden-sidebar-icon').on('click', function () {
		$('#hidden-sidebar-wrap').slideToggle(250);
		$(this).toggleClass('visible-sidebar');
		$('#body-overlay-wrap').toggleClass('body-overlay');
		$('body').css('overflow', 'hidden');
	});

	$('#body-overlay-wrap, .hidden-sidebar-close').on('click', function () {
		$('#body-overlay-wrap').removeClass('body-overlay');
		$('#hidden-sidebar-wrap').slideUp(250);
		$('#hidden-sidebar-icon').removeClass('visible-sidebar');
		$('body').css('overflow', 'visible');
	});

	// Search Forms
	var $navFormValue = $('#modal-search #s').val();

	$('#modal-search #s').blur(
		function () {
			if (this.value.length === 0) {
				this.value = $navFormValue;
			}
		}
	);

	$('#modal-search #s').focus(
		function () {
			if (this.value === $navFormValue) {
				this.value = '';
			}
		}
	);

	var $formValue = $('.widget #s').val();

	$('.widget #s').blur(
		function () {
			if (this.value.length === 0) {
				this.value = $formValue;
			}
		}
	);

	$('.widget #s').focus(
		function () {
			if (this.value === $formValue) {
				this.value = '';
			}
		}
	);

	var $errorFormValue = $('.error-wrap #s').val();

	$('.error-wrap #s').blur(
		function () {
			if (this.value.length === 0) {
				this.value = $errorFormValue;
			}
		}
	);

	$('.error-wrap #s').focus(
		function () {
			if (this.value === $errorFormValue) {
				this.value = '';
			}
		}
	);

	// Toggle Header Search From
	$('#header-search-icon').on('click', function () {
		var isExpanded = $(this).attr('aria-expanded') === 'true';
		$(this).attr('aria-expanded', !isExpanded);
		$(this).toggleClass('search-show');
		$('.m-search-close').toggleClass('search-show');
		$('#modal-search').toggleClass('search-show');
		$('body').css('overflow', 'hidden');
	});

	$('.m-search-close').on('click', function () {
		$(this).toggleClass('search-show');
		$('#header-search-icon').toggleClass('search-show');
		$('#modal-search').toggleClass('search-show');
		$('body').css('overflow', 'visible');
	});

	$(document).on('keydown', function (e) {
		if (e.key === 'Escape' && $('#modal-search').hasClass('search-show')) {
			$('.m-search-close').toggleClass('search-show');
			$('#header-search-icon').toggleClass('search-show');
			$('#modal-search').toggleClass('search-show');
			$('body').css('overflow', 'visible');
		}
	});

	// WooCommerce Single Product
	$('.single-product .summary, .single-product .woocommerce-tabs').wrapAll('<div class="single-prod-right"></div>');

	$('.single-product .images').wrapAll('<div class="single-prod-left"></div>');

	$('.single-prod-right, .single-prod-left').wrapAll('<div id="single-prod-sticky" class="group"></div>');

	// Move .onsale badge into .single-prod-left if it's the first child of .product
	$('.onsale').each(function () {
		if ($(this).parent().hasClass('product') && $(this).index() === 0) {
			$(this).appendTo('.single-prod-left');
		}
	});

	// Button share
	$('.button-share').on('click', function (e) {
		$(this).children('.button-share-icons').toggleClass('share-show');
		$(this).children('.share-span').toggleClass('share-active');
	});

	// Contact Form
	if ($('.contact-us .entry .wpcf7').length) {
		$('.contact-us .entry .wpcf7').wrap('<div class="right-contact-form"></div>');
		$('.contact-us .entry > *').not('.right-contact-form').wrapAll('<div class="left-contact-text"></div>');
	}

	// Fade In #back-to-top
	$(window).scroll(function () {
		var footer = $('#main-footer');
		var scrollPosition = $(window).scrollTop() + $(window).height();
		var footerPosition = footer.offset().top;

		if (scrollPosition > (footerPosition + 120)) {
			$('#back-to-top').addClass('show-back-top');
		} else {
			$('#back-to-top').removeClass('show-back-top');
		}
	});

	// Scroll body to 0px on click
	$('#back-to-top').on('click', function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	// WooCommerce Quantity Buttons
	if (!String.prototype.getDecimals) {
		String.prototype.getDecimals = function () {
			var num = this,
				match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
			if (!match) {
				return 0;
			}
			return Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
		}
	}

	$(document).on('click', '.plus, .minus', function () {

		var $qty = $(this).closest('.quantity').find('.qty'),
			currentVal = parseFloat($qty.val()),
			max = parseFloat($qty.attr('max')),
			min = parseFloat($qty.attr('min')),
			step = $qty.attr('step');

		if (!currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
		if (max === '' || max === 'NaN') max = '';
		if (min === '' || min === 'NaN') min = 0;
		if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

		if ($(this).is('.plus')) {
			if (max && (currentVal >= max)) {
				$qty.val(max);
			} else {
				$qty.val((currentVal + parseFloat(step)).toFixed(step.getDecimals()));
			}
		} else {
			if (min && (currentVal <= min)) {
				$qty.val(min);
			} else if (currentVal > 0) {
				$qty.val((currentVal - parseFloat(step)).toFixed(step.getDecimals()));
			}
		}

		$qty.trigger('change');
	});

});