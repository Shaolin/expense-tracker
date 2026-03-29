<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Route::get('/expenses', function () {
//     return view('expenses.index');
// })->name('expenses.index');

// Route::get('/expenses', [TransactionController::class, 'expenses'])->name('expenses.index');

// Route::middleware(['auth'])->group(function () {
//     Route::resource('expenses', TransactionController::class)
//         ->only(['index', 'create' , 'store', 'edit', 'update', 'destroy']);
// });



// Expenses
Route::get('/expenses', [TransactionController::class, 'expenses'])->name('expenses.index');
Route::get('/expenses/create', [TransactionController::class, 'createExpense'])
    ->name('expenses.create');
Route::get('/expenses/{transaction}/edit', [TransactionController::class, 'editExpense'])
    ->name('expenses.edit');
    Route::delete('/expenses/{transaction}', [TransactionController::class, 'destroyExpense'])
    ->name('expenses.destroy');

// Income
Route::get('/income', [TransactionController::class, 'income'])->name('income.index');

// CRUD (still needed)
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');


Route::get('/income', function () {
    return view('income.index');
})->name('income.index');




Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'create' , 'store', 'edit', 'update', 'destroy']);
});




Route::get('/budget', function () {
    return view('budget.index');
})->name('budget.index');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
