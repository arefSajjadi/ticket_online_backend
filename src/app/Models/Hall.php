<?php

namespace App\Models;

use App\Enums\HallEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends BaseModel
{
    protected $table = 'halls';

    protected $fillable = [
        'concert_id',
        'status',
        'name'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', HallEnum::ACTIVE_STATUS);
    }

    public function concert(): BelongsTo
    {
        return $this->belongsTo(Concert::class, 'concert_id', 'id');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class, 'hall_id', 'id');
    }
}
