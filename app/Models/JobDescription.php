<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobDescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'employer_id',
        'title',
        'description',
        'requirements',
        'domain',
    ];

    protected $casts = [
        'requirements' => 'array',
    ];

    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');
    }
}
