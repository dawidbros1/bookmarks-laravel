<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use App\Repository\CategoryRepository;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function author(User $user, Category $category, $id)
    {
        return $this->checkCategory($user, $id);
    }

    public function checkCategory($user, $id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
