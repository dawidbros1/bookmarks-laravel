<?php

namespace App\Models;

use App\Repository\PageRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subcategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'category_id',
        'name',
        'image_url',
        'hidden',
        'public', // Zmienne do których ma dostęp użytkownik
    ];

    public function store(array $data)
    {
        $this->category_id = $data['category_id'];
        $this->name = $data['name'];
        $this->image_url = $data['image_url'];
        // $this->public = $data['public'];
        $this->public = true;
        $this->save();
    }

    public function deleteWithContent(PageRepository $pageRepository)
    {
        $pages = $pageRepository->getAllByIdAndType($this->id, 'subcategory');
        $page_ids = $pages->pluck('id')->toArray();
        $pageRepository->getModel()->destroy($page_ids);

        $this->destroy($this->id);
    }
}
