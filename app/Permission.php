<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label_permission
 * @property string $created_at
 * @property string $updated_at
 */
class Permission extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['label_permission', 'created_at', 'updated_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, PermissionRole::class)
            ->withTimestamps();
    }
}
