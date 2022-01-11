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

    protected $fillable = ['category_id', 'name', 'image_url', 'hidden', 'private', 'position',];

    public function create(array $data)
    {
        $this->category_id = $data['category_id'];
        $this->name = $data['name'];
        $this->image_url = $data['image_url'];
        $this->private = $data['private'];
        $this->save();
    }

    // Relacje
    // [ 1 do n ] [ Jedna podkategoria posiada wiele stron ]
    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_id')
            ->orderBy('position')
            ->where('type', 'subcategory');
    }

    // [1 do 1 ] [ Jedna podkategoria posiada jednego rodzica ]
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id')->where([
            'user_id' => Auth::id(),
        ]);
    }
}
