<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Middleware\redirectLoggedInUserToCategoryList;
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

// Jeżeli użytkownik jest zalogowany to przekerujemy go na stronę category.list
Route::group(
    [
        'as' => 'name',
        'middleware' => redirectLoggedInUserToCategoryList::class
    ],

    function () {
        Route::get('/', function () {
            return view('welcome');
        });
    }
);

// Dla zalogowanego użytkownika
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
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
            Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
            Route::get('/changeVisibility/{id}', [CategoryController::class, 'changeVisibility'])->name('changeVisibility');
            Route::get('/{id}/manage/pages', [CategoryController::class, 'managePages'])->name('manage.pages');
            Route::get('/{id}/manage/subcategories', [CategoryController::class, 'manageSubcategories'])->name('manage.subcategories');
        }
    );

    Route::group(
        [
            'prefix' => "subcategory",
            'as' => 'subcategory.'
        ],
        function () {

            Route::match(array('GET', 'POST'), '/create/{category_id}', [SubcategoryController::class, 'create'])->name('create');
            Route::match(array('GET', 'POST'), '/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [SubcategoryController::class, 'delete'])->name('delete');
            Route::get('/show/{id}', [SubcategoryController::class, 'show'])->name('show');
            Route::get('/changeVisibility/{id}', [SubcategoryController::class, 'changeVisibility'])->name('changeVisibility');
            Route::post('/manage', [SubcategoryController::class, 'manage'])->name('manage');
            Route::get('/{id}/manage/pages', [SubcategoryController::class, 'managePages'])->name('manage.pages');
        }
    );

    Route::group(
        [
            'prefix' => "page",
            'as' => 'page.'
        ],
        function () {
            Route::match(array('GET', 'POST'), '/{type}/{id}/create', [PageController::class, 'create'])->name('create');
            Route::match(array('GET', 'POST'), '/edit/{id}', [PageController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('delete');
            Route::get('/changeVisibility/{id}', [PageController::class, 'changeVisibility'])->name('changeVisibility');
            Route::post('/manage', [PageController::class, 'manage'])->name('manage');
        }
    );
});

// Dane publiczne
Route::get('category/public/show/{id}', [CategoryController::class, 'showPublic'])->name('category.public');
Route::get('subcategory/public/show/{id}', [SubcategoryController::class, 'showPublic'])->name('subcategory.public');
