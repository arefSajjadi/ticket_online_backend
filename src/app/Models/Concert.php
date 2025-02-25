<?php

namespace App\Models;

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
}
