<?php

namespace App\Repository;

use App\Models\Page;

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

    // parent ID can be INT OR ARRAY OF INT
    public function getAllByParameters($parent_id, string $type, int $hidden = -1)
    {
        if (gettype($parent_id) != "array") {
            $parent_id = [$parent_id];
        }

        if ($hidden == -1) {
            return $this->model
                ->orderBy('order')
                ->where('type', $type)
                ->whereIN('parent_id', $parent_id)
                ->get();
        } else {
            return $this->model
                ->orderBy('order')
                ->where(['parent_id' => $parent_id, 'type' => $type, 'hidden' => $hidden])
                ->get();
        }
    }


    public function getPublicDataParameters($id, $type)
    {
        return $this->model
            ->orderBy('order')
            ->where(['parent_id' => $id, 'type' => $type, 'public' => 1])
            ->get();
    }
}
