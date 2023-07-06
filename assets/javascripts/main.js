var $scrolling_section_is_active = false;

jQuery(document).ready(function ($) {
	website_spacings();
	image_to_svg();
	swiper_slider();
	modal_trigger();
	thumb_swiper();
	variation_radio();
	quantity_plus_minus();
	parallax();
	/*mobile_menu();*/
	drone_animation();
	setTimeout(function () {
		if (window.innerWidth > 991) {
			scrolling_section();
			scrolling_section_v2();
		}
	}, 1000);

	load_more_button_listener();

	ajax_form();

	tab_columns();

	elementor_slider();

	open_enquire_tab();

	sidecart();

	heyflow_button();
	
});

function image_center_tab() {
	if (window.innerWidth < 992) {

	}
}

function heyflow_button() {
	if (jQuery('a[heyflow="true"]').length > 0) {
		jQuery('a[heyflow="true"]').click(function (e) {
			e.preventDefault();

		});
	}
}



function sidecart() {


	jQuery('body').on("click", '.added_to_cart', function (e) {
		show_sidecart();
		e.preventDefault();
	});

	jQuery('body').on('added_to_cart', function () {
		if (!jQuery('body').hasClass('elementor-editor-active')) {
			show_sidecart();
		}
	});
}

function show_sidecart() {
	var $offCanvasSideCart = document.getElementById('offCanvasSideCart');
	var $bsOffcanvas = new bootstrap.Offcanvas($offCanvasSideCart)
	$bsOffcanvas.show();
}

function open_enquire_tab() {
	if (jQuery('#product-enquire-now').length > 0) {
		jQuery('.open-enquire-tab').click(function (e) {
			jQuery('.enquire_now_tab a').click();

		});
	}
}

function tab_columns() {
	jQuery('.tabs-center-content .nav-link').click(function (e) {
		jQuery('.tabs-center-content .nav-link').removeClass('active');
		jQuery(this).addClass('active');
	});
}

