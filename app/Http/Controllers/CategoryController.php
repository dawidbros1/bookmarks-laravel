<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\Store;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;
    private SubcategoryRepository $subcategoryRepository;
    private PageRepository $pageRepository;
    private string $type;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->pageRepository = $this->subcategoryRepository->getPageRepository();
        $this->type = "category";
    }

    //! Pokazanie zawartości
    public function list($view)
    {
        if ($view == 'visible') $categories = $this->categoryRepository->getAllByParameters(0);
        else if ($view == "hidden") $categories = $this->categoryRepository->getAllByParameters(1);
        else if ($view == "all") $categories = $this->categoryRepository->getAllByParameters();

        return view('category.list', [
            'categories' => $categories,
            'view' => $view
        ]);
    }

    public function show($view, int $id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $this->authorize('author', $category);

        if ($view == "visible") {
            $subcategories = $this->subcategoryRepository->getAllByParameters($id, 0);
            $pages = $this->pageRepository->getAllByParameters($id, $this->type, 0);
        } else if ($view == "hidden") {
            $subcategories = $this->subcategoryRepository->getAllByParameters($id, 1);
            $pages = $this->pageRepository->getAllByParameters($id, $this->type, 1);
        } else if ($view == "all") {
            $subcategories = $this->subcategoryRepository->getAllByParameters($id);
            $pages = $this->pageRepository->getAllByParameters($id, $this->type);
        }

        return view('category.show', [
            'category' => $category,
            'subcategories' => $subcategories,
            'pages' => $pages,
            'view' => $view
        ]);
    }

    public function showPublic($id)
    {
        $category = $this->categoryRepository->getModel()->find($id);

        if ($category->public == 0) {
            return abort(403, 'Zasób nie jest publiczny');
        }

        $subcategories = $this->subcategoryRepository->getPublicDataByCategoryId($id);
        $pages = $this->pageRepository->getPublicDataParameters($id, $this->type);

        return view('category.public', [
            'category' => $category,
            'subcategories' => $subcategories,
            'pages' => $pages,
        ]);
    }

    //! CREATE
    public function create()
    {
        return view('category.create');
    }

    public function store(Store $request)
    {
        $data = $request->validated();

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;
        $this->categoryRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', 'Kategoria została dodana');
    }

    //! EDIT
    public function edit(Request $request, $id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $this->authorize('author', $category);

        return view(
            'category.edit',
            [
                'category' => $category,
                'view' => $request->input('view')
            ]
        );
    }

    public function update(Store $request, $id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $this->authorize('author', $category);
        $data = $request->validated();

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        $category->update($data);

        return redirect(url()->previous())
            ->with('success', 'Kategoria została edytowana');
    }

    public function changeVisibility($id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $this->authorize('author', $category);
        $category->update(['hidden' => !$category->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność kategorii została zmieniona');
    }

    //! MANAGE
    public function manage()
    {
        $categories = $this->categoryRepository->getAllByParameters();
        return view('category.manage', ['categories' => $categories]);
    }

    public function updateCheckboxes(Request $request)
    {
        $ids = $request->input('ids');
        $hidden = $request->input('hidden');
        $public = $request->input('public');

        $categories = $this->categoryRepository->getAllByIds($ids);
        $this->authorize('categories', [new Category, $categories]);

        $changeHidden = $this->updateColumn($ids, $hidden, 'hidden');
        $changePublic = $this->updateColumn($ids, $public, 'public');

        if ($changeHidden || $changePublic) $categories = $this->categoryRepository->getAllByIds($ids);

        foreach ($categories as $key => $category) {
            if ($category->public != $public[$key] || $category->hidden != $hidden[$key]) {
                $data = ['hidden' => $hidden[$key], 'public' => $public[$key]];
                $category->update($data);
            }
        }

        return redirect()
            ->route('manage.categories')
            ->with('success', 'Dane zostały zaktualizowane');
    }

    //! DELETE
    public function delete(Request $request, $id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $this->authorize('author', $category);
        $category->deleteWithContent($this->subcategoryRepository);

        return redirect()
            ->route('category.list', ['view' => $request->input('view')])
            ->with('success', 'Kategoria została usunięta');
    }

    // Pomocnicza funckja do metody manageUpdate
    private function updateColumn($ids, $data, $column)
    {
        $zeroCounter = count(array_filter($data, function ($a) {
            return ($a == 0);
        }));

        if ($zeroCounter == count($data)) {
            // Wszystkie kategorie są ukryte
            $this->categoryRepository->updateColumn($ids, $column, 0);
            return true;
        } elseif ($zeroCounter == 0) {
            // Wszystkie kategorie są widoczne
            $this->categoryRepository->updateColumn($ids, $column, 1);
            return true;
        }

        return false;
    }
}
