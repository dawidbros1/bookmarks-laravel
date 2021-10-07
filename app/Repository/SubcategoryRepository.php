<?php

namespace App\Repository;

use App\Models\SubCategory;
// use App\Repository\PageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getAllByIds(array $ids)
    {
        return $this->model
            // ->orderBy('order')
            ->whereIN('id', $ids)
            ->get();
    }

    public function getAllByCategoryIds(array $ids)
    {
        return $this->model
            ->orderBy('order')
            ->whereIN('category_id', $ids)
            ->get();
    }

    public function getAllByParameters(int $id, int $hidden = -1)
    {
        if ($hidden == -1) {
            return $this->model
                ->orderBy('order')
                ->where('category_id', $id)
                ->get();
        } else {
            return $this->model
                ->orderBy('order')
                ->where(['category_id' => $id, 'hidden' => $hidden])
                ->get();
        }
    }

    public function getPublicDataByCategoryId($id)
    {
        return $this->model
            ->orderBy('order')
            ->where(['category_id' => $id, 'public' => 1])
            ->get();
    }

    public function updateColumn(array $ids, string $column, int $value)
    {
        DB::table('subcategories')->whereIn('id', $ids)->update(array($column => $value));
    }
}
