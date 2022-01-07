<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\Subcategory\MultiUpdate;
use App\Http\Requests\Subcategory\Store;
use App\Models\Subcategory;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Repository\SettingsRepository;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct(SubcategoryRepository $subcategoryRepository, Subcategory $subcategory)
    {
        $this->subcategoryRepository = $subcategoryRepository;
        $this->subcategory = $subcategory;
        $this->type = "subcategory";
    }

    public function show($view, $id)
    {
        // $subcategory = $this->subcategoryRepository->getModel()->find($id);
        // if ($this->empty($subcategory)) return $this->error();
        // $category = $this->categoryRepository->getModel()->find($subcategory->category_id);
        // if ($this->empty($category)) return $this->error();
        // $this->authorize('categoryAuthor', [new Subcategory, $category]);

        // if ($view == 'visible') $pages = $this->pageRepository->getAllByParameters($id, $this->type, 0);
        // else if ($view == "hidden") $pages = $this->pageRepository->getAllByParameters($id, $this->type, 1);
        // else if ($view == "all") $pages = $this->pageRepository->getAllByParameters($id, $this->type);

        // return view('subcategory.show', [
        //     'subcategory' => $subcategory,
        //     'pages' => $pages,
        //     'view' => $view
        // ]);
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

    public function create(Store $request, $category_id) // OK
    {
        $category = $this->subcategoryRepository->getCategory($category_id);
        if ($this->empty($category)) return $this->error();

        if ($request->isMethod('GET')) {
            $settings = SettingsRepository::get();

            return view('subcategory.create', [
                'category' => $category,
                'visibility' => $request->input('visibility'),
                'settings' => $settings
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $data['category_id'] = $category_id;

            $this->subcategory->store($data);
            return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Store $request, $id)
    {
        $subcategory = $this->subcategoryRepository->get($id);
        if ($subcategory == null) return $this->error();
        $this->authorize('author', $subcategory);

        if ($request->isMethod('GET')) {
            return view('subcategory.edit',
                [
                    'subcategory' => $subcategory,
                    'visibility' => $request->input('visibility'),
                    'categories' => $this->subcategoryRepository->getCategories()
                ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $data['category_id'] = $request->input('category_id');

            if ($data['category_id'] != $subcategory->category_id) {
                $category = $this->subcategoryRepository->getCategory($data['category_id']);
                if ($this->empty($category)) return $this->error();
            }

            $subcategory->update($data);

            return redirect(url()->previous())
                ->with('success', Message::get(1));
        }
    }

    public function update(Store $request, $id)
    {

    }

    public function changeVisibility($id)
    {
        $subcategory = $this->subcategory->find($id);
        // if (!$this->check($subcategory)) return $this->error();
        $subcategory->update(['hidden' => !$subcategory->hidden]);

        return redirect(url()->previous())
            ->with('success', $this->message(2));
    }

    public function manage()
    {
        $empty = true;
        $categories = $this->categoryRepository->getAllWithSubcategories(); // BY USER ID

        foreach ($categories as $category) {
            if (count($category->subcategories) != 0) {
                $empty = false;
            }
        }

        return view('subcategory.manage', ['categories' => $categories, 'empty' => $empty]);
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

    public function delete(Request $request, $id)
    {
        // $subcategory = $this->subcategoryRepository->getModel()->find($id);
        // if (!$this->check($subcategory)) return $this->error();
        // $subcategory->deleteWithContent($this->pageRepository);

        // return redirect()
        //     ->route('category.show', ['id' => $subcategory->category_id, 'view' => $request->input('view')])
        //     ->with('success', $this->message(1));
    }

    // Metody prywatne

    private function subcategory($id)
    {
        $this->check($subcategory = $this->subcategory->find($id));
        // return $category;
    }

    private function message($id)
    {
        return Message::get($id, $this->type);
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

    private function empty($item)
    {
        // if ($item == null) return true;
        // else return false;
    }

    private function error()
    {
        // return redirect()
        //     ->route('category.list', ['view' => 'visible'])
        //     ->with('error', Message::get(0));
        // exit();
    }
}
