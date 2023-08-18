<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'title',
        'description',
        'price',
        'inventory',
        'view_count',
        
    ];

    public function gallery()
    {
        return $this->hasMany(ProductGallery::class);
    }


    public function discountplans()
    {
        return $this->belongsToMany(DiscountPlan::class);
    }


    
}
