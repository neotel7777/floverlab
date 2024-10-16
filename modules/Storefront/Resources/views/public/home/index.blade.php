
@extends('storefront::public.layout')

@section('title', setting('store_tagline'))

@section('content')
    @include('storefront::public.home.sections.feature_slider',['slider'=>$feature_slider])
    @includeUnless(is_null($slider), 'storefront::public.home.sections.slider')


    @include('storefront::public.layout.navigation.home_category_menu', ['menus'=>$category_menu,'type' => 'category_menu'])
    <div class="topContent"></div>
    @include('storefront::public.home.sections.catalog')
    @include('storefront::public.home.sections.contacts_block')
    <div class="faq-list-block">
        <div class="sectionWrap">
            <home-faq-list :faqsdata="{{ json_encode($faqs) }}"></home-faq-list>
        </div>
    </div>
    @if (setting('storefront_blogs_section_enabled'))
        @if(!empty($blogPosts))

        <div class="sectionWrap">
            <blog-posts :data="{{ json_encode($blogPosts) }}"></blog-posts>
        </div>
        @endif
    @endif
@endsection
