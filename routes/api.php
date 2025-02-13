<?php

use App\Http\Controllers\Website\GeneralSettingController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('base-configurations', [GeneralSettingController::class, 'baseConfigurations']);
Route::post('send-contact-us-message', [ContactUsController::class, 'send']);

Route::get('page/home', [PageController::class, 'home']);
Route::get('page/about-us', [PageController::class, 'AboutUs']);
Route::get('page/our-services', [PageController::class, 'ourServices']);
Route::get('page/our-services/{id}', [PageController::class, 'showPage'])->name('service.show');
Route::get('page/our-projects', [PageController::class, 'ourProjects']);
Route::get('page/our-partners', [PageController::class, 'ourPartners']);
Route::get('page/our-articles', [PageController::class, 'ourArticles']);
Route::get('page/our-articles/{slug}', [PageController::class, 'showPage'])->name('article.show');
