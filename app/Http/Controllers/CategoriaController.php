<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Categoria;

class CategoriaController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['index','getCategorias','saveCategoria','deleteCategoria']]);
    }


    public function index()
    {
        return view('adm.categoria.listado-categoria');
    }

    public function getCategoria(){
        $categoria = Categoria::where('eliminado',0)->get();
        return $categoria;
    }

    public function saveCategoria(Request $request)
    {

        $categoria=Categoria::where('idcategoria',$request->idcategoria)->first();
        if(!$categoria){
            $categoria=new Categoria();
            $categoria->nombre=$request->nombre;
            $categoria->save();
        }else{
            $categoria->nombre=$request->nombre;
            $categoria->save();
        }
        return $categoria;
    }

    public function deleteCategoria(Request $request)
    {
        $categoria=Categoria::where('idcategoria',$request->idcategoria)->update(['eliminado' => 1]);
    }
}
