function init(container, openBtn, closeBtn){
	var slider = $(container);
	var open = $(openBtn);
	var close = slider.find(closeBtn);
	var body = $('body');

	open.on("click", function (e){
		e.preventDefault();
		slider.removeClass("hide").addClass("show");
		body.addClass('has-overflow-hidden');
	});

	close.on("click", function (e){
		e.preventDefault();
		slider.addClass("hide").removeClass("show");
		body.removeClass('has-overflow-hidden');
	});
};

function showNext(){};
function showPrev(){};

module.exports = {
	init : init,
	showNext: showNext,
	showPrev: showPrev
};

