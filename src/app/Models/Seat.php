<?php

namespace App\Models;

use App\Enum\SeatEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Seat extends BaseModel
{
    protected $table = 'seats';

    protected $fillable = [
        'hall_id',
        'status',
        'block',
        'row',
        'column',
        'cost'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function scopeUsable(Builder $query): Builder
    {
        return $query->where('status', '!=', SeatEnum::UNAVAILABLE_STATUS);
    }

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'id');
    }

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'itemable', 'itemable_type', 'itemable_id');
    }
}
