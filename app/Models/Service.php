<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Service extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'user_id',
        'category_id',
        'district_id',
        'title',
        'description',
        'slug',
        'price_from',
        'phone',
        'whatsapp',
        'location_text',
        'is_emergency',
        'available_hours',
        'status',
        'is_verified',
        'is_featured',
        'views_count',
        'avg_rating',
        'reviews_count',
    ];

    protected $casts = [
        'is_emergency' => 'boolean',
        'is_verified'  => 'boolean',
        'is_featured'  => 'boolean',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Scopes
    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function scopeEmergency($q)
    {
        return $q->where('is_emergency', true);
    }

    public function scopeFeatured($q)
    {
        return $q->where('is_featured', true);
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('service-images')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(600)
            ->height(400);
    }
}
