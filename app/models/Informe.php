<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $idinforme
 * @property string $url_informe
 * @property string $titulo
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $descripcion
 * @property boolean $eliminado
 * @property string $created_at
 * @property string $updated_at
 */
class Informe extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'informe';

    /**
     * @var array
     */
    protected $fillable = ['idinforme', 'url_informe', 'titulo', 'fecha_inicio', 'fecha_fin', 'descripcion', 'eliminado', 'created_at', 'updated_at'];


    public function indice(){
        return $this->belongsTo('App\models\Indice','idinforme','idinforme');
    }
}
