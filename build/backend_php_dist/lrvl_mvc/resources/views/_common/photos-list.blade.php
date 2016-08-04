@forelse ($photos as $photo)
	<div class="photo-item single-photo"
		data-id="{{ $photo->id }}"
		data-title="{{ $photo->title }}"
		data-desc="{{ $photo->description }}"
		data-likes="{{ $photo->likes }}"
		data-comments="{{ $photo->comments }}"
		data-photo="{{ $photo->img_url }}"
		data-user_id="{{ $photo->user->id }}"
		data-user_avatar="{{ $photo->user->avatar }}"
		data-user_name="{{ $photo->user->name }}"
		>
		<div class="photo-item-holder">
			<div class="album-photo">
				<div class="open-img-popup js-open-slider">
					<div class="album-mask"><i class="fa fa-search-plus"></i></div>
					<div style="background-image: url('{{ $photo->thumb_url }}')" class="album-photo__thumb"></div>
				</div>
				<div class="photo-info">
					<button class="photo-info__item">
						<i class="fa fa-commenting"> </i>
						<span class="comment-count">{{ $photo->comments }}</span>
					</button>
					<button class="photo-info__item">
						<i class="fa fa-heart"> </i>
						<span class="like-count">{{ $photo->likes }}</span>
					</button>
				</div>
			</div>
			<div class="album-category">
				@if(Auth::user()->id == $photo->user->id)
					<button class="edit-post js-edit-photo">
						<i class="fa fa-pencil"></i>
					</button>
				@endif
				<span class="category-desc is-hidden">{{ $photo->description }}</span>
				<span class="category-name">{{ $photo->title }}</span>
			</div>
		</div>

		<div class="is-hidden comments_hidden" id="photo-item__hidden-comments-{{$photo->id}}">

			@forelse ($photo->comment as $comment)
			<div class="comments__item">
				<div class="comments__item-photo">
					<div class="photo-user-img">
						<img src="{{($comment->user->avatar!="")?$comment->user->avatar:"/assets/img/default_avatar.jpg"}}" alt="{{ $comment->user->name }}"/>
						<a href="/user/{{ $comment->user->id }}" class="photo-user-img__mask preload-link">
							<svg class="svg-more">
								<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-more"></use>
							</svg>
						</a>
					</div>
				</div>
				<div class="comments__item-info">
					<div class="user__name">{{ $comment->user->name }}</div>
					<div class="comments__item-text">{{ $comment->content }}</div>
				</div>
			</div>
			@empty
				Нет комментариев
			@endforelse

		</div>
	</div>
@empty
	<h3 class="photo-item">Нет фотографий</h3>
@endforelse