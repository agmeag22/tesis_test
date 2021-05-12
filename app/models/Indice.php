<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $idindice
 * @property int $idinforme
 * @property int $idcategoria
 * @property int $idsubcategoria
 * @property int $idpregunta
 * @property int $idsubpregunta
 * @property int $eliminado
 * @property string $created_at
 * @property string $updated_at
 */
class Indice extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'indice';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idindice';

    /**
     * @var array
     */
    protected $fillable = ['idinforme', 'idpregunta','idsubpregunta','idcategoria','idsubcategoria', 'eliminado', 'created_at', 'updated_at'];

    public function informe()
    {
        return $this->hasOne('App\models\Informe', 'idinforme' ,'idinforme');
    }

    public function pregunta()
    {
        return $this->hasOne('App\models\Pregunta', 'idpregunta' ,'idpregunta');
    }

    public function categoria()
    {
        return $this->hasOne('App\models\Categoria', 'idcategoria' ,'idcategoria');
    }

    public function subpregunta()
    {
        return $this->hasOne('App\models\Subpregunta', 'idsubpregunta' ,'idsubpregunta');
    }


    public function subcategoria()
    {
        return $this->hasOne('App\models\Subcategoria', 'idsubcategoria' ,'idsubcategoria');
    }
}
