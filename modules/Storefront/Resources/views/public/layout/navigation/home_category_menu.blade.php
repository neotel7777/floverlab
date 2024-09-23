<section class="sectionWrap categoryWrap">
    <div class="category-nav-home flex-column-start-start">
        <div class="category-nav-inner-home font-30-36-500 color-black">
            {{ trans('storefront::layout.home_categories_title') }}
        </div>
        <nav class="home_category_list">
            <ul class="horizontal-catmenu flex-row-start-center">
                @foreach ($menus as $item)
                    @include('storefront::public.layout.navigation.menuitem', ['type' => 'primary_menu'])
                @endforeach
            </ul>
        </nav>
    </div>
</section>



