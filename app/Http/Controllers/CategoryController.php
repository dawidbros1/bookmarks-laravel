<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\category\MultiUpdate;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use App\Repository\CategoryRepository;
use App\Repository\SettingsRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;
    private string $type;

    public function __construct(CategoryRepository $categoryRepository, Category $category)
    {
        $this->categoryRepository = $categoryRepository;
        $this->category = $category;
        $this->type = "category";
    }

    public function list(Request $request) // OK
    {
        $visibility = (int) $request->input('visibility') ?? 0;
        $categories = $this->categoryRepository->getByParams(['hidden' => $visibility]);

        return view('category.list', [
            'categories' => $categories,
            'visibility' => $visibility
        ]);
    }

    public function show(Request $request, int $id) // OK
    {
        $category = $this->withRelations($id);
        $visibility = (int) $request->input('visibility') ?? 0;
        if ($category == null) { return $this->error(); }

        return view('category.show', [
            'category' => $category,
            'visibility' => $visibility
        ]);
    }

    public function showPublic($id) // OK
    {
        $category = $this->withRelations($id);
        if ($category == null) { return $this->error(); }
        if ($category->public == 0) { return abort(403, 'Zasób nie jest publiczny'); }
        return view('category.public', ['category' => $category]);
    }

    public function create(Store $request) // OK
    {
        if ($request->isMethod('GET')) {
            $settings = SettingsRepository::get();
            return view('category.create', ['settings' => $settings]);
        }

        if ($request->isMethod('POST')) {
             $data = $request->validated();
             $data['public'] = Checkbox::get($request->input('public'));
             $this->category->create($data);
             return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Store $request, $id) // OK
    {
        if ($request->isMethod('GET')) {
            $category = $this->category($id);

            return view('category.edit',[
                    'category' => $category,
                    'visibility' => $request->input('visibility')
                ]
            );
        }

        if ($request->isMethod('POST')) {
            $category = $this->category($id);
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $category->update($data);

            return redirect(url()->previous())
                ->with('success', Message::get(1));
        }
    }

    public function changeVisibility($id) // OK
    {
        $category = $this->category($id);
        $category->update(['hidden' => !$category->hidden]);
        return redirect(url()->previous())->with('success', $this->message(2));
    }

    public function manage()
    {
        // $categories = $this->categoryRepository->getAllByParameters();
        // return view('category.manage', ['categories' => $categories]);
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

        // $categories = $this->categoryRepository->getAllByIds($ids);
        // $this->authorize('categories', [new Category, $categories]);

        // foreach ($order as $key => $value) {
        //     if (!is_numeric($value)) {
        //         $order[$key] = 0;
        //     }
        // }

        // foreach ($ids as $index => $id) {
        //     $category = $this->categoryRepository->getModel()->find($id);

        //     if ($category != null) {
        //         $data = [
        //             'hidden' => $hidden[$index],
        //             'public' => !$private[$index],
        //             'order' => $order[$index]
        //         ];
        //         $category->update($data);
        //     }
        // }

        // return redirect()
        //     ->route('manage.categories')
        //     ->with('success', Message::get(1));
    }

    public function delete(Request $request, $id)
    {
        // $category = $this->categoryRepository->getModel()->find($id);
        // if ($this->empty($category)) return $this->error();
        // $this->authorize('author', $category);
        // $category->deleteWithContent($this->subcategoryRepository);

        // return redirect()
        //     ->route('category.list', ['view' => $request->input('view')])
        //     ->with('success', $this->message(1));
    }

    // Metody prywatne

    private function message($id)
    {
        return Message::get($id, $this->type);
    }

    private function error()
    {
        return redirect()
            ->route('category.list', ['view' => 'visible'])
            ->with('error', Message::get(0));
        exit();
    }

    private function category($id){
        $this->check($category = $this->category->find($id));
        return $category;
    }

    private function withRelations($id){
        $this->check($category = $this->categoryRepository->getWithRelations($id));
        return $category;
    }

    private function check($category){
        if ($category != null) {
            $this->authorize('author', $category);
        }
    }
}
