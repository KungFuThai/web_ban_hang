<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name_receiver',
        'phone_receiver',
        'address_receiver',
        'status',
        'total_price',
        'customer_id',
    ];

    public function customer(): BelongsTo
    {
        return $this->BelongsTo(Customer::class);
    }

    public function order_details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getTimeCreatedAtAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}
