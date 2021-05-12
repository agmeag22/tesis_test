<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idcategoria
 * @property string $nombre
 * @property boolean $eliminado
 * @property string $created_at
 * @property string $updated_at
 */
class Pregunta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'pregunta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idpregunta';

    /**
     * @var array
     */
    protected $fillable = ['idpregunta','num_pregunta','idinforme', 'eliminado', 'created_at', 'updated_at'];


    public function subpregunta()
    {
        return $this->hasMany('App\models\Subpregunta', 'idpregunta', 'idpregunta');
    }

    public function informe()
    {
        return $this->hasOne('App\models\Informe', 'idinforme', 'idinforme');
    }

}
