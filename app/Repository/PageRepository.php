<?php

namespace App\Repository;

use App\Models\Page;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PageRepository
{
    private Page $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getAllByIds($ids)
    {
        return $this->model
            ->orderBy('position')
            ->whereIN('id', $ids)
            ->get();
    }

    public function getCategories()
    {
        return (new Category())->orderBy('position')->where(['user_id' => Auth::id()])->get();
    }

    public static function getSubcategoriesByCategoryIds(array $ids)
    {
        return (new Subcategory())->orderBy('position')
            ->whereIN('category_id', $ids)->get();
    }

    public function getSubcategory($id)
    {
        return (new Subcategory)->where('id', $id)->with('category')->get()->first();
    }

    public function getCategory($id)
    {
        return (new Category)->where(['id' => $id, 'user_id' => Auth::id()])->get()->first();
    }

    public function get($id)
    {
        return $this->model->orderBy('position')
            ->where(['id' => $id])->get()->first();
    }
}
