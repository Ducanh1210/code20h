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
        Schema::create('job_descriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->constrained('users')->onDelete('cascade');
            $table->string('company_name');                // Tên doanh nghiệp
            $table->string('title');                       // Vị trí thực tập
            $table->string('domain')->nullable();          // Chuyên ngành
            $table->text('description')->nullable();       // Mô tả công việc
            $table->text('requirements')->nullable();      // Yêu cầu công việc
            $table->text('benefits')->nullable();          // Quyền lợi (nếu có)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_descriptions');
    }
};
