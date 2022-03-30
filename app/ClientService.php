<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 */
class ClientService extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_service';

    /**
     * @var array
     */
    protected $fillable = [];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
