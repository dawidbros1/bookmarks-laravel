<?php

namespace App\Policies;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Subcategory $subcategory)
    {
        if (($category = $subcategory->category ?? null) == null) {
            return Response::deny('Brak uprawnień do tego zasobu');
        }

        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
