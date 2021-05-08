<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function prueba()
    {
    	$mensaje_prueba1="ESTA ES UNA VARIABLE DE PRUEBA";
    	$mensaje_prueba2=["ESTE","ES","UN","ARREGLO"];
    	//solo sintaxis if
    	if(!$mensaje_prueba2){
    		$mensaje_prueba2=1;
    	}
        return view('vistas-prueba.primer-contenido', compact('mensaje_prueba1', 'mensaje_prueba2'));
    }
}
