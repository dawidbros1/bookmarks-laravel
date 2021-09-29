<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Page;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    use HandlesAuthorization;

    private Subcategory $subcategory;
    private Category $category;

    public function __construct(Subcategory $subcategory, Category $category)
    {
        $this->subcategory = $subcategory;
        $this->category = $category;
    }

    // Tutaj strona już istnieje
    public function author(User $user, $page)
    {
        if ($page == null) return Response::deny('Zasób nie istnieje');
        return  $this->checkParent($user, new Page(), $page->type, $page->parent_id);
    }

    // Tutaj strona jeszcze nie istnieje
    public function checkParent(User $user, Page $page, $type = null, $parent_id = null)
    {
        if ($type == 'subcategory') {
            $subcategory = $this->subcategory->find($parent_id);
            $this->checkSubcategory($user, $subcategory);
        } elseif ($type == 'category') {
            $category = $this->category->find($parent_id);
            $this->checkCategory($user, $category);
        } else {
            return Response::deny('Nieprawidłowy typ strony');
        }

        return Response::allow();
    }

    public function checkSubcategory($user, Subcategory $subcategory)
    {
        if ($subcategory == null) return Response::deny('Zasób nie istnieje');
        $category = $this->category->find($subcategory->category_id);
        $this->checkCategory($user, $category);
    }

    public function checkCategory($user, Category $category)
    {
        if ($category == null) return Response::deny('Zasób nie istnieje');
        if ($category->user_id != $user->id) return Response::deny('Brak uprawnień do tego zasobu');
    }
}
