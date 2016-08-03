	var $dropzone = $("#dropzone");
	var $dropzoneInnerText = $('.dropzone__inner-text');
	var $failArea = $("#fail-area");
	var $failDropzone = $("#fail-dropzone");
	var myDropzone;

function init() {

	var options = {
		url: "/photo/save",
		maxFilesize: 2,
    thumbnailWidth: 135,
    thumbnailHeight: 135,
    acceptedFiles: '.jpg, .jpeg, .png',
		addRemoveLinks: true,
		dictDefaultMessage: "",
		dictFallbackMessage: "Ваш браузер не поддерживает загрузку файлов через drag'n'drop.",
		dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
		dictFileTooBig: "Превышен размер {{maxFilesize}}мб",
		dictInvalidFileType: "Выбран неверный формат изображений",
		dictResponseError: "Server responded with {{statusCode}} code.",
		dictCancelUpload: "Отменить загрузку",
		dictCancelUploadConfirmation: "Вы уверены что хотите отменить загрузку?",
		dictRemoveFile: "",
		dictRemoveFileConfirmation: null,
		dictMaxFilesExceeded: "Вы не можете загрузить больше файлов.",
		autoProcessQueue: false
	}
	myDropzone = new Dropzone("#dropzone", options);
}




function clear() {
	myDropzone.removeAllFiles();
}

function send() {
	myDropzone.processQueue();
}

$dropzone.on("DOMSubtreeModified", function(){

	// move every errored thumb to fail-dropzone
	$dropzone.find(".dz-error").not(".dz-processing").each(function(key, value) {
		$failDropzone.append(value);
	});

	if ($(this).find(".dz-preview").length) {

		// hide dropzone inner text
		$dropzoneInnerText.addClass("is-hidden");
	} else {

		// show dropzone inner text
		$dropzoneInnerText.removeClass("is-hidden");
	}


});

$failDropzone.on("DOMSubtreeModified", function() {
	if (!$(this).html()) {
		// hide fail-dropzone area
		$failArea.addClass("is-hidden");
	} else {
		// show fail-dropzone area
		$failArea.removeClass("is-hidden");
	}
});

module.exports = {
	init: init,
	clear: clear,
	send: send
};