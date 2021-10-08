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
        $categories = $this->categoryRepository->getAllByParameters();

        return view(
            'subcategory.edit',
            [
                'subcategory' => $subcategory,
                'view' => $request->input('view'),
                'category_image' => $this->categoryRepository->getModel()->find($subcategory->category_id)->image_url,
                'categories' => $categories,
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

        if ($data['category_id'] != $subcategory->category_id) {
            $category = $this->categoryRepository->getModel()->find($data['category_id']);
            $this->authorize('categoryAuthor', [new Subcategory, $category]);
        }

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

    //! MANAGE
    public function manage()
    {
        $categories = $this->categoryRepository->getAllByParameters();
        $category_ids = $categories->pluck('id')->toArray();
        $subcategories = $this->subcategoryRepository->getAllByCategoryIds($category_ids);

        $package = [];
        $category_names = [];
        $indexes = [];

        foreach ($categories as $key => $category) {
            $package[$category->id] = [];
            $indexes[$category->id] = [];
            $category_names[$category->id] = $category->name;
        }

        foreach ($subcategories as $key => $subcategory) {
            array_push($package[$subcategory->category_id], $subcategory);
            array_push($indexes[$subcategory->category_id], $key);
        }

        return view('subcategory.manage', [
            'package' => $package,
            'category_names' => $category_names,
            'indexes' => $indexes
        ]);
    }

    public function updateCheckboxes(Request $request)
    {
        $ids = $request->input('ids');
        $hidden = $request->input('hidden');
        $public = $request->input('public');

        $subcategories = $this->subcategoryRepository->getAllByIds($ids);
        $category_ids = array_unique($subcategories->pluck('category_id')->toArray());
        $categories = $this->categoryRepository->getAllByIds($category_ids);

        foreach ($categories as $category) {
            $this->authorize('categoryAuthor', [new Subcategory, $category]);
        }

        $changeHidden = $this->updateColumn($ids, $hidden, 'hidden');
        $changePublic = $this->updateColumn($ids, $public, 'public');

        if ($changeHidden == false || $changePublic == false) {
            // Jedna kolumna została całościowo zaaktualizowana
            if ($changeHidden == true || $changePublic == true) {
                $subcategories = $this->subcategoryRepository->getAllByIds($ids);
            }
            // Żadna kolumna została całościowo zaaktualizowana
            for ($i = 0; $i < count($ids); $i++) {
                $subcategory = $subcategories[$i];
                if ($subcategory->public != $public[$i] || $subcategory->hidden != $hidden[$i]) {
                    $data = ['hidden' => $hidden[$i], 'public' => $public[$i]];
                    $subcategory->update($data);
                }
            }
        }

        return redirect()
            ->route('manage.subcategories')
            ->with('success', 'Dane zostały zaktualizowane:');
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

    // Pomocnicza funckje do metody manageUpdate
    private function updateColumn($ids, $data, $column)
    {
        $zeroCounter = count(array_filter($data, function ($a) {
            return ($a == 0);
        }));

        if ($zeroCounter == count($data)) {
            // Wszystkie checkboxy niezaznaczone
            $this->subcategoryRepository->updateColumn($ids, $column, 0);
            return true;
        } elseif ($zeroCounter == 0) {
            // Wszystkie checkboxy zaznaczone
            $this->subcategoryRepository->updateColumn($ids, $column, 1);
            return true;
        }

        return false;
    }
}
