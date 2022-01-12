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

    public function __construct()
    {
    }
}
