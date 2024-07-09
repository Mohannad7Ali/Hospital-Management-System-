<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\SectionsController;
use App\Http\Controllers\Dashboard\AmbulanceController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\InsuranceController;
use App\Http\Controllers\Dashboard\RayEmployeeController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\PaymentAccountController;
use App\Http\Controllers\Dashboard\ReceiptAccountController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Route::get('/',[DashboardController::class , 'index']);
Route::get('/', function () {
    return view('welcome');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/custom/livewire/update', $handle);
        });



        // Route::get('index', [DashboardController::class, 'index']);

        //################# dashboard user #####################################################
        Route::get('/dashboard/user', function () {
            return view('Dashboard.User.dashboard');
        })->middleware(['auth'])->name('dashboard.user');
        //######################################################################################

        //################# dashboard Admin ####################################################
        Route::get('/dashboard/admin', function () {
            return view('Dashboard.Admin.dashboard');
        })->middleware(['auth:admin'])->name('dashboard.admin');
        //######################################################################################


        //------------------------------------------------------------------------------------------------------
        Route::middleware('auth:admin')->group(function () {

            //################## start Section Routes ########################################

            Route::resource('sections', SectionsController::class);

            //################## end Section Routes ########################################

            //################## start Doctor Routes ########################################

            Route::resource('Doctors', DoctorController::class);
            Route::post('update_password', [DoctorController::class, 'update_password'])->name('update_password');
            Route::post('update_status', [DoctorController::class, 'update_status'])->name('update_status');


            //################## end Doctor Routes ########################################


            //################## start Services Routes ########################################

            Route::resource('Service', SingleServiceController::class);

            //################## end Services Routes ########################################



            //################## start ServicesGroup Routes ########################################

            Route::view('Add_Services_Group', 'livewire.GroupServices.include_create')->name('AddServicesGroup');
            //################## end ServicesGroup Routes ########################################

            //############################# insurance route ##########################################

            Route::resource('insurance', InsuranceController::class);

            //############################# end insurance route ######################################


            //############################# Ambulance route ##########################################

            Route::resource('Ambulance', AmbulanceController::class);

            //############################# end Ambulance route ######################################


            //############################# Patients route ##########################################

            Route::resource('Patients', PatientController::class);

            //############################# end Patients route ######################################

            //############################# single_invoices route ##########################################

            Route::view('single_invoices', 'livewire.single_invoices.index')->name('single_invoices');

            Route::view('Print_single_invoices', 'livewire.single_invoices.print')->name('Print_single_invoices');

            //############################# end single_invoices route ######################################

            //############################# group_invoices route ##########################################

            Route::view('group_invoices', 'livewire.group_invoices.index')->name('group_invoices');

            Route::view('group_Print_invoices', 'livewire.group_invoices.print')->name('group_Print_invoices');

            //############################# end group_invoices route ######################################

            //############################# Reciept Account route ##########################################

            Route::resource('Receipt', ReceiptAccountController::class);

            //#############################End  Reciept Account route ##########################################

            //############################# Payment Account route ##########################################

            Route::resource('Payment', PaymentAccountController::class);

            //#############################End  Payment Account route ##########################################


            //############################# RayEmployee route ##########################################

            Route::resource('ray_employee', RayEmployeeController::class);

            //############################# end RayEmployee route ######################################

        });
        //--------------------------------------------------------------------------------------------------------
        require __DIR__ . '/auth.php';
    }
);
