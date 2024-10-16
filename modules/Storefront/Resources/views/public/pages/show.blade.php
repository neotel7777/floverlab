@extends('storefront::public.layout')

@section('title', $page->name)

@push('meta')
    <meta name="title" content="{{ $page->meta->meta_title ?: $page->name }}">
    <meta name="description" content="{{ $page->meta->meta_description }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page->meta->meta_title ?: $page->name }}">
    <meta property="og:description" content="{{ $page->meta->meta_description }}">
    <meta property="og:image" content="{{ $logo }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach
@endpush
@section('breadcrumb')
    <li class="active">{{ $page->name }}</li>
@endsection
@section('content')
    <section class="custom-page-wrap clearfix">
        <div class="sectionWrap">
            <div class="custom-page-content clearfix">

                <div class="pageBody flex-row-between-start">
                    <ul class="pageMenu flex-column-start-start">
                        @foreach($pages as $pageItem)

                            <li class="flex-row-start-center">
                                @if(!empty($pageItem->files[0]->path))
                                <div class="pageIcon">
                                    <img src="{{ $pageItem->files[0]->path}}">
                                </div>
                                @endif
                                <a href="{{ route('pages.show',$pageItem->page->slug) }}">
                                    {{ $pageItem->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="page_content">
                        <h2 class="font-30-36-500">{{ $page->name }}</h2>
                        <div class="page_text font-16-24-normal color-black">{!! $page->body !!}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
