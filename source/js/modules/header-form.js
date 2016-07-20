// hform = header form
// hcontent = header content
var hform,
	close,
	hcontent;

function init(container, close, header) {
	hform = $(container);
	hcontent = $(header);

	console.log(hcontent);
	close = hform.find(close);
	close.on("click", closeHeaderForm);
};

function closeHeaderForm(){
	hform.addClass("hide").removeClass("show");
	hcontent.removeClass("hide").addClass("show");
};

function showHeaderForm (){
	hform.removeClass("hide").addClass("show");
	hcontent.addClass("hide").removeClass("show");
};

module.exports = {
	init : init,
	showHeaderForm : showHeaderForm
};

