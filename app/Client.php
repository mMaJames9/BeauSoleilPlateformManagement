<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name_client
 * @property int $phone_number
 * @property string $created_at
 * @property string $updated_at
 */
class Client extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['name_client', 'phone_number', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany(User::class, ClientUser::class)
            ->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, ClientService::class)
            ->withPivot(['quantity'])
            ->withTimestamps();
    }

    public function factures()
    {
        return $this->hasMany(Facture::class);
    }
}
