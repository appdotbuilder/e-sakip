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
        Schema::create('performance_indicators', function (Blueprint $table) {
            $table->id();
            $table->foreignId('strategic_plan_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('code')->unique();
            $table->text('definition')->nullable();
            $table->string('unit')->nullable();
            $table->decimal('target_value', 15, 2)->nullable();
            $table->enum('type', ['input', 'output', 'outcome', 'impact'])->default('output');
            $table->enum('measurement_frequency', ['daily', 'weekly', 'monthly', 'quarterly', 'yearly'])->default('monthly');
            $table->json('cascading_data')->nullable();
            $table->timestamps();
            
            $table->index(['strategic_plan_id', 'type']);
            $table->index('code');
            $table->index('measurement_frequency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_indicators');
    }
};