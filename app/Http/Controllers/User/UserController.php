<?php
namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User\Order as OrderResource;

class UserController extends Controller
{
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user()->load(['address', 'order']);
            $success['token'] = $user->createToken('mandu')->accessToken;
            $success['user_id'] = $user->id;
            $success['address'] = $user->address;
            $success['orders'] = OrderResource::collection($user->order);
            $user->api_token = $success['token'];
            $user->save();
            return response()->json(['success' => $success, 'user'=> $user], 200);
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
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('mandu')->accessToken;
        $user->api_token = $success['token'];
        $user->save();
        $success['name'] = $user->first_name.' '.$user->last_name;
        return response()->json(['success'=>$success], 200);
    }

    public function logout(Request $request)
    {
        $user = Auth::guard('api')->user();

        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data' => 'User logged out.'], 200);
    }

    public function index(){

        $user = User::OrderBy('id', 'asc')->get();

        $data = UserResource::collection($user);

        return $this->responser($user, $data, 'Users');

    }

    public function myProfile(){

        $user = Auth::user();

        $data = new UserResource($user);

        return $this->responser($user, $data, 'User');

    }

    public function update(Request $request){
        $user = Auth::user();

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        $data = new UserResource($user);
        return $this->responser($user, $data, 'User Data Updated and');
    }

    public function changePassword(Request $request){
        $user = Auth::user();
        $oldpass = $request->old_password;
        $ok = password_verify($oldpass, $user->password);
        if ( $ok == true) {
            if($request->new_password == $request->confirm__password){
                $user->password = bcrypt($request->new_password);
                $user->save();
                return response()->json(['data' => $user, 'message' => 'User Password Updated successfully'],200);
            } else {
                return response()->json(['message' => 'Password doesn\'t match'],200);
            }
        } else {
            return response()->json(['message' => 'Old password doesn\'t match'],200);
        }
    }

}
