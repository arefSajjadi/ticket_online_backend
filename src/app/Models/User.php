<?php

namespace App\Models;

class User extends BaseModel
{
    protected $table = 'users';

    protected $fillable = [
        'last_login',
        'username',
        'status',
        'token'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'last_login' => 'datetime'
    ];
}
