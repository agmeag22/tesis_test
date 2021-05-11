<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Subcategoria;
use App\models\Categoria;

class SubcategoriaController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['index','getSubcategorias','saveSubcategoria','deleteSubcategoria']]);
    }


    public function index()
    {
        return view('adm.subcategoria.listado-subcategoria');
    }

    public function getSubcategoria()
    {
        $subcategoria = Subcategoria::with(['categoria'])->where('eliminado',0)->get();
        return $subcategoria;
    }

    public function saveSubcategoria(Request $request)
    {

        $subcategoria=Subcategoria::where('idsubcategoria',$request->idsubcategoria)->first();
        if(!$subcategoria){
            $subcategoria=new Subcategoria();
            $subcategoria->nombre=$request->nombre;
            $subcategoria->idcategoria=$request->categoria;
            $subcategoria->save();
        }else{
            $subcategoria->nombre=$request->nombre;
            $subcategoria->idcategoria=$request->categoria;
            $subcategoria->save();
        }
        return $subcategoria;
    }

    public function deleteSubcategoria(Request $request)
    {
        $subcategoria=Subcategoria::where('idsubcategoria',$request->idsubcategoria)->update(['eliminado' => 1]);
    }
}
