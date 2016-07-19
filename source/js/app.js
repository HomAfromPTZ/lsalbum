(function($) {
	"use strict";

	var preloader = require("./modules/preloader.js"),
		helpers = require("./modules/helpers.js"),
		// forms = require("./modules/forms.js"),
		popup = require("./modules/popup.js"),
		animations = require("./modules/animations.js"),
		map = require("./modules/gmap.js"),
		tinyMceL10n = require("./modules/tinymce_l10n.js"),
		headerForm = require("./modules/header-form.js");

	// ==============================
	// Adaptive breakpoints
	// ==============================
	var scrollbar_width = helpers.getScrollbarWidth(),
		screen_sizes = {
			mobile : 480 - scrollbar_width,
			tablet : 768 - scrollbar_width,
			limit : 2000 - scrollbar_width
		};


	// ==============================
	// Popup example
	// ==============================
	// popup.init("#hm-popup", ".hm-popup__text", ".hm-popup__close");
	// popup.showPopup("Screen breakpoints:<br/>Mobile: " + screen_sizes.mobile + "<br/>Tablet: " + screen_sizes.tablet, 2000);

	// ==============================
	// Google map init example
	// ==============================
	if($("#map-test-container").length){
		var container_id = "map-test-container",
			center_lat = 59.8939942,
			center_lng = 30.4368229,
			zoom = 17;

		google.maps.event.addDomListener(window, "load", map.init(container_id, center_lat, center_lng, zoom));
	}

	// ==============================
	// Animations example
	// ==============================
	animations.fadePageOn("a.preload-link", "#preloader", 300);

	$.fn.animated = animations.animateCss;
	// Example
	$(".animated-test-container").animated("slideInRight");




	// ==============================
	// Tiny MCE example
	// ==============================
	tinymce.init({
		selector: ".tinymce-field",
		plugins: "link, image",
		min_height: 200,
		menubar: false,
		toolbar1: "undo redo | bold italic | link image",
		toolbar2: "alignleft aligncenter alignright"
	});


	// ==============================
	// Add Album Modal
	// ==============================
	function showAddAlbumModal() {
		popup.init("#add-album-modal", ".hm-modal__text", ".hm-modal__close");
		popup.showPopup();
	}

	if ($(".js-add-album-btn").length > 0) {
		$(".js-add-album-btn").on("click", showAddAlbumModal);
	}


	// ==============================
	// Add Photos Modal
	// ==============================
	function showAddPhotosModal() {
		popup.init("#add-photos-modal", ".hm-modal__text", ".hm-modal__close");
		popup.showPopup();
	}

	if ($(".js-add-photos-btn").length > 0) {
		$(".js-add-photos-btn").on("click", showAddPhotosModal);
	}


	// ==============================
	// Edit Photo Modal
	// ==============================
	function showEditPhotoModal() {
		popup.init("#edit-photo-modal", ".hm-modal__text", ".hm-modal__close");
		popup.showPopup();
	}

	if ($(".js-edit-photo-btn").length > 0) {
		$(".js-edit-photo-btn").on("click", showEditPhotoModal);
	}

	// ==============================
	// Edit User Modal - Delete Photo
	// ==============================
	function showPhotoRemovingBlock(e) {
		e.preventDefault();
		$(".photo-editing").slideUp(300);
		$(".photo-removing").slideDown(300);
	}

	function hidePhotoRemovingBlock(e) {
		e.preventDefault();
		$(".photo-removing").slideUp(300);
		$(".photo-editing").slideDown(300);
	}

	if ($(".js-show-photo-removing").length > 0) {
		$(".js-show-photo-removing").on("click", showPhotoRemovingBlock);
	}

	if ($(".js-hide-photo-removing").length > 0) {
		$(".js-hide-photo-removing").on("click", hidePhotoRemovingBlock);
	}

	// ==============================
	// Edit User Modal
	// ==============================
	function showEditUserModal() {
		popup.init("#edit-user-modal", ".hm-modal__text", ".js-close-popup");
		popup.showPopup();
	}

	if ($(".js-edit-user-btn").length > 0) {
		$(".js-edit-user-btn").on("click", showEditUserModal);
	}


	// ==============================
	// Edit User Header
	// ==============================
	function showEditUserHeader() {
		headerForm.init("#edit-user-header", ".js-close-header");
		headerForm.showHeaderForm();
	}

	if ($(".js-edit-user-header-btn").length > 0) {
		$(".js-edit-user-header-btn").on("click", showEditUserHeader);
	}



	// ==============================
	// Show Social Items Forms
	// ==============================
	function showSocialForm(e) {
		e.preventDefault();
		$(this).closest('.social__item').find('.form__group').show();
	}
	function hideSocialForm(e) {
		e.preventDefault();
		$(this).closest('.form__group').hide();
	}

	if ($(".js-open-social-form").length > 0) {
		$(".js-open-social-form").on("click", showSocialForm);
	}
	if ($(".js-close-form").length > 0) {
		$(".js-close-form").on("click", hideSocialForm);
	}


	// ==============================
	// Edit Album Header
	// ==============================
	function showEditAlbumHeader() {
		headerForm.init("#edit-album-header", ".js-close-header");
		headerForm.showHeaderForm();
	}

	if ($(".js-edit-album-header-btn").length > 0) {
		$(".js-edit-album-header-btn").on("click", showEditAlbumHeader);
	}



	tinyMceL10n();

	preloader();

})(jQuery);