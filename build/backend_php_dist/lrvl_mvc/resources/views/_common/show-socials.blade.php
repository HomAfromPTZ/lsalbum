<!--  Массив для генерации соц иконок-->
<?php
  $arr_socials = array(
      array('prefix' => '',        'blade'=>'vk',        'svg'=>'vk'),
      array('prefix' => '',        'blade'=>'facebook',  'svg'=>'fb'),
      array('prefix' => '',        'blade'=>'twitter',   'svg'=>'twitter'),
      array('prefix' => '',        'blade'=>'google',    'svg'=>'google'),
      array('prefix' => 'mailto:', 'blade'=>'email',     'svg'=>'email')
  );
?>

<ul class="social-links">
  
  @foreach($arr_socials as $social)
    <li class="social-links__item">
      <a href="{{ $social['prefix'] . $user[ $social['blade'] ] }}" class="social-links__link">
        <svg class="social-links__svg">
          <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-soc_{{ $social['svg'] }}"></use>
        </svg>
      </a>
    </li>
  @endforeach
  
</ul>

