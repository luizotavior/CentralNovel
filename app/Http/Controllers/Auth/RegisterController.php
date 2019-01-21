<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Foundation\Auth\RegistersUsers;
use Bestmomo\LaravelEmailConfirmation\Traits\RegistersUsers;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'nome' => 'required|string|max:255',
            'email' => 'required|confirmed|string|email|max:255|unique:users',
            'username' => 'required|string|max:60|unique:users',
            'password' => 'required|confirmed|string|min:6',
        ]);
    }
    public function confirm($id, $confirmation_code)
    {
        $model = config('auth.providers.users.model');

        $user = $model::whereId($id)->whereConfirmationCode($confirmation_code)->firstOrFail();
        $user->confirmation_code = null;
        $user->confirmed = true;
        $user->save();
        try{
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.welcome', [
            'nome' => $user->nome
        ], function($message) use ($user){
            $message
                ->from('luiz@centralnovel.com.br')
                ->to($user->email, $user->nome)
                ->subject('Central Novel: Seja Bem Vindo');
        });
       }catch(\Exception $e){

       }
        return redirect(route('login'))->with('confirmation-success', trans('confirmation::confirmation.success'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       
        return User::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
