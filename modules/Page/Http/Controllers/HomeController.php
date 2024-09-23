<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Category\Entities\Category;
use Modules\FlashSale\Entities\FlashSale;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Page\Http\Controllers\CommonController;
use Illuminate\Http\Response;
use Modules\Media\Entities\File;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductVariant;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Controllers\ProductSearch;
use Modules\Slider\Entities\Slider;
use Modules\Storefront\Http\ViewComposers\ProductIndexPageComposer;
use Modules\Support\Money;

class HomeController extends CommonController
{
    use ProductSearch;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index(Request $request, ProductFilter $productFilter)
    {

        $features           = Slider::findWithSlides(2);
        $flashsaleClass     = new FlashSale();
        $allsales           = $flashsaleClass->all();
        $allsalesproducts   = [];
        $productClass       = new Product();
        foreach ($allsales as $sale){
            $saleproducts = $flashsaleClass->find($sale->id)->products()
                ->wherePivot('end_date',">",date("Y-m-d"))
                ->wherePivot('qty','>',0)->get();
            foreach ($saleproducts as $saleproduct){
                $saleproduct->media = $productClass->getMediaForProduct($saleproduct->id);
                $allsalesproducts[] = $saleproduct;
            }
        }
        $sales = $productClass::where('special_price',"!=",Null)->where("price","<>","special_price")->get();
        foreach ($sales as &$sale){
            $sale->media            = $productClass->getMediaForProduct($sale->id);
            $sale->baseImage        = $sale->media[0];
            $sale->url              = route('products.show',$sale->slug);
            $sale->rating_percent   = 0;
            $sale->title            = $sale->translations[0]->name;
        }
        //dd($sales);

        $category_menu = new MegaMenu(2);
        $category_menu = $category_menu->menus();

        $this->data['feature_slider']       = $features;
        $this->data['sale_products']        = $sales;
        $this->data['category_menu']        = $category_menu;
        $this->data['search']               = (request('search'))?request('search'):"";


        return view('storefront::public.home.index',[
            "data"=>$this->data,
            'minPrice' => $this->minPrice(),
            'maxPrice' => $this->maxPrice(),
            'home'  => 'home',
        ]);
    }

    private function categories()
    {
        return Category::tree();
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
}
