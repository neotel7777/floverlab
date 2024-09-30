<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Entities\BlogPost;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\Attribute;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Events\ShowingProductList;
use Modules\Review\Entities\Review;

trait ProductSearch
{
    /**
     * Search products for the request.
     *
     * @param Product $model
     * @param ProductFilter $productFilter
     *
     * @return JsonResponse
     */
    public function searchProducts(Product $model, ProductFilter $productFilter)
    {
        $productIds = [];
        $categories_home = [];
        $attributes = [];
        $reviews = [];
        if (request()->filled('query')) {
            $model = $model->search(request('query'));
            $productIds = $model->keys();
        }

        $query = $model->filter($productFilter);

        if (request()->filled('category')) {
            $productIds = (clone $query)->select('products.id')->resetOrders()->pluck('id');

            $attributes = $this->getAttributes($productIds);

            $reviews = Review::getCategoryReviews($productIds);
        } else {
            $ids = $this->getCategoryProductsIds(Category::all());
            $attributes = $this->getHomeAttributes($ids);
            $reviews = Review::getHomeReviews();
        }
        if (request()->get('page') =="home") {
            $categories_home = Category::atHome($productFilter);
            $ids = $this->getCategoryProductsIds($categories_home);
            $attributes = $this->getHomeAttributes($ids);
            $reviews = Review::getHomeReviews();

        }

        foreach ($attributes as &$attribute){
            $attribute->isActive = false;
        }

        $products = $query->paginate(request('perPage', 30));

        foreach ($products as $key=> $product){
            $item = Product::getProductsById($product->id);
            $product->medias = $item->files;
            $products[$key] = $product;
        }
        //$products->total = count($products);
        event(new ShowingProductList($products));

        return response()->json([
            'products' => $products,
            'categories_home' => $categories_home,
            'attributes' => $attributes,
            'reviewsList' => $reviews,
            'blogPostsList' => $this->blogPosts(),

        ]);
    }

    private function blogPosts()
    {
        $blogPosts = BlogPost::published()->with(['tags','category'])
            ->latest()
            ->take(setting('storefront_recent_blogs') ?? 10)
            ->get();
        setlocale(LC_TIME,locale());
        foreach ($blogPosts as $blogPost) {
            $blogPost->append('user_name');
            $blogPost->data = strftime('%d %B %G');
        }

        return [
            'title' => setting('storefront_blogs_section_title'),
            'blogPosts' => $blogPosts,
        ];
    }
    private function getCategoryProductsIds($categories){
        $ids = [];

        if(empty($categories)) return [];
        foreach ($categories as $category){
            if(empty($category['products'])) continue;
            foreach($category['products'] as $product){
                $ids[$product->id] = $product->id;
            }
        }
        return $ids;
    }

    private function getAttributes($productIds)
    {
        return Attribute::with('values')
            ->where('is_filterable', true)
            ->whereHas('categories', function ($query) use ($productIds) {
                $query->whereIn('id', $this->getProductsCategoryIds($productIds));
            })
            ->get();
    }
    private function getHomeAttributes($productIds)
    {

        return Attribute::with('values')
            ->where('is_filterable', true)
            ->whereIn('id', $productIds)
            ->get();
    }


    private function filteringViaRootCategory()
    {
        return Category::where('slug', request('category'))
            ->firstOrNew([])
            ->isRoot();
    }


    private function getProductsCategoryIds($productIds)
    {
        return DB::table('product_categories')
            ->whereIn('product_id', $productIds)
            ->distinct()
            ->pluck('category_id');
    }
}
