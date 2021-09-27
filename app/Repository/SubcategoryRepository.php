<?php

namespace App\Repository;

use App\Models\SubCategory;
// use App\Repository\PageRepository;
use Illuminate\Support\Facades\Auth;

class SubcategoryRepository
{
    private Subcategory $model;
    private PageRepository $pageRepository;

    public function __construct(Subcategory $model, PageRepository $pageRepository)
    {
        $this->model = $model;
        $this->pageRepository = $pageRepository;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getPageRepository()
    {
        return $this->pageRepository;
    }

    public function getAllByCategoryId(int $id)
    {
        return $this->model
            ->orderBy('order')
            ->where('category_id', $id)
            ->get();
    }

    public function getAllByCategoryIdAndHidden($id ,$hidden)
    {
        return $this->model
            ->orderBy('order')
            ->where(['category_id' => $id, 'hidden' => $hidden])
            ->get();
    }
}
