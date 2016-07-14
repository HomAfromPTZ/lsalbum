// ==============================
// Simple tabs
// ==============================

module.exports = function(control_selector, content_selector){
	$(control_selector).on("click", function(){
		var index = $(this).index(),
			content = $(content_selector);

		content.eq(index)
			.add(this)
			.addClass("active")
			.siblings()
			.removeClass("active");
	});
};