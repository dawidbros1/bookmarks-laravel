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

    // public function getCategoryBySubcategoryId($id){
    //     return $this->model
    //         ->where('category_id', $id)
    //         ->get();
    // }

    public function getPageRepository()
    {
        return $this->pageRepository;
    }

    // public function getAllByParentSubcategoryId(int $id)
    // {
    //     return $this->model
    //         ->orderBy('order')
    //         ->where('parent_subcategory_id', $id)
    //         ->get();
    // }

    public function getAllByCategoryId(int $id)
    {
        return $this->model
            ->orderBy('order')
            ->where('category_id', $id)
            ->get();
    }

    // public function getAllByCategoryIds(array $ids)
    // {
    //     return $this->model
    //         ->whereIN('category_id', $ids)
    //         ->get();
    // }

    // public function getAllByCategoryIdsNotInBadIndexes($ids, $badIndexses)
    // {
    //     return $this->model
    //         ->whereIn('category_id', $ids)
    //         ->whereNotIn('id', $badIndexses)
    //         ->get();
    // }

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

    // Update usunięcia danych

    // public function deleteByIds($ids)
    // {
    //     foreach ($ids as $id) {
    //         $this->deleteContent($id);
    //     }
    // }

    // // Helping Functions

    // public function deleteContent($id)
    // {
    //     $subcategories = $this->getAllByParentSubcategoryId($id);

    //     foreach ($subcategories as $subcategory) {
    //         $this->deleteContent($subcategory->id);
    //     }

    //     $this->pageRepository->deleteAllBySubcategoryId($id);
    //     $this->getModel()->destroy($id);
    // }
}
