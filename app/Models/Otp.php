<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    protected $fillable = [
        'user_id',
        'mobile_number',
        'code',
        'used',
        'expires_at'
    ];

    protected $casts = [
        'used' => 'boolean',
        'expires_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isValid()
    {
        return !$this->used && $this->expires_at->isFuture();
    }

    public static function generateCode()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }
}
