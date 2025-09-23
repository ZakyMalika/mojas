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
        Schema::table('tarif_jarak', function (Blueprint $table) {
            $table->decimal('min_distance_km', 8, 2)->default(0)->after('id');
            $table->decimal('max_distance_km', 8, 2)->after('min_distance_km');
            $table->enum('rounding_rule', ['up', 'down', 'nearest'])->default('up')->after('max_distance_km');
            $table->text('description')->nullable()->after('rounding_rule');
            $table->boolean('is_active')->default(true)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tarif_jarak', function (Blueprint $table) {
            $table->dropColumn(['min_distance_km', 'max_distance_km', 'rounding_rule', 'description', 'is_active']);
        });
    }
};
