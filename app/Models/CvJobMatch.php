<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CvJobMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_id',
        'job_description_id',
        'match_score',
        'strengths',
        'missing_skills',
        'improvement_suggestions',
        'analysis_data',
        'roadmap',
    ];

    protected $casts = [
        'match_score' => 'decimal:2',
        'strengths' => 'array',
        'missing_skills' => 'array',
        'improvement_suggestions' => 'array',
        'analysis_data' => 'array',
        'roadmap' => 'array',
    ];

    public function cv(): BelongsTo
    {
        return $this->belongsTo(Cv::class);
    }

    public function jobDescription(): BelongsTo
    {
        return $this->belongsTo(JobDescription::class);
    }
}
