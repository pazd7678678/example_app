<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountPlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'percent',
        'payment_type',
        'start_at',
        'expired_at',
        
        
    ];



    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
 

 
}
