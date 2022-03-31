<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 */
class Permission extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, Permission::class);
    }
}
