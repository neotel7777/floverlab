@extends('storefront::public.layout')

@section('title', $product->name)

@push('meta')
    <meta name="title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta name="description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta name="twitter:card" content="summary">
    <meta property="og:type" content="product">
    <meta property="og:url" content="{{ $product->variant?->url() ?? $product->url() }}">
    <meta property="og:title" content="{{ $product->meta->meta_title ?: $product->name }}">
    <meta property="og:description" content="{{ $product->meta->meta_description ?: $product->short_description }}">
    <meta property="og:image" content="{{ $product->variant?->base_image->path ?? $product->base_image->path ?? asset('build/assets/image-placeholder.png') }}">
    <meta property="og:locale" content="{{ locale() }}">

    @foreach (supported_locale_keys() as $code)
        <meta property="og:locale:alternate" content="{{ $code }}">
    @endforeach

    <meta property="product:price:amount" content="{{ $product->variant?->selling_price->convertToCurrentCurrency()->amount() ?? $product->selling_price->convertToCurrentCurrency()->amount() }}">
    <meta property="product:price:currency" content="{{ currency() }}">
@endpush

@push('globals')
    <script>
        FleetCart.langs['storefront::product.in_stock'] = '{{ trans('storefront::product.in_stock') }}';
        FleetCart.langs['storefront::product.left_in_stock'] = '{{ trans('storefront::product.left_in_stock') }}';
        FleetCart.langs['storefront::product.add_to_cart'] = '{{ trans('storefront::product.add_to_cart') }}';
        FleetCart.langs['storefront::product.unavailable'] = '{{ trans('storefront::product.unavailable') }}';
        FleetCart.langs['storefront::product.reviews'] = '{{ trans("storefront::product.reviews") }}';
        FleetCart.langs['storefront::product.review_submitted'] = '{{ trans("storefront::product.review_submitted") }}';
        FleetCart.langs['storefront::product.related_products'] = '{{ trans("storefront::product.related_products") }}';
    </script>

    {!! $productSchemaMarkup->toScript() !!}
@endpush

@section('breadcrumb')
    @if (! $categoryBreadcrumb)
        <li><a href="{{ route('products.index') }}">{{ trans('storefront::products.shop') }}</a></li>
    @endif

    {!! $categoryBreadcrumb !!}

    <li class="active">{{ $product->name }}</li>
@endsection

@section('content')
    <product-show
        :product="{{ json_encode($product) }}"
        :viewed="{{ json_encode($viewedProducts)  ?? json_encode(new stdClass) }}"
        :recomended="{{ json_encode($relatedProducts)  ?? json_encode(new stdClass) }}"
        :variant="{{ $product->variant ?? json_encode(new stdClass) }}"
        :review-count="{{ $review->count ?? 0 }}"
        :avg-rating="{{ $review->avg_rating ?? 0 }}"
        inline-template
    >
        <section class="product-details-wrap">
            <div class="sectionWrap">
                <div class="product-details-top flex-column-start-start">
                    <div class="topProductInfo">
                        @include('storefront::public.products.show.top_info', ['item' => $product->variant ?? $product])
                    </div>
                    <div class="topInfoProduct d-flex flex-column flex-lg-row flex-lg-nowrap ">
                        @if ($product->variant)
                            @include('storefront::public.products.show.variant_gallery')
                        @else
                            @include('storefront::public.products.show.gallery')
                        @endif

                            @include('storefront::public.products.show.details', ['item' => $product->variant ?? $product])

                    </div>
                </div>
            @if(count($relatedProducts)>0)
            <div class="relatedProducts sliderProductBlock  flex-column" >
                <div class="title sliderProductTitle">{{ trans('storefront::product.you_might_also_like') }}</div>
                <div class="relatedSlider" >
                    <product-item-card v-for="itemproduct in recomended"
                                       :key="itemproduct.id"
                                       :productitem="itemproduct"
                                       refname="relatedSlider"  >

                    </product-item-card>
                </div>
            </div>
            @endif
            @if(count($viewedProducts)>0)
            <div class="viewedProducts sliderProductBlock flex-column">
                <div class="title sliderProductTitle">{{ trans('storefront::product.have_you_watched') }}</div>
                <div class="viewedSlider" ref="viewedSlider">
                    <product-item-card v-for="itemproduct in viewed"
                                  :key="itemproduct.id"
                                  :productitem="itemproduct"
                                  refname="viewedSlider"  >

                    </product-item-card>
                </div>
            </div>
            @endif
            </div>

        </section>
    </product-show>
@endsection

@push('scripts')
    @vite([
        'modules/Storefront/Resources/assets/public/js/vendors/flatpickr.js'
    ])
@endpush
