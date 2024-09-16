<section class="sectionWrap">
    <div class="category-nav ">
        <div class="category-nav-inner">
            {{ trans('storefront::layout.home_categories_title') }}
        </div>
        <nav class="home_category_list">
            <ul class="horizontal-catmenu">
                @foreach ($menus as $item)
                    @include('storefront::public.layout.navigation.menuitem', ['type' => 'primary_menu'])
                @endforeach
            </ul>
        </nav>
    </div>
</section>



