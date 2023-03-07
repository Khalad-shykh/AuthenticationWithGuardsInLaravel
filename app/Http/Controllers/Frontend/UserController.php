<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function show(){
        return view('Frontend.login');
    }
    public function show_r(){
        return view('Frontend.register');
    }
    public function register(Request $req){
        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' =>  Hash::make($req->password),
        ]);
        if($user){
            return redirect('/login');
        }
    }
    public function login(Request $req){
        if(Auth::attempt(["email" => $req->email, "password" => $req->password])){
            return redirect('/');
        }else{
            echo '<script>alert("Inavlid");</script>';
        }
    }
    public function logout(Request $req){
        Auth::logout();
        return redirect()->route('login');
        
        
    }
}
