<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
<<<<<<< HEAD
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Client;
use App\Role;
use App\RoleUser;
use App\UserClient;



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

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'users';
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
>>>>>>> 2f7fd8d95a92382171367f9046255166932d1ff7

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'
=======
        'name', 'email', 'password',
>>>>>>> 2f7fd8d95a92382171367f9046255166932d1ff7
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $casts = ['updated_at','created_at','deleted_at','email_verified_at'];

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }

    }
=======
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
>>>>>>> 2f7fd8d95a92382171367f9046255166932d1ff7

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

