<?php

namespace App\Models;

use App\Enum\OrderEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use SoftDeletes;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function scopePaid(Builder $query): Builder
    {
        return $query->where('status', '=', OrderEnum::PAID_STATUS);
    }

    public function scopeUnpaid(Builder $query): Builder
    {
        return $query->where('status', '=', OrderEnum::UNPAID_STATUS);
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->items()->sum('cost')
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_idl', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
