<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //
    public function index() {
        return view('auth.login');
    }

    public function admin() {
        return view('auth.admin_login');
    }

    public function register() {
        if (request()->has('ref')) {
            session(['referrer' => request()->query('ref')]);
        }

        $referrer = User::wherereferrer_code(session()->pull('referrer'))->first();
        $referrer_id = $referrer ? $referrer->referrer_code : null;

        return view('auth.register', compact('referrer_id'));
    }

}
