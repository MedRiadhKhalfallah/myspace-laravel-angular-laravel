<?php
/*
|--------------------------------------------------------------------------
| Application front url
|--------------------------------------------------------------------------
|
|
*/

if (config('app.env') == "production") {
    return [
        'FRONT_URL' => env('FRONT_URL', 'http://www.angular.mtsplus.tn'),
        'STORAGE_URL' => env('image_URL', '/front/storage/app/public'),
    ];
} else {
    return [
        'FRONT_URL' => env('FRONT_URL', 'http://localhost:4200'),
        'STORAGE_URL' => env('storage_URL', '/storage'),
    ];
}
