<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view("admin.auth.login");
    }

    public function login_post(Request $request){
        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
            return redirect("/admin/coins");
        }else{
            return redirect("/admin/login")->withErrors("Böyle bir kullanıcı bulunamadı. Lütfen bilgilerinizi kontrol ediniz.");
        }
    }

    public function logout(){
        Auth::logout();
        return redirect("/admin/login");
    }
}
