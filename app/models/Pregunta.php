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
    protected $table = 'categoria';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'idcategoria';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'eliminado', 'created_at', 'updated_at'];

}
