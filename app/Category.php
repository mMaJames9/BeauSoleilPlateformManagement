<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label_category
 * @property string $created_at
 * @property string $updated_at
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['label_category', 'created_at', 'updated_at'];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
