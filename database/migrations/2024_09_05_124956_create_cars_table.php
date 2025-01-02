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
        Schema::create('car_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('car_makes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('make_id')->constrained('car_makes')->onDelete('cascade');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('car_categories')->onDelete('cascade');
            $table->foreignId('model_id')->constrained('car_models')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('year');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('license_plate')->unique();
            $table->integer('seating_capacity');
            $table->enum('transmission', ['automatic', 'manual', 'semi-automatic', 'cvt', 'dct'])->default('automatic');
            $table->string('color')->default('black');
            $table->integer('doors')->nullable();
            $table->integer('baggage')->nullable();
            $table->enum('fuel_type', ['petrol', 'diesel', 'electric', 'hybrid']);
            $table->decimal('daily_rate', 8, 2);
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('per_km_rate', 8, 2)->nullable();
            $table->boolean('transfer_mode')->default(false);
            $table->boolean('rental_mode')->default(false);
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('video_link')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->date('featured_from')->nullable();
            $table->date('featured_to')->nullable();
            $table->boolean('is_available')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();              
            $table->enum('status', ['active', 'pending', 'booked'])->default('active');
            $table->timestamps();
        });

        Schema::create('car_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('booking_type', ['transfer', 'rental']);
            
            $table->string('pickup_location')->nullable();
            $table->string('dropoff_location')->nullable();
            $table->decimal('distance', 8, 2)->nullable();
            $table->decimal('price_per_km', 8, 2)->nullable();

            $table->decimal('total_price', 10, 2);
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('car_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_locations');
        Schema::dropIfExists('car_bookings');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('car_categories');
        Schema::dropIfExists('car_models');
        Schema::dropIfExists('car_makes');
    }
};
