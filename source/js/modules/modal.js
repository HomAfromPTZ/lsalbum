function init(container, openBtn, closeBtn){
	var modal = $(container);
	var open = $(openBtn);
	var close = modal.find(closeBtn);
	var body = $('body');

	open.on("click", function (e){
		e.preventDefault();
		modal.removeClass("hide").addClass("show");
		body.addClass("has-overflow-hidden");
	});

	close.on("click", function (e){
		e.preventDefault();
		modal.addClass("hide").removeClass("show");
		body.removeClass('has-overflow-hidden');
	});
};

module.exports = {
	init : init
};

