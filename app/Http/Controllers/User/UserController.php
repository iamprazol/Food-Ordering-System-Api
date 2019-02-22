<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    /**
     * login api
     *
    * @return \Illuminate\Http\Response
    */

    public function login(){

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] = $user->createToken('mandu')->accessToken;
            return response()->json(['success' => $success], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phone' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('mandu')->accessToken;
        $success['name'] = $user->first_name.' '.$user->last_name;

        return response()->json(['success'=>$success], 200);
    }

    public function index(){

        $user = User::OrderBy('id', 'asc')->get();

        $data = UserResource::collection($user);

        $num = count($user);

        if($num > 0){
            return $this->responser($data,200,"All user are listed");
        } else {
            return $this->responser($data,404,"No users found");
        }
    }

    public function userById($id){

        $user = User::where('id', $id)->get();

        $data = UserResource::collection($user);

        $num = count($user);

        if($num > 0){
            return $this->responser($data,200,"User with specific id is found");
        } else {
            return $this->responser($data,404,"User with specific id cannot be found");
        }
    }

}
