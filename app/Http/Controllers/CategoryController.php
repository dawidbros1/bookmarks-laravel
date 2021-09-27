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

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->pageRepository = $this->subcategoryRepository->getPageRepository();
    }

    //! LIST
    public function list(Request $request)
    {
        $type = $request->input('show');

        if ($type == null) $categories = $this->categoryRepository->getAllByHidden(0);
        else if ($type == "hidden") $categories = $this->categoryRepository->getAllByHidden(1);
        else if ($type == "all") $categories = $this->categoryRepository->getAll();

        return view('category.list', [
            'categories' => $categories,
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
            ->with('success', 'Widoczność strony została zmieniona');
    }

    //! DELETE
    public function delete($id)
    {
        $this->authorize('author', [new Category, $id]);
        $category = $this->categoryRepository->getModel()->find($id);
        $category->deleteWithContent($this->subcategoryRepository);

        return redirect()
            ->route('category.list')
            ->with('success', 'Kategoria została usunięta');
    }

    //! SHOW
    public function show(Request $request, $id)
    {
        $type = $request->input('show');

        if ($type == null) $subcategories = $this->subcategoryRepository->getAllByCategoryIdAndHidden($id, 0);
        else if ($type == "hidden") $subcategories = $this->subcategoryRepository->getAllByCategoryIdAndHidden($id, 1);
        else if ($type == "all") $subcategories = $this->subcategoryRepository->getAllByCategoryId($id);

        $category = $this->categoryRepository->getModel()->find($id);
        $pages = $this->pageRepository->getAllByIdAndType($id, 'category');

        return view('category.show', [
            'category' => $category,
            'subcategories' => $subcategories,
            'pages' => $pages
        ]);
    }
}
