<?php

namespace Modules\Storefront\Http\ViewComposers;

use Illuminate\View\View;
use Modules\Faq\Entities\Faq;
use Modules\Media\Entities\File;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariant;
use Modules\Review\Entities\Review;
use Modules\Storefront\Banner;
use Modules\Storefront\Feature;
use Modules\Brand\Entities\Brand;
use Illuminate\Support\Collection;
use Modules\Blog\Entities\BlogPost;
use Modules\Slider\Entities\Slider;
use Illuminate\Support\Facades\Cache;
use Modules\Category\Entities\Category;
use Modules\Support\Country;
use Modules\Support\Money;
use Modules\Support\State;

class HomePageComposer
{
    /**
     * Bind data to the view.
     *
     * @param View $view
     *
     * @return void
     */
    public function compose($view)
    {
        $view->with([
            'slider' => Slider::findWithSlides(setting('storefront_slider')),
            'sliderBanners' => Banner::getSliderBanners(),
            'features' => Feature::all(),
            'featuredCategories' => $this->featuredCategoriesSection(),
            'threeColumnFullWidthBanners' => $this->threeColumnFullWidthBanners(),
            'productTabsOne' => $this->productTabsOne(),
            'topBrands' => $this->topBrands(),
            'flashSaleAndVerticalProducts' => $this->flashSaleAndVerticalProducts(),
            'twoColumnBanners' => $this->twoColumnBanners(),
            'productGrid' => $this->productGrid(),
            'threeColumnBanners' => $this->threeColumnBanners(),
            'tabProductsTwo' => $this->tabProductsTwo(),
            'oneColumnBanner' => $this->oneColumnBanner(),
            'reviewsList' => Review::getHomeReviews(),
            'sale_products' =>$this->getSales(),
            'minPrice' => $this->minPrice(),
            'maxPrice' => $this->maxPrice(),
            'category_menu' => $this->getCategoryMenu(),
            'blogPosts'         => BlogPost::blogPosts(),
            'feature_slider' => Slider::findWithSlides(2),
            'faqs'           => Faq::getActive(),
            'contact_block_image' => $this->getMedia(setting('storefront_home_contacts_image'))->path,
            'countries'    => Country::all(),
            'shop_country'  => $this->getCoutries(),
            'shop_city'          => State::name(setting('store_country'),setting('store_state')),
        ]);
    }

    private function getCoutries()
    {
        $countries = Country::all();
        return $countries[setting('store_country')];
    }
    private function blogPosts()
    {
        $blogPosts = BlogPost::published()->with(['tags','category'])
            ->latest()
            ->take(setting('storefront_recent_blogs') ?? 10)
            ->get();
        setlocale(LC_TIME,getLocale(locale()));
        foreach ($blogPosts as $blogPost) {
            $blogPost->append('user_name');
            $blogPost->data = strftime('%d %B %G');
        }

        return  [
            'title' => setting('storefront_blogs_section_title'),
            'blogPosts' => !empty($blogPosts) ? $blogPosts : [],
        ];
    }
    private function getCategoryMenu(){

        $category_menu = new MegaMenu(2);

        return $category_menu->menus();
    }
    private function getSales(){

        $productClass = new Product();
        $sales = Product::where('special_price',"!=",Null)->where("price","<>","special_price")->get();

        foreach ($sales as &$sale){
            $sale->media            = $productClass->getMediaForProduct($sale->id);
            $sale->baseImage        = $sale->media[0];
            $sale->url              = route('products.show',$sale->slug);
            $sale->rating_percent   = 0;
            $sale->title            = $sale->translations[0]->name;
        }
        return $sales;
    }

    private function minPrice()
    {
        $minProductPrice = Product::min('selling_price');
        $minVariantPrice = ProductVariant::min('selling_price');
        $minPrice = min($minProductPrice, $minVariantPrice);

        return Money::inDefaultCurrency($minPrice)
            ->convertToCurrentCurrency()
            ->ceil()
            ->amount();
    }


    private function maxPrice()
    {
        $maxProductPrice = Product::max('selling_price');
        $maxVariantPrice = ProductVariant::max('selling_price');
        $maxPrice = max($maxProductPrice, $maxVariantPrice);

        return Money::inDefaultCurrency($maxPrice)
            ->convertToCurrentCurrency()
            ->ceil()
            ->amount();
    }

