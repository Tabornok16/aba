<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PublicAdvisory extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'advisory_date',
        'created_by'
    ];

    protected $casts = [
        'advisory_date' => 'datetime'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
