<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResidentValidation extends Model
{
    protected $fillable = [
        'user_id',
        'status',
        'validation_notes',
        'validated_by',
        'validated_at'
    ];

    protected $casts = [
        'validated_at' => 'datetime'
    ];

    // Relationship with the user being validated
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the staff member who validated
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // Scope for pending validations
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for validated residents
    public function scopeValidated($query)
    {
        return $query->where('status', 'validated');
    }

    // Scope for rejected residents
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
