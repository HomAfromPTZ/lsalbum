helpers = require("./helpers.js");

var scrollbar_width = helpers.getScrollbarWidth(),
	slider,
	img_container,
	img_wrapper,
	current,
	resizeTimeout,
	resizeDelta = 100;

function init(container, openBtn, closeBtn, nextBtn, prevBtn){
	slider = $(container);
	img_container = slider.find('#slider-full-img');
	img_wrapper = slider.find('.slider__photo');

	img_container.on("load", function(){
		ajustImgHeight();
		img_container.fadeIn(300);
	});

	var open = $(openBtn),
		close = slider.find(closeBtn),
		next = slider.find(nextBtn),
		prev = slider.find(prevBtn),
		body = $('html');

	open.on("click", function (e){
		e.preventDefault();

		current = $(this).closest('.photo-item');
		showSlide(current);

		slider.removeClass("hide").addClass("show");
		body.addClass('has-overflow-hidden')
			.css({"padding-right" : scrollbar_width});
	});

	close.on("click", function (e){
		e.preventDefault();
		slider.addClass("hide").removeClass("show");
		body.removeClass('has-overflow-hidden')
			.css({"padding-right" : 0});
	});

	next.on("click", function (e){
		e.preventDefault();
		showNext();
	});

	prev.on("click", function (e){
		e.preventDefault();
		showPrev();
	});


	$(window).resize(function(){
		clearTimeout(resizeTimeout);
		resizeTimeout = setTimeout(ajustImgHeight, resizeDelta);
	});
};

function ajustImgHeight(){
	img_wrapper.animate({
		'height': img_container.height()
	}, 300);
}

function showNext(){
	var nextSlide = current.next('.photo-item');
	if (nextSlide.length) {
		showSlide(nextSlide);
		current = nextSlide;
	}
};

function showPrev(){
	var prevSlide = current.prev('.photo-item');
	if (prevSlide.length) {
		showSlide(prevSlide);
		current = prevSlide;
	}
};

function showSlide(_item){
	var img_full = _item.data('photo'),
		img_title = _item.data('title'),
		img_likes = _item.data('likes'),
		img_user_id = _item.data('user_id'),
		img_user_name = _item.data('user_name'),
		img_user_avatar = _item.data('user_avatar'),
		img_desc = _item.data('desc'),
		comments_holder = slider.find('.comments__holder'),
		img_comments = _item.find('.comments__item').clone();

	// Очищение блока для комментариев
	comments_holder.html('');

	// Добавление комментариев
	img_comments.each(function(key, value){
		comments_holder.append(value);
	});

	img_container.fadeOut(200,function(){
		img_container.attr('src', img_full);
	});

	slider.find('.slider__title').html(img_title);
	slider.find('.likes__count').html(img_likes);
	slider.find('.slider__text').html(img_desc);
	slider.find('.slider__author-photo .photo-user-img__mask').attr('href', '/user/'+ img_user_id);
	slider.find('.slider__author-name').html(img_user_name);
	slider.find('.slider__author-photo img').attr('src', img_user_avatar);

}

module.exports = {
	init : init,
	showNext: showNext,
	showPrev: showPrev
};

