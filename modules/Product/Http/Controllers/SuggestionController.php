<?php

namespace Modules\Product\Http\Controllers;

use Closure;
use Modules\Product\Entities\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Modules\Product\Http\Response\SuggestionsResponse;

class SuggestionController
{
    /**
     * Display a listing of the resource.
     *
     * @return SuggestionsResponse
     */
    public function index(Product $model): SuggestionsResponse
    {

        $products = $this->getProducts($model);

        return new SuggestionsResponse(
            request('query'),
            $products,
            $this->getTotalResults($model)
        );
    }


    /**
     * Get products suggestions.
     *
     * @param Product $model
     *
     * @return Collection
     */
    private function getProducts(Product $model)
    {
        return $model->search(request('query'))
            ->query()
            ->limit(10)
            ->withName()
            ->withBaseImage()
            ->withPrice()
            ->addSelect([
                'products.id',
                'products.slug',
                'products.in_stock',
                'products.manage_stock',
                'products.qty',
            ])
            ->with(['files'])
            ->get();
    }


    /**
     * Returns categories condition closure.
     *
     * @return Closure
     */
    private function categoryQuery()
    {
        return function (Builder $query) {
            $query->whereHas('categories', function ($categoryQuery) {
                $categoryQuery->where('slug', request('category'));
            });
        };
    }


    /**
     * Get totalPrice results count.
     *
     * @param Product $model
     *
     * @return int
     */
    private function getTotalResults(Product $model): int
    {
        return $model->search(request('query'))
            ->query()
            ->when(request()->filled('category'), $this->categoryQuery())
            ->count();
    }


    public function newindex()
    {
        dd('hi');
    }
}
