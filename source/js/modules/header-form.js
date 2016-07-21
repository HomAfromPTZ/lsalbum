// hform = header form
// hcontent = header content
var hform,
	close;

function init(container, close, header) {
	hform = $(container);
	close = hform.find(close);
	close.on("click", closeHeaderForm);
};

function closeHeaderForm(){
	hform.addClass("hide").removeClass("show");
};

function showHeaderForm (){
	hform.removeClass("hide").addClass("show");
};

module.exports = {
	init : init,
	showHeaderForm : showHeaderForm
};

