<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
Route::get('/', function (Request $request) {

    \Log::debug($request->ip() ?? 'no_IP_was_discovered');
    return view('main');
})->name('home');

Route::get('/language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

/*
Route::get('/en', function (Request $request) {
    App::setLocale('en');
    return view('main');
})->name('locale-eng');

Route::get('/ru', function (Request $request) {
    App::setLocale('ru');
    return view('main');
})->name('locale-ru');
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('tasks', TaskController::class);

Route::resource('labels', LabelController::class)->except(['show']);

// Route::get('task_statuses', 'App\Http\Controllers\TaskController@index')->name('task_statuses.index');
Route::resource('task_statuses', TaskStatusController::class)->except(['show']);

require __DIR__ . '/auth.php';
