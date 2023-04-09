<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable
        = [
            'name',
            'producer_id',
        ];

    protected static function booted(): void //thêm vào khi làm gì đó
    {
        static::saved(static function ($object) {
            $categories = Category::query()
                ->select([
                    'id',
                    'name',
                    'slug',
                ])
                ->get();

            cache()->put('categories', $categories, 86400 * 30);
        });
    }

    public function producer(): BelongsTo
    {
        return $this->BelongsTo(Producer::class);
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
