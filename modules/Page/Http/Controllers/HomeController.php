<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Modules\Page\Http\Controllers\CommonController;
use Illuminate\Http\Response;
use Modules\Media\Entities\File;
use Modules\Setting\Entities\Setting;

class HomeController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */


    public function index(Request $request)
    {
        $this->data['search'] = ($request::get('search'))?$request::get('search'):"";
        //dd($this->data);
        return view('storefront::public.home.index',["data"=>$this->data]);
    }
}
