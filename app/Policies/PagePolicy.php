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

    public function subcategoryAuthor($user, Page $page,  Subcategory $subcategory)
    {
        $category = $this->categoryRepository->getModel()->find($subcategory->category_id);
        if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }

    public function categoryAuthor($user, Page $page,  Category $category)
    {
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
            if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
        }

        return Response::allow();
    }
}
