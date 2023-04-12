<?php

namespace App\Models;

use App\Enums\ActivityNameEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity',
        'order_id',
        'admin_id',
    ];

    public function order(): BelongsTo
    {
        return $this->BelongsTo(Order::class);
    }

    public function admin(): BelongsTo
    {
        return $this->BelongsTo(Admin::class);
    }

    public function getTimeCreatedAtAttribute() : string
    {
        return $this->created_at->diffForHumans();
    }
    public function getActivityNameAttribute() : string
    {
        return ActivityNameEnum::getKeys($this->activity)[0];
    }
}
