<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $role_id
 * @property int $id
 */
class PermissionRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * @var array
     */
    protected $fillable = [];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
