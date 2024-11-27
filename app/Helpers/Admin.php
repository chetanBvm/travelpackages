<?php

namespace App\Helpers;

use App\Models\User as AdminModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class Admin
{
    public static function checkLogin()
    {
        $session = self::getSession();
        if (!empty($session['user_id'])) {
            return 'success';
        }
        return 'error';
    }
    public static function checkAdminLogin()
    {
        return self::authenticateUser('1');
    }
    public static function setSession($userId = '', $role = '')
    {
        self::destroySession();
        Session::put('user_id', $userId);
        Session::put('user_role', $role);
        Session::save();

        return 'success';
    }
    public static function getSession()
    {
        return [
            'user_id' => Session::get('user_id'),
            'user_role' => Session::get('user_role'),
        ];
    }
    public static function flashSessionMessage($status, $message)
    {
        return Session::flash('flash-message', ['status' => $status, 'msg' => $message]);
    }
    public static function destroySession()
    {
        Session::remove('user_id');
        Session::remove('user_role');

        return 'success';
    }
    public static function currentUser()
    {
        return AdminModel::where('id', self::getSession()['user_id'])->first();
    }
    public static function setRememberMeCookie($email, $password)
    {
        Cookie::queue('remember_email', $email);
        Cookie::queue('remember_password', $password);
    }
    public static function getRememberMeCookie()
    {
        return array('email' => Cookie::get('remember_email'), 'password' => Cookie::get('remember_password'));
    }
    public static function destroyRememberMeCookie()
    {
        Cookie::queue(Cookie::forget('remember_email'));
        Cookie::queue(Cookie::forget('remember_password'));

        return 'success';
    }
    public static function authenticateUser($role)
    {
        $currentUser = self::currentUser();
        switch ($currentUser) {
            case isset($currentUser) && empty($currentUser):
                return 'error_account_deleted';
                break;
            case isset($currentUser) && $currentUser->status != '1':
                return 'error_account_deactivated';
                break;
            case self::getSession()['user_role'] != $role:
                return 'error';
                break;
            default:
                return 'success';
                break;
        }
    }
    // public static function isCurrentRoute($routes = [], $activeClass = 'active')
    // {
    //     if (in_array(\Route::currentRouteName(), $routes)) {
    //         return $activeClass;
    //     }

    //     return '';
    // }
      
}
