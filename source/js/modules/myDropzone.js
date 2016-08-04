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
			autoProcessQueue: false
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

		// Вставляем фото в DOM
		myDropzone.on("success", function (file, res) {

			var $photo = $('<div class="photo-item single-photo"\
												data-id="'+res.photo.id+'"\
												data-title="'+res.photo.title+'"\
												data-desc="'+res.photo.description+'"\
												data-likes="0"\
												data-comments=""\
												data-thumb="'+res.photo.thumb_url+'"\
												data-user_id="'+res.photo.user_id+'"\
												data-user_avatar="'+res.photo.user_avatar+'"\
												data-user_name="'+res.photo.user_name+'">\
											<div class="photo-item-holder">\
											<div class="album-photo">\
											<a href="#" class="open-img-popup js-open-slider">\
											<div class="album-mask"><i class="fa fa-search-plus"></i></div>\
											<div style="background-image: url(\''+res.photo.thumb_url+'\')" class="album-photo__thumb"></div>\
											</a>\
											<div class="photo-info">\
											<button class="photo-info__item">\
											<i class="fa fa-commenting"> </i>\
											<span class="comment-count">0</span>\
									</button>\
									<button class="photo-info__item">\
											<i class="fa fa-heart"> </i>\
											<span class="like-count">0</span>\
									</button></div></div>\
									<div class="album-category">\
											<button class="edit-post js-edit-photo"><i class="fa fa-pencil"></i></button>\
											<span class="category-name">'+res.photo.title+'</span>\
									</div></div>\
									<div class="is-hidden comments_hidden">Нет комментариев</div></div>');


			$(".album-container").append($photo);

			$(".album-general-info .photo-count").text( $(".photo-item").length );
		});

		// Для каждой загруженной фото
		myDropzone.on("complete", function (file) {
			$(file.previewElement).fadeOut(1000, function(){
				myDropzone.removeFile(file);
			});
		});

		// Все фото загружены
		myDropzone.on("queuecomplete", function () {
			myDropzone.options.autoProcessQueue = false;
			$("#add-photos-modal").addClass('hide').removeClass('show');
			$('html').removeClass('has-overflow-hidden');
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