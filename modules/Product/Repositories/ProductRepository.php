<?php

namespace Modules\Product\Repositories;

use Modules\Product\Entities\Product;

class ProductRepository
{
    public static function list($ids = [])
    {
        return Product::select('id')
            ->withName()
            ->whereIn('id', $ids)
            ->when(!empty($ids), function ($query) use ($ids) {
                $idsString = collect($ids)
                    ->filter()
                    ->implode(',');

                $query->orderByRaw("FIELD(id, {$idsString})");
            })
            ->get()
            ->mapWithKeys(function ($product) {
                return [$product->id => $product->name];
            });
    }


    public static function findBySlug($slug)
    {
        return Product::with(['variations', 'variations.values', 'variations.values.files', 'variants', 'variants.files', 'categories', 'tags', 'attributes.attribute.attributeSet', 'options', 'files', 'reviews'])
            ->where('slug', $slug)
            ->firstOrFail();
    }
    public static function findByIds($ids=[])
    {
        return Product::with(['variations', 'variations.values', 'variations.values.files', 'variants', 'variants.files', 'categories', 'tags', 'attributes.attribute.attributeSet', 'options', 'files', 'reviews'])
            ->whereIn('id', $ids)
            ->get();
    }

    public static function getProductsByCategoryIds($ids=[])
    {
        if(empty($ids)) return false;

        return Product::with(['variations', 'variations.values', 'variations.values.files', 'variants', 'variants.files', 'categories', 'tags', 'attributes.attribute.attributeSet', 'options', 'files', 'reviews'])
            ->whereRaw("id in (select product_id from product_categories where category_id IN (".implode(",",$ids)."))")
            ->limit(20)
            ->get();
    }

}
