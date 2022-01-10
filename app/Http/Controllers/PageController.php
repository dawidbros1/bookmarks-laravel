<?php

namespace App\Http\Controllers;

use App\Helpers\Checkbox;
use App\Helpers\Message;
use App\Http\Requests\Page\MultiUpdate;
use App\Http\Requests\Page\Store;
use App\Http\Requests\Page\Update;
use App\Models\Page;
use App\Repository\PageRepository;
use App\Repository\SettingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct(PageRepository $pageRepository, Page $model)
    {
        $this->pageRepository = $pageRepository;
        $this->model = $model;
        $this->type = "page";
    }

    public function create(Store $request, $parent, $id)
    {
        if ($this->author($parent, $id) == false) return $this->error();

        if ($request->isMethod('GET')) {

            return view('page.create', [
                'parent' => $parent,
                'id' => $id,
                'visibility' => $request->input('visibility') ?? 0
            ]);
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));
            $this->model->create($data);
            return redirect(url()->previous())->with('success', $this->message(0));
        }
    }

    public function edit(Update $request, $id)
    {
        if (($page = $this->model->find($id)) == null) return $this->error();
        if ($this->author($page->type, $page->parent_id) == false) return $this->error();

        if ($request->isMethod('GET')) {
            $categories = $this->pageRepository->getCategories();
            $category_ids = $categories->pluck('id')->toArray();
            $subcategories = $this->pageRepository->getSubcategoriesByCategoryIds($category_ids);

            if ($page->type == "subcategory") {
                $parent = $this->pageRepository->getSubcategory($page->parent_id);
                $category_id = $parent->category_id;
            } else if ($page->type = "category") {
                $parent = $this->pageRepository->getCategory($page->parent_id);
                $category_id = $parent->id;
            }

            return view(
                'page.edit',
                [
                    'page' => $page,
                    'visibility' => $request->input('visibility'),
                    'parent' => $parent,
                    'categories' => $categories,
                    'subcategories' => $subcategories,
                    'category_id' => $category_id
                ]
            );
        }

        if ($request->isMethod('POST')) {
            $data = $request->validated();
            $data['private'] = Checkbox::get($request->input('private'));

            $subcategory_id = $data['subcategory_id'];

            if ($subcategory_id == 0) {
                // Umieszczenie w głównej kategorii
                $category_id = $data['category_id'];
                // Czy kategoria się zmieniła
                if ($category_id != $page->parent_id) {
                    $category = $this->pageRepository->getCategory($category_id);
                    if ($this->empty($category)) return $this->error();

                    $data['parent_id'] = $category_id;
                    $data['type'] = 'category';
                }
            } else {
                if ($subcategory_id != $page->parent_id) {
                    if (($subcategory = $this->pageRepository->getSubcategory($subcategory_id)) == null) return $this->error();
                    if ($subcategory->category->user_id != Auth::id()) return $this->error();

                    $data['parent_id'] = $subcategory_id;
                    $data['type'] = 'subcategory';
                }
            }

            $page->update($data);

            return redirect(url()->previous())
                ->with('success', 'Strona została edytowana');
        }
    }

    public function changeVisibility($id)
    {
        if (($page = $this->model->find($id)) == null) return $this->error();
        if ($this->author($page->type, $page->parent_id) == false) return $this->error();

        $page->update(['hidden' => !$page->hidden]);

        return redirect(url()->previous())
            ->with('success', $this->message(2));
    }

    public function delete(Request $request, $id)
    {
        if (($page = $this->model->find($id)) == null) return $this->error();
        if ($this->author($page->type, $page->parent_id) == false) return $this->error();

        $this->model->destroy($id);

        return redirect()
            ->route($page->type . '.show', ['id' => $page->parent_id, 'visibility' => $request->input('visibility')])
            ->with('success', $this->message(1));
    }

    public function manage(MultiUpdate $request)
    {
        $data = $request->validated();
        $ids = $data['ids'];
        $hidden = $data['hidden'];
        $private = $data['private'];
        $position = $data['position'];
        $type = $data['type'];

        if (count($ids) != count($hidden) || count($hidden) != count($private) || count($private) != count($position)) {
            return $this->error();
        }

        $pages = $this->pageRepository->getAllByIds($ids);
        if (count($pages) == 0) return $this->error();

        $id  = array_unique($pages->pluck('parent_id')->toArray());
        if (count($id) != 1) return $this->error();

        if ($type == "category") {
            if ($this->pageRepository->getCategory($id) == null) return $this->error();
        } else if ($type == "subcategory") {
            if (($subcategory = $this->pageRepository->getSubcategory($id)) == null) return $this->error();
            if ($subcategory->category == null) return $this->error();
        }

        foreach ($ids as $index => $id) {
            $page = $this->model->find($id);
            if ($page != null) {
                $package = [
                    'hidden' => $hidden[$index],
                    'private' => $private[$index],
                    'position' => $position[$index]
                ];
                $page->update($package);
            }
        }

        return redirect(url()->previous())
            ->with('success', Message::get(1));
    }


    private function author($parent, $id)
    {
        $author = false;

        if ($parent == "subcategory") {
            if (($subcategory = $this->pageRepository->getSubcategory($id)) != null) {
                $category = $subcategory->category ?? null;
            }
        } else if ($parent == "category") {
            $category = $this->pageRepository->getCategory($id);
        }

        if ($category->user_id == Auth::id()) $author = true;

        return $author;
    }
}
