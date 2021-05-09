<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class PublicHomeController extends Controller
{
    //
    public function index(){
        $variable = "hola";
        return view('publichome');
    }

    public function getUsers(){
    	$usuarios=User::get();
    	return $usuarios;
    }
}
