<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Indice;

class IndiceController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['index','getIndices','saveIndice','deleteIndice']]);
    }


    public function index()
    {
        return view('adm.indice.listado-indice');
    }

    public function getIndice(){
        $indice = Indice::where('eliminado',0)->get();
        return $indice;
    }
    public function saveIndice(Request $request)
    {

        $indice=Indice::where('idindice',$request->idindice)->first();
        if(!$indice){
            $indice=new Indice();
            $indice->nombre=$request->nombre;
            $indice->save();
        }else{
            $indice->nombre=$request->nombre;
            $indice->save();
        }
        return $indice;
    }

    public function deleteIndice(Request $request)
    {
        $indice=Indice::where('idindice',$request->idindice)->update(['eliminado' => 1]);
    }
}
