<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_roles
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends Model
{
    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;
    /**
     * The table name for the model.
     *
     * @var string
     */
    protected $table = 'role';

/**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'idrole';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['nombre', 'estado', 'eliminado', 'created_at', 'updated_at'];


}
