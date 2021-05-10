<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   

        $this->middleware('auth');
        $this->middleware('is_admin', ['only' => ['only_admin_can_see']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function only_admin_can_see()
    {
        return view('home');
    }
}
