@push('globals')
    <script>
        FleetCart.langs['storefront::products.showing_results'] = '{{ trans("storefront::products.showing_results") }}';
    </script>
@endpush
<product-index
    initial-query="{{ request('query') }}"
    initial-category-slug="{{ request('category') }}"
    initial-tag-name="{{ $tagName ?? '' }}"
    initial-tag-slug="{{ request('tag') }}"
    :initial-attribute="{{ json_encode(request('attribute', [])) }}"
    :min-price="{{ $minPrice }}"
    :max-price="{{ $maxPrice }}"
    initial-sort="{{ request('sort', 'latest') }}"
    :initial-per-page="{{ request('perPage', 30) }}"
    initial-page="{{$home}}"
    initial-view-mode="{{ request('viewMode', 'grid') }}"
    inline-template
>
    <section class=" product-search-wrap">
        <div class="sectionWrap">
            <div class="product-search">
                <div class="product-search-left">
                    @include('storefront::public.products.index.home_filter')
                </div>

                <div class="product-search-right" v-cloak>
                    <div class="search-result">
                            <section class="home-categories-wrap">
                                <div class="container">
                                    <div class="homeCategoryWrapper flex-column-start-start gap-20">
                                        <home-categories
                                            v-for="category in categories_home"
                                            :key="category.id"
                                            :category="category"
                                        ></home-categories>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</product-index>
