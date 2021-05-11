<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Informe;

class InformeController extends Controller
{
    public function __construct()
    {
        //First: Middleware that Checks if user is autenticathed
        $this->middleware('auth');
        //Second: Middleware that Checks if user is admin and set up what routes (functions) in this controller are admin only.
        $this->middleware('is_admin', ['only' => ['index','getinformes','saveInforme','deleteInforme']]);
    }


    public function index()
    {
        return view('adm.informe.listado-informe');
    }

    public function getInforme(){
        $informe = Informe::where('eliminado',0)->get();
        return $informe;
    }
    public function saveInforme(Request $request)
    {

        $informe=Informe::where('idinforme',$request->idinforme)->first();
        if(!$informe){
            $informe=new Informe();
            $informe->nombre=$request->nombre;
            $informe->save();
        }else{
            $informe->nombre=$request->nombre;
            $informe->save();
        }
        return $informe;
    }

    public function deleteInforme(Request $request)
    {
        $informe=Informe::where('idinforme',$request->idinforme)->update(['eliminado' => 1]);
    }
}
