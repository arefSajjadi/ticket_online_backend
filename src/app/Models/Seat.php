<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class, 'hall_id', 'id');
    }
}
