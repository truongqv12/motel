<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Category;
use App\Transformers\CategoryTransformer;

class CategoryRepository implements CategoryInterface
{

    public function tranformCategories($categories)
    {
        $items = [];
        foreach ($categories as $category) {
            $items[$category->cat_id] = $category;
            if ($category->childs) {
                foreach ($category->childs as $child) {
                    $child->cat_name       = '|__' . $child->cat_name;
                    $items[$child->cat_id] = $child;
                    foreach ($child->childs as $child1) {
                        $child1->cat_name       = '|__|__' . $child1->cat_name;
                        $items[$child1->cat_id] = $child1;
                    }
                }
            }
        };

        $result = transformer_collection($items, new CategoryTransformer(), ['childs']);

        return $result;
    }

    public function backendAllByType($type = 'POST')
    {
        $categories = Category::where('cat_parent_id', '=', 0)
            ->where('cat_type', '=', $type)
            ->with('childs')
            ->orderBy('cat_id', 'asc')
            ->get();

        $result = $this->tranformCategories($categories);

        return $result ? collect_recursive($result) : false;
    }

    public function findById($id)
    {
        $cat    = Category::findOrFail($id);
        $result = transformer_item($cat, new CategoryTransformer(), ['childs']);
        return $result ? collect_recursive($result) : false;
    }

    public function allNotMyChild($id)
    {
        $cat    = $this->findById($id);
        $result = $this->backendAllByType($cat['type']);
        if ($result) {
            $result = unsset_childs_cat($result, $cat['id']);
        }

        return $result;
    }

    public function allByType($type = 'MOTEL')
    {
        $categories = Category::with('childs')
            ->where('cat_active', '=', 1)
            ->where('cat_type', '=', $type)
            ->get();

        if ($categories) {
            $categories = transformer_collection($categories, new CategoryTransformer());
        }

        return ($categories) ? collect_recursive($categories) : false;
    }

    public function createCategory($rq)
    {
        $category = Category::create($rq->all());
        return isset($category) ? true : false;
    }

    public function updateCategory($rq, $id)
    {
        $cat   = Category::findOrFail($id);
        $check = $cat->update($rq->all());
        if ($check) {
            $redirectLink = route('category.index') . '?type=' . $cat->cat_type;
        }

        return isset($redirectLink) ? $redirectLink : false;
    }

    public function all()
    {
        $categories = Category::with('childs')
            ->where('cat_active', '=', 1)
            ->get();

        if ($categories) {
            $categories = transformer_collection($categories, new CategoryTransformer());
        }

        return ($categories) ? collect_recursive($categories) : false;
    }

    public function getByRewrite($rewrite)
    {
        $cat = Category::where('cat_rewrite', '=', $rewrite)
            ->first();

        if ($cat) {
            $cat = transformer_item($cat, new CategoryTransformer());
        }

        return ($cat) ? collect_recursive($cat) : false;
    }
}