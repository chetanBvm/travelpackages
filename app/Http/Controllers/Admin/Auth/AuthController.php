<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Admin as AdminHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (AdminHelper::checkAdminLogin() == 'success' && AdminHelper::checkLogin() == 'success') {
            return redirect()->route('admin.dashboard');
        } else {        
            return view('admin.auth.login');
        }
    }

    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $getUser = User::Email($email)->first();
        if (!empty($getUser)) {
            if (Hash::check($password, $getUser->password) == true) {
                Auth::login($getUser);
                AdminHelper::setSession($getUser->id);
                if ($request->rememberme === 'on') {
                    AdminHelper::setRememberMeCookie($email, $password);
                } else {
                    AdminHelper::destroyRememberMeCookie();
                }
                return redirect()->route('admin.dashboard');
            }           
            return redirect()->back()->withInput($request->all());
        } else {
            return redirect()->back()->withInput($request->all());
        }
    }

    public function logout()
    {
        
        AdminHelper::destroySession();
        
        Auth::logout();


        return redirect()->route('admin.login');
    }
}
