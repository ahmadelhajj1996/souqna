<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReview extends Model
{
    /** @use HasFactory<\Database\Factories\StoreReviewFactory> */
    use HasFactory;
    protected $fillable = ['store_id', 'user_id', 'rating', 'comment'];

    public function store()
    {
        return $this->belongsTo(Seller::class, 'store_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}