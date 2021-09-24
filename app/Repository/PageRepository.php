<?php

namespace App\Repository;

use App\Models\Page;
use App\Repository\PageRepository as PageRepositoryInterface;

class PageRepository
{
    private Page $model;

    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getAllByIdAndType(int $parent_id, string $type)
    {
        return $this->model
            ->orderBy('order')
            ->where(['parent_id' => $parent_id, 'type' => $type])
            ->get();
    }

    public function getAllByIdsAndType(array $ids, string $type)
    {
        return $this->model
            ->whereIN('parent_id', $ids)
            ->where('type', $type)
            ->get();
    }

    public function getAllBySubcategoryIds($ids)
    {
        return $this->model
            ->whereIn('subcategory_id', $ids)
            ->get();
    }

    // Scalic te dwie funcji niżej i wyżej i pozamieniać w kodzie

    // public function getAllByCategoryIds($ids)
    // {
    //     return $this->model
    //         ->whereIn('category_id', $ids)
    //         ->get();
    // }

    // public function getAllByIds(array $ids)
    // {
    //     return $this->model
    //         ->whereIN('id', $ids)
    //         ->get();
    // }

    public function deleteAllBySubcategoryId(int $subcategory_id)
    {
        $this->model->where('subcategory_id', $subcategory_id)->delete();
    }

    public function deleteAllBySubcategoryArrayId(array $ids)
    {
        // Usuń stron po subcategory_ids
        $this->model->whereIn('subcategory_id', $ids)->delete();
    }

    public function multiUpdateOrders(array $ids, array $orders)
    {
        foreach ($ids as $key => $id) {
            $this->model::where('id', $ids[$key])->update(['order' => $orders[$key]]);
        }
    }
}
