<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Concert extends BaseModel
{
    protected $table = 'concerts';

    protected $fillable = [
        'date',
        'status',
        'title',
        'capacity',
        'address',
        'file'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'date'       => 'datetime'
    ];

    protected function file(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $value ? config('app.url') . "/storage/$value" : config('app.url') . "/storage/default.png",
        );
    }

    protected function delicate(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->capacity
        );
    }

    public function halls(): HasMany
    {
        return $this->hasMany(Hall::class, 'concert_id', 'id');
    }
}
