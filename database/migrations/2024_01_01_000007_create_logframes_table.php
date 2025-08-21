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
        Schema::create('logframes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('goal')->nullable();
            $table->json('outcomes')->nullable();
            $table->json('outputs')->nullable();
            $table->json('activities')->nullable();
            $table->json('assumptions')->nullable();
            $table->json('risks')->nullable();
            $table->enum('status', ['draft', 'active', 'completed'])->default('draft');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['organization_id', 'status']);
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logframes');
    }
};