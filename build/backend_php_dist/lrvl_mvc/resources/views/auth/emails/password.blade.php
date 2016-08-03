Перейдите по указанной ссылке, чтобы произвести сброс пароля: <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
