<?php

namespace App\Actions\Jetstream;

use App\Models\Category;
use App\Models\Page;
use App\Models\Subcategory;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Contracts\DeletesUsers;

class DeleteUser implements DeletesUsers
{
    /**
     * Delete the given user.
     *
     * @param  mixed  $user
     * @return void
     */
    public function delete($user)
    {
        // Pobranie zalogowanego użytkownika
        $me = Auth::user();

        if ($me == null) {
            return redirect()->route('login');
            exit();
        }

        // Pobranie kategorii użytkownika
        $categories = CategoryRepository::getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        // Pobranie podkategorii użytkownika
        $subcategories = SubcategoryRepository::getAllByCategoryIds($category_ids);
        $subcategory_ids = $subcategories->pluck('id')->toArray();
        // Pobranie stron użytkownika dla kategorii oraz podkategori
        $category_pages = PageRepository::getAllByParameters($category_ids, 'category');
        $subcategory_pages = PageRepository::getAllByParameters($subcategory_ids, 'subcategory');
        // Pobranie stron użytkownika dla podkategorii

        //! KASOWANIE
        Category::destroy($category_ids);
        Subcategory::destroy($subcategory_ids);
        Page::destroy($category_pages->pluck('id')->toArray());
        Page::destroy($subcategory_pages->pluck('id')->toArray());

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();
    }
}
