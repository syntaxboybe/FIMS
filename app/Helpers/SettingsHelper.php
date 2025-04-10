<?php

namespace App\Helpers;

use App\Models\Setting;

class SettingsHelper
{
    /**
     * Get a setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }

    /**
     * Get the site logo URL
     *
     * @return string|null
     */
    public static function getLogo()
    {
        $logoPath = self::get('site_logo');
        if ($logoPath) {
            return asset('storage/' . $logoPath);
        }
        return null;
    }

    /**
     * Get the site favicon URL
     *
     * @return string|null
     */
    public static function getFavicon()
    {
        $faviconPath = self::get('site_favicon');
        if ($faviconPath) {
            return asset('storage/' . $faviconPath);
        }
        return null;
    }
}
