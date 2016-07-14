(function($) {
	"use strict";

	var helpers = require("./modules/helpers.js");

	
	$(".jquery-test-container").html("Message from separate_example.js<br/>Scrollbar width is: " + helpers.getScrollbarWidth());

})(jQuery);