<div id="slider" class="slider">
	<div class="slider__overlay">
		<div class="slider__holder">
			<div class="slider__btn slider__btn_close js-close-slider"><span class="fa fa-close"></span></div>
			<div class="slider__btn slider__btn_left js-slider-prev"><span class="fa fa-chevron-left"></span></div>
			<div class="slider__btn slider__btn_right js-slider-next"><span class="fa fa-chevron-right"></span></div>
			<div class="slider__photo">
				<img src="" class="slider__img" id="slider-full-img">
				<div class="slider__preloader"></div>
			</div>
			<div class="slider__meta">
				<div class="slider__author-photo">
					<div class="photo-user-img"><img src="/assets/img/default_avatar.jpg" alt=""/>
						<a href="" class="photo-user-img__mask preload-link">
							<svg class="svg-more">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
							</svg>
						</a></div>
				</div>
				<h2 class="slider__author-name"></h2>
				<div class="slider__likes">
					<button class="likes btn btn_red" id="js-like-button">
						<span class="likes__icon">
							<span class="fa fa-heart-o"></span>
						</span>
						<span class="likes__count"></span>
					</button>
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
							<img id="slider__authuser-avatar" src="{{(Auth::user()->avatar !== "") ?  Auth::user()->avatar : '/assets/img/default_avatar.jpg'}}" alt="Auth::user()->name"/>
							<a href="/user/{{Auth::user()->id}}" class="photo-user-img__mask">
								<svg class="svg-more">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
								</svg>
							</a>
						</div>
					</div>
					<div class="comments__item-info">
						<div class="user__name">{{Auth::user()->name}}</div>
						<form class="comments__form" id="post-comment-form">
							{{csrf_field()}}
							<input type="hidden" name="content" id="comment__save-box"/>
							<div id="comment__edit-box" contentEditable="true" data-placeholder="Добавить комментарий" class="input_rounded comments__textarea"></div>
							<button class="btn btn_transparent comments__btn">Добавить</button>
						</form>
					</div>
				</div>

				<div class="comments__holder"></div>
			</div>
		</div>
	</div>
</div>