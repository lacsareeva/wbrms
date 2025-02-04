<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminOtp extends Model
{
    use HasFactory;
    protected $table = 'otps';
    protected $fillable = [
        'email',
        'otp',
        'expires_at',
    ];

    public $timestamps = true; // Use created_at and updated_at
}