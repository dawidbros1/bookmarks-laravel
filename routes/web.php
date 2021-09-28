<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Middleware\redirectLoggedInUserToNews;
use Illuminate\Support\Facades\Route;

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

// Jeżeli użytkownik jest zalogowany to przekerujemy go na stronę news
Route::group(
    [
        'as' => 'name',
        'middleware' => redirectLoggedInUserToNews::class
    ],

    function () {
        Route::get('/', function () {
            return view('welcome');
        });
    }
);

Route::middleware(['auth:sanctum', 'verified'])->get('/news', function () {
    return view('news');
})->name('news');


// Dla zalogowanego użytkownika
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Categories //
    Route::group(
        [
            'prefix' => "category",
            'as' => 'category.'
        ],
        function () {
            // CREATE
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');

            // LIST & SHOW
            Route::get('/{view}/list', [CategoryController::class, 'list'])->name('list');
            Route::get('/{view}/show/{id}', [CategoryController::class, 'show'])->name('show');

            // EDIT
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::get('/changeVisibility/{id}', [CategoryController::class, 'changeVisibility'])->name('changeVisibility');

            // DELETE
            Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        }
    );

    // SubCategories
    Route::group(
        [
            'prefix' => "subcategory",
            'as' => 'subcategory.'
        ],
        function () {
            Route::get('/create/{category_id}', [SubcategoryController::class, 'create'])->name('create');
            Route::post('/store', [SubcategoryController::class, 'store'])->name('store');
            Route::get('/show/{view}/{id}', [SubcategoryController::class, 'show'])->name('show');
            Route::get('/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [SubcategoryController::class, 'update'])->name('update');
            Route::get('/changeVisibility/{id}', [SubcategoryController::class, 'changeVisibility'])->name('changeVisibility');
            Route::delete('/delete/{id}', [SubcategoryController::class, 'delete'])->name('delete');
        }
    );

    // Pages
    Route::group(
        [
            'prefix' => "page",
            'as' => 'page.'
        ],
        function () {
            Route::get('/create/{type}/{parent_id}', [PageController::class, 'create'])->name('create');
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PageController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [PageController::class, 'update'])->name('update');
            Route::get('/changeVisibility/{id}', [PageController::class, 'changeVisibility'])->name('changeVisibility');
            Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('delete');
        }
    );

    //
});

// Bez logowania
// Dostęp do listy gdy
// Route::group(
//     [
//         'prefix' => "subcategory",
//         'as' => 'subcategory.'
//     ],
//     function () {
//         Route::get('/list/{id}', [SubcategoryController::class, 'list'])->name('list');
//     }
// );
