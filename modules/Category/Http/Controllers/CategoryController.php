<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Modules\Category\Entities\Category;
use Modules\Page\Http\Controllers\CommonController;
use Modules\Product\Http\Middleware\SetProductSortOption;

class CategoryController extends CommonController
{
    public function __construct(Application $app, Request $request)
    {

        parent::__construct($app, $request);

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('storefront::public.categories.index', [
            'categories' => Category::all()->nest(),
        ]);
    }
}
