<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\Informe;
use Carbon\Carbon;

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

    public function getInforme(Request $request){
        $informe = Informe::where('eliminado',0);
        // $filters=json_decode($request->filters);
        // if ($filters->search) {
        //     $informe=$informe->where('titulo', 'like', '%'+$filters->search+'%');
        // }
        $informe=$informe->get();
        return $informe;
    }

    public function saveInforme(Request $request)
    {
        $informe=Informe::where('id',$request->id)->first();
        if(!$informe){
            $informe=new Informe();
            $informe->idinforme=$request->idinforme;
            $informe->titulo=$request->titulo;
            $informe->descripcion=$request->descripcion;
            $informe->url_informe=$request->url;
            $informe->fecha_inicio=Carbon::parse($request->fecha_inicio)->format('Y-m-d');
            $informe->fecha_fin=Carbon::parse($request->fecha_fin)->format('Y-m-d');
            $informe->save();
        }else{
            $informe->idinforme=$request->idinforme;
            $informe->titulo=$request->titulo;
            $informe->descripcion=$request->descripcion;
            $informe->url_informe=$request->url;
            $informe->fecha_inicio=Carbon::parse($request->fecha_inicio)->format('Y-m-d');
            $informe->fecha_fin=Carbon::parse($request->fecha_fin)->format('Y-m-d');
            $informe->save();
        }
        return $informe;
    }

    public function deleteInforme(Request $request)
    {
        $informe=Informe::where('id',$request->id)->update(['eliminado' => 1]);
    }
}
