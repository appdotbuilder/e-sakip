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
        Schema::create('performance_measurements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('performance_indicator_id')->constrained()->onDelete('cascade');
            $table->decimal('actual_value', 15, 2);
            $table->decimal('target_value', 15, 2);
            $table->decimal('achievement_percentage', 5, 2)->nullable();
            $table->date('measurement_date');
            $table->text('notes')->nullable();
            $table->json('supporting_documents')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['performance_indicator_id', 'measurement_date']);
            $table->index('measurement_date');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_measurements');
    }
};