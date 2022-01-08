<?php

namespace App\Repository;

use App\Models\Page;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PageRepository
{
    private Page $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getAllByIds($ids)
    {
        //     return $this->model
        //         ->orderBy('order')
        //         ->whereIN('id', $ids)
        //         ->get();
    }

    // parent ID can be INT OR ARRAY OF INT
    public static function getAllByParameters($parent_ids, string $type, int $hidden = -1)
    {
        // $model = new Page;

        // if (gettype($parent_ids) != "array") {
        //     $parent_ids = [$parent_ids];
        // }

        // if ($hidden == -1) {
        //     return $model
        //         ->orderBy('order')
        //         ->where('type', $type)
        //         ->whereIN('parent_id', $parent_ids)
        //         ->get();
        // } else {
        //     return $model
        //         ->orderBy('order')
        //         ->where(['parent_id' => $parent_ids, 'type' => $type, 'hidden' => $hidden])
        //         ->get();
        // }
    }

    public function getPublicDataParameters($id, $type)
    {
        // return $this->model
        //     ->orderBy('order')
        //     ->where(['parent_id' => $id, 'type' => $type, 'public' => 1])
        //     ->get();
    }

    public function getCategories()
    {
        return (new Category())->orderBy('order')->where(['user_id' => Auth::id()])->get();
    }

    public static function getSubcategoriesByCategoryIds(array $ids)
    {
        return (new Subcategory())->orderBy('order')
            ->whereIN('category_id', $ids)->get();
    }

    public function getSubcategory($id)
    {
        return (new Subcategory)->where('id', $id)->with('category')->get()->first();
    }

    public function getCategory($id)
    {
        return (new Category)->where('id', $id)->get()->first();
    }

    public function get($id)
    {
        return $this->model->orderBy('order')
            ->where(['id' => $id])->get()->first();
    }
}
