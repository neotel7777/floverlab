
@extends('storefront::public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @include('storefront::public.home.sections.feature_slider',['slider'=>$data['feature_slider']])
    @includeUnless(is_null($slider), 'storefront::public.home.sections.slider')


    @include('storefront::public.layout.navigation.home_category_menu', ['menus'=>$data['category_menu'],'type' => 'category_menu'])
    @if (setting('storefront_product_tabs_1_section_enabled'))
        <product-tabs-one :data="{{ json_encode($productTabsOne) }}"></product-tabs-one>
    @endif

    @if (setting('storefront_top_brands_section_enabled') && $topBrands->isNotEmpty())
        <top-brands :top-brands="{{ json_encode($topBrands) }}"></top-brands>
    @endif

    @if (setting('storefront_flash_sale_and_vertical_products_section_enabled'))
        <flash-sale-and-vertical-products
            :data="{{ json_encode($flashSaleAndVerticalProducts) }}"
            :flash-sale-enabled="{{ setting('storefront_active_flash_sale_campaign') ? 'true' : 'false' }}"
        >
        </flash-sale-and-vertical-products>
    @endif

    @if (setting('storefront_two_column_banners_enabled'))
        <banner-two-column :data="{{ json_encode($twoColumnBanners) }}"></banner-two-column>
    @endif

    @if (setting('storefront_product_grid_section_enabled'))
        @include('storefront::public.home.sections.catalog')
    @endif

    @if (setting('storefront_three_column_banners_enabled'))
        <banner-three-column :data="{{ json_encode($threeColumnBanners) }}"></banner-three-column>
    @endif

    @if (setting('storefront_product_tabs_2_section_enabled'))
        <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
    @endif

    @if (setting('storefront_one_column_banner_enabled'))
        <banner-one-column :banner="{{ json_encode($oneColumnBanner) }}"></banner-one-column>
    @endif

    @if (setting('storefront_blogs_section_enabled'))
        <blog-posts :data="{{ json_encode($blogPosts) }}"></blog-posts>
    @endif
@endsection
