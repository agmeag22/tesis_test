<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class PublicHomeController extends Controller
{
    //
    public function index(){
        $variable = "hola";
        // return view('publichome');
        return view('home');
    }

    public function getUsers(){
    	$usuarios=User::get();
    	return $usuarios;
    }
}
