<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Page;
use App\Models\Subcategory;
use App\Models\User;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    use HandlesAuthorization;

    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->category = $this->categoryRepository->getModel();
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->subcategory = $this->subcategoryRepository->getModel();
    }

    // Tutaj strona już istnieje
    public function author(User $user, $page)
    {
        if ($page == null) return Response::deny('Zasób nie istnieje');
        return  $this->checkParent($user, new Page(), $page->type, $page->parent_id);
    }

    // Tutaj strona jeszcze nie musi istnieje, ale może
    public function checkParent(User $user, Page $page, $type = null, $parent_id = null)
    {
        if ($type == 'subcategory') {
            $subcategory = $this->subcategory->find($parent_id);
            return $this->checkSubcategory($user, $subcategory);
        } elseif ($type == 'category') {
            $category = $this->category->find($parent_id);
            return $this->checkCategory($user, $category);
        } else {
            return Response::deny('Nieprawidłowy typ strony');
        }
    }

    public function categoryAuthor($user, Page $page,  Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }

    public function categories($user, Page $page, $type, $parent_ids)
    {
        if ($type == "subcategory") {
            $subcategories = $this->subcategoryRepository->getAllByIds($parent_ids);
            $parent_ids = $subcategories->pluck('category_id')->toArray();
        }

        $categories = $this->categoryRepository->getAllByIds($parent_ids);

        foreach ($categories as $category) {
            if ($category == null) return Response::deny('Zasób nie istnieje');
            if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
        }

        return Response::allow();
    }

    // Funkcje pomocnicze
    private function checkSubcategory($user, Subcategory $subcategory)
    {
        if ($subcategory == null) return Response::deny('Zasób nie istnieje');
        $category = $this->category->find($subcategory->category_id);
        return $this->checkCategory($user, $category);
    }

    private function checkCategory($user, Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
