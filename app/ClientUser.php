<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $client_id
 */
class ClientUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'client_user';

    /**
     * @var array
     */
    protected $fillable = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
