<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Page;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Repository
{
    public function deletePages($pages)
    {
        (new Page())->destroy($pages->pluck('id')->toArray());
    }

    public function deleteSubcategories($subcategory)
    {
        (new Subcategory())->destroy($subcategory->pluck('id')->toArray());
    }
}
