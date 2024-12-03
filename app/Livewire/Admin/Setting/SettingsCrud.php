<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\Setting;

class SettingsCrud extends Component
{
    public $name, $address, $phone, $email, $logo, $google_map, $zip_code, $favicon, $default_currency_id, $default_language_id, $default_theme_id;
    public $meta_title, $meta_description, $styles, $scripts, $mail_from_name, $mail_from_email, $smtp_host, $smtp_port, $smtp_username, $smtp_password;
    public $facebook_link, $instagram_link, $twitter_link, $whatsapp_link, $youtube_link, $linkedin_link, $google_link, $app_version;
    public $multi_languages = false, $multi_currencies = false, $supplier_mode = false, $agent_mode = false, $guest_booking = false;
    public $pusher_id, $puscher_key, $puscher_secret, $puscher_cluster, $google_client_id, $google_client_secret, $google_client_redirect_url;

    public $settingId;

    public function mount()
    {
        // Fetch the existing setting, if any
        $setting = Setting::first();
    
        if ($setting) {
            $this->settingId = $setting->id;
            $this->fill($setting->toArray());
        } else {
            // Set default values if no setting exists
            $this->name = '';
            $this->address = '';
            $this->phone = '';
            $this->email = '';
            $this->logo = '';
            $this->google_map = '';
            $this->zip_code = '';
            $this->favicon = '';
            $this->default_currency_id = null;
            $this->default_language_id = null;
            $this->default_theme_id = null;
            $this->meta_title = '';
            $this->meta_description = '';
            $this->styles = '';
            $this->scripts = '';
            $this->mail_from_name = '';
            $this->mail_from_email = '';
            $this->smtp_host = '';
            $this->smtp_port = '';
            $this->smtp_username = '';
            $this->smtp_password = '';
            $this->facebook_link = '';
            $this->instagram_link = '';
            $this->twitter_link = '';
            $this->whatsapp_link = '';
            $this->youtube_link = '';
            $this->linkedin_link = '';
            $this->google_link = '';
            $this->app_version = '';
            $this->multi_languages = false;
            $this->multi_currencies = false;
            $this->supplier_mode = false;
            $this->agent_mode = false;
            $this->guest_booking = false;
            $this->pusher_id = '';
            $this->puscher_key = '';
            $this->puscher_secret = '';
            $this->puscher_cluster = '';
            $this->google_client_id = '';
            $this->google_client_secret = '';
            $this->google_client_redirect_url = '';
        }
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'nullable|email|max:255',
        'logo' => 'nullable|string',
        'google_map' => 'nullable|string',
        'zip_code' => 'nullable|string|max:20',
        'favicon' => 'nullable|string',
        'default_currency_id' => 'nullable|integer',
        'default_language_id' => 'nullable|integer',
        'default_theme_id' => 'nullable|integer',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'styles' => 'nullable|string',
        'scripts' => 'nullable|string',
        'mail_from_name' => 'nullable|string|max:255',
        'mail_from_email' => 'nullable|email|max:255',
        'smtp_host' => 'nullable|string|max:255',
        'smtp_port' => 'nullable|string|max:10',
        'smtp_username' => 'nullable|string|max:255',
        'smtp_password' => 'nullable|string|max:255',
        'facebook_link' => 'nullable|string|max:255',
        'instagram_link' => 'nullable|string|max:255',
        'twitter_link' => 'nullable|string|max:255',
        'whatsapp_link' => 'nullable|string|max:255',
        'youtube_link' => 'nullable|string|max:255',
        'linkedin_link' => 'nullable|string|max:255',
        'google_link' => 'nullable|string|max:255',
        'app_version' => 'nullable|string|max:255',
        'multi_languages' => 'boolean',
        'multi_currencies' => 'boolean',
        'supplier_mode' => 'boolean',
        'agent_mode' => 'boolean',
        'guest_booking' => 'boolean',
        'pusher_id' => 'nullable|string|max:255',
        'puscher_key' => 'nullable|string|max:255',
        'puscher_secret' => 'nullable|string|max:255',
        'puscher_cluster' => 'nullable|string|max:255',
        'google_client_id' => 'nullable|string|max:255',
        'google_client_secret' => 'nullable|string|max:255',
        'google_client_redirect_url' => 'nullable|string|max:255',
    ];

    public function render()
    {
        return view('admin.setting.settings-crud');
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->settingId) {
            // Update existing record
            $setting = Setting::find($this->settingId);
            $setting->update($validatedData);
            session()->flash('message', 'Settings updated successfully.');
        } else {
            // Create new record if no existing record
            Setting::create($validatedData);
            session()->flash('message', 'Settings saved successfully.');
        }
    }
}
