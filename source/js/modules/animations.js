// ===================================================
// Animate elements on scroll. Based on waypoints.js
// ===================================================
var animateCss = function (in_effect) {
	$(this).each(function() {
		var elem = $(this);
		elem.css({opacity:0})
			.addClass("animated")
			.waypoint(function(dir) {
				if (dir === "down") {
					elem.addClass(in_effect).css({opacity:1});
				}
			},
			{
				offset: "90%"
			});
	});
};


// ========================================================
// Show owerlay layer when specified link has been clicked
// ========================================================
function fadePageOn (link_selector, overlay_selector, time){
	$(document).on("click", link_selector, function(e) {
		var href = $(this).attr("href");
		if(href[0]!="#"){
			e.preventDefault();

			return $(overlay_selector)
				.fadeIn(time, function(){
					return document.location = href != null ? href : "/";
				});
			}
	});
};

module.exports = {
	animateCss : animateCss,
	fadePageOn : fadePageOn
};