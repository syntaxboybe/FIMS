<?php

// This file fixes the cache directory issue when running on Windows with XAMPP
// It overrides the PackageManifest class to use the correct path

use Illuminate\Foundation\PackageManifest;
use Illuminate\Filesystem\Filesystem;

// Create the .laravel/cache directory if it doesn't exist
if (!is_dir(__DIR__ . '/../.laravel/cache')) {
    mkdir(__DIR__ . '/../.laravel/cache', 0777, true);
}

// Create the bootstrap/cache directory if it doesn't exist
if (!is_dir(__DIR__ . '/cache')) {
    mkdir(__DIR__ . '/cache', 0777, true);
}

// Override the PackageManifest class to use the correct path
$app->singleton(PackageManifest::class, function ($app) {
    $basePath = $app->basePath();
    $manifestPath = $basePath . '/.laravel/cache/packages.php';
    
    return new PackageManifest(
        new Filesystem, $basePath, $manifestPath
    );
});

return $app;
