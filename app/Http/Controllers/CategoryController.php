<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\category\MultiUpdate;
use App\Http\Requests\Category\Store;
use App\Models\Category;
use App\Repository\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $categoryRepository, Category $model)
    {
        $this->repository = $categoryRepository;
        $this->model = $model;
        $this->type = "category";
    }

    public function list(Request $request)
    {
        $visibility = (int) $request->input('visibility') ?? 0;
        $categories = $this->repository->get(['hidden' => $visibility]);

        return view('category.list', [
            'categories' => $categories,
            'visibility' => $visibility
        ]);
    }

    public function show(Request $request, int $id)
    {
        if (($category = $this->repository->getWithRelations(['id' => $id])) == null) {
            return $this->error();
        }

        return view('category.show', [
            'category' => $category,
            'visibility' => (int) $request->input('visibility') ?? 0
        ]);
    }

    public function showPublic($id)
    {
        if (($category = $this->repository->getWithRelations(['id' => $id, 'private' => 0], false)) == null) {
            return $this->error();
        }

        return view('category.public', ['category' => $category]);
    }

    public function create(Store $request)
    {
        if ($request->isMethod('GET')) {
            return view('category.create');
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));
            $this->model->create($data);
            return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Store $request, $id)
    {
        if (($category = $this->repository->get(['id' => $id])->first()) == null) {
            return $this->error();
        }

        // return $category;

        if ($request->isMethod('GET')) {
            return view(
                'category.edit',
                [
                    'category' => $category,
                    'visibility' => $request->input('visibility') ?? 0
                ]
            );
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));
            $category->update($data);

            return redirect(url()->previous())
                ->with('success', Message::get(1));
        }
    }

    public function changeVisibility($id)
    {
        if (($category = $this->repository->get(['id' => $id])->first()) == null) {
            return $this->error();
        }

        $category->update(['hidden' => !$category->hidden]);
        return redirect(url()->previous())->with('success', $this->message(2));
    }

    public function manage(MultiUpdate $request)
    {
        if ($request->isMethod('GET')) {
            $categories = $this->repository->get();
            return view('category.manage', ['categories' => $categories]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();

            $ids = $data['ids'];
            $hidden = $data['hidden'];
            $private = $data['private'];
            $position = $data['position'];

            if (count($ids) != count($hidden) || count($hidden) != count($private) || count($private) != count($position)) {
                return $this->error();
            }

            $categories = $this->repository->getAllByIds($ids);

            foreach ($position as $key => $value) {
                if (!is_numeric($value)) {
                    $position[$key] = 0;
                }
            }

            foreach ($ids as $index => $id) {
                $category = $this->model->find($id);

                if ($category != null) {
                    $data = [
                        'hidden' => $hidden[$index],
                        'private' => $private[$index],
                        'position' => $position[$index]
                    ];
                    $category->update($data);
                }
            }

            return redirect()
                ->route('category.manage')
                ->with('success', Message::get(1));
        }
    }

    public function manageSubcategories($id)
    {
        $category = $this->repository->getWithRelation($id, 'subcategories');
        return view('subcategory.manage', ['category' => $category]);
    }

    public function managePages($id)
    {
        $category = $this->withRelations($id, 'pages');
        return view('page.manage', ['parent' => $category, 'type' => "category"]);
    }

    public function delete(Request $request, $id)
    {
        $category = $this->withRelations(['id' => $id]);
        $this->repository->delete($category);

        return redirect()
            ->route('category.list', ['visibility' => $request->input('visibility')])
            ->with('success', $this->message(1));
    }
}
