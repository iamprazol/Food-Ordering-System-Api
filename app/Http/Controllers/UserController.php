<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\Delivery;
use App\Restaurant;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::where('role_id', 1)->orderBy('first_name', 'asc')->paginate(15);
        return view('users.index')->with('users', $user);
    }

    public function manager()
    {
        $user = User::where('role_id', 2)->orderBy('first_name', 'asc')->paginate(15);
        return view('users.manager')->with('users', $user);
    }

    public function customer()
    {
        $user = User::where('role_id', 4)->orderBy('first_name', 'asc')->paginate(15);
        return view('users.customer')->with('users', $user);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        if(Auth::user()->restaurant) {
            return view('restaurant.delivery.create');
        } else {
            $role = Role::all();
            return view('users.create')->with('roles', $role->except(['id' =>  3]));
        }
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $model)
    {
        $model->create($request->merge(['password' => Hash::make($request->get('password'))])->all());
        if($request->role_id == 1) {
            return redirect()->route('user')->withStatus(__('Super Admin successfully created.'));
        } elseif($request->role_id == 2){
            return redirect()->route('user.managers')->withStatus(__('Restaurant Manager successfully created.'));
        } else {
            return redirect()->route('user.customers')->withStatus(__('Customer Account successfully created.'));
        }
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $role = Role::all();
        return view('users.edit', compact('user'))->with('roles', $role->except(['id' =>  3]));
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User  $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        if($request->role_id == 1) {
            return redirect()->route('user')->withStatus(__(' User successfully Updated.'));
        } elseif($request->role_id == 2){
            return redirect()->route('user.managers')->withStatus(__('User successfully Updated.'));
        } else {
            return redirect()->route('user.customers')->withStatus(__('User successfully Updated.'));
        }
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(User  $user)
    {
        $user_id = $user->id;
        $user->delete();

        if($user_id == 1) {
            return redirect()->route('user')->withStatus(__('Super Admin successfully created.'));
        } elseif($user_id == 2){
            return redirect()->route('user.managers')->withStatus(__('Restaurant Manager successfully created.'));
        } else {
            return redirect()->route('user.customers')->withStatus(__('Customer Account successfully created.'));
        }
    }
}
