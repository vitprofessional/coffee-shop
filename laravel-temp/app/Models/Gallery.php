<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title','image','category','sort_order','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
