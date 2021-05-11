<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\models\Informe;
use App\models\Pregunta;
use App\models\Subpregunta;
use App\models\Categoria;
use App\models\Subcategoria;

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
    protected $fillable = ['idinforme', 'idcategoria', 'idsubcategoria', 'idpregunta', 'idsubpregunta', 'eliminado', 'created_at', 'updated_at'];

    public function Informe()
    {
        return $this->hasOne(Informe::className(), ['idinforme' => 'idinforme']);
    }

    public function Pregunta()
    {
        return $this->hasOne(Pregunta::className(), ['idpregunta' => 'idpregunta']);
    }

    public function Subpregunta()
    {
        return $this->hasOne(Subpregunta::className(), ['idsubpregunta' => 'idsubpregunta']);
    }

    public function Categoria()
    {
        return $this->hasOne(Categoria::className(), ['idcategoria' => 'idcategoria']);
    }

    public function Subcategoria()
    {
        return $this->hasOne(Subcategoria::className(), ['idsubcategoria' => 'idsubcategoria']);
    }
}
