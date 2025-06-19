<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'store_name',
        'description',
        'logo',
        'banner',
        'phone',
        'address',
        'rating'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function storeReviews()
    {
        return $this->hasMany(StoreReview::class, 'store_id');
    }
}