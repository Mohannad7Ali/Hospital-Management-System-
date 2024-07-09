<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Counter ;

use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/custom/livewire/update', $handle);
        });
        Route::get('/counter', Counter::class);

    });



// GET|HEAD        livewire/livewire.js ............................ Livewire\Mechanisms › FrontendAssets@returnJavaScriptAsFile
// GET|HEAD        livewire/livewire.min.js.map ...................................... Livewire\Mechanisms › FrontendAssets@maps
// GET|HEAD        livewire/preview-file/{filename} ... livewire.preview-file › Livewire\Features › FilePreviewController@handle
// POST            livewire/update ......................... livewire.update › Livewire\Mechanisms › HandleRequests@handleUpdate
// POST

