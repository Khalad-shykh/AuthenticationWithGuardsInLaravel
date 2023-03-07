<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function show(){
        return view('admin.login');
    }
    public function login(Request $req){
        if(Auth::guard('admins')->attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect()->route('admin.index');
        }else{
            return redirect()->route('admin.login');
        }
    }
    public function logout(Request $req){
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    } 
}
