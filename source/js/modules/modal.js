function init(container, openBtn, closeBtn){
	var modal = $(container);
	var open = $(openBtn);
	var close = modal.find(closeBtn);

	open.on("click", function (e){
		e.preventDefault();
		modal.removeClass("hide").addClass("show");
	});

	close.on("click", function (e){
		e.preventDefault();
		modal.addClass("hide").removeClass("show");
	});
};

module.exports = {
	init : init
};

