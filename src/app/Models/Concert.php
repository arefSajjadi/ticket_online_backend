<?php

namespace App\Models;

use App\Enum\ConcertEnum;
use App\Enum\HallEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Concert extends BaseModel
{
    protected $table = 'concerts';

    protected $fillable = [
        'date',
        'status',
        'title',
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
            get: fn(mixed $value) => $value ? config('app.website') . "/storage/concerts/$value" : config('app.website') . "/storage/default.png",
        );
    }

    protected function capacity(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hall?->seats()->usable()->count()
        );
    }

    protected function reserve(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->hall?->seats()
                ->whereHas('orderItems.order', fn(Builder $query) => $query->paid())
                ->count()
        );
    }

    protected function remaining(): Attribute
    {
        return Attribute::make(
            get: fn() => max($this->capacity - $this->reserve, 0)
        );
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value) {
                if ($this->cost == 0 or $this->remaining == 0) {
                    return ConcertEnum::FULL_STATUS;
                }

                return $value;
            }
        );
    }

    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value) => $this->hall?->seats()->usable()->min('cost') ?? 0
        );
    }

    public function hall(): HasOne
    {
        return $this->hasOne(Hall::class, 'concert_id', 'id')
            ->where('status', HallEnum::ACTIVE_STATUS);
    }
}
