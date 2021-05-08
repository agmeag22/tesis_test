<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicHomeController extends Controller
{
    //
    public function index(){
        $variable = "hola";
        return view('publichome');
    }
}
