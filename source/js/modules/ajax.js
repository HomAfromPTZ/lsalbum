/** ====================================
* ----- Установка ajax-запросов --------
* =================================== */

function init() {

	// -----------------------------------
	// Редактирование данных пользователя
	// -----------------------------------
	$('#edit-user-header').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]);

		$.ajax({
			method: "POST",
			url: "/user/savedata",
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (msg) {
			if(msg.status == 'success') {
				if(msg.background !== undefined) {
					$('.header').css({
						backgroundImage: "url("+msg.background+")"
					});
				}

				if(msg.avatar !== undefined) {
					$('#user-avatar')
					.add('#slider__authuser-avatar')
					.attr('src', msg.avatar);
				}
				$('.user-info__name').text(formData.get('name'));
				$('.user-info__desc').text(formData.get('description'));
				$('#social__link_vk').attr('href', formData.get('vk'));
				$('#social__link_fb').attr('href', formData.get('facebook'));
				$('#social__link_tw').attr('href', formData.get('twitter'));
				$('#social__link_gg').attr('href', formData.get('google'));
				$('#social__link_email').attr('href', "mailto:"+formData.get('email'));
			}
			$(e.target).removeClass('show').addClass('hide');
			$('html').removeClass('has-overflow-hidden')
				.css({"padding-right" : 0});
		});
	});



	// -----------------------------
	// Добавление альбома
	// -----------------------------
	$('#form-add-album').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]);

		// console.log('add-album');

		$.ajax({
			method: "POST",
			url: "/album/save",
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
			// console.log(album);
			if(album.status == 'success') {
				var album_template_src = $("#album-item-template"),
					album_tmp = album_template_src.clone(),
					album_item = album_tmp.find(".album-item"),
					album_container = $(".album-container");

				album_item.attr("data-id", album.id);

				album_item.find(".album__thumb").css({
					"background-image" : "url('" + album.cover + "')"
				});

				album_item.find(".my-album").attr("href", "/album/"+album.id);
				album_item.find(".mask-content__desc").html(album.description);
				album_item.find(".mask-content__count span").html(1);
				album_item.find(".category-name").html(album.title);

				$album = album_tmp.html();

				if( album_container.eq(1).children('h3') ) {
					album_container.eq(1).children('h3').remove();
				}

				album_container.eq(1).prepend(album_tmp.html());

				$("#add-album-modal").removeClass('show').addClass('hide');
				$("#add-album-modal").find("input, textarea").not('input[type=hidden]').each(function () {
					$(this).val('');
				});
				$('#add-album-preview').attr('src', '/assets/img/no_photo.jpg');
				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	// -----------------------------
	// Изменение альбома в header
	// -----------------------------
	$('#edit-album-header').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]),
		album_id = $(e.target).data('id');

		// console.log('edit-album with id ='+ album_id);

		$.ajax({
			method: "POST",
			url: "/album/update/"+ album_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
			if(album.status == 'success') {
				$('.my-album-title').text(album.title);
				$('.my-album-desc').html(album.description);
				$('.header_album').css({
					backgroundImage: "url("+album.cover+")"
				});

				$(e.target).removeClass('show').addClass('hide');
				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	//-----------------------------
	// Изменение альбома в модалке
	// -----------------------------
	$('#edit-album-modal__form').on('submit', function (e) {
		e.preventDefault();
		var formData = new FormData($(e.target)[0]),
		album_id = $(e.target).data('id');

		// console.log('edit-album-modal with id ='+ album_id);

		$.ajax({
			method: "POST",
			url: "/album/update/"+ album_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (album) {
			// console.log(album);
			if(album.status == 'success') {

				var $album_block = $(".album-item[data-id="+ album_id +"]");

				$album_block.find(".category-name").text(album.title);
				$album_block.find(".mask-content__desc").text(album.description);
				$album_block.find(".my-album img").attr("src", album.cover );

				$("#edit-album-modal").removeClass('show').addClass('hide');
				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	// -----------------------------
	// Удаление альбома в модалке
	// -----------------------------
	$('#delete-album').on('click', function (e) {
		e.preventDefault();
		var album_id = $("#edit-album-modal__form").data('id');
		// console.log(album_id);
		$.ajax({
			method: "GET",
			url: "/album/delete/"+ album_id,
			processData: false,
			contentType: false
		})
		.done(function (album) {

			if(album.status == 'success') {

				var $album_block = $(".album-item[data-id="+ album_id +"]"),
				$album_container = $album_block.parent();

				$album_block.remove();

				if( !$album_container.children(".album-item").length ) {
					$album_container.append("<h3 class='album-item'>Альбомов пока еще нет</h3>");
				}

				$("#edit-album-modal").find('.editing-block').show();
				$("#edit-album-modal").find('.hm-modal__footer button').show();
				$("#edit-album-modal").find('.removing-block').hide();

				$("#edit-album-modal").removeClass('show').addClass('hide');
				$("#edit-album-modal").find("input, textarea").not('input[type=hidden]').each(function () {
					$(this).val('');
				});

				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	// -----------------------------
	// Изменение фото в модалке
	// -----------------------------
	$('#edit-photo-modal__form').on('submit', function (e) {
		e.preventDefault();
		var form = $(e.target),
			formData = new FormData(form[0]),
			photo_id = form.data('id');

		$.ajax({
			method: "POST",
			url: "/photo/update/"+ photo_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (photo) {
			// console.log(photo);
			if(photo.status == 'success') {

				var $photo_block = $(".photo-item[data-id="+ photo_id +"]");

				$photo_block.data("title", photo.title)
					.data("desc", photo.description)
					.find(".category-name").text(photo.title);

				$("#edit-photo-modal").removeClass('show').addClass('hide');

				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	// -----------------------------
	// Удаление фото в модалке
	// -----------------------------
	$('#remove-photo-modal').on('click', function (e) {
		e.preventDefault();
		var $form = $("#edit-photo-modal__form"),
			photo_id = $form.data('id');

		$.ajax({
			method: "GET",
			url: "/photo/delete/"+ photo_id,
			processData: false,
			contentType: false
		})
		.done(function (photo) {
			if(photo.errors === true){
				console.log(photo.result);
			} else {
				$(".photo-item[data-id="+ photo_id +"]").remove();
				$("#edit-photo-modal").removeClass('show').addClass('hide');

				$("#edit-photo-modal").find(".removing-block").slideUp(300);
				$("#edit-photo-modal").find(".hm-modal__footer button").show();
				$("#edit-photo-modal").find(".editing-block, .photo-editing").slideDown(300);

				$(".album-general-info .photo-count").text( $(".content .photo-item").length );

				$('html').removeClass('has-overflow-hidden')
					.css({"padding-right" : 0});
			}
		});
	});



	// -----------------------------
	// Обработка лайков
	// -----------------------------
	$("#js-like-button").click(function(e){
		var like_button = $(this),
			photo_id = like_button.data("photoid"),
			like_counter = like_button.find('.likes__count'),
			likes_num = parseInt(like_counter.html());

			like_button.prop("disabled",true);

		$.ajax({
			url: "/like/" + photo_id,
			type: "GET",
			dataType: "json"
		}).done(function(resp){
			if(resp.result=="like"){
				like_counter.html(++likes_num);
			} else {
				like_counter.html(--likes_num);
			}
			$(".photo-item[data-id="+ photo_id +"] .like-count").text(likes_num);
			$(".photo-item[data-id="+ photo_id +"]").data("likes", likes_num);

			var likes = 0;
			$(".content .photo-item .like-count").each(function () {
				likes += parseInt($(this).text());
			});
			$(".album-general-info .like-count").text( likes );

			like_button.prop("disabled",false);
		}).fail(function(resp){
			alert("Ошибка сервера");
		});
	});



	// -----------------------------
	// Оставить комментарий
	// -----------------------------
	$('#post-comment-form').on('submit', function (e) {
		e.preventDefault();
		var form = $(e.target),
			comment = form.find("#comment__edit-box"),
			photo_id = $(form).data('photoid');

		form.find("#comment__save-box").val(comment.html());
		comment.html("");

		var formData = new FormData(form[0]);

		$.ajax({
			method: "POST",
			url: "/comment/"+ photo_id,
			data: formData,
			processData: false,
			contentType: false
		})
		.done(function (response) {
			var template_src = $("#comment-item-template").clone(),
				comments_section = form.closest(".slider__comments"),
				comments_container = comments_section.find(".comments__holder"),
				comments_hidden_container = $("#photo-item__hidden-comments-"+photo_id),
				template;

			template_src.find(".photo-user-img img").attr("src", response.avatar).attr("alt", response.name);
			template_src.find(".photo-user-img__mask").attr("href", "/user/"+response.user_id);
			template_src.find(".user__name").html(response.name);
			template_src.find(".comments__item-text").html(response.content);

			template = template_src.html();
			comments_container.prepend(template);
			comments_hidden_container.prepend(template);

			var comments_count = parseInt($(".photo-item[data-id="+ photo_id +"] .comment-count").text());
				comments_count++;
			$(".photo-item[data-id="+ photo_id +"] .comment-count").text( comments_count );
			$(".photo-item[data-id="+ photo_id +"]").data("comments", comments_count);

			var comments = 0;
			$(".content .photo-item .comment-count").each(function () {
				comments += parseInt($(this).text());
			});
			$(".album-general-info .comments-count").text( comments );
		});
	});



	// -----------------------------
	// Показать еще
	// -----------------------------
	$("#js-show-more-button").click(function(e){
		e.preventDefault();
		var more_button = $(this),
			page = more_button.data("page");

		$.ajax({
			url: "/storage/getPhotos/" + page,
			type: "GET",
			dataType: "json"
		}).done(function(resp){
			var comment_template_src = $("#comment-item-template"),
				photo_template_src = $("#photo-item-template"),
				more_container = $("#show-more-container");

			$.each(resp.photos, function(index, photo){
				var photo_tmp = photo_template_src.clone(),
					photo_item = photo_tmp.find(".photo-item"),
					comments_container = photo_tmp.find(".comments_hidden");

				comments_container.attr('id', "photo-item__hidden-comments-"+photo.id);

				$.each(photo.comments, function(index, comment){
					var comment_tmp = comment_template_src.clone();

					comment_tmp.find(".photo-user-img img").attr("src",comment.user.avatar).attr("alt",comment.user.name);
					comment_tmp.find(".photo-user-img__mask").attr("href","/user/"+comment.user_id);
					comment_tmp.find(".user__name").html(comment.user.name);
					comment_tmp.find(".comments__item-text").html(comment.content);

					comments_container.prepend(comment_tmp.html());
				});

				photo_item.attr("data-id", photo.id);
				photo_item.attr("data-title", photo.title);
				photo_item.attr("data-desc", photo.description);
				photo_item.attr("data-likes", photo.likes);
				photo_item.attr("data-comments", photo.comments);
				photo_item.attr("data-photo", photo.img_url);
				photo_item.attr("data-user_id", photo.user.id);
				photo_item.attr("data-user_avatar", photo.user.avatar);
				photo_item.attr("data-user_name", photo.user.name);

				photo_item.find(".album-photo__thumb").css({
					"background-image" : "url('" + photo.thumb_url + "')"
				});

				photo_item.find(".comment-count").html(photo.comments);
				photo_item.find(".like-count").html(photo.likes);
				photo_item.find(".category-desc").html(photo.description);
				photo_item.find(".category-name").html(photo.title);

				more_container.append(photo_tmp.html());
			});

			if(page >= resp.totalpages){
				more_button.prop("disabled", true)
					.fadeOut(400, function(){
						more_button.remove();
					});
			} else {
				more_button.data("page", ++page);
			}

		}).fail(function(resp){
			alert("Ошибка сервера");
		});
	});



	// -----------------------------
	// Следующий обработчик
	// -----------------------------

}

module.exports = {
	init: init
};