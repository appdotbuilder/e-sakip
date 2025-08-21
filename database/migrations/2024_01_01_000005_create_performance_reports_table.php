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
        Schema::create('performance_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('type', ['monthly', 'quarterly', 'yearly', 'custom']);
            $table->date('period_start');
            $table->date('period_end');
            $table->json('report_data')->nullable();
            $table->text('executive_summary')->nullable();
            $table->enum('status', ['draft', 'submitted', 'reviewed', 'approved'])->default('draft');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            
            $table->index(['organization_id', 'type']);
            $table->index(['period_start', 'period_end']);
            $table->index('status');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_reports');
    }
};