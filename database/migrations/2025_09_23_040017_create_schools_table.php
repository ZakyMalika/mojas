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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('umum'); // 'sekolah' or 'umum'
            $table->text('address')->nullable();
            $table->boolean('has_partnership')->default(false); // for schools like Tunas Cendekia
            $table->decimal('partnership_rate', 10, 2)->nullable(); // 7800 for Tunas Cendekia
            $table->decimal('one_way_price', 10, 2)->nullable(); // 75000 for partnership schools
            $table->decimal('two_way_price', 10, 2)->nullable(); // 150000 for partnership schools
            $table->decimal('general_rate', 10, 2)->default(7000); // 7000 for general rate
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
