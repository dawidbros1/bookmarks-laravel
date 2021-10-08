<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\Store;
use App\Models\Category;
use App\Models\Page;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private CategoryRepository $categoryRepository;
    private SubcategoryRepository $subcategoryRepository;
    private PageRepository $pageRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->pageRepository = $this->subcategoryRepository->getPageRepository();
    }

    //! CREATE
    public function create(Request $request, $type, $parent_id)
    {
        $this->authorize('checkParent', [new Page, $type, $parent_id]);

        if ($type == "category") {
            $parent = $this->categoryRepository->getModel()->find($parent_id);
        } else if ($type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($parent_id);
        }

        return view('page.create', ['parent' => $parent, 'type' => $type, 'view' => $request->input('view')]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        $this->authorize('checkParent', [new Page, $data['type'], $data['parent_id']]);

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        if ($request->input('open_in_new_window') != NULL) $data['open_in_new_window'] = true;
        else $data['open_in_new_window'] = false;

        $this->pageRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', 'Strona została dodana');
    }

    //! EDIT
    public function edit(Request $request, $id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        $this->authorize('author', $page);

        $categories = $this->categoryRepository->getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        $subcategories = $this->subcategoryRepository->getAllByCategoryIds($category_ids);

        if ($page->type == "category") {
            $parent = $this->categoryRepository->getModel()->find($page->parent_id);
            $category_id = $parent->id;
        } else if ($page->type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($page->parent_id);
            $category_id = $parent->category_id;
        }

        return view(
            'page.edit',
            [
                'page' => $page,
                'view' => $request->input('view'),
                'parent' => $parent,
                'categories' => $categories,
                'subcategories' => $subcategories,
                'category_id' => $category_id
            ]
        );
    }

    public function update(Store $request, $id)
    {
        $data = $request->validated();
        $page = $this->pageRepository->getModel()->find($id);
        $this->authorize('author', $page);

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        if ($request->input('open_in_new_window') != NULL) $data['open_in_new_window'] = true;
        else $data['open_in_new_window'] = false;

        $subcategory_id = $request->input('subcategory_id');

        if ($subcategory_id == 0) {
            $category_id = $request->input('category_id');
            $data['parent_id'] = $category_id;
            $data['type'] = 'category';
        } else {
            $this->authorize('checkParent', [new Page, 'subcategory', $subcategory_id]);
            $subcategory = $this->subcategoryRepository->getModel()->find($subcategory_id);
            $category_id = $this->categoryRepository->getModel()->find($subcategory->category_id)->id;
            $data['parent_id'] = $subcategory_id;
            $data['type'] = 'subcategory';
        }

        $this->authorize('checkParent', [new Page, 'category', $category_id]);
        $page->update($data);

        return redirect(url()->previous())
            ->with('success', 'Strona została edytowana');
    }


    public function changeVisibility($id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        $this->authorize('author', $page);
        $page->update(['hidden' => !$page->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność strony została zmieniona');
    }

    //! MANAGE
    public function managePagesFromCategories()
    {
        $categories = $this->categoryRepository->getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        $pages = $this->pageRepository->getAllByParameters($category_ids, 'category');

        $package = [];
        $page_names = [];
        $indexes = [];

        //! Uprawnienia

        foreach ($categories as $key => $category) {
            $package[$category->id] = [];
            $indexes[$category->id] = [];
            $page_names[$category->id] = $category->name;
        }

        foreach ($pages as $key => $page) {
            array_push($package[$page->parent_id], $page);
            array_push($indexes[$page->parent_id], $key);
        }

        return view('page.manage', [
            'package' => $package,
            'page_names' => $page_names,
            'indexes' => $indexes
        ]);
    }

    public function updateCheckboxesToPagesFromCategories(Request $request)
    {
        $ids = $request->input('ids');
        $hidden = $request->input('hidden');
        $public = $request->input('public');

        $pages = $this->pageRepository->getAllByIds($ids);
        $category_ids = array_unique($pages->pluck('parent_id')->toArray());
        $categories = $this->categoryRepository->getAllByIds($category_ids);


        foreach ($categories as $category) {
            $this->authorize('categoryAuthor', [new Page, $category]);
        }

        $changeHidden = $this->updateColumn($ids, $hidden, 'hidden');
        $changePublic = $this->updateColumn($ids, $public, 'public');

        if ($changeHidden == false || $changePublic == false) {
            // Jedna kolumna została całościowo zaaktualizowana
            if ($changeHidden == true || $changePublic == true) {
                $pages = $this->pageRepository->getAllByIds($ids);
            }
            // Żadna kolumna została całościowo zaaktualizowana
            for ($i = 0; $i < count($ids); $i++) {
                $page = $pages[$i];
                if ($page->public != $public[$i] || $page->hidden != $hidden[$i]) {
                    $data = ['hidden' => $hidden[$i], 'public' => $public[$i]];
                    $page->update($data);
                }
            }
        }

        return redirect()
            ->route('manage.PagesFromCategoties')
            ->with('success', 'Dane zostały zaktualizowane:');
    }

    public function managePagesFromSubcategories()
    {
        $categories = $this->categoryRepository->getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        $pages = $this->pageRepository->getAllByParameters($category_ids, 'category');

        $package = [];
        $page_names = [];
        $indexes = [];

        //! Uprawnienia

        foreach ($categories as $key => $category) {
            $package[$category->id] = [];
            $indexes[$category->id] = [];
            $page_names[$category->id] = $category->name;
        }

        foreach ($pages as $key => $page) {
            array_push($package[$page->parent_id], $page);
            array_push($indexes[$page->parent_id], $key);
        }

        return view('page.manage', [
            'package' => $package,
            'page_names' => $page_names,
            'indexes' => $indexes
        ]);
    }

    //! DELETE
    public function delete(Request $request, $id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        $this->authorize('author', $page);
        $page->destroy($id);

        return redirect()
            ->route($page->type . '.show', ['id' => $page->parent_id, 'view' => $request->input('view')])
            ->with('success', 'Strona została usunięta');
    }

    // Pomocnicza funckje do metody manageUpdate
    private function updateColumn($ids, $data, $column)
    {
        $zeroCounter = count(array_filter($data, function ($a) {
            return ($a == 0);
        }));

        if ($zeroCounter == count($data)) {
            // Wszystkie checkboxy niezaznaczone
            $this->pageRepository->updateColumn($ids, $column, 0);
            return true;
        } elseif ($zeroCounter == 0) {
            // Wszystkie checkboxy zaznaczone
            $this->pageRepository->updateColumn($ids, $column, 1);
            return true;
        }

        return false;
    }
}
