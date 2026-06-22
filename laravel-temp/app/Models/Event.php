<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','description','image','event_date','event_time','location','price','is_active'];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'price' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
