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
    private $type;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subcategoryRepository = $this->categoryRepository->getSubcategoryRepository();
        $this->pageRepository = $this->subcategoryRepository->getPageRepository();
        $this->type = "subcategory";
    }

    //! CREATE
    public function create(Request $request, $category_id)
    {
        return view('subcategory.create', [
            'category_id' => $category_id,
            'view' => $request->input('view')
        ]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        // $this->authorize('create', [new Subcategory(), $id]);

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

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
                'view' => $request->input('view')
            ]
        );
    }

    public function update(Store $request, $id)
    {
        // $this->authorize('update', [new Subcategory(), $id]);
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $data = $request->validated();

        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;

        // var_dump($data);
        // die();

        $subcategory->update($data);
        return redirect(url()->previous())
            ->with('success', 'Podkategoria została edytowana');
    }

    public function changeVisibility($id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $subcategory->update(['hidden' => !$subcategory->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność podkategorii została zmieniona');
    }

    //!  DELETE
    public function delete(Request $request, $id)
    {
        // $this->authorize('delete', [new Subcategory(), $id]);
        $subcategory = $this->subcategoryRepository->getModel()->find($id);
        $category_id = $subcategory->category_id;
        $subcategory->deleteWithContent($this->pageRepository);

        return redirect()
            ->route('category.show', ['id' => $category_id, 'view' => $request->input('view')])
            ->with('success', 'Podkategoria została usunięta');
    }

    //! SHOW
    public function show($view, $id)
    {
        $subcategory = $this->subcategoryRepository->getModel()->find($id);

        if ($view == 'visible') $pages = $this->pageRepository->getAllByParameters($id, $this->type, 0);
        else if ($view == "hidden") $pages = $this->pageRepository->getAllByParameters($id, $this->type, 1);
        else if ($view == "all") $pages = $this->pageRepository->getAllByParameters($id, $this->type);

        // $pages = $this->pageRepository->getAllByParameters($id, $this->type, $hidden);

        // var_dump($pages);
        // die();

        return view('subcategory.show', [
            'subcategory' => $subcategory,
            'pages' => $pages,
            'view' => $view
        ]);
    }
}
