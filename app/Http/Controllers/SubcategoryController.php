<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\Subcategory\MultiUpdate;
use App\Http\Requests\Subcategory\Store;
use App\Models\Subcategory;
use App\Repository\SettingsRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct(
        SubcategoryRepository $subcategoryRepository,
        Subcategory $model
    ) {
        $this->subcategoryRepository = $subcategoryRepository;
        $this->model = $model;
        $this->type = 'subcategory';
    }

    public function show(Request $request, $id)
    {
        if (($subcategory = $this->subcategoryRepository->getWithPages($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);

        return view('subcategory.show', [
            'subcategory' => $subcategory,
            'visibility' => $request->input('visibility') ?? 0
        ]);
    }

    public function showPublic($id)
    {
        // $subcategory = $this->subcategoryRepository->getModel()->find($id);
        // $this->authorize('author', $subcategory);

        // if ($subcategory->public == 0) return abort(403, 'Zasób nie jest publiczny');

        // $category = $this->categoryRepository->getModel()->find($subcategory->category_id);

        // $pages = $this->pageRepository->getPublicDataParameters($id, $this->type);

        // return view('subcategory.public', [
        //     'category' => $category,
        //     'subcategory' => $subcategory,
        //     'pages' => $pages,
        // ]);
    }

    public function create(Store $request, $category_id)
    {
        $category = $this->subcategoryRepository->getCategory($category_id);
        if ($this->empty($category)) {
            return $this->error();
        }

        if ($request->isMethod('GET')) {
            $settings = SettingsRepository::get();

            return view('subcategory.create', [
                'category' => $category,
                'visibility' => $request->input('visibility'),
                'settings' => $settings,
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $data['category_id'] = $category_id;

            $this->model->create($data);
            return redirect(url()->previous())->with(
                'success',
                $this->message(0)
            );
        }
    }

    public function edit(Store $request, $id)
    {
        if (($subcategory = $this->subcategoryRepository->get($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);

        if ($request->isMethod('GET')) {
            return view('subcategory.edit', [
                'subcategory' => $subcategory,
                'visibility' => $request->input('visibility'),
                'categories' => $this->subcategoryRepository->getCategories(),
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $data['category_id'] = $request->input('category_id');

            if ($data['category_id'] != $subcategory->category_id) {
                $category = $this->subcategoryRepository->getCategory(
                    $data['category_id']
                );
                if ($this->empty($category)) {
                    return $this->error();
                }
            }

            $subcategory->update($data);

            return redirect(url()->previous())->with(
                'success',
                Message::get(1)
            );
        }
    }

    public function changeVisibility($id)
    {
        if (($subcategory = $this->subcategoryRepository->get($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);

        $subcategory->update(['hidden' => !$subcategory->hidden]);
        return redirect(url()->previous())->with('success', $this->message(2));
    }

    public function delete(Request $request, $id)
    {
        if (($subcategory = $this->subcategoryRepository->getWithPages($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);

        $this->subcategoryRepository->deletePages($subcategory->pages);
        $this->model->destroy($id);

        return redirect()
            ->route('category.show', ['id' => $subcategory->category_id, 'visibility' => $request->input('visibility')])
            ->with('success', $this->message(1));
    }

    public function manage()
    {
        // $empty = true;
        // $categories = $this->categoryRepository->getAllWithSubcategories(); // BY USER ID

        // foreach ($categories as $category) {
        //     if (count($category->subcategories) != 0) {
        //         $empty = false;
        //     }
        // }

        // return view('subcategory.manage', [
        //     'categories' => $categories,
        //     'empty' => $empty,
        // ]);
    }

    public function manageAllFromCategory($id)
    {
        // $category = $this->categoryRepository->getWithSubcategories($id)->first();
        // if ($this->empty($category)) return $this->error();
        // $this->authorize('categoryAuthor', [new Subcategory, $category]);
        // return view('subcategory.manageFromCategory', ['category' => $category]);
    }

    public function multiUpdate(MultiUpdate $request)
    {
        // $data = $request->validated();
        // $ids = $data['ids'];
        // $hidden = $data['hidden'];
        // $private = $data['public'];
        // $order = $data['order'];

        // if (count($ids) != count($hidden) || count($hidden) != count($private) || count($private) != count($order)) {
        //     // Być może jakiś inny błąd tutaj
        //     return $this->error();
        // }

        // $subcategories = $this->subcategoryRepository->getAllByIds($ids);
        // if (!$this->checkArray($subcategories)) return $this->error();

        // foreach ($order as $key => $value) {
        //     if (!is_numeric($value)) {
        //         $order[$key] = 0;
        //     }
        // }

        // foreach ($ids as $index => $id) {
        //     $subcategory = $this->subcategoryRepository->getModel()->find($id);

        //     if ($subcategory != null) {
        //         $data = [
        //             'hidden' => $hidden[$index],
        //             'public' => !$private[$index],
        //             'order' => $order[$index]
        //         ];
        //         $subcategory->update($data);
        //     }
        // }

        // return redirect(url()->previous())
        //     ->with('success', Message::get(1));
    }

    // Metody prywatne

    private function subcategory($id)
    {
        $this->check($subcategory = $this->model->find($id));
        // return $category;
    }

    private function checkArray($subcategories)
    {
        // $category_ids = array_unique($subcategories->pluck('category_id')->toArray());
        // $categories = $this->categoryRepository->getAllByIds($category_ids);

        // foreach ($categories as $category) {
        //     if ($this->empty($category)) return false;
        //     $this->authorize('categoryAuthor', [new Subcategory, $category]);
        // }

        // return true;
    }

    private function check($subcategory)
    {
        // if ($this->empty($subcategory)) return false;
        // $category = $this->categoryRepository->getModel()->find($subcategory->category_id);
        // if ($this->empty($category)) return false;
        // $this->authorize('categoryAuthor', [new Subcategory, $category]);
        // return true;
    }
}
