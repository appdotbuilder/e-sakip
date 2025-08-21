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
        Schema::create('strategic_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->enum('type', ['renstra', 'renja', 'action_plan', 'rpjmd', 'rkpd']);
            $table->year('start_year');
            $table->year('end_year');
            $table->text('description')->nullable();
            $table->json('objectives')->nullable();
            $table->enum('status', ['draft', 'active', 'completed'])->default('draft');
            $table->timestamps();
            
            $table->index(['organization_id', 'type']);
            $table->index(['start_year', 'end_year']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_plans');
    }
};