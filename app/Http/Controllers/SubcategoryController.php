<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subcategory\Store;
use App\Models\Subcategory;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
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
    public function create($category_id)
    {
        return view('subcategory.create', ['category_id' => $category_id]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        // $this->authorize('create', [new Subcategory(), $id]);
        $this->subcategoryRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', 'Podkategoria została dodana');
    }

    //! EDIT
    public function edit(Request $request, $id)
    {
        // $this->authorize('edit', [new Subcategory, $id]);
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        return view(
            'subcategory.edit',
            [
                'subcategory' => $subcategory,
            ]
        );
    }

    public function update(Store $request, $id)
    {
        // $this->authorize('update', [new Subcategory(), $id]);
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $data = $request->validated();
        $subcategory->update($data);
        return redirect(url()->previous())
            ->with('success', 'Podkategoria została edytowana');
    }

    //!  DELETE
    public function delete($id)
    {
        // $this->authorize('delete', [new Subcategory(), $id]);
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $category_id = $subcategory->category_id;
        $subcategory->deleteWithContent($this->pageRepository);

        return redirect()
            ->route('category.show', ['id' => $category_id])
            ->with('success', 'Podkategoria została usunięta');
    }

    //! SHOW
    public function show($id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $pages = $this->pageRepository->getAllByIdAndType($id, 'subcategory');

        return view('subcategory.show', [
            'subcategory' => $subcategory,
            'pages' => $pages
        ]);
    }
}
