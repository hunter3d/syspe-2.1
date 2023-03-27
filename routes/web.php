<?php

use App\Http\Controllers\AnsweroptionsController;
use App\Http\Controllers\AnswersController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CardsController;
use App\Http\Controllers\Config\LogsController;
use App\Http\Controllers\Config\RolesController;
use App\Http\Controllers\Config\StaffController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ExhibitionsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PromocodesController;
use App\Http\Controllers\QuestionnairesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ScanerController;
use App\Http\Controllers\TextsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\VisitorsController;
use Illuminate\Support\Facades\Route;

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
//
Route::get('/', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
// MESSAGES
Route::prefix('messages')->group(function () {
    Route::get('/add', [MainController::class, 'create'])
        ->middleware('auth')
        ->name('messages.create');
    Route::post('/add', [MainController::class, 'store'])
        ->middleware('auth')
        ->name('messages.store');
    Route::get('/edit/{id}', [MainController::class, 'edit'])
        ->middleware('auth')
        ->name('messages.create');
    Route::post('/edit/{id}', [MainController::class, 'update'])
        ->middleware('auth')
        ->name('messages.update');
    Route::get('/delete/{id}', [MainController::class, 'destroy'])
        ->middleware('auth')
        ->name('messages.destroy');
});

// TEXTS
Route::prefix('texts')->group(function () {
    Route::get('/index',[TextsController::class,'index'])
        ->middleware('auth')
        ->middleware('allow:texts')
        ->name('texts');
    Route::get('/add', [TextsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:texts create')
        ->name('messages.create');
    Route::post('/add', [TextsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:texts store')
        ->name('messages.store');
    Route::get('/edit/{id}', [TextsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:texts edit')
        ->name('messages.create');
    Route::post('/edit/{id}', [TextsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:texts update')
        ->name('messages.update');
    Route::get('/delete/{id}', [TextsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:texts destroy')
        ->name('messages.destroy');
});

// AUTH
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])
        ->middleware('guest')
        ->name('login');
    Route::post('/login', [AuthController::class, 'store'])
        ->middleware('guest');
    Route::get('/logout', [AuthController::class, 'destroy'])
        ->middleware('auth');
});

// CONFIG
Route::prefix('config')->group(function () {
    // LOGS
    Route::get('/logs', [ LogsController::class, 'index' ])
        ->middleware('auth')
        ->middleware('allow:logs')
        ->name('logs');
    Route::get('/logs/name/{name}', [LogsController::class, 'name'])
        ->middleware('auth')
        ->middleware('allow:logs')
        ->name('logs.name');
    // STAFF
    Route::get('/staff', [StaffController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:staff')
        ->name('staff');
    Route::get('/staff/add', [StaffController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:staff create');
    Route::post('/staff/add', [StaffController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:staff store');
    Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:staff edit');
    Route::post('/staff/edit/{id}', [StaffController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:staff update');
    Route::get('/staff/block/{id}', [StaffController::class, 'block'])
        ->middleware('auth')
        ->middleware('allow:staff block');
    // ROLES
    Route::get('/roles', [RolesController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:roles')
        ->name('roles');
    Route::get('/roles/add', [RolesController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:roles create');
    Route::post('/roles/add', [RolesController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:roles store');
    Route::get('/roles/edit/{id}', [RolesController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:roles destroy');
    Route::post('/roles/edit/{id}', [RolesController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:roles update');
    Route::get('/roles/delete/{id}', [RolesController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:roles destroy');
});

// SEARCH
Route::post('/search',[\App\Http\Controllers\SearchController::class,'get'])
    ->middleware('auth')
    ->name('search');

// EXHIBITIONS
Route::prefix('exhibitions')->group(function () {
    Route::get('/index', [ExhibitionsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:exhibitions')
        ->name('exhibitions');
    Route::get('/add', [ExhibitionsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:exhibitions create')
        ->name('exhibitions.create');
    Route::post('/add', [ExhibitionsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:exhibitions store')
        ->name('exhibitions.store');
    Route::get('/edit/{id}', [ExhibitionsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:exhibitions edit')
        ->name('exhibitions.edit');
    Route::post('/edit/{id}', [ExhibitionsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:exhibitions update')
        ->name('exhibitions.update');
    Route::get('/delete/{id}', [ExhibitionsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:exhibitions destroy')
        ->name('exhibitions.destroy');
});

// EVENTS
Route::prefix('events')->group(function () {
    Route::get('/index', [EventsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events');
    Route::get('/exhibition/{id}', [EventsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events:exhibition');
    Route::get('/show/{id}', [EventsController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events.show');
    Route::get('/exhibition/{id}', [EventsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:events')
        ->name('events.exhibition');
    Route::get('/add', [EventsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:events create')
        ->name('events.create');
    Route::post('/add', [EventsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:events store')
        ->name('events.store');
    Route::get('/edit/{id}', [EventsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:events edit')
        ->name('events.create');
    Route::post('/edit/{id}', [EventsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:events update')
        ->name('events.update');
    Route::get('/delete/{id}', [EventsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:events destroy')
        ->name('events.destroy');
});

// PROMOCODES
Route::prefix('promocodes')->group(function () {
    Route::get('/index', [PromocodesController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:promocodes')
        ->name('promocodes');
    Route::get('/event/{id}', [PromocodesController::class, 'event'])
        ->middleware('auth')
        ->middleware('allow:promocodes')
        ->name('promocodes.event');
    Route::get('/add', [PromocodesController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:promocodes add');
    Route::post('/add', [PromocodesController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:promocodes add');
    Route::get('/edit/{id}', [PromocodesController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:promocodes edit');
    Route::post('/edit/{id}', [PromocodesController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:promocodes edit');
    Route::get('/delete/{id}', [PromocodesController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:promocodes delete');
});

// SCANER
Route::prefix('scaner')->group(function () {
    Route::get('index', [ScanerController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:scaner')
        ->name('scaner');
});

// ORDERS
Route::prefix('orders')->group(function () {
    Route::get('/index', [OrdersController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:orders')
        ->name('orders');
});
Route::prefix('orders')->group(function () {
    Route::get('/exhibition/{id}', [OrdersController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:orders')
        ->name('orders.exhibition');
});
Route::prefix('orders')->group(function () {
    Route::get('/event/{id}', [OrdersController::class, 'event'])
        ->middleware('auth')
        ->middleware('allow:orders')
        ->name('orders.event');
});

// TICKETS
Route::prefix('tickets')->group(function () {
    Route::get('/index', [TicketsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:tickets')
        ->name('tickets');
    Route::get('/exhibition/{id}', [TicketsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:tickets')
        ->name('tickets.exhibition');
    Route::get('/event/{id}', [TicketsController::class, 'event'])
        ->middleware('auth')
        ->middleware('allow:tickets')
        ->name('tickets.event');
    // Tickets Ajax
    Route::post('/check', [TicketsController::class, 'check'])
        ->middleware('auth')
        ->middleware('allow:tickets');
});

// CARDS
Route::prefix('cards')->group(function () {
    Route::get('/index', [CardsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:cards')
        ->name('cards');

    Route::get('/show/{id}', [CardsController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:cards')
        ->name('cards.show');
    Route::post('/addcomment/{id}', [CardsController::class, 'addcomment'])
        ->middleware('auth')
        ->middleware('allow:cards addcomment')
        ->name('cards.addcomment');
    Route::get('/delcomment/{id}', [CardsController::class, 'delcomment'])
        ->middleware('auth')
        ->middleware('allow:cards delcomment')
        ->name('cards.delcomment');
    Route::get('/edit/{id}', [CardsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:cards edit')
        ->name('cards.edit');
    Route::post('/edit/{id}', [CardsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:cards edit')
        ->name('cards.update');
    Route::get('/delete/{id}', [CardsController::class, 'delete'])
        ->middleware('auth')
        ->middleware('allow:cards delete')
        ->name('cards.delete');
    Route::post('/addphone/{id}', [CardsController::class, 'addphone'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::get('/delphone/{id}', [CardsController::class, 'delphone'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::post('/addemail/{id}', [CardsController::class, 'addemail'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::get('/delemail/{id}/{visitor_id}', [CardsController::class, 'delemail'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
});

// TOPICS
Route::prefix('topics')->group(function () {
    Route::get('/index', [TopicsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:topics')
        ->name('topics');

    Route::get('/exhibition/{id}', [TopicsController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:topics')
        ->name('topics.exhibition');

    Route::get('/add', [TopicsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:topics add')
        ->name('topics.add');

    Route::post('/add', [TopicsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:topics add')
        ->name('topics.store');

    Route::get('/edit/{id}', [TopicsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:topics edit')
        ->name('topics.edit');

    Route::post('/edit/{id}', [TopicsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:topics edit')
        ->name('topics.update');

    Route::get('/delete/{id}', [TopicsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:topics delete')
        ->name('topics.destroy');
});

// QUESTIONNAIRES
Route::prefix('questionnaires')->group(function () {
    Route::get('index', [QuestionnairesController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:questionnaires')
        ->name('questionnaires');
    Route::get('exhibition/{id}', [QuestionnairesController::class, 'exhibition'])
        ->middleware('auth')
        ->middleware('allow:questionnaires')
        ->name('questionnaires.exhibition');
    Route::get('show/{id}', [QuestionnairesController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:questionnaires create')
        ->name('questionnaires show');
    Route::get('add', [QuestionnairesController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:questionnaires create')
        ->name('questionnaires create');
    Route::post('add', [QuestionnairesController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:questionnaires store')
        ->name('questionnaires store');
    Route::get('edit/{id}', [QuestionnairesController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:questionnaires edit')
        ->name('questionnaires edit');
    Route::post('edit/{id}', [QuestionnairesController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:questionnaires update')
        ->name('questionnaires update');
    Route::get('delete/{id}', [QuestionnairesController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:questionnaires destroy')
        ->name('questionnaires destroy');
});

// ANSWEROPTIONS
Route::prefix('answeroptions')->group(function () {
    Route::get('add/{id}', [AnsweroptionsController::class, 'create'])
        ->middleware('auth')
        ->middleware('allow:answeroptions create')
        ->name('answeroptions create');
    Route::post('add', [AnsweroptionsController::class, 'store'])
        ->middleware('auth')
        ->middleware('allow:answeroptions store')
        ->name('answeroptions store');
    Route::get('edit/{id}', [AnsweroptionsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:answeroptions edit')
        ->name('answeroptions edit');
    Route::post('edit/{id}', [AnsweroptionsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:answeroptions update')
        ->name('answeroptions update');
    Route::get('delete/{id}', [AnsweroptionsController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('allow:answeroptions destroy')
        ->name('answeroptions destroy');
});

// VISITORS
Route::prefix('visitors')->group(function () {
    Route::get('/index', [VisitorsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:visitors')
        ->name('visitors');
});

// CARDS
Route::prefix('cards')->group(function () {
    Route::get('/index', [CardsController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:cards')
        ->name('cards');

    Route::get('/show/{id}', [CardsController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:cards')
        ->name('cards.show');
    Route::post('/addcomment/{id}', [CardsController::class, 'addcomment'])
        ->middleware('auth')
        ->middleware('allow:cards addcomment')
        ->name('cards.addcomment');
    Route::get('/delcomment/{id}', [CardsController::class, 'delcomment'])
        ->middleware('auth')
        ->middleware('allow:cards delcomment')
        ->name('cards.delcomment');
    Route::get('/edit/{id}', [CardsController::class, 'edit'])
        ->middleware('auth')
        ->middleware('allow:cards edit')
        ->name('cards.edit');
    Route::post('/edit/{id}', [CardsController::class, 'update'])
        ->middleware('auth')
        ->middleware('allow:cards edit')
        ->name('cards.update');
    Route::get('/delete/{id}', [CardsController::class, 'delete'])
        ->middleware('auth')
        ->middleware('allow:cards delete')
        ->name('cards.delete');
    Route::post('/addphone/{id}', [CardsController::class, 'addphone'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::get('/delphone/{id}', [CardsController::class, 'delphone'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::post('/addemail/{id}', [CardsController::class, 'addemail'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
    Route::get('/delemail/{id}/{visitor_id}', [CardsController::class, 'delemail'])
        ->middleware('auth')
        ->middleware('allow:cards edit');
});

// ANSWERS
Route::prefix('answers')->group(function () {
    Route::get('/index', [AnswersController::class, 'index'])
        ->middleware('auth')
        ->middleware('allow:answers')
        ->name('answers');
    Route::get('/show/{event_id}', [AnswersController::class, 'show'])
        ->middleware('auth')
        ->middleware('allow:answers')
        ->name('answers.show');
    Route::get('/showcard/{event_id}', [AnswersController::class, 'showcard'])
        ->middleware('auth')
        ->middleware('allow:answers')
        ->name('answers.showcard');
});

// REPORTS
Route::prefix('reports')->group(function () {
    Route::get('/notickets', [ReportsController::class, 'notickets'])
        ->middleware('auth')
        ->middleware('allow:reports')
        ->name('reports.notickets');
});

// DEBUG
Route::get('debug', [DebugController::class, 'index']);
