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
    private string $type;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->pageRepository = $this->subcategoryRepository->getPageRepository();
        $this->type = "subcategory";
    }

    //! Pokazanie zawartości
    public function show($view, $id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);

        if ($view == 'visible') $pages = $this->pageRepository->getAllByParameters($id, $this->type, 0);
        else if ($view == "hidden") $pages = $this->pageRepository->getAllByParameters($id, $this->type, 1);
        else if ($view == "all") $pages = $this->pageRepository->getAllByParameters($id, $this->type);

        return view('subcategory.show', [
            'subcategory' => $subcategory,
            'pages' => $pages,
            'view' => $view
        ]);
    }

    public function showPublic($id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);

        if ($subcategory->public == 0) return abort(403, 'Zasób nie jest publiczny');

        $category = $this->categoryRepository->getModel()->find($subcategory->category_id);

        $pages = $this->pageRepository->getPublicDataParameters($id, $this->type);

        return view('subcategory.public', [
            'category' => $category,
            'subcategory' => $subcategory,
            'pages' => $pages,
        ]);
    }

    //! CREATE
    public function create(Request $request, $category_id)
    {
        $category = $this->categoryRepository->getModel()->find($category_id);
        $this->authorize('categoryAuthor', [new Subcategory(), $category]);

        return view('subcategory.create', [
            'category_id' => $category_id,
            'view' => $request->input('view'),
            'category_image' => $category->image_url,
        ]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        $category = $this->categoryRepository->getModel()->find($data['category_id']);
        $this->authorize('categoryAuthor', [new Subcategory(), $category]);

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        $this->subcategoryRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', 'Podkategoria została dodana');
    }

    //! EDIT
    public function edit(Request $request, $id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);

        return view(
            'subcategory.edit',
            [
                'subcategory' => $subcategory,
                'view' => $request->input('view'),
                'category_image' => $this->categoryRepository->getModel()->find($subcategory->category_id)->image_url,
            ]
        );
    }

    public function update(Store $request, $id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);
        $data = $request->validated();

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        $subcategory->update($data);
        return redirect(url()->previous())
            ->with('success', 'Podkategoria została edytowana');
    }

    public function changeVisibility($id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);
        $subcategory->update(['hidden' => !$subcategory->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność podkategorii została zmieniona');
    }

    //!  DELETE
    public function delete(Request $request, $id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $this->authorize('author', $subcategory);
        $subcategory->deleteWithContent($this->pageRepository);

        return redirect()
            ->route('category.show', ['id' => $subcategory->category_id, 'view' => $request->input('view')])
            ->with('success', 'Podkategoria została usunięta');
    }
}
