<?php

use App\Http\Controllers\AdditionalServicesController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\IndexController;
use App\Models\Communication;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\WorkersServicesController;

// API valdymas
// Čia nurodomi visi kliento komunikacijos su vidiniu serveriu kanalai
// angliškai tariant front-end gali pasiekti back-end

// PASLAUGOS (tai taip pat yra bendrinis puslapis) puslapio užkrunami tokie duomenys, kaip
// visos siūlomos paslaugos, taip pat datos ir laikai jų rezervacijoms
// papildomos darbuotojų (visažisto ir plaukų stilisto) paslaugos
Route::get('/', function () {
    $services = DB::table('services')->get();
    $workerServicesVisaz = DB::table('workers_services')
                    ->where('workerServiceType', 'Visažistas')
                    ->get();
    $workerServicesStyle = DB::table('workers_services')
                    ->where('workerServiceType', 'Plaukų stilistas')
                    ->get();
        $currentMonth = date('n');
        $currentYear = date('Y');

    return view('index', ['services' => $services, 'currentMonth' => $currentMonth, 'currentYear' => $currentYear, 'workerServicesVisaz' => $workerServicesVisaz, 'workerServicesStyle' => $workerServicesStyle]);
})->name('index');
Route::post('/addService', [IndexController::class, 'addService'])->name('addService');
Route::post('/deleteService/{serviceId}', [IndexController::class, 'deleteService'])->name('deleteService');
Route::get('/showService/{serviceId}', [IndexController::class, 'showService'])->name('showService');
Route::get('/get-calendar/{currentYear}/{currentMonth}', [IndexController::class, 'getCalendar'])->name('getCalendar');
Route::get('/get-available-times/{selectedDate}/{serviceId}', [IndexController::class, 'getAvailability'])->name('getAvailability');
Route::post('/editService', [IndexController::class, 'editService'])->name('editService');

// APIE puslapio užkrovimui
Route::get('/about', function () {
    return view('about');
});


// VARTOTOJAI puslapio užkrovimui
Route::get('users', function () {
    $users = DB::table('users')->get();
    $roles = DB::table('roles')->get();
    return view('users', ['users' => $users, 'roles'=>$roles]);
})->name('users');
Route::get('/getUserById/{userId}', [UsersController::class, 'getUserById'])->name('getUserById');
Route::post('/editUser', [UsersController::class, 'editUser'])->name('editUser');


// REGISTRACIJA puslapio užkrovimui ir valdymui
Route::get('/registration',[AuthManager::class, 'registration'])->name('registration');
Route::post('registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

// PRISIJUNGTI puslapio užkrovimui ir valdymui
Route::get('/login',[AuthManager::class, 'login'])->name('login');
Route::post('login', [AuthManager::class, 'loginPost'])->name('login.post');

// ATSIJUNGTI funkcijos užkrovimui
Route::get('/logout',[AuthManager::class,'logout'])->name('logout');

// REZERVACIJŲ bendriniam valdymui ir užkrovimui (BŪSIMI VIZITAI, ATLIKTI DARBAI)
Route::get('/reservations', [ReservationController::class, 'index']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservation_done/{date}/{time}/{price}/{paymentType}/{serviceId}/{userId}/{comment}/{additionalServices}', [ReservationController::class, 'reservationDone'])->name('reservationDone');
Route::get('/upcoming-events', [ReservationController::class, 'upcomingEvents'])->name('upcomingEvents');
Route::get('/getReservationById/{userId}', [ReservationController::class, 'getReservationById'])->name('getReservationById');
Route::post('/editReservation', [ReservationController::class, 'editReservation'])->name('editReservation');
Route::get('/done-events', [ReservationController::class, 'doneEvents'])->name('doneEvents');
Route::get('/done-events-specific/{userId}', [ReservationController::class, 'doneEventsSpecific'])->name('doneEventsSpecific');
Route::post('/addFile', [ReservationController::class, 'addFile'])->name('addFile');
Route::get('/reservation_done', [ReservationController::class, 'reservationDones'])->name('reservationDones');
Route::get('/cancelReservation/{serviceId}', [ReservationController::class, 'cancelReservation'])->name('cancelReservation');

// PASLAUGŲ UŽSAKYMO bendriniam valdymui
Route::get('/create-order', [PaymentController::class, 'createOrder'])->name('createOrder');


// ATSILIEPIMAI valdymas
Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('feedback');
Route::post('/addFeedback', [FeedbackController::class, 'addFeedback'])->name('addFeedback');


// KOMENTARŲ valdymas tarp kliento ir fotografo
Route::post('/addComment', [CommunicationController::class, 'addComment'])->name('addComment');
Route::post('/getComments', [CommunicationController::class, 'getComments'])->name('getComments');

// PAPILDOMŲ PASLAUGŲ vadymas
Route::post('/addWorkerService', [WorkersServicesController::class, 'addWorkerService'])->name('addWorkerService');
Route::post('/deleteWorkerService/{workerServiceId}', [WorkersServicesController::class, 'deleteWorkerService'])->name('deleteWorkerService');
Route::post('/editWorkerServices', [WorkersServicesController::class, 'editWorkerService'])->name('editWorkerService');
Route::get('/specificWorkerService/{userId}', [WorkersServicesController::class, 'specificWorkerService'])->name('specificWorkerService');
Route::get('/worker-services', [WorkersServicesController::class, 'allWorkersServices'])->name('allWorkersServices');
Route::get('/additional-service/{reservationId}', [AdditionalServicesController::class, 'getSpecificReservationAdditionals'])->name('getSpecificReservationAdditionals');
