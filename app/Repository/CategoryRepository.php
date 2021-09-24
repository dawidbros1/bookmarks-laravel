<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\SubcategoryRepository;
use Illuminate\Support\Facades\Auth;

class CategoryRepository
{
    private Category $model;
    private SubcategoryRepository $subcategoryRepository;

    public function __construct(Category $model, SubcategoryRepository $subcategoryRepository)
    {
        $this->model = $model;
        $this->subcategoryRepository = $subcategoryRepository;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getSubcategoryRepository()
    {
        return $this->subcategoryRepository;
    }

    public function all()
    {
        return $this->model
            ->orderBy('order')
            ->where('user_id', Auth::id())
            ->get();
    }

    // public function getAllByIds($ids)
    // {
    //     return $this->model
    //         ->whereIn('id', $ids)
    //         ->get();
    // }

    // public function multiUpdateOrders(array $ids, array $orders)
    // {
    //     foreach ($ids as $key => $id) {
    //         $this->model::where('id', $ids[$key])->update(['order' => $orders[$key]]);
    //     }
    // }

    // public function deleteByIds($ids)
    // {
    //     $subcategories = $this->subcategoryRepository->getAllByCategoryIds($ids);
    //     $subcategories_id = $subcategories->pluck('id')->toArray();
    //     $this->subcategoryRepository->getModel()->destroy($subcategories_id);
    //     $this->subcategoryRepository->getPageRepository()->deleteAllBySubcategoryArrayId($subcategories_id);
    //     $this->getModel()->destroy($ids);
    // }
}
