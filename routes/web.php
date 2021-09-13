<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MasterDocsController;
use App\Http\Controllers\DetectController;

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Searchbox on header
    Route::get('/search', [SearchController::class, 'search'])->name('searchbox');

    // Category
    Route::resource('/category', CategoryController::class);
    Route::get('/getJSONCategory', [CategoryController::class, 'getJSON'])->name('category.json');

    // Master Docs
    Route::resource('/all-documents', MasterDocsController::class);
    Route::get('/JSONDatatable', [MasterDocsController::class, 'JSONDatatable'])->name('all-documents.json');

    // Detect
    Route::get('/detect', [DetectController::class, 'index'])->name('detect.index');
    Route::get('/detect/datatbleJson', [DetectController::class, 'datatbleJson'])->name('detect.datatable');
    Route::get('/detect/create', [DetectController::class, 'create'])->name('detect.create');
    Route::get('/getMasterDocs', [DetectController::class, 'getMasterDocs'])->name('detect.master-docs');
    Route::get('/detect/result/{id}', [DetectController::class, 'result'])->name('detect.result');
    Route::post('/detect', [DetectController::class, 'store'])->name('detect.store');
});
