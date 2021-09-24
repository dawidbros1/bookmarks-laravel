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
    public function list()
    {
        $categories = $this->categoryRepository->all();

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
        $category->update($data);

        return redirect(url()->previous())
            ->with('success', 'Kategoria została edytowana');
    }

    //! DELETE
    public function delete($id)
    {
        $this->authorize('author', [new Category, $id]);

        $category = $this->categoryRepository->getModel()->find($id);
        $category->deleteWithContent($this->subcategoryRepository);


        // $subcategories = $this->subcategoryRepository->getAllByCategoryId($id);
        // $subcategory_ids = $subcategories->pluck('id')->toArray();

        // $this->subcategoryRepository->getModel()->destroy($subcategory_ids);
        // $this->categoryRepository->getModel()->destroy($id);

        return redirect()
            ->route('category.list')
            ->with('success', 'Kategoria została usunięta');
    }

    //! SHOW
    public function show($id)
    {
        $category = $this->categoryRepository->getModel()->find($id);
        $subcategories = $this->subcategoryRepository->getAllByCategoryId($id);
        $pages = $this->pageRepository->getAllByIdAndType($id, 'category');

        return view('category.show', [
            'category' => $category,
            'subcategories' => $subcategories,
            'pages' => $pages
        ]);
    }
}
