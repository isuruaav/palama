<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'icon', 'color', 'is_emergency', 'sort_order'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}