<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['user_id', 'category_public', 'subcategory_public', 'page_public'];

    public function saveDefault($user_id)
    {
        $this->user_id = $user_id;
        $this->save();
    }
}
