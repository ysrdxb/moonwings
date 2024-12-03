<div>
    @include('message')
    <div class="row">
        <!-- First Column -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>General Settings</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" id="address" wire:model="address" class="form-control">
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" wire:model="phone" class="form-control">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" wire:model="email" class="form-control">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Column -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Branding</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="logo">Logo</label>
                        <input type="text" id="logo" wire:model="logo" class="form-control">
                        @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="favicon">Favicon</label>
                        <input type="text" id="favicon" wire:model="favicon" class="form-control">
                        @error('favicon') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="google_map">Google Map</label>
                        <input type="text" id="google_map" wire:model="google_map" class="form-control">
                        @error('google_map') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="zip_code">Zip Code</label>
                        <input type="text" id="zip_code" wire:model="zip_code" class="form-control">
                        @error('zip_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Column -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Defaults</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="default_currency_id">Default Currency ID</label>
                        <input type="text" id="default_currency_id" wire:model="default_currency_id" class="form-control">
                        @error('default_currency_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="default_language_id">Default Language ID</label>
                        <input type="text" id="default_language_id" wire:model="default_language_id" class="form-control">
                        @error('default_language_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="default_theme_id">Default Theme ID</label>
                        <input type="text" id="default_theme_id" wire:model="default_theme_id" class="form-control">
                        @error('default_theme_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <!-- Mail and Social Links (Full Row) -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mail and Social Links</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="mail_from_name">Mail From Name</label>
                                <input type="text" id="mail_from_name" wire:model="mail_from_name" class="form-control">
                                @error('mail_from_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="mail_from_email">Mail From Email</label>
                                <input type="email" id="mail_from_email" wire:model="mail_from_email" class="form-control">
                                @error('mail_from_email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_host">SMTP Host</label>
                                <input type="text" id="smtp_host" wire:model="smtp_host" class="form-control">
                                @error('smtp_host') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="smtp_port">SMTP Port</label>
                                <input type="text" id="smtp_port" wire:model="smtp_port" class="form-control">
                                @error('smtp_port') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="smtp_username">SMTP Username</label>
                                <input type="text" id="smtp_username" wire:model="smtp_username" class="form-control">
                                @error('smtp_username') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="smtp_password">SMTP Password</label>
                                <input type="password" id="smtp_password" wire:model="smtp_password" class="form-control">
                                @error('smtp_password') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="facebook_link">Facebook Link</label>
                                <input type="text" id="facebook_link" wire:model="facebook_link" class="form-control">
                                @error('facebook_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="instagram_link">Instagram Link</label>
                                <input type="text" id="instagram_link" wire:model="instagram_link" class="form-control">
                                @error('instagram_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="twitter_link">Twitter Link</label>
                                <input type="text" id="twitter_link" wire:model="twitter_link" class="form-control">
                                @error('twitter_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="whatsapp_link">WhatsApp Link</label>
                                <input type="text" id="whatsapp_link" wire:model="whatsapp_link" class="form-control">
                                @error('whatsapp_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="youtube_link">YouTube Link</label>
                                <input type="text" id="youtube_link" wire:model="youtube_link" class="form-control">
                                @error('youtube_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="linkedin_link">LinkedIn Link</label>
                                <input type="text" id="linkedin_link" wire:model="linkedin_link" class="form-control">
                                @error('linkedin_link') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Text Areas spanning full width -->
                    <div class="mb-3">
                        <label for="about_us">About Us</label>
                        <textarea id="about_us" wire:model="about_us" class="form-control" rows="3"></textarea>
                        @error('about_us') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="terms_of_service">Terms of Service</label>
                        <textarea id="terms_of_service" wire:model="terms_of_service" class="form-control" rows="3"></textarea>
                        @error('terms_of_service') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="privacy_policy">Privacy Policy</label>
                        <textarea id="privacy_policy" wire:model="privacy_policy" class="form-control" rows="3"></textarea>
                        @error('privacy_policy') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button wire:click="save" class="btn btn-success mt-3">Save Settings</button>

                </div>
            </div>
        </div>
    </div>
</div>
