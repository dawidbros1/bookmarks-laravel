<?php

namespace App\Models;

use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public static function deleteContent()
    {
        // Pobranie kategorii użytkownika
        $categories = CategoryRepository::getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        // Pobranie podkategorii użytkownika
        $subcategories = SubcategoryRepository::getAllByCategoryIds($category_ids);
        $subcategory_ids = $subcategories->pluck('id')->toArray();
        // Pobranie stron użytkownika dla kategorii oraz podkategori
        $category_pages = PageRepository::getAllByParameters($category_ids, 'category');
        $subcategory_pages = PageRepository::getAllByParameters($subcategory_ids, 'subcategory');
        // Pobranie stron użytkownika dla podkategorii

        //! KASOWANIE
        Category::destroy($category_ids);
        Subcategory::destroy($subcategory_ids);
        Page::destroy($category_pages->pluck('id')->toArray());
        Page::destroy($subcategory_pages->pluck('id')->toArray());
    }
}
