<?php

namespace App\Models;

use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'image_url',
        'hidden',
        'public',
    ];

    public function store(array $data)
    {
        $this->user_id = Auth::id();
        $this->name = $data['name'];
        $this->image_url = $data['image_url'];
        // $this->public = $data['public'];
        $this->public = true;
        $this->save();
    }

    public function deleteWithContent(SubcategoryRepository $subcategoryRepository)
    {
        // DANE
        $pageRepository = $subcategoryRepository->getPageRepository();

        // Kasowanie podkategorii
        $subcategories = $subcategoryRepository->getAllByCategoryId($this->id);
        $this->deleteSubcategoriesWithContent($subcategoryRepository, $subcategories);

        // Kasowanie stron w kategorii
        $pages = $pageRepository->getAllByIdAndType($this->id, 'category');
        $page_ids = $pages->pluck('id')->toArray();
        $pageRepository->getModel()->destroy($page_ids);

        // Kasowanie kategorii
        $this->destroy($this->id);
    }

    private function deleteSubcategoriesWithContent(SubcategoryRepository $subcategoryRepository, $subcategories)
    {
        // DANE
        $pageRepository = $subcategoryRepository->getPageRepository();
        $subcategory_ids = $subcategories->pluck('id')->toArray();

        // Usuwanie stron z podkategorii
        $pages = $pageRepository->getAllByIdsAndType($subcategory_ids, 'subcategory');
        $page_ids = $pages->pluck('id')->toArray();
        $pageRepository->getModel()->destroy($page_ids);

        // Usuwanie podkategorii
        $subcategoryRepository->getModel()->destroy($subcategory_ids);
    }
}