function ajax_form() {
	jQuery(".archive-form-filter").change(function (e) {
		e.preventDefault();
		ajax(0);
	});

	var typingTimer;
	var doneTypingInterval = 500;

	jQuery('.archive-section #search').on('keyup', function () {
		clearTimeout(typingTimer);
		typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	jQuery('.archive-section #search').on('keydown', function () {
		clearTimeout(typingTimer);
	});

	function doneTyping() {
		ajax();
	}
}

function load_more_button_listener($) {
	jQuery(document).on("click", '#load-more', function (event) {
		event.preventDefault();
		var offset = jQuery('.post-item').length;
		ajax(offset, 'append');
	});

	jQuery(document).on("click", '#load-more-careers', function (event) {
		event.preventDefault();
		var offset = jQuery('.post-item').length;
		careers_ajax(offset, 'append');
	});
}

function ajax($offset, $event_type = 'html') {
	var $loadmore = jQuery('#load-more');

	var $archive_section = jQuery('.archive-section');

	var $result_holder = jQuery('#results .results-holder');

	var $post_type = jQuery("input[name='post-type']").val();

	var $taxonomy = jQuery("input[name='taxonomy']").val();

	var $is_search = jQuery("input[name='is_search']").val();

	var $s = jQuery("input[name='s']").val();

	var $terms_category = jQuery("input[name='terms-category']").val();

	var $terms_value = "";



	var $terms = jQuery("input[name='terms[]']:checked");
	$terms.each(function () {
		$terms_value += jQuery(this).val() + ",";
	});

	var $post_types_value = "";

	var $post_types = jQuery("input[name='post_types[]']:checked");
	$post_types.each(function () {
		$post_types_value += jQuery(this).val() + ",";
	});




	$loading = jQuery('<div class="loading-results"> <svg class="spin" xmlns="http://www.w3.org/2000/svg" id="Group_27" data-name="Group 27" width="123" height="123" viewBox="0 0 123 123"> <g id="Ellipse_2" data-name="Ellipse 2" fill="none" stroke="#2DA1FF" stroke-width="2"> <circle cx="61.5" cy="61.5" r="61.5" stroke="none"></circle> <circle cx="61.5" cy="61.5" r="60.5" fill="none"></circle> </g> <circle id="Ellipse_8" data-name="Ellipse 8" cx="6.5" cy="6.5" r="6.5" transform="translate(30 55)" fill="none" stroke="#2DA1FF" stroke-width="3"></circle> <circle id="Ellipse_9" data-name="Ellipse 9" cx="6.5" cy="6.5" r="6.5" transform="translate(55 55)" fill="none" stroke="#2DA1FF" stroke-width="3"></circle> <circle id="Ellipse_10" data-name="Ellipse 10" cx="6.5" cy="6.5" r="6.5" transform="translate(80 55)" fill="none" stroke="#2DA1FF" stroke-width="3"></circle> </svg></div>');

	$archive_section.addClass('loading-post');

	if ($event_type == 'html') {
		jQuery('#results  .results-holder').html($loading);
		$loadmore.addClass('d-none');
	} else {
		$loadmore.addClass('loading');
		$loadmore.find('span').text('Loading');
	}

	jQuery.ajax({

		type: "POST",

		//url: "/coptrz/wp-admin/admin-ajax.php",

		url: "/wp-admin/admin-ajax.php",

		data: {

			action: 'archive_ajax',

			post_type: $post_type,

			taxonomy: $taxonomy,

			is_search: $is_search,

			terms: $terms_value,

			post_types: $post_types_value,

			terms_category: $terms_category,

			s: $s,

			offset: $offset

		},

		success: function (response) {
			if ($event_type == 'append') {
				$result_holder_row = $result_holder.find('.row');
				jQuery(response).appendTo($result_holder_row);
			} else {
				$result_holder.html(response);
			}
			$loadmore.removeClass('d-none loading');

			$loadmore.find('span').text('Load more');

			$archive_section.removeClass('loading-post');

		},
		error: function (e) {
			console.log(e);
		}

	});
}


function ajax_product($product_id, $button) {



	$button.addClass('loading');


	var $result_holder = jQuery('#productModal #productModalDetails');

	jQuery.ajax({

		type: "POST",

		//url: "/coptrz/wp-admin/admin-ajax.php",

		url: "/wp-admin/admin-ajax.php",

		data: {

			action: 'product_modal_ajax',

			product_id: $product_id

		},


		success: function (response) {
			$result_holder.html(response);
			image_to_svg();

			if (window.innerWidth < 1200) {
				jQuery('.product-add-to-cart-holder').appendTo('.product-summary .col-lg-7 .column-holder');
			}

			setTimeout(function () {
				thumb_swiper();
				variation_radio();
				jQuery('html').addClass('product-modal-active');
				$button.removeClass('loading');
			}, 1000);
		},
		error: function (e) {
			console.log(e);
		}


	});
}

function drone_animation() {
	let $banner = document.getElementById('hero-banner');

	if ($banner) {
		$banner.addEventListener("mousemove", e => {
			let x = e.clientX;
			let y = e.clientY;
			gsap.to('.animated-image-1', {
				x: x * 0.08,
				y: y * 0.16,
				duration: 1
			})
			gsap.to('.animated-image-2', {
				x: -x * 0.1,
				y: -y * 0.15,
				duration: 1
			})
		})
	}
}

function mobile_menu() {
	var coptrMenu = document.getElementById('coptrzMenu');
	coptrMenu.addEventListener('hidden.bs.offcanvas', function () {
		jQuery('html').removeClass('mobile-menu-active');
	})
	coptrMenu.addEventListener('show.bs.offcanvas', function () {
		jQuery('html').addClass('mobile-menu-active');
	})
}

function modal_trigger() {
	if (window.innerWidth > 991) {
		jQuery('.navbar-nav > li').each(function (index, element) {
			var $this = jQuery(this);
			if ($this.hasClass('anchor-modal')) {
				jQuery(this).hover(function (e) {
					jQuery('html').addClass('shop-modal-open');
				});
			} else {
				jQuery(this).hover(function (e) {
					jQuery('html').removeClass('shop-modal-open');
				});
			}
		});

		jQuery('.menu-modal-backdrop').hover(function (e) {
			jQuery('html').removeClass('shop-modal-open');
		});
	}


	jQuery(document).on("click", '.product-modal-trigger-open', function (event) {
		event.preventDefault();
		$product = jQuery(this).attr('product');
		ajax_product($product, jQuery(this));
	});

	jQuery(document).on("click", '.close-button', function (event) {
		event.preventDefault();
		jQuery('html').removeClass('product-modal-active');
	});


}
function scrolling_section() {
	var $scrolling_section = jQuery('.scrolling-section');
	if ($scrolling_section.length > 0) {
		var $scrolling_section_height = $scrolling_section.outerHeight();
		var $sticky = $scrolling_section.find('.col-left');
		var $sticky_height = $sticky.find('.col-inner').outerHeight();
		var $scrolling_section_position = $scrolling_section.offset().top;
		var $total_height = $scrolling_section_position + $scrolling_section_height - $sticky_height;
		var $sticky_width = $sticky.width();
		$sticky.find('.col-inner').css('width', $sticky_width);
		jQuery(window).scroll(function () {
			var $scroll = jQuery(window).scrollTop();
			if ($scroll >= $scrolling_section_position && $scroll < $total_height) {
				$scrolling_section.addClass('left-side-sticky');
				$scrolling_section.removeClass('left-side-absolute');
				$scrolling_section_is_active = true;
			} else if ($scroll >= $total_height) {
				$scrolling_section.addClass('left-side-absolute');
				$scrolling_section_is_active = false;
			} else {
				$scrolling_section.removeClass('left-side-sticky');
				$scrolling_section_is_active = false;
			}
		});
	}
}

function scrolling_section_v2() {
	var $scrolling_section = jQuery('.scrolling-section-v2');
	if ($scrolling_section.length > 0) {
		var $scrolling_section_height = $scrolling_section.outerHeight();
		var $sticky = $scrolling_section.find('.col-right');
		var $sticky_height = $sticky.find('.column-holder').outerHeight();
		var $scrolling_section_position = $scrolling_section.offset().top;
		var $total_height = $scrolling_section_position + $scrolling_section_height - $sticky_height;
		var $sticky_width = $sticky.width();
		$sticky.find('.column-holder').css('width', $sticky_width);
		jQuery(window).scroll(function () {
			var $scroll = jQuery(window).scrollTop();
			if ($scroll >= $scrolling_section_position && $scroll < $total_height) {
				$scrolling_section.addClass('left-side-sticky');
				$scrolling_section.removeClass('left-side-absolute');
				$scrolling_section_is_active = true;
			} else if ($scroll >= $total_height) {
				$scrolling_section.addClass('left-side-absolute');
				$scrolling_section_is_active = false;
			} else {
				$scrolling_section.removeClass('left-side-sticky');
				$scrolling_section_is_active = false;
			}
		});
	}
}

var $lastScrollTop = 0;
jQuery(window).scroll(function ($) {
	var $scroll = jQuery(window).scrollTop();
	if ($scroll != 0) {
		if ($scroll > $lastScrollTop) {
			jQuery('body').addClass('scrolled-down');
			jQuery('body').removeClass('scrolled-up scrolled-top');
			if (window.innerWidth > 991) {
				jQuery('html').removeClass('shop-modal-open');
			}
		} else {
			jQuery('body').addClass('scrolled-up');
			jQuery('body').removeClass('scrolled-down');
			if ($scroll > 700) {
				if ($scrolling_section_is_active == false) {
					jQuery('body').addClass('scrolled-up');
					jQuery('body').removeClass('scrolled-down scrolled-top');
				} else {
					jQuery('body').addClass('scrolled-down');
					jQuery('body').removeClass('scrolled-up scrolled-top');
				}
			}
		}
	} else {
		jQuery('body').removeClass('scrolled-up scrolled-down');
		jQuery('body').addClass('scrolled-top');
	}
	$lastScrollTop = $scroll;

	scrolling_section_active($scroll);

});

function scrolling_section_active($scroll) {
	if (window.innerWidth > 992) {
		jQuery('.featured-post-image').each(function (index, element) {
			var $scroll_top = jQuery(this).offset().top;
			var $data_target = jQuery(this).attr('data-target');
			var $height = jQuery(this).outerHeight();
			if ($scroll > $scroll_top && $scroll < $scroll_top + $height) {
				jQuery('.featured-post').removeClass('active');
				jQuery($data_target).addClass('active');
			}
		});
	}
}

function elementor_slider() {
	jQuery('body:not(.elementor-editor-active) .elementor-swiper-slider-js > div').addClass('swiper-wrapper');
	$pagination = jQuery('<div class="swiper-pagination swiper-pagination-elementor"></div>');
	$pagination.insertAfter('.elementor-swiper-slider-js .swiper-wrapper');
	setTimeout(function () {
		var elementorSlider = new Swiper(".elementor-swiper-slider-js", {
			loop: false,
			spaceBetween: 0,
			slidesPerView: 1,
			autoplay: false,
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			},

		});

	}, 1000);
	jQuery('body:not(.elementor-editor-active) .elementor-swiper-slider-js-vertical > div').addClass('swiper-wrapper');
	$pagination = jQuery('<div class="swiper-pagination swiper-pagination--vertical swiper-pagination-elementor"></div>');
	$pagination.insertAfter('.elementor-swiper-slider-js-vertical .swiper-wrapper');
	setTimeout(function () {
		if (window.innerWidth > 991) {
			var $direction = 'vertical';
		} else {
			var $direction = 'horizontal';
		}

		var elementorSliderVertical = new Swiper(".elementor-swiper-slider-js-vertical", {
			loop: false,
			slidesPerView: 1,
			direction: $direction,
			autoHeight: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: true,
			},
			pagination: {
				el: ".swiper-pagination--vertical",
				clickable: true
			},
		});

	}, 1000);




}


