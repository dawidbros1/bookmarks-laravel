<?php

namespace App\Http\Controllers;

use App\Http\Requests\Page\Store;
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
    public function create($type, $parent_id)
    {
        // $this->authorize('create', [new Page, $parent_id]);
        // $subcategory = $this->subcategoryRepository->getModel()->find($subcategory_id);

        if ($type == "category") {
            $parent = $this->categoryRepository->getModel()->find($parent_id);
        } else if ($type == "subcategory") {
            $parent = $this->subcategoryRepository->getModel()->find($parent_id);
        }

        return view('page.create', ['parent' => $parent, 'type' => $type]);
    }

    public function store(Store $request)
    {
        $data = $request->validated();
        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;
        // $this->authorize('store', [new Page, $data['subcategory_id']]);
        $this->pageRepository->getModel()->store($data);

        return redirect(url()->previous())
            ->with('success', 'Strona została dodana');
    }

    //! EDIT
    public function edit($id)
    {
        $page = $this->pageRepository->getModel()->find($id);

        $type = $page->type;

        return view(
            'page.edit',
            ['page' => $page]
        );
    }

    public function update(Store $request, $id)
    {
        // $this->authorize('update', [new Page, $id, $newSCID]);
        $data = $request->validated();
        if ($request->input('public') != NULL) $data['public'] = true;
        else $data['public'] = false;
        $this->pageRepository->getModel()->find($id)->update($data);

        return redirect(url()->previous())
            ->with('success', 'Strona została edytowana');
    }


    public function changeVisibility($id)
    {
        $page = $this->pageRepository->getModel()->find($id);
        $page->update(['hidden' => !$page->hidden]);

        return redirect(url()->previous())
            ->with('success', 'Widoczność strony została zmieniona');
    }

    //! DELETE
    public function delete($id)
    {
        // $this->authorize('delete', [new Page, $id]);
        $page = $this->pageRepository->getModel()->find($id);
        $type = $page->type;
        $parent_id = $page->parent_id;
        $page->destroy($id);

        return redirect()
            ->route($type . '.show', ['id' => $parent_id])
            ->with('success', 'Strona została usunięta');
    }
}
