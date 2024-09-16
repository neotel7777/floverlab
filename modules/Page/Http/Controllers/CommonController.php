<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Request;
use Modules\Media\Entities\File;
use Modules\Category\Entities\Category;
use Modules\Support\Country;
use Modules\Support\State;
use Modules\Menu\MegaMenu\MegaMenu;
use Modules\Setting\Entities\Setting;
use Modules\Slider\Entities\Slider;
use Modules\Product\Entities\Product;
class CommonController extends Controller
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
        $current_locale     = $app->getLocale();
        $request            = request('search');

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
                'name'  => "ROM",
                'icon'  => "/storage/media/ro_icon.png",

            ]
        ];

        $this->data = [
            'logo'              => $logo,
            'menu'              => $menu,
            'locales'           => $locales,
            'locale'            => $app->getLocale(),
            'current_locale'    => $locales[$app->getLocale()],
            'burger_menu'       => $catalog_menu,
            'countries'         => $countries,
            'shop_country'      => $shop_country_name,
            'shop_city'         => $shop_city,
            'search'            => $request
        ];
    }

}
