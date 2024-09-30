
@extends('storefront::public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @include('storefront::public.home.sections.feature_slider',['slider'=>$feature_slider])
    @includeUnless(is_null($slider), 'storefront::public.home.sections.slider')


    @include('storefront::public.layout.navigation.home_category_menu', ['menus'=>$category_menu,'type' => 'category_menu'])

    @include('storefront::public.home.sections.catalog')



    @if (setting('storefront_blogs_section_enabled'))
        <div class="sectionWrap">
            <blog-posts :data="{{ json_encode($blogPosts) }}"></blog-posts>
        </div>
    @endif
@endsection
