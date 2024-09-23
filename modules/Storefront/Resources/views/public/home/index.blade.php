
@extends('storefront::public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @include('storefront::public.home.sections.feature_slider',['slider'=>$data['feature_slider']])
    @includeUnless(is_null($slider), 'storefront::public.home.sections.slider')


    @include('storefront::public.layout.navigation.home_category_menu', ['menus'=>$data['category_menu'],'type' => 'category_menu'])

    @include('storefront::public.home.sections.catalog')

    <reviews-home-list  :reviewsitems='@json($reviewsList)'></reviews-home-list>

    @if (setting('storefront_three_column_banners_enabled'))
        <banner-three-column :data='{{ json_encode($threeColumnBanners) }}'></banner-three-column>
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
