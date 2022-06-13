<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{CompanyController, EmployeeController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    
Route::get('/', function () {
    return auth()->check() ?
    view('home') :
    view('auth.login');
});

Route::get('/localization', function() {
    if(session('lang') === 'en')
        session(['lang' => 'es']);
    else if(session('lang') === 'es')
        session(['lang' => 'en']);
    else
        session(['lang' => 'es']);

    return redirect()->back();
})->name('localization');

Auth::routes([
    "register"  => false,
    "reset"     => false,
    "verify"    => false
]);

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');

    Route::group(['middleware' => ['role:Admin']], function () {
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees/create', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::put('/employees/{employee}/edit', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/companies/create', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/companies/{company}/edit', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/companies/{company}/delete', [CompanyController::class, 'destroy'])->name('companies.destroy');
    });
});