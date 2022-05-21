<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function getUser(){
        $users = User::all();
            return response()->json([
            "success" => true,
            "message" => "User List",
            "data" => $users
            ]);
    }

    public function getUserById($id){
        $user = User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'User not Found'],404);
        }
        return response()->json([
            "success" => true,
            "message" => "User retrieved successfully.",
            "data" => $user
            ]);

    }
    
    public function addUser(Request $request){
        $user = User::create($request->all());
        return response($user,201);
    }   

    public function updateUser(Request $request,User $user){
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'username' =>'required',
            'email' =>'required',
            'password' =>'required',
        ]);
        if(is_null($user)){
            return response()->json(['message'=>'User not Found'],404);
        }
        
    }
    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json([
            "success" => true,
            "message" => "user deleted successfully.",
            "data" => $user
        ]);
    }
}
