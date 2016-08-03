	var $dropzone = $("#dropzone");
	var $dropzoneInnerText = $('.dropzone__inner-text');
	var $failArea = $("#fail-area");
	var $failDropzone = $("#fail-dropzone");
	var myDropzone;
	var $clearBtn;
	var $sendBtn;

	function init(clearDropzoneBtn, sendDropzoneBtn, album_id) {
		var options = {
			url: "/photo/save/" + album_id,
			headers: {
				'X-CSRF-TOKEN': $('input[name="csrf_token"]').val()
			},
			method: "POST",
			paramName: "cover",
			maxFilesize: 2,
			maxFiles: 8,
			thumbnailWidth: 135,
			thumbnailHeight: 135,
			acceptedFiles: '.jpg, .jpeg, .png',
			addRemoveLinks: true,
			dictDefaultMessage: "Перетащите сюда файлы или кликните",
			// dictFallbackMessage: "Ваш браузер не поддерживает загрузку файлов через drag'n'drop.",
			// dictFallbackText: "Используйте форму ниже для загрузки по-старинке",
			dictFileTooBig: "Превышен размер {{maxFilesize}}мб",
			dictInvalidFileType: "Выбран неверный формат изображений",
			// dictResponseError: "Сервер ответил кодом: {{statusCode}}",
			dictCancelUpload: "",
			// dictCancelUploadConfirmation: "Вы уверены что хотите отменить загрузку?",
			dictRemoveFile: "",
			// dictRemoveFileConfirmation: null,
			dictMaxFilesExceeded: "Вы не можете загрузить больше 8 файлов.",
			autoProcessQueue: false,
			// forceFallback: true
		};

		myDropzone = new Dropzone("#dropzone", options);

		$clearBtn = $(clearDropzoneBtn);
		$sendBtn = $(sendDropzoneBtn);

		attachEvents();
	}

	function clearDropzone() {
		myDropzone.removeAllFiles();
	}

	function sendDropzone() {
		myDropzone.processQueue();
	}

	function attachEvents(){

		$clearBtn.on("click", function(){
			clearDropzone();
		});

		$sendBtn.on("click", function(e){
			e.preventDefault();
			sendDropzone();
		});

		myDropzone.on("processing", function() {
			myDropzone.options.autoProcessQueue = true;
		});

		myDropzone.on("complete", function (file) {
			$(file.previewElement).fadeOut(1000, function(){
				myDropzone.removeFile(file);
			});
			// console.log("COMPLETE");
		});

		// All current uploads has been finished
		myDropzone.on("queuecomplete", function () {
			myDropzone.options.autoProcessQueue = false;
		});


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

}





module.exports = {
	init: init
};