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

    public function getAllByParentIdTypeHidden($parent_id, $type, $hidden)
    {
        return $this->model
            ->where('parent_id', $parent_id)
            ->where('type', $type)
            ->where('hidden', $hidden)
            ->get();
    }


    // public function deleteAllBySubcategoryId(int $subcategory_id)
    // {
    //     $this->model->where('subcategory_id', $subcategory_id)->delete();
    // }

    // public function deleteAllBySubcategoryArrayId(array $ids)
    // {
    //     $this->model->whereIn('subcategory_id', $ids)->delete();
    // }
}
