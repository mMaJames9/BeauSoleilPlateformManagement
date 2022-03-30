<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'];

    public function clients()
    {
        return $this->belongsToMany(Client::class, ClientUser::class)
            ->withTimestamps();
    }


    public function roles()
    {
        return $this->belongsToMany(Role::class, RoleUser::class)
            ->withTimestamps();
    }
}
