<?php

namespace App\Repository;

use App\Models\Page;
use Illuminate\Support\Facades\DB;

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

    public function getAllByIds($ids)
    {
        return $this->model
            ->orderBy('order')
            ->whereIN('id', $ids)
            ->get();
    }

    // parent ID can be INT OR ARRAY OF INT
    public static function getAllByParameters($parent_ids, string $type, int $hidden = -1)
    {
        $model = new Page;

        if (gettype($parent_ids) != "array") {
            $parent_ids = [$parent_ids];
        }

        if ($hidden == -1) {
            return $model
                ->orderBy('order')
                ->where('type', $type)
                ->whereIN('parent_id', $parent_ids)
                ->get();
        } else {
            return $model
                ->orderBy('order')
                ->where(['parent_id' => $parent_ids, 'type' => $type, 'hidden' => $hidden])
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

    public function updateColumn(array $ids, string $column, int $value)
    {
        DB::table('pages')->whereIn('id', $ids)->update(array($column => $value));
    }
}
