<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'address',
        'precinct_number',
        'voter_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function verifyVoter($firstName, $lastName, $middleName = null)
    {
        $query = self::where('first_name', 'LIKE', "%{$firstName}%")
            ->where('last_name', 'LIKE', "%{$lastName}%")
            ->where('is_active', true);

        if ($middleName) {
            $query->where('middle_name', 'LIKE', "%{$middleName}%");
        }

        return $query->first();
    }

    public function getFullNameAttribute()
    {
        return trim(implode(' ', array_filter([
            $this->first_name,
            $this->middle_name,
            $this->last_name
        ])));
    }
}