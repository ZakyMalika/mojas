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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_code')->unique();
            $table->foreignId('orang_tua_id')->constrained('orang_tua');
            $table->foreignId('school_id')->nullable()->constrained('schools');
            $table->foreignId('rental_service_id')->nullable()->constrained('rental_services');
            $table->enum('service_type', ['school_transport', 'rental', 'general']);
            $table->enum('trip_type', ['one_way', 'two_way'])->default('one_way');
            $table->json('children_ids')->nullable(); // array of anak IDs
            $table->decimal('distance_km', 8, 2);
            $table->decimal('base_price', 12, 2);
            $table->decimal('additional_charges', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2);
            $table->string('currency', 3)->default('IDR');
            $table->datetime('pickup_time');
            $table->datetime('return_time')->nullable();
            $table->text('pickup_address');
            $table->text('destination_address');
            $table->text('return_address')->nullable();
            $table->json('pricing_breakdown')->nullable(); // detailed pricing calculation
            $table->enum('status', ['pending', 'confirmed', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
