<?php

namespace App;

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
    /**
     * @var array
     */
    protected $fillable = ['name_client', 'phone_number', 'created_at', 'updated_at'];


    public function users()
    {
        return $this->belongsToMany(User::class, ClientUser::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, ClientService::class)
            ->withPivot('num_ticket')
            ->withTimestamps();
    }


}
