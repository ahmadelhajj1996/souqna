<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdPackage extends Model
{
    /** @use HasFactory<\Database\Factories\UserAdPackageFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'ad_package_id', 'activated_at', 'expires_at', 'is_active'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(AdPackage::class, 'ad_package_id');
    }
}