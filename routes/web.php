<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingsController;
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
    //! Categories
    Route::group(
        [
            'prefix' => "category",
            'as' => 'category.'
        ],
        function () {
            Route::get('/list', [CategoryController::class, 'list'])->name('list');
            Route::get('/show/{id}', [CategoryController::class, 'show'])->name('show');

            Route::match(array('GET', 'POST'), '/create', [CategoryController::class, 'create'])->name('create');
            Route::match(array('GET', 'POST'), '/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::match(array('GET', 'POST'), '/manage', [CategoryController::class, 'manage'])->name('manage');
            Route::get('/managePages', [CategoryController::class, 'managePages'])->name('manage.pages');

            Route::get('/changeVisibility/{id}', [CategoryController::class, 'changeVisibility'])->name('changeVisibility');
            Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
        }
    );

    //! Subcategories
    Route::group(
        [
            'prefix' => "subcategory",
            'as' => 'subcategory.'
        ],
        function () {

            Route::match(array('GET', 'POST'), '/create/{category_id}', [SubcategoryController::class, 'create'])->name('create');
            Route::match(array('GET', 'POST'), '/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');

            Route::get('/show/{id}', [SubcategoryController::class, 'show'])->name('show');
            Route::get('/changeVisibility/{id}', [SubcategoryController::class, 'changeVisibility'])->name('changeVisibility');
            Route::delete('/delete/{id}', [SubcategoryController::class, 'delete'])->name('delete');
        }
    );

    //! Pages
    Route::group(
        [
            'prefix' => "page",
            'as' => 'page.'
        ],
        function () {
            Route::match(array('GET', 'POST'), '/{parent}/{id}/create', [PageController::class, 'create'])->name('create');
            Route::match(array('GET', 'POST'), '/edit/{id}', [PageController::class, 'edit'])->name('edit');
            Route::post('/manage/{type}', [PageController::class, 'manage'])->name('manage');

            Route::get('/changeVisibility/{id}', [PageController::class, 'changeVisibility'])->name('changeVisibility');
            Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('delete');
        }
    );

    Route::group(
        [
            'prefix' => "settings",
            'as' => 'settings.'
        ],
        function () {
            Route::match(array('GET', 'POST'), '/manage', [SettingsController::class, 'manage'])->name('manage');
        }
    );


    //! MANAGE VIEW
    Route::group(
        [
            'prefix' => "manage",
            'as' => 'manage.'
        ],
        function () {
            // Route::get('/settings', [SettingsController::class, 'manage'])->name('settings');

            Route::get('/subcategories', [SubcategoryController::class, 'manage'])->name('subcategories');

            Route::get('/subcategories/pages', [PageController::class, 'manage'])->name('subcategories.pages');

            // Dla pojedynczych elementów
            Route::get('/category/{id}/pages', [PageController::class, 'managePagesFromCategory'])->name('category.pages');
            Route::get('/category/{id}/subcategories', [SubcategoryController::class, 'manageAllFromCategory'])->name('category.subcategories');
            Route::get('/subcategory/{id}/pages', [PageController::class, 'manageAllFromSubcategory'])->name('subcategory.pages');
        }
    );

    //! MANAGE UPDATA
    Route::group(
        [
            'prefix' => "update",
            'as' => 'update.'
        ],
        function () {
            Route::post('/settings', [SettingsController::class, 'update'])->name('settings');
            Route::post('/categories', [CategoryController::class, 'multiUpdate'])->name('categories');
            Route::post('/subcategories', [SubcategoryController::class, 'multiUpdate'])->name('subcategories');
            Route::post('/{type}/pages', [PageController::class, 'multiUpdate'])->name('pages');
        }
    );
});

// Dane publiczne
Route::get('category/public/show/{id}', [CategoryController::class, 'showPublic'])->name('category.public');
Route::get('subcategory/public/show/{id}', [SubcategoryController::class, 'showPublic'])->name('subcategory.public');
