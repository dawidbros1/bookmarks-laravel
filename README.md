# Bookmarks
It is a system that allows you to share multiple links with a single link.

## Build with
1. LARAVEl 8
2. BOOTSTRAP 5

## Features
1. Adding categories, subcategories and pages
2. Sorting items
3. Change the status of items
4. Changing the parent for subcategories and pages
5. Access to public content without logging in

## Installation Instructions
1. Run `git clone https://github.com/dawidbros1/bookmarks-laravel`
2. Run `composer install` and `npm-install`
3. Create database for the project 
4. Run `copy .env.example .env`
5. Configure your `.env` file 
6. Run `php artisan migrate`
7. Run `php artisan serve`

## Table of contents
- [Screenshots](#screenshots)
- [Commands](#commands)

## Screenshots
<kbd>

![image not found](readme_img/other/homepage.png)

![image not found](readme_img/category/list_01.png)

![image not found](readme_img/category/list_02.png)

![image not found](readme_img/category/create.png)

![image not found](readme_img/category/edit.png)

![image not found](readme_img/category/delete.png)

![image not found](readme_img/category/manage.png)

![image not found](readme_img/category/show_01.png)

![image not found](readme_img/category/show_02.png)

![image not found](readme_img/subcategory/manage.png)

![image not found](readme_img/subcategory/edit_01.png)

![image not found](readme_img/subcategory/edit_02.png)

![image not found](readme_img/page/manage.png)

![image not found](readme_img/page/edit_01.png)

![image not found](readme_img/page/edit_02.png)

![image not found](readme_img/page/edit_03.png)

</kbd>

## Commands
* `php artisan db:seed`: The command runs all seeders
* `php artisan db:seed --class=UserSeeder`: The command run user seeder
* `php artisan db:seed --class=CategorySeeder`: The command run category seeder
* `php artisan db:seed --class=SubcategorySeeder`: The command run subcategory seeder
* `php artisan db:seed --class=PageSeeder`: The command run page seeder
