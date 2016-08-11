<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth;
use URL;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



    public function postLogin(Request $request)
    {
        $auth = false;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $auth = true;
        }

        return [
            'auth' => $auth,
        ];
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            return [
                "status" => "error",
                "errors" => $validator->errors(),
            ];
        };
        $user = $this->create($request->all());

        // $code = CodeController::generateCode(8);
        // Code::create([
        //     'user_id' => $user->id,
        //     'code' => $code,
        // ]);

        // $url = url('/').'/activate?id='.$user->id.'&code='.$code;
        // Mail::send('emails.registration', array('url' => $url), function($message) use ($request)
        // {          
        //     $message->to($request->email)->subject('Registration');
        // });
        
        // return 'Регистрация прошла успешно, на Ваш email отправлено письмо со ссылкой для активации аккаунта';

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return [
                "status" => "ok",
                "message" => "Регистрация прошла успешно!",
            ];
        } else {
            return [
                "status" => "auth error",
                "message" => "Регистрация прошла успешно. Но при авторизации произошла ошибка!",
            ];
        }

    }
}
