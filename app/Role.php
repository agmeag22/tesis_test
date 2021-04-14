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
    public const ADMIN_ROLE = 1;
    public const USER_ROLE = 2;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_roles';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'created_at', 'updated_at'];

}
