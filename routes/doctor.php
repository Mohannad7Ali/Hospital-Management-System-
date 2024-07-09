<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard_Doctor\RayController;
use App\Http\Controllers\Dashboard_Doctor\InvoiceController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard_Doctor\DiagnosticController;
use App\Http\Controllers\Dashboard_Doctor\LaboratoryController;
use App\Http\Controllers\Dashboard_Doctor\PatientDetailsController;

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
        Route::get('/dashboard/doctor', function () {
            return view('Dashboard.Doctor.dashboard');
        })->middleware(['auth:doctor'])->name('dashboard.Doctor');
        //######################################################################################

        //------------------------------------------------------------------------------------------------------
        Route::middleware('auth:doctor')->group(function () {

            Route::prefix('doctor')->group(function () {


                //#################  completed invoices route ####################################################
                Route::get('completedInvoices', [InvoiceController::class, 'completedInvoices'])->name('completedInvoices');
                //#############################################################################################

                //#################  Doctor invoices route ####################################################
                Route::get('reviewInvoices', [InvoiceController::class, 'reviewInvoices'])->name('reviewInvoices');

                //#############################################################################################

                //############################# review_invoices route ##########################################
                Route::post('add_review', [DiagnosticController::class, 'addReview'])->name('add_review');
                //############################# end invoices route #############################################

                //#################  Doctor invoices route ####################################################
                Route::resource('invoices', InvoiceController::class);
                //#############################################################################################

                //#################  Doctor Diagnostic route ####################################################
                Route::resource('Diagnostics', DiagnosticController::class);
                //#############################################################################################

                //#################  rays route ####################################################
                Route::resource('rays', RayController::class);
                //#############################################################################################

                //#################  patients_details route ####################################################
                Route::get('patient_details/{id}', [PatientDetailsController::class, 'index'])->name('Patient_Details');
                //#############################################################################################



                //#################  rays route ####################################################
                Route::resource('Laboratories', LaboratoryController::class);
                //#############################################################################################
            });
        });
        //--------------------------------------------------------------------------------------------------------
        require __DIR__ . '/auth.php';
    }
);
