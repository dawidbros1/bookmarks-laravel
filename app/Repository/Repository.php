<?php

namespace App\Repository;

use App\Models\Page;
use App\Models\Subcategory;

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
