<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $category_id
 * @property string $label_service
 * @property int $price_service
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 */
class Service extends Model
{
    use HasFactory;
    /**
     * @var array
     */
    protected $fillable = ['category_id', 'label_service', 'price_service', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function factures()
    {
        return $this->belongsToMany(Facture::class, FactureService::class)
            ->withTimestamps();
    }
}
