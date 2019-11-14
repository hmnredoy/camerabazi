<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

            'username' => ['required', 'string', 'unique:users'],
            'mobile' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $role = Role::find($data['role']);



        $user = User::make([

            'username' => $data['username'],
            'mobile' => $data['mobile'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);



        $role->users()->save($user);





        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if(!$type = $request->has('type')){
           return redirect('/login');
        }

        $type = $request->get('type');
        $role = Role::where('name',$type)->firstOrFail();



        return view('auth.register',['role'=> $role]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {


        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath($user));
    }

    /**
     * Get the post register / login redirect path.
     *
     * @param $user
     * @return string
     */
    public function redirectPath($user)
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo($user);
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Get the post register / login redirect path.
     *
     * @param $user
     * @return string
     */
    public function redirectTo($user)
    {
       if($user->role->name === 'freelancer'){ return '/freelancer/home'; }
       if($user->role->name === 'client'){ return '/client/home'; }
       return '/';
    }
}
