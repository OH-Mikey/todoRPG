<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table = 'todos';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeGaming($query)
    {
        return $query->where('status', 2)
            ->where('category', 'gaming');
    }

    public function scopeWorking($query)
    {
        return $query->where('status', 2)
            ->where('category', 'working');
    }

    public function scopeThinking($query)
    {
        return $query->where('status', 2)
            ->where('category', 'thinking');
    }

    public function scopeEating($query)
    {
        return $query->where('status', 2)
            ->where('category', 'eating');
    }

    public function scopeReading($query)
    {
        return $query->where('status', 2)
            ->where('category', 'reading');
    }

    public function scopeDrinking($query)
    {
        return $query->where('status', 2)
            ->where('category', 'gaming');
    }
}
