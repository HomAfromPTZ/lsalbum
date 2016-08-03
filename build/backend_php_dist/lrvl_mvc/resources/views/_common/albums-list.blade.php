@if($albums->count()>0)
	<div class="album-container">
	@foreach ($albums as $album)
		<div class="album-item" data-id="{{ $album->id }}">
			<div class="album-item-holder">
				<a href="/album/{{$album->id}}" class="my-album preload-link">
					<div style="background-image: url('{{ ($album->cover->img_url !== '') ? $album->cover->img_url : 'assets/img/no_photo.jpg' }}')" alt="{{$album->title}}" class="album__thumb"></div>

					<div class="album-mask">
						<div class="mask-content">
							<div class="mask-content__desc">{{$album->description}}</div>
							<div class="mask-content__count">
								Фотографий:<span>{{$album->photos->count()}}</span>
							</div>
						</div>
					</div>
				</a>
				<div class="album-item__footer">
					<button class="edit-post js-edit-album">
						<i class="fa fa-pencil"></i>
					</button>
					<span class="category-name">{{ $album->title }}</span>
				</div>
			</div>
		</div>
	@endforeach
	</div>
@else
	<h3>Альбомов пока еще нет</h3>
@endif