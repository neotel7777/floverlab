<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Modules\Category\Entities\Category;
use Modules\Product\Entities\Product;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Controllers\ProductSearch;
use Modules\Product\Http\Middleware\SetProductSortOption;

class CategoryController
{

    use ProductSearch;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
//    public function index()
//    {
//        return view('storefront::public.categories.index', [
//            'categories' => Category::all()->nest(),
//        ]);
//    }

    public function index(Product $model, ProductFilter $productFilter)
    {
        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }


        return view('storefront::public.products.index', [
            'categoryName' => trans('storefront::categories.all_categories'),
            'categories' => Category::all()->nest(),
        ]);
    }

}
