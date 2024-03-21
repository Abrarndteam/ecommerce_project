<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Model\Users;

class UserController extends Controller
{
    //
    function login(Request $req)
    {

        $user= User::where(['email'=>$req->email])->first();
        if(!$user)
        {
            return "Username or Password is invalid";
        }
        else{
            $req->session()->('user',$user);
            return redirect('/');
        }

    }
    function register(Request $req)
    {
        $user= new User;
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=($req->password);
        return redirect('/login');

        // return $req->input();
    }
}
