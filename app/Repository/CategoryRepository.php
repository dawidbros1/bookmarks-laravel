<?php

namespace App\Repository;

use App\Models\Category;
use App\Repository\SubcategoryRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function getAllByIds($ids)
    {
        return $this->model
            ->orderBy('order')
            ->whereIN('id', $ids)
            ->get();
    }

    public static function getAllByParameters(int $hidden = -1)
    {

        $model = new Category;

        if ($hidden == -1) {
            return $model
                ->orderBy('order')
                ->where(['user_id' => Auth::id()])
                ->get();
        } else {
            return $model
                ->orderBy('order')
                ->where(['user_id' => Auth::id(), 'hidden' => $hidden])
                ->get();
        }
    }

    // public function updateColumn(array $ids, string $column, int $value)
    // {
    //     DB::table('categories')->whereIn('id', $ids)->update(array($column => $value));
    // }

    // Pobieranie danych z relacjami
    public function getAllWithSubcategories()
    {
        return $this->model
            ->orderBy('order')
            ->where('user_id', Auth::id())
            ->with('subcategories')
            ->get();
    }

    public function getAllWithPages()
    {
        return $this->model
            ->orderBy('order')
            ->where('user_id', Auth::id())
            ->with('pages')
            ->get();
    }

    public function getAllWithSubcategoriesWithPages()
    {
        return $this->model
            ->orderBy('order')
            ->where('user_id', Auth::id())
            ->with('subcategories.pages')
            ->get();
    }

    // Pojedyncze po ID z relacjami

    public function getWithPages($id)
    {
        return $this->model
            ->orderBy('order')
            ->where(['user_id' => Auth::id(), 'id' => $id])
            ->with('pages')
            ->get();
    }

    public function getWithSubcategories($id)
    {
        return $this->model
            ->orderBy('order')
            ->where(['user_id' => Auth::id(), 'id' => $id])
            ->with('subcategories')
            ->get();
    }
}
