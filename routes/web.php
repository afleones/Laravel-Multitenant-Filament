<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Resources\TenantResource;
use Filament\Facades\Filament;


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth'])->group(function () {
    Filament::registerResources([
        TenantResource::class,
    ]);
});
