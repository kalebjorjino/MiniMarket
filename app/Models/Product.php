<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'stocks',
        'stock_alert',
        'product_cover',
        'product_images',
        'featured',
        'status',
        'brand_id',
        'category_id',
     ];

    protected static function boot()
    {
        parent::boot();

        static::created(static function ($product) {
            $product->slug = Str::slug($product->title);
            $product->save();
        });
    }
    
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
        // return $this->belongsToMany(Category::class, 'product_categories', 'product_id','category_id');
    }

    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'product_categories', 'product_id','category_id');
    // }

    // public function images()
    // {
    //     return $this->hasMany(ProductImage::class);
    // }
}
