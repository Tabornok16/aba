<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resident extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'contact_number',
        'birth_date',
        'gender',
        'occupation',
        'civil_status',
        'nationality',
        'identification_type',
        'identification_number',
        'status',
        'remarks',
        'validated_by',
        'validated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => 'date',
        'validated_at' => 'datetime',
    ];

    /**
     * Get the user who validated the resident.
     */
    public function validator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    /**
     * Get the resident's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name
        ])));
    }
}
