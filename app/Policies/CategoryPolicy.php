<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }

    public function categories(User $user, Category $category, $categories)
    {
        foreach ($categories as $category) return $this->author($user, $category);
    }
}
