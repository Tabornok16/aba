<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    protected $fillable = [
        'name',
        'min_age',
        'max_age',
        'description'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
