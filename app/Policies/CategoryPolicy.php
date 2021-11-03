<?php

namespace App\Policies;

use App\Helpers\Message;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Category $category)
    {
        if ($user->id != $category->user_id) return Response::deny(Message::get(2));
        return Response::allow();
    }

    public function categories(User $user, Category $category, $categories)
    {
        foreach ($categories as $category) {
            if ($user->id != $category->user_id) return Response::deny(Message::get(2));
        }

        return Response::allow();
    }
}
