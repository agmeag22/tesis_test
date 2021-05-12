<?php

namespace App\models;
use App\models\Pregunta;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $idsubpregunta
 * @property int $num_subpregunta
 * @property int $idpregunta
 * @property boolean $eliminado
 * @property string $created_at
 * @property string $updated_at
 */
class Subpregunta extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subpregunta';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var array
     */
    protected $fillable = ['idsubpregunta', 'num_subpregunta','idpregunta','eliminado', 'created_at', 'updated_at'];


    public function pregunta()
    {
       return $this->belongsTo('App\models\Pregunta', 'idcategoria', 'idcategoria');
   }

}
