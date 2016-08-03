<div id="slider" class="slider">
	<div class="slider__overlay">
		<div class="slider__holder">
			<div class="slider__btn slider__btn_close js-close-slider"><span class="fa fa-close"></span></div>
			<div class="slider__btn slider__btn_left js-slider-prev"><span class="fa fa-chevron-left"></span></div>
			<div class="slider__btn slider__btn_right js-slider-next"><span class="fa fa-chevron-right"></span></div>
			<div class="slider__photo"><img src="/assets/img/slide-1.jpg" alt="" class="slider__img"></div>
			<div class="slider__meta">
				<div class="slider__author-photo">
					<div class="photo-user-img"><img src="/assets/img/default_avatar.jpg" alt=""/>
						<a href="user.html" class="photo-user-img__mask">
							<svg class="svg-more">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
							</svg>
						</a></div>
				</div>
				<h2 class="slider__author-name"></h2>
				<div class="slider__likes">
					<a class="likes btn btn_red">
						<span class="likes__icon">
							<span class="fa fa-heart-o"></span>
						</span>
						<span class="likes__count"></span>
					</a>
				</div>
			</div>
			<div class="slider__info">
				<div class="slider__title"></div>
				<div class="slider__text">
					<span class="hashtag js-hashtag"></span>
				</div>
			</div>
			<div class="slider__comments">
				<div class="comments__title">Комментарии</div>
				<div class="comments__item comments__item_add">
					<div class="comments__item-photo">
						<div class="photo-user-img">
							<img src="{{(Auth::user()->avatar !== "") ?  Auth::user()->avatar : '/assets/img/default_avatar.jpg'}}" alt="Auth::user()->name"/>
							<a href="/user/{{Auth::user()->id}}" class="photo-user-img__mask">
								<svg class="svg-more">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
								</svg>
							</a>
						</div>
					</div>
					<div class="comments__item-info">
						<div class="user__name">{{Auth::user()->name}}</div>
						<form class="comments__form">
							<input name="" contentEditable="true" data-placeholder="Добавить комментарий" class="input_rounded comments__textarea"/>
							<button class="btn btn_transparent comments__btn">Добавить</button>
						</form>
					</div>
				</div>
				<div class="comments__holder"></div>
			</div>
		</div>
	</div>
</div>