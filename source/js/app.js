(function($) {
	"use strict";

	var preloader = require("./modules/preloader.js"),
		// helpers = require("./modules/helpers.js"),
		modal = require("./modules/modal.js"),
		slider = require("./modules/slider.js"),
		animations = require("./modules/animations.js"),
		setAjaxResponce = require("./modules/ajax.js"),
		imagePreview = require("./modules/image_preview.js");

	// ==============================
	// Adaptive breakpoints
	// ==============================
	// var scrollbar_width = helpers.getScrollbarWidth(),
	// 	screen_sizes = {
	// 		mobile : 480 - scrollbar_width,
	// 		tablet : 768 - scrollbar_width,
	// 		limit : 2000 - scrollbar_width
	// 	};

	// ==============================
	// Parallax
	// ==============================

	// Main page mouse parallax
	if($("#scene.axis").length){
		$("#scene.axis").parallax({
			scalarX: 3,
			scalarY: 3,
			frictionX: 0.5,
			frictionY: 0.5
		});
	}


	// ==============================
	// Footer scroll button
	// ==============================
	$("#go-up").click(function(){
		$("html, body").stop().animate({
			scrollTop: 0
		}, 700, "swing");
	});


	// ==============================
	// Animations example
	// ==============================
	animations.fadePageOn("a.preload-link", "#preloader", 300);

	$.fn.animated = animations.animateCss;
	$(".album-item").animated("fadeIn");
	$(".photo-item").animated("fadeIn");



	// ==============================
	// Init Add Album Modal
	// ==============================
	if ($(".js-add-album").length) {
		modal.init("#add-album-modal", ".js-add-album", ".js-close-modal");
	}

	// ==============================
	// Init Edit Album Modal
	// ==============================
	if ($(".js-edit-album").length) {
		modal.init("#edit-album-modal", ".js-edit-album", ".js-close-modal");
	}

	// ==============================
	// Init Add Photos Modal
	// ==============================
	if ($(".js-add-photos").length) {
		modal.init("#add-photos-modal", ".js-add-photos", ".js-close-modal");
	}

	// ==============================
	// Init Edit Photo Modal
	// ==============================
	if ($(".js-edit-photo").length) {
		modal.init("#edit-photo-modal", ".js-edit-photo", ".js-close-modal");
	}

	// ==============================
	// Init Edit User Modal
	// ==============================
	if ($(".js-edit-user").length) {
		modal.init("#edit-user-modal", ".js-edit-user", ".js-close-modal");
	}


	// ==============================
	// Init Edit User Modal (in Header)
	// ==============================
	if ($(".js-edit-user-header").length) {
		modal.init("#edit-user-header", ".js-edit-user-header", ".js-close-header");
	}

	// ==============================
	// Init Edit Album Modal (in Header)
	// ==============================
	if ($(".js-edit-album-header").length) {
		modal.init("#edit-album-header", ".js-edit-album-header", ".js-close-header");
	}


	// ==============================
	// Edit User Modal - Delete Photo
	// ==============================
	function showRemovingBlock(e) {
		e.preventDefault();
		$(this).closest('.hm-modal__content').find(".editing-block").slideUp(300);
		$(this).closest('.hm-modal__content').find(".removing-block").slideDown(300);
	}

	function hideRemovingBlock(e) {
		e.preventDefault();
		$(this).closest('.hm-modal__content').find(".removing-block").slideUp(300);
		$(this).closest('.hm-modal__content').find(".editing-block").slideDown(300);
	}

	if ($(".js-show-removing-block").length) {
		$(".js-show-removing-block").on("click", showRemovingBlock);
	}

	if ($(".js-hide-removing-block").length) {
		$(".js-hide-removing-block").on("click", hideRemovingBlock);
	}


	// ==============================
	// Init Edit Album Modal (in Header)
	// ==============================
	if ($(".js-open-slider").length > 0) {
		slider.init("#slider", ".js-open-slider", ".js-close-slider", ".js-slider-next", ".js-slider-prev");
	}




	// ==============================
	// Show Social Items Forms
	// ==============================
	function showSocialForm(e) {
		e.preventDefault();
		var socialItem =  $(this).closest(".social-links__item");
		socialItem.siblings().find(".social-links__form").hide();
		socialItem.find(".social-links__form").show();
	}

	function hideSocialForm(e) {
		e.preventDefault();
		$(this).closest(".social-links__form").hide();
	}

	if ($(".js-open-social-form").length) {
		$(".js-open-social-form").on("click", showSocialForm);
	}
	if ($(".js-close-form").length) {
		$(".js-close-form").on("click", hideSocialForm);
	}


	// ==============================
	// Login card flip
	// ==============================
	$("#flip-card").click(function() {
		$("body").addClass("card_flipped");
	});

	$("#unflip-card").click(function(e) {
		e.preventDefault();
		$("body").removeClass("card_flipped");
	});


	// ==============================
	// Login show Recovery password Card
	// ==============================
	$("#show-recovery").click(function(e) {
		e.preventDefault();
		$("body").addClass("show_recovery");
	});

	$("#hide-recovery").click(function(e) {
		e.preventDefault();
		$("body").removeClass("show_recovery");
	});

	// ==============================
	// Dropzone (Add photos)
	// ==============================

	if ($("div#dropzone").length) {

		var maxFileSizeMb = 2;

		$("div#dropzone").dropzone({
			url: "/" ,
			maxFilesize: maxFileSizeMb
		});
	}

	preloader();

	setAjaxResponce.init();
	imagePreview.init();

})(jQuery);