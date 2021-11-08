<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\Page\MultiUpdate;
use App\Http\Requests\Page\Store;
use App\Http\Requests\Page\Update;
use App\Models\Page;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SettingsRepository;
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
        $category_id = $parent_id;

        if ($type == "subcategory") {
            $subcategory = $this->subcategoryRepository->getModel()->find($parent_id);
            if ($this->empty($subcategory)) return $this->error();
            $category_id = $subcategory->category_id;
        }

        $category = $this->categoryRepository->getModel()->find($category_id);
        if ($this->empty($category)) return $this->error();

        if ($type == "subcategory") {
            $parent = $subcategory;
            $this->authorize('subcategoryAuthor', [new Page, $parent]);
        } else if ($type = "category") {
            $parent = $category;
            $this->authorize('categoryAuthor', [new Page, $parent]);
        }

        $settings = SettingsRepository::get();

        return view('page.create', ['parent' => $parent, 'type' => $type, 'view' => $request->input('view'), 'settings' => $settings]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        $type = $data['type'];
        $category_id = $data['parent_id'];

        if ($type == "subcategory") {
            $subcategory = $this->subcategoryRepository->getModel()->find($data['parent_id']);
            if ($this->empty($subcategory)) return $this->error();
            $category_id = $subcategory->category_id;
        }

        $category = $this->categoryRepository->getModel()->find($category_id);
        if ($this->empty($category)) return $this->error();

        if ($type == "subcategory") {
            $this->authorize('subcategoryAuthor', [new Page, $subcategory]);
        } else if ($type = "category") {
            $this->authorize('categoryAuthor', [new Page, $category]);
        }

        $data['public'] = Checkbox::get($request->input('public'));
        $data['open_in_new_window'] = Checkbox::get($request->input('open_in_new_window'));
        $this->pageRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', Message::get(3));
    }

    //! EDIT
    public function edit(Request $request, $id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        if ($this->empty($page)) return $this->error();

        if ($page->type == "category") {
            $parent = $this->categoryRepository->getModel()->find($page->parent_id);
            $this->authorize('categoryAuthor', [new Page, $parent]);
            $category_id = $parent->id;
        } else if ($page->type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($page->parent_id);
            $this->authorize('subcategoryAuthor', [new Page, $parent]);
            $category_id = $parent->category_id;
        }

        $categories = $this->categoryRepository->getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        $subcategories = $this->subcategoryRepository->getAllByCategoryIds($category_ids);

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

    public function update(Update $request, $id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        if ($this->empty($page)) return $this->error();

        $data = $request->validated();
        $type = $page->type;

        if ($type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($page->parent_id);
            $this->authorize('subcategoryAuthor', [new Page, $parent]);
        } else if ($type = "category") {
            $parent = $this->categoryRepository->getModel()->find($page->parent_id);
            $this->authorize('categoryAuthor', [new Page, $parent]);
        }

        $data['public'] = Checkbox::get($request->input('public'));
        $data['open_in_new_window'] = Checkbox::get($request->input('open_in_new_window'));

        $subcategory_id = $data['subcategory_id'];

        if ($subcategory_id == 0) {
            $category_id = $data['category_id'];

            if ($category_id != $page->parent_id) {
                $category = $this->categoryRepository->getModel()->find($category_id);
                if ($this->empty($category)) return $this->error();
                $this->authorize('categoryAuthor', [new Page, $category]);
                $data['parent_id'] = $category_id;
                $data['type'] = 'category';
            }
        } else {
            $subcategory = $this->subcategoryRepository->getModel()->find($subcategory_id);

            if ($subcategory->id != $page->parent_id) {
                if ($this->empty($subcategory)) return $this->error();
                $category = $this->categoryRepository->getModel()->find($subcategory->category_id);
                if ($this->empty($category)) return $this->error();
                $this->authorize('categoryAuthor', [new Page, $category]);
                $data['parent_id'] = $subcategory_id;
                $data['type'] = 'subcategory';
            }
        }

        $page->update($data);

        return redirect(url()->previous())
            ->with('success', 'Strona została edytowana');
    }


    public function changeVisibility($id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        if ($this->empty($page)) return $this->error();

        $type = $page->type;

        if ($type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($page->parent_id);
            $this->authorize('subcategoryAuthor', [new Page, $parent]);
        } else if ($type = "category") {
            $parent = $this->categoryRepository->getModel()->find($page->parent_id);
            $this->authorize('categoryAuthor', [new Page, $parent]);
        }

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
        if ($this->empty($category)) return $this->error();
        $this->authorize('categoryAuthor', [new Page, $category]);
        return view('page.manageFromCategory', ['category' => $category]);
    }

    public function manageAllFromSubcategory($id)
    {
        $subcategory = $this->subcategoryRepository->getWithPages($id)->first();
        if ($this->empty($subcategory)) return $this->error();
        $this->authorize('subcategoryAuthor', [new Page, $subcategory]);
        return view('page.manageFromSubcategory', ['subcategory' => $subcategory]);
    }

    public function multiUpdate(MultiUpdate $request, $type)
    {
        $data = $request->validated();
        $ids = $data['ids'];
        $hidden = $data['hidden'];
        $private = $data['public'];
        $order = $data['order'];
        $open = $data['open'];

        if (count($ids) != count($hidden) || count($hidden) != count($private) || count($private) != count($order)  || count($order) != count($open)) {
            // Być może jakiś inny błąd tutaj
            return $this->error();
        }

        $pages = $this->pageRepository->getAllByIds($ids);
        if (count($pages) == 0) return $this->error();
        $parent_ids = $pages->pluck('parent_id')->toArray();
        $this->authorize('categories', [new Page, $type, $parent_ids]);

        foreach ($ids as $index => $id) {
            $page = $this->pageRepository->getModel()->find($id);
            if ($page != null) {
                $package = [
                    'hidden' => $hidden[$index],
                    'public' => !$private[$index],
                    'order' => $order[$index],
                    'open_in_new_window' => $open[$index]
                ];
                $page->update($package);
            }
        }

        return redirect(url()->previous())
            ->with('success', 'Dane zostały zaktualizowane');
    }

    //! DELETE
    public function delete(Request $request, $id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        if ($this->empty($page)) return $this->error();

        $type = $page->type;

        if ($type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($page->parent_id);
            $this->authorize('subcategoryAuthor', [new Page, $parent]);
        } else if ($type = "category") {
            $parent = $this->categoryRepository->getModel()->find($page->parent_id);
            $this->authorize('categoryAuthor', [new Page, $parent]);
        }

        $page->destroy($id);

        return redirect()
            ->route($page->type . '.show', ['id' => $page->parent_id, 'view' => $request->input('view')])
            ->with('success', 'Strona została usunięta');
    }

    // Metody prywatne


    private function empty($item)
    {
        if ($item == null) return true;
        else return false;
    }

    private function error()
    {
        return redirect()
            ->route('category.list', ['view' => 'visible'])
            ->with('error', Message::get(0));
        exit();
    }
}
