<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function author(User $user, $subcategory)
    {
        if ($subcategory == null) return Response::deny('Zasób nie istnieje');
        $category = $this->category->find($subcategory->category_id);
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }

    public function categoryAuthor(User $user, $subcategory, Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
