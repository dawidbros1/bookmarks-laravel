<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;

class SubcategoryRepository  extends Repository
{
    private Subcategory $model;

    public function __construct(Subcategory $model)
    {
        $this->model = $model;
    }

    public function getCategory($id)
    {
        $args['user_id'] = Auth::id();
        $args['id'] = $id;

        return (new Category())->where($args)->get()->first();
    }

    public function get($id)
    {
        return $this->model->where(['id' => $id])->with('category')->get()->first();
    }

    public function getWithPages($id)
    {
        return $this->model->where(['id' => $id])->with('pages')->get()->first();
    }

    public function getCategories()
    {
        return (new Category())->orderBy('order')->where('user_id', Auth::id())->get();
    }

    public function getAllByIds(array $ids)
    {
        return $this->model
            ->whereIN('id', $ids)
            ->get();
    }
}
