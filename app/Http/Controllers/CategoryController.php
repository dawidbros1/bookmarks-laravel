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

    public function __construct(CategoryRepository $categoryRepository, Category $model)
    {
        $this->categoryRepository = $categoryRepository;
        $this->model = $model;
        $this->type = "category";
    }

    public function list(Request $request)
    {
        $visibility = (int) $request->input('visibility') ?? 0;
        $categories = $this->categoryRepository->getByParams(['hidden' => $visibility]);

        return view('category.list', [
            'categories' => $categories,
            'visibility' => $visibility
        ]);
    }

    public function show(Request $request, int $id)
    {
        $category = $this->withRelations($id);
        $visibility = (int) $request->input('visibility') ?? 0;
        if ($category == null) {
            return $this->error();
        }

        return view('category.show', [
            'category' => $category,
            'visibility' => $visibility
        ]);
    }

    public function showPublic($id)
    {
        $category = $this->withRelations($id);
        if ($category == null) {
            return $this->error();
        }
        if ($category->public == 0) {
            return abort(403, 'Zasób nie jest publiczny');
        }
        return view('category.public', ['category' => $category]);
    }

    public function create(Store $request)
    {
        if ($request->isMethod('GET')) {
            $settings = SettingsRepository::get();
            return view('category.create', ['settings' => $settings]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['public'] = Checkbox::get($request->input('public'));
            $this->model->create($data);
            return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Store $request, $id)
    {
        if ($request->isMethod('GET')) {
            $category = $this->category($id);

            return view(
                'category.edit',
                [
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

    public function changeVisibility($id)
    {
        $category = $this->category($id);
        $category->update(['hidden' => !$category->hidden]);
        return redirect(url()->previous())->with('success', $this->message(2));
    }

    public function manage(MultiUpdate $request)
    {
        if ($request->isMethod('GET')) {
            $categories = $this->categoryRepository->getByParams();
            return view('category.manage', ['categories' => $categories]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();

            $ids = $data['ids'];
            $hidden = $data['hidden'];
            $private = $data['public'];
            $order = $data['order'];

            if (count($ids) != count($hidden) || count($hidden) != count($private) || count($private) != count($order)) {
                return $this->error();
            }

            $categories = $this->categoryRepository->getAllByIds($ids);
            $this->authorize('categories', [new Category, $categories]);

            foreach ($order as $key => $value) {
                if (!is_numeric($value)) {
                    $order[$key] = 0;
                }
            }

            foreach ($ids as $index => $id) {
                $category = $this->model->find($id);

                if ($category != null) {
                    $data = [
                        'hidden' => $hidden[$index],
                        'public' => !$private[$index],
                        'order' => $order[$index]
                    ];
                    $category->update($data);
                }
            }

            return redirect()
                ->route('category.manage')
                ->with('success', Message::get(1));
        }
    }

    public function manageSubcategories(Request $request, $id)
    {
        $category = $this->withRelation($id, 'subcategories');
        return view('subcategory.manage', ['category' => $category]);
    }

    public function managePages($id)
    {
        $category = $this->withRelations($id, 'pages');
        return view('page.manage', ['parent' => $category, 'type' => "category"]);
    }

    public function delete(Request $request, $id)
    {
        $category = $this->withRelations($id);

        $this->categoryRepository->delete($category);

        return redirect()
            ->route('category.list', ['visibility' => $request->input('visibility')])
            ->with('success', $this->message(1));
    }

    // Metody prywatne

    private function category($id)
    {
        $this->check($category = $this->model->find($id));
        return $category;
    }

    private function withRelation($id, $relation)
    {
        $this->check($category = $this->categoryRepository->getWithRelation($id, $relation));
        return $category;
    }

    private function withRelations($id)
    {
        $this->check($category = $this->categoryRepository->getWithRelations($id));
        return $category;
    }

    private function check($category)
    {
        if ($category != null) {
            $this->authorize('author', $category);
        }
    }
}
