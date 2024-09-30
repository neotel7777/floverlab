<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Modules\Blog\Entities\BlogPost;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Controllers\ProductSearch;
use Illuminate\Foundation\Application;
use Modules\Review\Entities\Review;

class CategoryProductController
{
    use ProductSearch;


    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @param Product $model
     * @param ProductFilter $productFilter
     *
     * @return Response
     */
    public function index($slug, Product $model, ProductFilter $productFilter)
    {
        request()->merge(['category' => $slug]);

        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        $category = Category::findBySlug($slug);
        $categories = Category::parentActive($slug);
        $reviewsList = Review::getHomeReviews();
        $blogPosts = BlogPost::blogPosts();

        return view('storefront::public.products.index', [
            'categoryName' => $category->name,
            'categoryBanner' => $category->banner->path,
            'subcategories'    => $categories,
            'reviewsList'      => $reviewsList,
            'blogPosts' => $blogPosts
        ]);
    }
}
