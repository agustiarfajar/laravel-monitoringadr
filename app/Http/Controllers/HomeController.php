<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main()
    {
        return view('layout.home');
    }

    public function login()
    {
        return view('layout.login');
    }

    public function regist()
    {
        return view('layout.register');
    }

    public function faq()
    {
        return view('layout.faq');
    }

    public function userfaq()
    {
        return view('user.faq');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function status()
    {
        return view('user.status');
    }

    public function detail()
    {
        return view('user.detail');
    }
}
