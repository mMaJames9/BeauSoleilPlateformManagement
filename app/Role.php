<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['name', 'guard_name', 'created_at', 'updated_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, PermissionRole::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, RoleUser::class);
    }
}
