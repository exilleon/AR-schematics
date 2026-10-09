<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('about:ar', function () {
    $this->comment('AR Schematics is a Laravel 13 application.');
})->purpose('Display AR Schematics project information');