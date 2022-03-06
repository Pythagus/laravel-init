<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
class RegisterController extends Controller {

    use RegistersUsers ;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME ;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest') ;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
	    $rules =  [
            'first_name' => $s = 'required|string|max:255',
            'last_name'  => $s,
            'email'      => $s . '|email|unique:users',
            'password'   => $s . '|min:8|confirmed',
            'phone'      => 'nullable|string|max:15',
        ] ;

	    if(! app()->isLocal()) {
	        $rules['g-recaptcha-response'] = 'required|recaptcha' ;
        }

		return Validator::make($data, $rules) ;
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
		$user           = new User ;
		$user->password = Hash::make($data['password']) ;

		unset($data['password'], $data['g-recaptcha-response']) ;

		$user->fill($data) ;
		$user->save() ;

		return $user ;
	}
}