function swiper_slider() {


	var logoSwiper = new Swiper(".mySwiper-logoSwiper", {
		loop: true,
		freeMode: true,
		centeredSlides: true,
		speed: 5000,
		autoplay: {
			delay: 0,
			disableOnInteraction: false
		},
		breakpoints: {
			0: {
				slidesPerView: 3,
			},

			992: {
				slidesPerView: 4,
			},


		},

	});

	var vendorSwiper = new Swiper(".mySwiper-vendorSwiper", {
		loop: false,
		spaceBetween: 20,
		autoplay: false,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 2,
			},


			576: {
				slidesPerView: 3,
			},

			768: {
				slidesPerView: 4,
			},

			992: {
				slidesPerView: 5,
			},


			1200: {
				slidesPerView: 6,
			},

			1300: {
				slidesPerView: 6,
			},

			1400: {
				slidesPerView: 8,
			},


		},

	});

	var vendorSwiper = new Swiper(".mySwiper-vendorCategory", {
		loop: false,
		spaceBetween: 20,
		autoplay: false,
		freeMode: true,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
			},

			400: {
				slidesPerView: 2,
			},
			576: {
				slidesPerView: 3,
			},

			768: {
				slidesPerView: 'auto',
			},

		},

	});

	var vendorProduct = new Swiper(".mySwiper-productSwiper", {
		loop: false,
		spaceBetween: 20,
		autoplay: false,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
			},

			576: {
				slidesPerView: 2,
			},

			992: {
				slidesPerView: 2,
			},


			1200: {
				slidesPerView: 3,
			},


		},

	});


	var vendorProductMedium = new Swiper(".mySwiper-productSwiper-medium", {
		loop: false,
		spaceBetween: 20,
		autoplay: false,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 1,
			},

			576: {
				slidesPerView: 2,
			},

			992: {
				slidesPerView: 3,
			},


			1200: {
				slidesPerView: 4,
			},


		},

	});

	var vendorProductSmall = new Swiper(".mySwiper-productSwiper-small", {
		loop: false,
		spaceBetween: 20,
		autoplay: false,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},

		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 2,
			},

			992: {
				slidesPerView: 3,
			},


			1200: {
				slidesPerView: 5,
			},


		},

	});





	var testimonialSwiper = new Swiper(".mySwiper-Reviews", {
		loop: true,
		spaceBetween: 46,
		autoHeight: true,
		slidesPerView: 2,
		autoplay: {
			delay: 5000,
			disableOnInteraction: true,
		},

		breakpoints: {
			0: {
				slidesPerView: 1,
				spaceBetween: 20,
			},

			768: {
				slidesPerView: 2,
				spaceBetween: 20,
			},

			992: {
				slidesPerView: 2,
				spaceBetween: 46,
			},


		},

		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
	});


	var FeaturedProducts = new Swiper(".mySwiper-FeaturedProducts", {
		loop: false,
		spaceBetween: 0,
		slidesPerView: 1,
		autoplay: {
			delay: 5000,
			disableOnInteraction: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
	});


}
function thumb_swiper() {
	var swiper = new Swiper(".mySwiperThumb", {
		loop: true,
		spaceBetween: 10,
		freeMode: true,
		watchSlidesProgress: true,
		pagination: {
			el: ".swiper-pagination",
			dynamicBullets: true,
			clickable: true
		},
		breakpoints: {
			0: {
				slidesPerView: 4,
			},

			1200: {
				slidesPerView: 4,
			},
			1400: {
				slidesPerView: 5,
			},
		},
	});
	var swiper2 = new Swiper(".mySwiperMain", {
		loop: true,
		spaceBetween: 10,
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},

		thumbs: {
			swiper: swiper,
		},
	});
}


