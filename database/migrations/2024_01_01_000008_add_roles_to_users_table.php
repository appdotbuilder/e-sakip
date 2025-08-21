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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['system_admin', 'regional_official', 'regional_staff', 'evaluator', 'inspector', 'field_staff', 'public'])->default('regional_staff');
            $table->foreignId('organization_id')->nullable()->constrained()->onDelete('set null');
            $table->json('permissions')->nullable();
            
            $table->index(['role', 'organization_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'organization_id']);
            $table->dropForeign(['organization_id']);
            $table->dropColumn(['role', 'organization_id', 'permissions']);
        });
    }
};