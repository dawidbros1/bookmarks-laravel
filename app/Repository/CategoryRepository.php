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

    public function getAll()
    {
        return $this->model
            ->orderBy('order')
            ->where('user_id', Auth::id())
            ->get();
    }

    public function getAllByHidden($hidden)
    {
        return $this->model
            ->orderBy('order')
            ->where(['user_id' => Auth::id(), 'hidden' => $hidden])
            ->get();
    }
}
