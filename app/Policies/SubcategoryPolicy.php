<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use App\Repository\CategoryRepository;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->category = $this->categoryRepository->getModel();
        // $this->category = $category;
    }

    public function author(User $user, $subcategory)
    {
        if ($subcategory == null) return Response::deny('Zasób nie istnieje');
        $category = $this->category->find($subcategory->category_id);
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }

    public function subcategories(User $user, $subcategory, $subcategories)
    {
        $category_ids = array_unique($subcategories->pluck('category_id')->toArray());
        $categories = $this->categoryRepository->getAllByIds($category_ids);

        foreach ($categories as $category) {
            if ($category == null) return Response::deny('Zasób nie istnieje');
            if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        }
        return Response::allow();
    }

    public function categoryAuthor(User $user, $subcategory, Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
