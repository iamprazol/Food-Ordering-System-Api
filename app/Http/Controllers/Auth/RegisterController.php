<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Role;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'role'       => ['required', 'in:manager,delivery,user'],
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $roles = Role::all()->pluck('id', 'role')->toArray();
        $roleId = $roles[$data['role']] ?? $roles['user'];

        return User::create([
            'first_name'     => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'    => $data['email'],
            'role_id'     => $roleId,
            'password' => Hash::make($data['password']),
        ]);
    }

   protected function authenticated(Request $request, $user)
    {
        $roleName = optional($user->role)->role;

        if ($roleName === 'manager') {
            return redirect('/admin/profile');
        }

        if ($roleName === 'delivery') {
            return redirect()->route('user.delivery');
        }

        return redirect()->route('user.customer');
    }
}
