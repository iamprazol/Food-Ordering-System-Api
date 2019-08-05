<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Manager;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\User as UserResource;

class ManagerController extends Controller
{

    public function createUser(Request $request){
        $manager = Manager::where('user_id', Auth::id())->first();
        $restaurant_id = $manager->restaurant_id;

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
        $user->api_token = $success['token'];
        $user->role_id = 2;
        $user->save();
        $success['name'] = $user->first_name.' '.$user->last_name;

        Manager::create([
            'user_id' => $user->id,
            'restaurant_id' => $restaurant_id
        ]);
        return response()->json(['success'=>$success], 200);
    }

    public function listManagers(){
        $manager = Manager::where('user_id', Auth::id())->first();

        if(!$manager){
            abort(404);
        }

        $restaurant_id = $manager->restaurant_id;

        $man = Manager::where('restaurant_id', $restaurant_id)->get();

        foreach ($man as $m) {
            $user[] = $m->user;
        }

        $data = UserResource::collection(collect($user));
        return $this->responser(collect($user), $data, 'Managers');
    }

}
