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
    :reviewsList="{{ json_encode($reviewsList) }}"
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
                            <section class="home-categories-wrap" v-if="categories_home.length > 0">
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
                            <div class="empty-message gap-20 flex-column-center-center" v-else>
                                @include('storefront::public.products.index.empty_results_logo')

                                <h2>{{ trans('storefront::products.no_product_found') }}</h2>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    <reviews-home-list
        v-for="(reviewsitems, index) in reviewsList"
        :key="index"
        :reviewsitems='reviewsitems'>


    </reviews-home-list>
    </section>
    </product-index>
