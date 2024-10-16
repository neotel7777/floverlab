@extends('storefront::public.layout')

@section('title')
    @if (request()->has('query'))
        {{ trans('storefront::products.search_results_for') }}: "{{ request('query') }}"
    @else
        {{ trans('storefront::products.shop') }}
    @endif
@endsection

@push('globals')
    <script>
        FleetCart.langs['storefront::products.showing_results'] = '{{ trans("storefront::products.showing_results") }}';
    </script>
@endpush

@section('content')
    <div class="topContent"></div>
    <product-index
        initial-query="{{ request('query') }}"
        initial-brand-name="{{ $brandName ?? '' }}"
        initial-brand-banner="{{ $brandBanner ?? '' }}"
        initial-brand-slug="{{ request('brand') }}"
        initial-category-name="{{ $categoryName ?? '' }}"
        initial-category-banner="{{ $categoryBanner ?? '' }}"
        initial-category-slug="{{ request('category') }}"
        initial-tag-name="{{ $tagName ?? '' }}"
        initial-tag-slug="{{ request('tag') }}"
        :initial-attribute="{{ json_encode(request('attribute', [])) }}"
        :min-price="{{ $minPrice }}"
        :max-price="{{ $maxPrice }}"
        initial-sort="{{ request('sort', 'latest') }}"
        :initial-per-page="{{ request('perPage', 30) }}"
        :initial-page="{{ request('page', 1) }}"
        initial-view-mode="{{ request('viewMode', 'grid') }}"
        inline-template
    >
        <section class="product-search-wrap">
            <div class="sectionWrap">
                <div class="product-search">
                    <div class="product-search-left">
                        @include('storefront::public.products.index.filter')
                    </div>

                    <div class="product-search-right" v-cloak>

                        <div class="search-result">
                            <div class="search-result-top">
                                <div class="content-left">
                                    <h4 v-if="queryParams.query">
                                        {{ trans('storefront::products.search_results_for') }} <span>"@{{ queryParams.query }}"</span>
                                    </h4>
                                    <h4 v-else-if="queryParams.category" v-text="categoryName"></h4>
                                    <h4 v-else>{{ trans('storefront::products.shop') }}</h4>
                                </div>

                                <div class="content-right">
                                    <div class="mobile-view-filter">
                                        <i class="las la-sliders-h"></i>
                                        {{ trans('storefront::products.filters') }}
                                    </div>

                                    <div class="sorting-bar">
                                        <div class="form-group m-r-20">
                                            <select
                                                class="form-control custom-select-option left special"
                                                v-model="queryParams.sort"
                                                ref="sortSelect"
                                            >
                                                @foreach (trans('storefront::products.sort_options') as $key => $value)
                                                    <option
                                                        value="{{ $key }}"
                                                        {{ request('sort', 'latest') === $key ? 'selected' : '' }}
                                                    >
                                                        {{ $value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('storefront::public.products.index.category_menu',['categories'=>$subcategories])

                            <div class="search-result-middle" :class="{ empty: emptyProducts, loading: fetchingProducts }">
                                <div class="products-list flex-row-start-start" v-if="!emptyProducts">
                                    <product-card-grid-view v-for="product in products.data" :key="product.id" :product="product"></product-card-grid-view>
                                </div>

                                <div class="empty-message" v-if="!fetchingProducts && emptyProducts">
                                    @include('storefront::public.products.index.empty_results_logo')

                                    <h2>{{ trans('storefront::products.no_product_found') }}</h2>
                                </div>
                            </div>

                            <div class="search-result-bottom flex-row-center-center"
                                 :class="!emptyProducts ? 'showPaginate' : 'hidePaginate'"
                                >
                                <v-pagination
                                    :total-page="totalPage"
                                    :current-page="queryParams.page"
                                    @page-changed="changePage"
                                    v-if="products.total > queryParams.perPage"
                                >
                                </v-pagination>
                                <div class="view-all  flex-row-center-center"
                                     :class="(products.total > queryParams.perPage) ? 'showViewAll' : 'hideViewAll'"
                                     ref="viewAllProducts"
                                     v-if="viewAll">
                                    {{ trans('storefront::blog.blog_posts.view_all') }}
                                </div>
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

            <div class="sectionWrap">
                    <blog-posts :data="{{ json_encode($blogPosts) }}"></blog-posts>
            </div>
        </section>
    </product-index>

@endsection
