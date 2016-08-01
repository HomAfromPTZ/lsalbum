function init(container, openBtn, closeBtn){
	var modal = $(container);
	var open = $(openBtn);
	var close = modal.find(closeBtn);
	var body = $('body');

	open.on("click", function (e){
		e.preventDefault();
		modal.removeClass("hide").addClass("show");
		body.addClass("has-overflow-hidden");
	});

	close.on("click", function (e){
		e.preventDefault();
		
		// TODO: Закрыть все открытые окошки для смены url соц сетей

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
						$el.attr("src", $el.data("backup")) } },
				{
					"name": "#bg-edit-user",
					"reset": function ($el) {
						$el.css("background-image", "url("+ $el.data("backup") +")") } },
				{
					"name": "#bg_edit-album",
					"reset": function ($el) {
						$el.css("background-image", "url("+ $el.data("backup") +")") } }
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
		body.removeClass("has-overflow-hidden");
	});
}

module.exports = {
	init : init
};

