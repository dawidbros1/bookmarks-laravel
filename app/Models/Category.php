<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name', 'image_url', 'hidden', 'private', 'position'];

    public function create(array $data)
    {
        $this->user_id = Auth::id();
        $this->name = $data['name'];
        $this->image_url = $data['image_url'];
        $this->private = $data['private'];
        $this->save();
    }

    // Relacje
    // [ 1 do n ] [ Jedna kategoria posiada wiele podkategorii ]
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->orderBy('position');
    }

    // [ 1 do n ] [ Jedna kategoria posiada wiele stron ]
    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_id')->orderBy('position')->where('type', 'category');
    }
}
