<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryRepository
{
    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    // public function getModel()
    // {
    //     return $this->model;
    // }

    // public function getSubcategoryRepository()
    // {
    //     return $this->subcategoryRepository;
    // }

    // public function getAllByIds($ids)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->whereIN('id', $ids)
    //         ->get();
    // }

    public function getByParams(array $args)
    {
        $args = $args;
        $args['user_id'] = Auth::id();

        return $this->model->orderBy('order')->where($args)->get();
    }


    public function getWithRelations(int $id)
    {
        return $this->model
            ->orderBy('order')
            ->where(['user_id'=> Auth::id(), 'id' => $id])
            ->with('subcategories')
            ->with('pages')
            ->get()->first();
    }

    // Pobieranie danych z relacjami
    // public function getAllWithSubcategories()
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where('user_id', Auth::id())
    //         ->with('subcategories')
    //         ->get();
    // }

    // public function getAllWithPages()
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where('user_id', Auth::id())
    //         ->with('pages')
    //         ->get();
    // }

    // public function getAllWithSubcategoriesWithPages()
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where('user_id', Auth::id())
    //         ->with('subcategories.pages')
    //         ->get();
    // }

    // Pojedyncze po ID z relacjami
    // public function getWithPages($id)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where(['user_id' => Auth::id(), 'id' => $id])
    //         ->with('pages')
    //         ->get();
    // }

    // public function getWithSubcategories($id)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where(['user_id' => Auth::id(), 'id' => $id])
    //         ->with('subcategories')
    //         ->get();
    // }
}
