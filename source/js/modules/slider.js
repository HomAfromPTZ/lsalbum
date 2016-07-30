var slider;
var current;


function init(container, openBtn, closeBtn, nextBtn, prevBtn){
			slider = $(container);
	var open = $(openBtn);
	var close = slider.find(closeBtn);
	var next = slider.find(nextBtn);
	var prev = slider.find(prevBtn);
	var body = $('body');

	open.on("click", function (e){
		e.preventDefault();
		current = $(this).closest('.album-item');

    showSlide(current);

		slider.removeClass("hide").addClass("show");
		body.addClass('has-overflow-hidden');
	});

	close.on("click", function (e){
		e.preventDefault();
		slider.addClass("hide").removeClass("show");
		body.removeClass('has-overflow-hidden');
	});

	next.on("click", function (e){
		e.preventDefault();
		showNext();
	});

	prev.on("click", function (e){
		e.preventDefault();
		showPrev();
	});

}



function showNext(){
		var nextSlide = current.next('.album-item');
		if (nextSlide.length) {
			showSlide(nextSlide);
			current = nextSlide;
		}
};

function showPrev(){
		var prevSlide = current.prev('.album-item');
		if (prevSlide.length) {
			showSlide(prevSlide);
			current = prevSlide;
		}
};


function showSlide(_item){
  
		var img_thumb = _item.data('thumb');
		var img_title = _item.data('title');
		var img_desc = _item.data('desc');
		var img_likes = _item.data('likes');
		var img_user_avatar = _item.data('user_avatar');
		var img_user_name = _item.data('user_name');

		slider.find('.slider__img').attr('src', img_thumb);
		slider.find('.slider__title').html(img_title);
		slider.find('.slider__text').html(img_desc);
		slider.find('.likes__count').html(img_likes);
		slider.find('.slider__author-name').text(img_user_name);
		slider.find('.slider__author-photo img').attr('src', img_user_avatar);


// height animation
		var sliderPhoto =  slider.find('.slider__photo');
		var slideHeight = slider.find('.slider__img').height();
		sliderPhoto.animate({'height': slideHeight}, 300);

}

module.exports = {
	init : init,
	showNext: showNext,
	showPrev: showPrev
};

