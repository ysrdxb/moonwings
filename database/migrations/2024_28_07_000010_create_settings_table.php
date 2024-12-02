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
        Schema::create('settings', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('google_map')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('favicon')->nullable();
            $table->integer('default_currency_id')->nullable();
            $table->integer('default_language_id')->nullable();
            $table->integer('default_theme_id')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->text('styles')->nullable();
            $table->text('scripts')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->string('mail_from_email')->nullable();
            $table->string('smtp_host')->nullable();
            $table->string('smtp_port')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('google_link')->nullable();
            $table->string('app_version')->nullable();
            $table->boolean('multi_languages')->default(false);
            $table->boolean('multi_currencies')->default(false);
            $table->boolean('supplier_mode')->default(false);
            $table->boolean('agent_mode')->default(false);
            $table->boolean('guest_booking')->default(false);
            $table->string('pusher_id')->nullable();
            $table->string('puscher_key')->nullable();
            $table->string('puscher_secret')->nullable();
            $table->string('puscher_cluster')->nullable();
            $table->string('google_client_id')->nullable();
            $table->string('google_client_secret')->nullable();
            $table->string('google_client_redirect_url')->nullable();

            $table->timestamps();
        });

        // Insert default values into the table
        DB::table('settings')->insert([
            'id' => 1,
            'name' => 'Default Name',
            'address' => 'Default Address',
            'phone' => '000-000-0000',
            'email' => 'default@example.com',
            'logo' => '',
            'google_map' => '',
            'zip_code' => '00000',
            'favicon' => '',
            'default_currency_id' => 1,
            'default_language_id' => 1,
            'default_theme_id' => 1,
            'meta_title' => 'Default Meta Title',
            'meta_description' => 'Default Meta Description',
            'styles' => '',
            'scripts' => '',
            'mail_from_name' => 'Default Mail From Name',
            'mail_from_email' => 'default@mail.com',
            'smtp_host' => 'smtp.example.com',
            'smtp_port' => '587',
            'smtp_username' => 'smtp_user',
            'smtp_password' => 'smtp_password',
            'facebook_link' => '',
            'instagram_link' => '',
            'twitter_link' => '',
            'whatsapp_link' => '',
            'youtube_link' => '',
            'linkedin_link' => '',
            'google_link' => '',
            'app_version' => '1.0.0',
            'multi_languages' => false,
            'multi_currencies' => false,
            'supplier_mode' => false,
            'agent_mode' => false,
            'guest_booking' => false,
            'pusher_id' => '',
            'puscher_key' => '',
            'puscher_secret' => '',
            'puscher_cluster' => '',
            'google_client_id' => '',
            'google_client_secret' => '',
            'google_client_redirect_url' => ''
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

