<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Foundation\Application;
use Modules\Media\Entities\File;
use Modules\Category\Entities\Category;
use Modules\Support\Country;
use Modules\Support\State;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Slider\Entities\Slider;
use Modules\FlashSale\Entities\FlashSale;
use Modules\Product\Entities\Product;
class CommonController
{
    public $data = [];
    protected $app;

    public function __construct(Application $app)
    {
        $this->app          = $app;
        $logo               = File::findOrNew(setting('storefront_header_logo'))->path;
        $menus              = new MegaMenu(1);
        $menu               = $menus->menus();
        $catalog_menu       = Category::tree();
        $countries          = Country::all();
        $shop_country_name  = $countries[setting('store_country')];
        $shop_city          = State::name(setting('store_country'),setting('store_state'));
        $shop_city          = htmlentities($shop_city,ENT_COMPAT,"UTF-8");
        $features           = Slider::findWithSlides(2);
        $current_locale     = $app->getLocale();
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
        $category_menu = new MegaMenu(2);
        $category_menu = $category_menu->menus();

        //dd($allsalesproducts);

        $locales    = [
            'en'    =>[
                'name'  => "ENG",
                'icon'  => "/storage/media/en_icon.png",
            ],
            'ru_MD' =>[
                'name'  => "RUS",
                'icon'  => "/storage/media/ru_icon.png",

            ],
            "ro_MD" =>[
                'name'  => "MDL",
                'icon'  => "/storage/media/ro_icon.png",

            ]
        ];

        $this->data = [
            'logo'  => $logo,
            'menu'  => $menu,
            'locales' => $locales,
            'locale' => $app->getLocale(),
            'current_locale' => $locales[$app->getLocale()],
            'burger_menu' => $catalog_menu,
            'countries'=> $countries,
            'shop_country' => $shop_country_name,
            'shop_city' => $shop_city,
            'features' => $features,
            'feature_slider' => $features,
            'flashSaleProducts' => $allsalesproducts,
            'category_menu' => $category_menu
        ];
    }

}
