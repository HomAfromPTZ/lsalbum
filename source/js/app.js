(function($) {
	"use strict";

	var preloader = require("./modules/preloader.js"),
		helpers = require("./modules/helpers.js"),
		// forms = require("./modules/forms.js"),
		popup = require("./modules/popup.js"),
		animations = require("./modules/animations.js"),
		map = require("./modules/gmap.js"),
		tinyMceL10n = require("./modules/tinymce_l10n.js");

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
	// Add Album Popup
	// ==============================
	function showAddAlbumModal() {
		popup.init("#add-album-modal", ".hm-modal__text", ".hm-modal__close");
		popup.showPopup();
	}

	if ($('.js-add-album-btn').length > 0) {
		var addAlbumBtn = $('.js-add-album-btn');
		addAlbumBtn.on('click', showAddAlbumModal);
	}



	tinyMceL10n();

	preloader();

})(jQuery);