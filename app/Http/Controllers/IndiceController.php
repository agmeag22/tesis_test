<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Indice;
use App\models\Informe;
use App\models\Pregunta;
use App\models\Subpregunta;

class IndiceController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['index','getIndice','saveIndice','deleteIndice']]);
    }


    public function index()
    {
        return view('adm.indice.listado-indice');
    }

    public function getIndice(){
        $indice = Indice::with(['informe','pregunta','subpregunta','categoria','subcategoria'])
        ->where('eliminado',0)->get();
        return $indice;
    }

    public function saveIndice(Request $request)
    {
        $informe=Informe::where('idinforme',$request->idinforme)->first();

        $pregunta=Pregunta::where('num_pregunta',$request->idpregunta)
        ->with(['informe'=>function ($q) use ($request) { $q->where('idinforme',$request->idinforme);}])->first();
        if(!$pregunta){
            $pregunta=new Pregunta();
            $pregunta->num_pregunta=$request->idpregunta;
            $pregunta->idinforme=$request->idinforme;
            $pregunta->save();
        }
        if($request->idsubpregunta!=-1){
            $subpregunta=Subpregunta::where('num_subpregunta',$request->idsubpregunta)->where('idpregunta',$pregunta->idpregunta)->first();
            if(!$subpregunta){
                $subpregunta=new Subpregunta();
                $subpregunta->num_subpregunta=$request->idsubpregunta;
                $subpregunta->idpregunta=$pregunta->idpregunta;
                $subpregunta->save();
            }
        }

        $indice=Indice::where('idindice',$request->idindice)->first();
        if(!$indice){
            $indice=new Indice();
            $indice->idinforme=$request->idinforme;
            $indice->idpregunta=$pregunta->idpregunta;
            $indice->idsubpregunta=($request->idsubpregunta!=-1) ? $subpregunta->idsubpregunta : null;
            $indice->idcategoria=$request->idcategoria;
            $indice->idsubcategoria=($request->idsubcategoria!=-1) ? $request->idsubcategoria : null;
            $indice->save();
        }else{
            $indice->idinforme=$request->idinforme;
            $indice->idpregunta=$request->idpregunta;
            $indice->idsubpregunta=($request->idsubpregunta!=-1) ? $subpregunta->idsubpregunta : null;
            $indice->idcategoria=$request->idcategoria;
            $indice->idsubcategoria=($request->idsubcategoria!=-1) ? $request->idsubcategoria : null;
            $indice->save();
        }

        $indice=Indice::with(['informe','pregunta','subpregunta','categoria','subcategoria'])
        ->where('eliminado',0)->where('idindice',$indice->idindice)->first();
        return $indice;
    }

    public function deleteIndice(Request $request)
    {
        $indice=Indice::where('idindice',$request->idindice)->update(['eliminado' => 1]);
    }
}
