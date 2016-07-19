var hform,
	close;

function init(container, close){
	hform = $(container);
	close = hform.find(close);
	console.log(hform);
	console.log(close);
	close.on("click", closeHeaderForm);
};

function closeHeaderForm(){
	hform.addClass("hide").removeClass("show");
};

function showHeaderForm (time){
	hform.removeClass("hide").addClass("show");
};

module.exports = {
	init : init,
	showHeaderForm : showHeaderForm
};

