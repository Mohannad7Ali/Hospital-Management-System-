<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;


use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard_RayEmploy\InvoiceController;

/*
|--------------------------------------------------------------------------
| doctor Routes
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



        //################# dashboard Doctor ####################################################
        Route::get('/dashboard/ray_employee', function () {
            return view('Dashboard.dashboard_RayEmployee.dashboard');
        })->middleware(['auth:ray_employee'])->name('dashboard.ray_employee');
        //######################################################################################


        //------------------------------------------------------------------------------------------------------
        Route::middleware('auth:ray_employee')->group(function () {

            Route::prefix('ray_employee')->group(function () {

                //############################# end invoices route #############################################

                //#################  Doctor invoices route ####################################################
                Route::get('invoices', function () {
                    dd(564654);
                })->name('bbbbb');
                //#############################################################################################

            });
        });
        //--------------------------------------------------------------------------------------------------------

        require __DIR__ . '/auth.php';
    }
);
