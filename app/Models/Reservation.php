<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','phone','email','reservation_date','reservation_time','guests',
        'seating_preference','special_request','status'
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'reservation_time' => 'datetime:H:i',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
