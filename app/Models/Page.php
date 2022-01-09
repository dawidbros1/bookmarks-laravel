<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['parent_id', 'name', 'image_url', 'hidden', 'link', 'private', 'type', 'position'];

    public function create(array $data)
    {
        $this->parent_id = $data['parent_id'];
        $this->type = $data['type'];
        $this->name = $data['name'];
        $this->image_url = $data['image_url'];
        $this->link = $data['link'];
        $this->private = $data['private'];
        $this->save();
    }
}
