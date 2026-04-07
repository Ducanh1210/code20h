<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cv_job_matches', function (Blueprint $table) {
            if (!Schema::hasColumn('cv_job_matches', 'strengths')) {
                $table->json('strengths')->nullable()->after('match_score');
            }
            if (!Schema::hasColumn('cv_job_matches', 'analysis_data')) {
                $table->json('analysis_data')->nullable()->after('improvement_suggestions');
            }
        });
    }

    public function down(): void
    {
        Schema::table('cv_job_matches', function (Blueprint $table) {
            $table->dropColumn(['strengths', 'analysis_data']);
        });
    }
};
