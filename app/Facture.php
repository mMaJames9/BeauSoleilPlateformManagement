<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $client_id
 * @property string $num_ticket
 * @property int $total_price
 * @property string $created_at
 * @property string $updated_at
 * @property Client $client
 */
class Facture extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['client_id', 'num_ticket', 'total_price', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
