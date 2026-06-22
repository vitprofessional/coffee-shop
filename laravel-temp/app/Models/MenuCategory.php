<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image', 'sort_order', 'is_active'];

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
