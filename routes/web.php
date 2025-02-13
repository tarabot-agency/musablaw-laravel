<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\OurServicesController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartenerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('/');
Route::get('/login', function () {
    return view('Admin.Auth.login');
});
Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'optimized';
});

Route::get('switch-language/{lang}', [LanguageController::class, 'switchLang'])->name('switch-language');

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', [AuthController::class, 'loginPage'])->name('admin.login.view');
    Route::post('login', [AuthController::class, 'loginAdmin'])->name('admin.login');
});


Route::group(
    [
        'middleware' => ['auth.admin', 'website.lang'],
        'prefix' => 'admin'
    ],
    function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
        Route::get('admin/{id}', [AdminController::class, 'show'])->name('admins.show');
        Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('admins/store', [AdminController::class, 'store'])->name('admins.store');
        Route::get('admins/edit/{id}', [AdminController::class, 'edit'])->name('admins.edit');
        Route::post('admins/update/{id}', [AdminController::class, 'update'])->name('admins.update');
        Route::post('admins/delete/{id}', [AdminController::class, 'delete'])->name('admins.delete');

        Route::get('page/show/{key}', [PageController::class, 'show'])->name('page.show');
        Route::get('page/edit/{key}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('page/update/{key}', [PageController::class, 'update'])->name('page.update');

        Route::get('our-services', [OurServicesController::class, 'index'])->name('our-services.index');
        Route::get('our-services/create', [OurServicesController::class, 'create'])->name('our-services.create');
        Route::post('our-services/store', [OurServicesController::class, 'store'])->name('our-services.store');
        Route::post('our-services/delete/{key}', [OurServicesController::class, 'delete'])->name('our-services.delete');

        Route::get('general-settings', [SettingController::class, 'show'])->name('settings.general')->middleware('tech-admin');
        Route::post('general-settings', [SettingController::class, 'update'])->name('settings.general.update')->middleware('tech-admin');

        Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
        Route::get('project/{id}', [ProjectController::class, 'show'])->name('project.show');
        Route::get('projects/create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('projects/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::post('projects/update/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::post('projects/delete/{id}', [ProjectController::class, 'delete'])->name('project.delete');

        Route::get('parteners', [PartenerController::class, 'index'])->name('parteners.index');
        Route::get('parteners/create', [PartenerController::class, 'create'])->name('partener.create');
        Route::post('parteners/store', [PartenerController::class, 'store'])->name('partener.store');
        Route::post('parteners/delete/{id}', [PartenerController::class, 'delete'])->name('partener.delete');

        Route::get('sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('sliders/create', [SliderController::class, 'create'])->name('slider.create');
        Route::post('sliders/store', [SliderController::class, 'store'])->name('slider.store');
        Route::post('sliders/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');

        Route::get('certificates', [CertificateController::class, 'index'])->name('certificates.index');
        Route::get('certificates/create', [CertificateController::class, 'create'])->name('certificate.create');
        Route::post('certificates/store', [CertificateController::class, 'store'])->name('certificate.store');
        Route::post('certificates/delete/{id}', [CertificateController::class, 'delete'])->name('certificate.delete');


        Route::get('experiences', [ExperienceController::class, 'index'])->name('experiences.index');
        Route::get('experiences/create', [ExperienceController::class, 'create'])->name('experience.create');
        Route::post('experiences/store', [ExperienceController::class, 'store'])->name('experience.store');
        Route::post('experiences/delete/{id}', [ExperienceController::class, 'delete'])->name('experience.delete');

        Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
        Route::get('article/{id}', [ArticleController::class, 'show'])->name('article.show');
        Route::get('articles/create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('articles/store', [ArticleController::class, 'store'])->name('article.store');
        Route::get('articles/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
        Route::post('articles/update/{id}', [ArticleController::class, 'update'])->name('article.update');
        Route::post('articles/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete');
        Route::post('preview-article', [ArticleController::class, 'previewArticle'])->name('article.preview');

        Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
        Route::get('contact-us/{id}', [ContactUsController::class, 'show'])->name('contact-us.show');
        Route::post('contact-us/delete/{id}', [ContactUsController::class, 'delete'])->name('contact-us.delete');
    }
);
