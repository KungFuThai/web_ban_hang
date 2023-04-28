<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable
        = [
            'name',
            'description',
            'image',
            'price',
            'slug',
            'category_id',
        ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function order_detail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'name',
                'onUpdate' => true,
            ]
        ];
    }
}
