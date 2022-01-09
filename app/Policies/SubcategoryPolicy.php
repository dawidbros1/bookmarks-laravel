<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    use HandlesAuthorization;

    public function author(User $user, $subcategory)
    {
        $category = $subcategory->category ?? null;
        if ($user->id != $category->user_id) return Response::deny('Brak uprawnień do tego zasobu');
        return Response::allow();
    }
}
