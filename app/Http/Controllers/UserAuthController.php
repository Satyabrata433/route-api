<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    //
    function login(Request $req){
        $user = User::where('email',$req->email)->first();
        if(!$user || !Hash::check($req->password,$user->password)){
            return ['result'=>"User not found","Success"=>false];
        }
        $success['token']=$user->createToken('Welcome');
        $user['name']=$user->name;
        return ['success'=>true,"result"=>$success,"msg"=>"User register successfully"];
    }

    function signup(Request $req){
        $input= $req->all();
        $input["password"] = bcrypt($input["password"]);
        $user= User::create($input);
        $success['token']=$user->createToken('Welcome');
        $user['name']=$user->name;
        return ['success'=>true,"result"=>$success,"msg"=>"User register successfully"];
    }
}
