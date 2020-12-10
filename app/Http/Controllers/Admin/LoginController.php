<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Http\Requests\LoginRequest;
use App\Models\Admin;


class LoginController extends Controller
{

    public function  getLogin(){

        return view('admin.Auth.login');
    }

    public function save(){

        $admin = new Admin();
        $admin -> name ="Mahmoud Shalma";
        $admin -> email ="mahmoud@gmail.com";
        $admin -> password = bcrypt("0403120352");
        $admin -> save();

    }

    public function login(LoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
           // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('admin.dashboard');
        }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' => 'هناك خطا بالبيانات']);
    }
}
