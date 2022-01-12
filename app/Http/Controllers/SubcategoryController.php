<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\Subcategory\MultiUpdate;
use App\Http\Requests\Subcategory\Store;
use App\Models\Subcategory;
use App\Repository\SubcategoryRepository;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct(SubcategoryRepository $subcategoryRepository, Subcategory $model)
    {
        $this->repository = $subcategoryRepository;
        $this->model = $model;
        $this->type = 'subcategory';
    }

    public function show(Request $request, $id)
    {
        if (($subcategory = $this->repository->getWithPages($id)) == null) {
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
        if (($subcategory = $this->repository->getWithPages($id)) == null) {
            return $this->error(3);
        }

        return view('subcategory.public', [
            'subcategory' => $subcategory,
        ]);
    }

    public function create(Store $request, $category_id)
    {
        if (($category = $this->repository->getCategory($category_id)) == null) {
            return $this->error();
        }

        if ($request->isMethod('GET')) {
            return view('subcategory.create', [
                'category' => $category,
                'visibility' => $request->input('visibility')
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));
            $data['category_id'] = $category_id;

            $this->model->create($data);
            return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Store $request, $id)
    {
        if (($subcategory = $this->repository->get($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);

        if ($request->isMethod('GET')) {
            return view('subcategory.edit', [
                'subcategory' => $subcategory,
                'visibility' => $request->input('visibility') ?? 0,
                'categories' => $this->repository->getCategories()
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));
            $data['category_id'] = $request->input('category_id');

            if ($data['category_id'] != $subcategory->category_id) {
                if ($this->repository->getCategory($data['category_id']) == null) {
                    return $this->error();
                }
            }

            $subcategory->update($data);
            return redirect(url()->previous())->with('success', Message::get(1));
        }
    }

    public function changeVisibility($id)
    {
        if (($subcategory = $this->repository->get($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);
        $subcategory->update(['hidden' => !$subcategory->hidden]);
        return redirect(url()->previous())->with('success', $this->message(2));
    }

    public function delete(Request $request, $id)
    {
        if (($subcategory = $this->repository->getWithPages($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);
        $this->repository->deletePages($subcategory->pages);
        $this->model->destroy($id);

        return redirect()
            ->route('category.show', ['id' => $subcategory->category_id, 'visibility' => $request->input('visibility')])
            ->with('success', $this->message(1));
    }

    public function manage(MultiUpdate $request)
    {
        $data = $request->validated();
        $ids = $data['ids'];
        $hidden = $data['hidden'];
        $private = $data['private'];
        $position = $data['position'];

        $unique = array_unique([count($ids), count($hidden), count($private), count($position)]);

        if (count($unique) != 1) {
            return $this->error(4);
        }

        $subcategories = $this->repository->getAllByIds($ids);
        $id  = array_unique($subcategories->pluck('category_id')->toArray());
        if (count($id) != 1) return $this->error(4);

        $this->authorize('author', $subcategories[0]);

        foreach ($position as $key => $value) {
            if (!is_numeric($value)) {
                $position[$key] = 0;
            }
        }

        foreach ($ids as $index => $id) {
            $subcategory = $this->model->find($id);

            if ($subcategory != null) {
                $data = [
                    'hidden' => $hidden[$index],
                    'private' => $private[$index],
                    'position' => $position[$index]
                ];
                $subcategory->update($data);
            }
        }

        return redirect(url()->previous())
            ->with('success', Message::get(1));
    }

    public function managePages($id)
    {
        if (($subcategory = $this->repository->getWithPages($id)) == null) {
            return $this->error();
        }

        $this->authorize('author', $subcategory);
        return view('page.manage', ['parent' => $subcategory, 'type' => "subcategory"]);
    }
}
