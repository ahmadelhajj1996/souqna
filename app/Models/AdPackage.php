<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPackage extends Model
{
    /** @use HasFactory<\Database\Factories\AdPackageFactory> */
    use HasFactory;
    protected $fillable = ['name', 'price', 'duration_days', 'features'];

    protected $casts = [
        'features' => 'array',
    ];
}