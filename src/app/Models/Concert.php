<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Concert extends BaseModel
{
    protected $table = 'concerts';

    protected $fillable = [
        'date',
        'status',
        'title',
        'capacity',
        'cost',
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
            get: fn(mixed $value) => config('app.url') . "/storage/$value",
        );
    }
}
