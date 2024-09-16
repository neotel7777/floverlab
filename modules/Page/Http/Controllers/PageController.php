<?php

namespace Modules\Page\Http\Controllers;

use Illuminate\Http\Response;
use Modules\Page\Entities\Page;
use Modules\Media\Entities\File;

class PageController  extends CommonController
{
    /**
     * Display page for the slug.
     *
     * @param string $slug
     *
     * @return Response
     */
    public function show($slug)
    {

        $logo = File::findOrNew(setting('admin_logo'))->path;
        $page = Page::where('slug', $slug)->firstOrFail();
        $data  = $this->data;

        return view('storefront::public.pages.show', compact('page', 'logo','data'));
    }
}
