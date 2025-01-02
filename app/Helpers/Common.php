<?php

use Illuminate\Support\Facades\File;

if (!function_exists('fetchAirlineLogo')) {
    function fetchAirlineLogo($airlineCode)
    {
        $logoPath = public_path('airlines/' . strtolower($airlineCode) . '.png');
        return File::exists($logoPath) ? asset('airlines/' . strtolower($airlineCode) . '.png') : asset('default_logo_url.png');
    }
}

if (!function_exists('calculateDurationMinutes')) {
    function calculateDurationMinutes($duration)
    {
        $interval = new \DateInterval($duration);
        return ($interval->h * 60) + $interval->i;
    }
}

if (!function_exists('formatDuration')) {
    function formatDuration($duration) {
        $interval = new \DateInterval($duration);
        $hours = $interval->h + ($interval->d * 24);
        $minutes = $interval->i;
        return "{$hours}h {$minutes}m";
    }
}