function variation_radio() {

	jQuery('.variation-radio input:first-child').prop('checked', true);
	jQuery('.is-variation-radio .variations select option:eq(1)').attr('selected', 'selected');
	$val = jQuery('.variation-radio input:first-child').val();

	jQuery('.ajax_add_to_cart').attr('data-product_id', $val);


	jQuery('.variation-radio').change(function (e) {
		$val = jQuery('input[name="variation-radio"]:checked').val();
		$product_name = jQuery('input[name="variation-radio"]:checked').attr('product-name');

		jQuery('.ajax_add_to_cart').attr('data-product_id', $val);
		jQuery('.variations select').val($product_name).change();

	});


}

function quantity_plus_minus() {
	jQuery(document).on('click', 'button.plus, button.minus', function () {
		var qty = jQuery(this).parent('.quantity').find('.qty');
		var val = parseFloat(qty.val());
		var max = parseFloat(qty.attr('max'));
		var min = parseFloat(qty.attr('min'));
		var step = parseFloat(qty.attr('step'));


		var ajax_add_to_cart = jQuery('.ajax_add_to_cart');


		if (jQuery(this).is('.plus')) {
			if (max && (max <= val)) {
				qty.val(max).change();
				ajax_add_to_cart.attr('data-quantity', max);
			} else {
				qty.val(val + step).change();
				ajax_add_to_cart.attr('data-quantity', val + step);
			}
		} else {
			if (min && (min >= val)) {
				qty.val(min).change();
				ajax_add_to_cart.attr('data-quantity', min);
			} else if (val > 1) {
				qty.val(val - step).change();
				ajax_add_to_cart.attr('data-quantity', val - step);

			}
		}




	});
}

