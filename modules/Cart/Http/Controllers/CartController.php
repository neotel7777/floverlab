<?php

namespace Modules\Cart\Http\Controllers;

use Modules\Cart\Facades\Cart;
use Modules\Category\Entities\Category;

class CartController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $accessorii = Category::getProductStartCategory();
        return view('storefront::public.cart.index',compact('accessorii'));
    }


    /**
     * Clear the cart.
     *
     * @return \Modules\Cart\Cart
     */
    public function clear()
    {
        Cart::clear();

        return Cart::instance();
    }
}
