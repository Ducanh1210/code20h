<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cv_job_matches', function (Blueprint $table) {
            $table->json('roadmap')->nullable()->after('analysis_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cv_job_matches', function (Blueprint $table) {
            $table->dropColumn('roadmap');
        });
    }
};
