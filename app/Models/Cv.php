<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cv extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'file_path',
        'is_uploaded',
        'extracted_skills',
        'extracted_experience',
        'content',
    ];

    protected $casts = [
        'extracted_skills' => 'array',
        'extracted_experience' => 'array',
        'content' => 'array',
        'is_uploaded' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
