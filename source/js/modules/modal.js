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

		var $preview = $("#preview_avatar"),
				$bg = $("#bg-edit-user");

		if( $preview ) {
			$preview.attr("src", $preview.data("backup"));
		}

		if( $bg ) {
			$bg.css("background-image", "url("+ $bg.data("backup") +")");
		}

		modal.addClass("hide").removeClass("show");
		body.removeClass("has-overflow-hidden");
	});
}

module.exports = {
	init : init
};

