<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable(false);
            $table->unsignedBigInteger('country_id')->nullable(false);
            $table->string('avatar')->nullable();
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\CountriesAndCitiesSeeder::class,
        ]);

    }  

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
