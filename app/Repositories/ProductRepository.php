<?php
/**
 * Created by PhpStorm.
 * User: Truong
 * Date: 14/11/2018
 * Time: 10:12 CH
 */

namespace App\Repositories;


use App\Models\Product;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class ProductRepository implements ProductInterface
{

    public function all()
    {
        $products = Product::with(['category', 'author'])
            ->orderBy('id', 'desc')
            ->get();
        return (isset($products)) ? $products : false;
    }

    public function findById($id)
    {
        $product = Product::where('id', '=', $id)
            ->with(['category', 'author'])
            ->first();
        return (isset($product)) ? $product : false;
    }
//
//    public function newProduct(array $filters)
//    {
//        $query = Product::with('author')
//            ->where(function ($query) use ($filters){
//                $query->where('active', '=', 1);
//                if(isset($filters['keyword']) && !empty($filters['keyword'])){
//                    $query->where('name', 'like', '%' . $filters['keyword'] . '%');
//                }
//            })
//            ->orderBy('id', 'desc')
//            ->limit($filters['limit'])
//            ->offset($filters['offset']);
//
//        return $query;
//    }

}