    private function featuredCategoriesSection()
    {
        if (!setting('storefront_featured_categories_section_enabled')) {
            return;
        }

        return [
            'title' => setting('storefront_featured_categories_section_title'),
            'subtitle' => setting('storefront_featured_categories_section_subtitle'),
            'categories' => $this->getFeaturedCategories(),
        ];
    }


    private function getFeaturedCategories()
    {
        $categoryIds = Collection::times(6, function ($number) {
            if (!is_null(setting("storefront_featured_categories_section_category_{$number}_product_type"))) {
                return setting("storefront_featured_categories_section_category_{$number}_category_id");
            }
        })->filter();

        return Category::with('files')
            ->whereIn('id', $categoryIds)
            ->when($categoryIds->isNotEmpty(), function ($query) use ($categoryIds) {
                $query->orderByRaw("FIELD(id, {$categoryIds->filter()->implode(',')})");
            })
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'logo' => $category->logo,
                ];
            });
    }


    private function threeColumnFullWidthBanners()
    {
        if (setting('storefront_three_column_full_width_banners_enabled')) {
            return Banner::getThreeColumnFullWidthBanners();
        }
    }


    private function productTabsOne()
    {
        if (!setting('storefront_product_tabs_1_section_enabled')) {
            return;
        }

        return Collection::times(4, function ($number) {
            if (!is_null(setting("storefront_product_tabs_1_section_tab_{$number}_product_type"))) {
                return setting("storefront_product_tabs_1_section_tab_{$number}_title");
            }
        })->filter();
    }


    private function topBrands()
    {
        if (!setting('storefront_top_brands_section_enabled')) {
            return collect();
        }

        $topBrandIds = setting('storefront_top_brands', []);

        return Cache::rememberForever(md5('storefront_top_brands:' . serialize($topBrandIds)), function () use ($topBrandIds) {
            return Brand::with('files')
                ->whereIn('id', $topBrandIds)
                ->when(!empty($topBrandIds), function ($query) use ($topBrandIds) {
                    $topBrandIdsString = collect($topBrandIds)->filter()->implode(',');

                    $query->orderByRaw("FIELD(id, {$topBrandIdsString})");
                })
                ->get()
                ->map(function (Brand $brand) {
                    return [
                        'url' => $brand->url(),
                        'logo' => $brand->getLogoAttribute(),
                    ];
                });
        });
    }


    private function flashSaleAndVerticalProducts()
    {
        return [
            'flash_sale_title' => setting('storefront_flash_sale_title'),
            'vertical_products_1_title' => setting('storefront_vertical_products_1_title'),
            'vertical_products_2_title' => setting('storefront_vertical_products_2_title'),
            'vertical_products_3_title' => setting('storefront_vertical_products_3_title'),
        ];
    }


    private function twoColumnBanners()
    {
        if (setting('storefront_two_column_banners_enabled')) {
            return Banner::getTwoColumnBanners();
        }
    }


    private function productGrid()
    {
        if (!setting('storefront_product_grid_section_enabled')) {
            return;
        }

        return Collection::times(4, function ($number) {
            if (!is_null(setting("storefront_product_grid_section_tab_{$number}_product_type"))) {
                return setting("storefront_product_grid_section_tab_{$number}_title");
            }
        })->filter();
    }


    private function threeColumnBanners()
    {
        if (setting('storefront_three_column_banners_enabled')) {
            return Banner::getThreeColumnBanners();
        }
    }


    private function tabProductsTwo()
    {
        if (!setting('storefront_product_tabs_2_section_enabled')) {
            return;
        }

        $tabs = Collection::times(4, function ($number) {
            if (!is_null(setting("storefront_product_tabs_2_section_tab_{$number}_product_type"))) {
                return setting("storefront_product_tabs_2_section_tab_{$number}_title");
            }
        })->filter();

        return [
            'title' => setting('storefront_product_tabs_2_section_title'),
            'tabs' => $tabs,
        ];
    }


    private function oneColumnBanner()
    {
        if (setting('storefront_one_column_banner_enabled')) {
            return Banner::getOneColumnBanner();
        }
    }

    private function getMedia($fileId)
    {
        return Cache::rememberForever(md5("files.{$fileId}"), function () use ($fileId) {
            return File::findOrNew($fileId);
        });
    }
}
