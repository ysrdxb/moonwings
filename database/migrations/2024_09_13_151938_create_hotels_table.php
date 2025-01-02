<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description')->nullable();
            $table->string('slug')->unique();
            $table->string('address');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->tinyInteger('rating')->unsigned()->default(0);
            $table->integer('stars')->default(1);
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('status')->default(true);
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->string('video_link')->nullable();
            $table->integer('min_age')->default(1);
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->foreignId('cancellation_policy_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();             
            $table->timestamps();
        });

        Schema::create('hotel_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->enum('room_type', ['Standard', 'Deluxe', 'Suite', 'Family', 'Executive', 'Single', 'Double']);
            $table->integer('capacity')->default(1);
            $table->decimal('price', 8, 2);
            $table->json('facilities')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });

        Schema::create('hotel_amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('hotel_hotel_amenity', function (Blueprint $table) {
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('hotel_amenity_id')->constrained('hotel_amenities')->onDelete('cascade');
            $table->primary(['hotel_id', 'hotel_amenity_id']);
        });

        Schema::create('hotel_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('hotel_rooms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_pax')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['confirmed', 'canceled', 'pending', 'checked_in', 'checked_out'])->default('pending');
            $table->boolean('is_refundable')->default(true);
            $table->json('payment_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_bookings');
        Schema::dropIfExists('hotel_hotel_amenity');
        Schema::dropIfExists('hotel_amenities');
        Schema::dropIfExists('hotel_rooms');
        Schema::dropIfExists('hotels');
    }
};
