<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LawyerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailabilitieController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ConsultationsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Front\HomeController;



Route::controller(HomeController::class)->group(function () {

    Route::get('/home', 'index')
        ->name('front.index');

    Route::get('/specializations', 'all_specializations')
        ->name('front.allspecializations');

    Route::get('/doctors', 'doctors')
        ->name('front.doctors');

    Route::get('/lawyers', 'lawyers')
        ->name('front.lawyers');

    Route::get('/doctor-profile/{id}', 'doctor_profile')
        ->name('front.doctor_profile');

    Route::get('/lawyer-profile/{id}', 'lawyer_profile')
        ->name('front.lawyer_profile');

    Route::get('/consultation-room', 'consultations')
        ->name('front.consultations');

    Route::get('/contact-us', 'contacts')
        ->name('front.contact');

    Route::post('/contact-us', 'store_contact')
        ->name('front.contact.store');
});


Route::middleware('auth:web')->group(function () {

    Route::get('/profile/{id}', [ProfileController::class, 'edit_profile'])
        ->name('profile.edit');

    Route::put('/update-profile/{id}', [ProfileController::class, 'update_profile'])
        ->name('profile.update');

    Route::get('/my-appointments', [ProfileController::class, 'my_appointments'])
        ->name('myAppiontments');

    Route::put('/cancel-appointment/{id}', [ProfileController::class, 'cancel_appointment'])
        ->name('appointments.cancel');


    Route::get('/doctor-booking/{id}', [HomeController::class, 'doctor_booking'])
        ->name('front.booking_doctor');

    Route::post('/doctor-booking/{id}', [HomeController::class, 'store_doctor_booking'])
        ->name('doctor.booking.store');


    Route::get('/lawyer-booking/{id}', [HomeController::class, 'lawyer_booking'])
        ->name('front.booking_lawyer');

    Route::post('/lawyer-booking/{id}', [HomeController::class, 'store_lawyer_booking'])
        ->name('lawyer.booking.store');
});



Route::prefix('dashboard')->controller(AuthController::class)->group(function () {
    Route::get(
        '/login',
        'showLogin'
    )->name(
        'dashboard.login'
    );

    Route::post(
        '/login',
        'dashboard_login'
    )->name(
        'dashboard.login.post'
    );

    Route::post(
        '/logout',
        'logout'
    )->name(
        'dashboard.logout'
    );
});



Route::prefix('admin')
    ->middleware('auth:admin')
    ->group(function () {

        Route::get('/', [Dashboard::class, 'home'])
            ->name('admin.dashboard');

        Route::resource('admins', AdminController::class);

        Route::resource('doctors', DoctorController::class);

        Route::resource('lawyers', LawyerController::class);

        Route::resource('specializations', SpecializationController::class);

        Route::resource('appointments', AppointmentController::class);

        Route::resource('contacts', ContactController::class);

        Route::resource('availabilities', AvailabilitieController::class);

        Route::resource('consultations', ConsultationsController::class);

        Route::resource('users', UserController::class);

        Route::get(
            '/get-specializations',
            [SpecializationController::class, 'getSpecialization']
        )->name('get.specializations');

        Route::put(
            '/contact-read/{id}',
            [ContactController::class, 'markAsRead']
        )->name('contact.read');
    });




Route::prefix('doctor')
    ->middleware('auth:doctor')
    ->group(function () {

        Route::get(
            '/dashboard',
            [DoctorController::class, 'dashboard']
        )->name('doctor.dashboard');

        Route::get(
            '/profile',
            [DoctorController::class, 'profile']
        )->name('doctor.profile');

        Route::put(
            '/appointment-approve/{id}',
            [DoctorController::class, 'approve_appointment']
        )->name('doctor.appointment.approve');

        Route::put(
            '/appointment-reject/{id}',
            [DoctorController::class, 'reject_appointment']
        )->name('doctor.appointment.reject');
    });




Route::prefix('lawyer')
    ->middleware('auth:lawyer')
    ->group(function () {

        Route::get(
            '/dashboard',
            [LawyerController::class, 'dashboard']
        )->name('lawyer.dashboard');

        Route::get(
            '/profile',
            [LawyerController::class, 'profile']
        )->name('lawyer.profile');

        Route::put(
            '/appointment-approve/{id}',
            [LawyerController::class, 'approve_appointment']
        )->name('lawyer.appointment.approve');

        Route::put(
            '/appointment-reject/{id}',
            [LawyerController::class, 'reject_appointment']
        )->name('lawyer.appointment.reject');
    });


require __DIR__ . '/auth.php';
