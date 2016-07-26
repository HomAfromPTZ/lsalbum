function init(container, openBtn, closeBtn){
	var slider = $(container);
	var open = $(openBtn);
	var close = modal.find(closeBtn);

	open.on("click", function (e){
		e.preventDefault();
		slider.removeClass("hide").addClass("show");
	});

	close.on("click", function (e){
		e.preventDefault();
		slider.addClass("hide").removeClass("show");
	});
};

function showNext(){};
function showPrev(){};

module.exports = {
	init : init,
	showNext: showNext,
	showPrev: showPrev
};

