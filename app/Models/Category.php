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
        $this->public = $data['public'];
        $this->save();
    }

    public function deleteWithContent(SubcategoryRepository $subcategoryRepository)
    {
        // DANE
        $pageRepository = $subcategoryRepository->getPageRepository();
        $subcategories = $subcategoryRepository->getAllByParameters($this->id);

        // Kasowanie podkategorii
        $this->deleteSubcategoriesWithContent($subcategoryRepository, $subcategories);

        // Kasowanie stron w kategorii
        $pages = $pageRepository->getAllByParameters($this->id, 'category');
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
        $pages = $pageRepository->getAllByParameters($subcategory_ids, 'subcategory');
        $page_ids = $pages->pluck('id')->toArray();
        $pageRepository->getModel()->destroy($page_ids);

        // Usuwanie podkategorii
        $subcategoryRepository->getModel()->destroy($subcategory_ids);
    }

    // Relacje
    // [ 1 do n ] [ Jedna kategoria posiada wiele podkategorii ]
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->orderBy('order');
    }

    // [ 1 do n ] [ Jedna kategoria posiada wiele stron ]
    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('order')->where('type', 'category');
    }
}
