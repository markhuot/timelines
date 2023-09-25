<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property CarbonImmutable $start_at
 * @property CarbonImmutable $end_at
 */
class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'start_at' => 'immutable_datetime',
        'end_at' => 'immutable_datetime',
    ];

    public function start(): Attribute
    {
        return Attribute::make(get: fn () => $this->start_at);
    }

    public function end(): Attribute
    {
        return Attribute::make(get: fn () => $this->end_at);
    }

    public function active(): Attribute
    {
        return Attribute::make(get: fn () => $this->end_at === null);
    }

    public function color(): Attribute
    {
        return Attribute::make(get: fn () => $this->end_at === null ? 'red-500' : null);
    }

    public function period(): Attribute
    {
        return Attribute::make(get: fn () => $this->start_at->toPeriod($this->end_at ?? now()));
    }

    public function durationForHumans()
    {
        return $this->start_at->diffAsCarbonInterval($this->end_at)->forHumans();
    }
}
