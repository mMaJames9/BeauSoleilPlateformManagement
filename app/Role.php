<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label_role
 * @property string $created_at
 * @property string $updated_at
 */
class Role extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['label_role', 'created_at', 'updated_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, PermissionRole::class)
            ->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, RoleUser::class)
            ->withTimestamps();
    }
}
