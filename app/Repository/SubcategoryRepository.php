<?php

namespace App\Repository;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class SubcategoryRepository
{
    private Subcategory $model;

    public function __construct(Subcategory $model)
    {
        $this->model = $model;
    }

    public function getCategory($id){
        $args['user_id'] = Auth::id();
        $args['id'] = $id;

        return (new Category())->where($args)->get()->first();
    }

    public function get($id){
        return $this->model->where(['id' => $id])->with('category')->get()->first();
    }

    public function getCategories(){
        return (new Category())->orderBy('order')->where('user_id', Auth::id())->get();
    }

    // public function getAllByIds(array $ids)
    // {
    //     return $this->model
    //         ->whereIN('id', $ids)
    //         ->get();
    // }

    // public static function getAllByCategoryIds(array $ids)
    // {
    //     $model = new Subcategory();

    //     return $model
    //         ->orderBy('order')
    //         ->whereIN('category_id', $ids)
    //         ->get();
    // }

    // public function getAllByParameters(int $id, int $hidden = -1)
    // {
    //     if ($hidden == -1) {
    //         return $this->model
    //             ->orderBy('order')
    //             ->where('category_id', $id)
    //             ->get();
    //     } else {
    //         return $this->model
    //             ->orderBy('order')
    //             ->where(['category_id' => $id, 'hidden' => $hidden])
    //             ->get();
    //     }
    // }

    // public function getPublicDataByCategoryId($id)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where(['category_id' => $id, 'public' => 1])
    //         ->get();
    // }

    // Pobieranie z relacjami
    // public function getWithPages(int $id)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where('id', $id)
    //         ->with('pages')
    //         ->get();
    // }
}
