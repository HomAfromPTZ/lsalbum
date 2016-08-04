helpers = require("./helpers.js");
var scrollbar_width = helpers.getScrollbarWidth();

function init(container, openBtn, closeBtn){
	var modal = $(container);
	var body = $('html');

	$('body').on("click", openBtn, function (e){
		e.preventDefault();
		var $button = $(e.target);

		// console.log(modal);
		// Открытие модалки - Редактировать альбом
		if( container == "#edit-album-modal" ) {
			var album_id = $button.parents(".album-item").data("id"),
				album_title = $button.parents(".album-item").find(".category-name").text(),
				album_desc = $button.parents(".album-item").find(".mask-content__desc").text(),
				album_cover = $button.parents(".album-item").find(".my-album img").attr("src");

			$('#edit-album-modal__form').data("id", album_id);
			modal.find('input[name=title]').val(album_title);
			modal.find('textarea[name=description]').val(album_desc);
			modal.find('.image-preview__pic').attr("src", album_cover);

		// Открытие модалки - Редактировать фото
		} else if( container == "#edit-photo-modal" ) {
			var photo_id = $button.parents(".photo-item").data("id"),
<<<<<<< HEAD
					photo_title = $button.parents(".photo-item").data("title"),
					photo_desc = $button.parents(".photo-item").data("desc");
=======
				photo_title = $button.parents(".photo-item").find(".category-name").text(),
				photo_desc = $button.parents(".photo-item").find(".category-desc").text();
>>>>>>> 4cb1948e43f386317e6305d2ccfc8f69b4ba4dc4

			$('#edit-photo-modal__form').data("id", photo_id);
			modal.find('input[name=title]').val(photo_title);
			modal.find('textarea[name=description]').val(photo_desc);
		}


		modal.removeClass("hide").addClass("show");
		body.addClass("has-overflow-hidden")
			.css({"padding-right" : scrollbar_width});
	});

	$('body').on("click", closeBtn, function (e){
		e.preventDefault();

		// Откат значений inputs
		modal.find("input, textarea").each(function () {
			var $this = $(this);

			// Если input:file - удаляем выбранные файлы
			if($this.prop("type") == "file") {
				$this.val("");

				// Если input:text or :textarea - восстанавливаем значение из backup
			} else if($this.prop("type") == "text" || $this.prop("type") == "textarea") {
				if( $this.data("backup") !== undefined) {
					$this.val($this.data("backup"));
				}
			}
		});

		// Откат изображений
		// Массив элементов для отката и метод отката
		var backup_elements = [
		{
			"name": "#preview_avatar",
			"reset": function ($el) {
				$el.attr("src", $el.data("backup"))
			}
		},
		{
			"name": "#bg-edit-user",
			"reset": function ($el) {
				$el.css("background-image", "url("+ $el.data("backup") +")")
			}
		},
		{
			"name": "#bg_edit-album",
			"reset": function ($el) {
				$el.css("background-image", "url("+ $el.data("backup") +")")
			}
		},
		{
			"name": "#add-album-preview",
			"reset": function ($el) {
				$el.attr("src", "/assets/img/no_photo.jpg")
			}
		}
		];

		backup_elements.forEach(function (item) {
			var $el = $(item.name),
			reset = item.reset;

			if( $el ) {
				reset( $el )
			}
		});

		if( $(".social-links__form") ) {
			$(".social-links__form").hide()
		}

		// Скрытие формы и разблокировака body
		modal.addClass("hide").removeClass("show");

		if( container == "#add-album-modal" ) {
			modal.find("input, textarea").each(function () {
				$(this).val('');
			});
		}
		body.removeClass("has-overflow-hidden")
			.css({"padding-right" : 0});
	});
}

module.exports = {
	init : init
};

