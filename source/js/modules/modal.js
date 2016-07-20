var modal,
	close;

function init(container, close){
	modal = $(container);
	close = modal.find(close);
	close.on("click", closeModal);
};


function closeModal(){
	modal.addClass("hide").removeClass("show");
};


function showModal (){
	modal.removeClass("hide").addClass("show");
};


module.exports = {
	init : init,
	showModal : showModal
};

