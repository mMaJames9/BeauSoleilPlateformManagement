<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $label_service
 * @property int $price_service
 * @property string $created_at
 * @property string $updated_at
 */
class Service extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'label_service', 'price_service', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'id');
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class, ClientUser::class, Ticket::class, 'id', 'id')
        ->withPivot('num_ticket')
        ->withTimestamps();
    }
}
