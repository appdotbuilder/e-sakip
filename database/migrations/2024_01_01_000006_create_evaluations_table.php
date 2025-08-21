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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->foreignId('performance_report_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title');
            $table->enum('type', ['internal', 'external', 'thematic']);
            $table->text('evaluation_criteria')->nullable();
            $table->json('findings')->nullable();
            $table->json('recommendations')->nullable();
            $table->decimal('overall_score', 5, 2)->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed'])->default('planned');
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade');
            $table->date('evaluation_date');
            $table->timestamps();
            
            $table->index(['organization_id', 'type']);
            $table->index('evaluation_date');
            $table->index('status');
            $table->index('evaluator_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};