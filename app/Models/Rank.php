<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Rank extends Model
{
    protected $fillable = [
        'name',
        'description',
        'required_exp'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_ranks')
            ->withPivot('current_exp')
            ->withTimestamps();
    }
}
