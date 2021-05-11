<?php
/**
 * @property int $idsubcategoria
 * @property string $nombre
 * @property int $idcategoria
 * @property boolean $eliminado
 * @property string $created_at
 * @property string $updated_at
 */

namespace App\models;
use App\models\Categoria;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'subcategoria';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idsubcategoria';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'idcategoria', 'eliminado', 'created_at', 'updated_at'];

    public function categoria()
    {
        return $this->hasOne('App\models\Categoria', 'idcategoria', 'idcategoria');
    }




}
