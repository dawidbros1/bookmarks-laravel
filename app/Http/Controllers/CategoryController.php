<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\Store;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;
    private SubcategoryRepository $subcategoryRepository;
    private PageRepository $pageRepository;
    private $type;

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

    public function show($view, $id)
    {
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

        $category = $this->categoryRepository->getModel()->find($id);

        return view('category.show', [
            'category' => $category,
            'subcategories' => $subcategories,
            'pages' => $pages,
            'view' => $view
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
        $this->authorize('author', [new Category, $id]);
        $category = $this->categoryRepository->getModel()->find($id);

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
        $this->authorize('author', [new Category, $id]);
        $category = $this->categoryRepository->getModel()->find($id);
        $data = $request->validated();

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        $category->update($data);

        return redirect(url()->previous())
            ->with('success', 'Kategoria została edytowana');
    }

    public function changeVisibility($id)
    {
        $this->authorize('author', [new Category, $id]);
        $category = $this->categoryRepository->getModel()->find($id);
        $category->update(['hidden' => !$category->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność kategorii została zmieniona');
    }

    //! DELETE
    public function delete(Request $request, $id)
    {
        $this->authorize('author', [new Category, $id]);
        $category = $this->categoryRepository->getModel()->find($id);
        $category->deleteWithContent($this->subcategoryRepository);

        return redirect()
            ->route('category.list', ['view' => $request->input('view')])
            ->with('success', 'Kategoria została usunięta');
    }
}
