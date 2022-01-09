<?php

namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryRepository extends Repository
{
    private Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllByIds($ids)
    {
        return $this->model->orderBy('position')
            ->whereIN('id', $ids)
            ->where('user_id', Auth::id())->get();
    }

    public function get(array $args = [], $auth = true)
    {
        if ($auth) {
            $args['user_id'] = Auth::id();
        }

        return $this->model->orderBy('position')->where($args)->get();
    }

    public function getWithRelations(array $args, $auth = true)
    {
        if ($auth) {
            $args['user_id'] = Auth::id();
        }

        return $this->model->orderBy('position')->where($args)
            ->with('subcategories.pages')->with('pages')
            ->get()->first();
    }

    public function getWithRelation(int $id, string $relation)
    {
        return $this->model
            ->orderBy('position')
            ->where(['user_id' => Auth::id(), 'id' => $id])
            ->with($relation)
            ->get()
            ->first();
    }

    public function delete($category)
    {
        $subcategories = $category->subcategories;
        $pages = $category->pages;

        foreach ($category->subcategories as $subcategory) {
            foreach ($subcategory->pages as $page) {
                $pages[] = $page;
            }
        }

        $this->deletePages($pages);
        $this->deleteSubcategories($subcategories);
        $this->model->destroy($category->id);
    }
}
