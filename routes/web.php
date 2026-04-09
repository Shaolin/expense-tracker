<?php

use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrganizationController;
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






// Expenses
Route::get('/expenses', [TransactionController::class, 'expenses'])->name('expenses.index');
Route::get('/expenses/create', [TransactionController::class, 'createExpense'])
    ->name('expenses.create');
Route::get('/expenses/{transaction}/edit', [TransactionController::class, 'editExpense'])
    ->name('expenses.edit');
Route::delete('/expenses/{transaction}', [TransactionController::class, 'destroyExpense'])
    ->name('expenses.destroy');

// Income
// Route::get('/income', [TransactionController::class, 'income'])->name('income.index');
// Income routes
Route::prefix('income')->group(function () {
    Route::get('/', [TransactionController::class, 'indexIncome'])->name('income.index');
    Route::get('/create', [TransactionController::class, 'createIncome'])->name('income.create');
    Route::post('/', [TransactionController::class, 'storeIncome'])->name('income.store');
    Route::get('/{transaction}/edit', [TransactionController::class, 'editIncome'])->name('income.edit');
    Route::put('/{transaction}', [TransactionController::class, 'updateIncome'])->name('income.update');
    Route::delete('/{transaction}', [TransactionController::class, 'destroyIncome'])->name('income.destroy');
});


// CRUD (still needed)
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/transactions/{transaction}/edit', [TransactionController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{transaction}', [TransactionController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{transaction}', [TransactionController::class, 'destroy'])->name('transactions.destroy');







Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class)
        ->only(['index', 'create' , 'store', 'edit', 'update', 'destroy']);
});





Route::resource('budgets', BudgetController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Organisations

Route::middleware(['auth'])->group(function () {
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
});


Route::middleware(['auth'])->post('/switch-organization', [OrganizationController::class, 'switch'])
    ->name('organizations.switch');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
