<?php

namespace App\Http\Controllers;

use App\Helpers\Manage;
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
    public function manage(Request $request)
    {
        $type = $request->input('type');
        if ($type == "category") {
            $categories = $this->categoryRepository->getAllWithPages();
            return view('page.manageTypeCategory', ['categories' => $categories]);
        } else {
            $categories = $this->categoryRepository->getAllWithSubcategoriesWithPages();
            return view('page.manageTypeSubcategory', ['categories' => $categories]);
        }
    }

    public function managePagesFromCategory($id)
    {
        $category = $this->categoryRepository->getWithPages($id)->first();
        //! AUTH
        return view('page.manageFromCategory', ['category' => $category]);
    }

    public function manageAllFromSubcategory($id)
    {
        $subcategory = $this->subcategoryRepository->getWithPages($id)->first();
        //! AUTH
        return view('page.manageFromSubcategory', ['subcategory' => $subcategory]);
    }

    public function updateCheckboxes(Request $request, $type)
    {
        $ids = $request->input('ids');
        $hidden = $request->input('hidden');
        $public = $request->input('public');
        $open = $request->input('open');
        $pages = $this->pageRepository->getAllByIds($ids);
        $parent_ids = $pages->pluck('parent_id')->toArray();

        //! TYPE pobierać na podstawie pobranych stron

        if ($type == "subcategory") {
            $subcategories = $this->subcategoryRepository->getAllByIds($parent_ids);
            $parent_ids = $subcategories->pluck('category_id')->toArray();
        }

        $categories = $this->categoryRepository->getAllByIds($parent_ids);

        foreach ($categories as $category) {
            $this->authorize('categoryAuthor', [new Page, $category]);
        }


        $hidden = Manage::filter($ids, $hidden);
        $public = Manage::filter($ids, $public);
        $open = Manage::filter($ids, $open);

        Manage::updateColumn($hidden['zero'], $hidden['one'], 'hidden', $this->pageRepository);
        Manage::updateColumn($public['zero'], $public['one'], 'public', $this->pageRepository);
        Manage::updateColumn($open['zero'], $open['one'], 'open_in_new_window', $this->pageRepository);

        return redirect(url()->previous())
            ->with('success', 'Dane zostały zaktualizowane:');
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
}