function parallax() {
	$screen = window.innerWidth;
	var $height = window.innerHeight;
	if ($screen > 991) {
		jQuery('[data-type="background"]').each(function () {
			var $image_position = jQuery(this).parent().offset().top;
			var $bgobj = jQuery(this); // assigning the object
			var $transform = 0;
			var $lastScrollTop = 0;
			jQuery(window).scroll(function () {
				if ($screen > 991) {
					$scroll = jQuery(this).scrollTop();
					if ($scroll > $image_position - $height) {
						$position = $bgobj.offset().top;

						var $speed = parseInt($bgobj.data('speed'));


						if ($scroll > $lastScrollTop) {
							$transform = $transform - $speed;
						} else {
							$transform = $transform + $speed;
						}


						// Put together our final background position
						var coords = $transform + 'px';

						//console.log($bgobj.offset().top);
						//console.log($speed);
						//console.log($transform);
						// Move the background
						$bgobj.css({
							transform: 'translateY(' + coords + ')'
						});
						$lastScrollTop = $scroll;
					}
				}
			});
		});
	} else {
		jQuery('[data-type="background"]').removeAttr('style');
	}
}

function website_spacings() {
	$hero_banner = jQuery('.hero-banner-animated .hero-banner');
	$top_bar = jQuery('.top-bar');
	$header_height = jQuery('header').outerHeight();

	if ($hero_banner.length > 0) {
		if (window.innerWidth > 991) {
			$hero_banner_height = jQuery('.hero-banner-animated .hero-banner').outerHeight();
			jQuery('.hero-banner-animated main').css('padding-top', $hero_banner_height);
		}
	} else {

		jQuery('.hero-revealing').css('padding-top', $header_height);

		if (window.innerWidth > 991) {
			jQuery('body:not(.header-background-transparent) main').css('padding-top', $header_height);
		}
		if (window.innerWidth < 992) {
			jQuery('.hero-banner-revealing_heading main').css('margin-top', -$header_height);
		}
	}
	if ($top_bar.length > 0) {
		jQuery('header').css('--top-bar-height', $top_bar.outerHeight() + 'px');
		jQuery('header').css('--top-bar-height-n', '-' + $top_bar.outerHeight() + 'px');
	}

	jQuery('.modal-v2').css('padding-top', $header_height + 'px');


}



function image_to_svg() {
	jQuery(".svg-image").each(function () {
		var $img = jQuery(this);
		var imgID = $img.attr("id");
		var imgClass = $img.attr("class");
		var imgURL = $img.attr("src");
		jQuery.get(
			imgURL,
			function (data) {
				// Get the SVG tag, ignore the rest
				var $svg = jQuery(data).find("svg");

				// Add replaced image's ID to the new SVG
				if (typeof imgID !== "undefined") {
					$svg = $svg.attr("id", imgID);
				}
				// Add replaced image's classes to the new SVG
				if (typeof imgClass !== "undefined") {
					$svg = $svg.attr("class", imgClass + " replaced-svg");
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr("xmlns:a");

				// Check if the viewport is set, else we gonna set it if we can.
				if (!$svg.attr("viewBox") && $svg.attr("height") && $svg.attr("width")) {
					$svg.attr("viewBox", "0 0 " + $svg.attr("height") + " " + $svg.attr("width"));
				}

				// Replace image with new SVG
				$img.replaceWith($svg);
			},
			"xml"
		);
	});
}

