<!DOCTYPE html>
<html lang="{{ locale() }}">

<head>
    <base href="{{ config('app.url') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>
        @hasSection('title')
            @yield('title') - {{ setting('store_name') }}
        @else
            {{ setting('store_name') }}
        @endif
    </title>

    @stack('meta')
    @PWA

    <link rel="shortcut icon" href="{{ $favicon }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="{{ v(asset('storage/css/lib.css')) }}" rel="stylesheet">
    <link href="{{ t(asset('storage/css/styles.css')) }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="{{ v(asset('storage/js/jquery.min.js')) }}"></script>
    <script src="{{ v(asset('storage/js/bootstrap.js')) }}"></script>
    <script src="{{ v(asset('storage/js/slick.min.js')) }}"></script>
    <script src="{{ v(asset('storage/js/scripts.js')) }}"></script>

    @vite([
        'modules/Storefront/Resources/assets/public/sass/main.scss',
        'modules/Storefront/Resources/assets/public/js/main.js',
    ])

    @stack('styles')

    {!! setting('custom_header_assets') !!}

    <script>
        window.FleetCart = {
            baseUrl: '{{ config('app.url') }}',
            rtl: {{ is_rtl() ? 'true' : 'false' }},
            storeName: '{{ setting('store_name') }}',
            storeLogo: '{{ $logo }}',
            loggedIn: {{ auth()->check() ? 'true' : 'false' }},
            csrfToken: '{{ csrf_token() }}',
            razorpayKeyId: '{{ setting('razorpay_key_id') }}',
            cart: {!! $cart !!},
            wishlist: {!! $wishlist !!},
            compareList: {!! $compareList !!},
            langs: {
                'storefront::layout.next': '{{ trans('storefront::layout.next') }}',
                'storefront::layout.prev': '{{ trans('storefront::layout.prev') }}',
                'storefront::layout.search_for_products': '{{ trans('storefront::layout.search_for_products') }}',
                'storefront::layout.all_categories': '{{ trans('storefront::layout.all_categories') }}',
                'storefront::layout.most_searched': '{{ trans('storefront::layout.most_searched') }}',
                'storefront::layout.category_suggestions': '{{ trans('storefront::layout.category_suggestions') }}',
                'storefront::layout.product_suggestions': '{{ trans('storefront::layout.product_suggestions') }}',
                'storefront::layout.more_results': '{{ trans('storefront::layout.more_results') }}',
                'storefront::product_card.out_of_stock': '{{ trans('storefront::product_card.out_of_stock') }}',
                'storefront::product_card.new': '{{ trans('storefront::product_card.new') }}',
                'storefront::product_card.add_to_cart': '{{ trans('storefront::product_card.add_to_cart') }}',
                'storefront::product_card.view_options': '{{ trans('storefront::product_card.view_options') }}',
                'storefront::product_card.compare': '{{ trans('storefront::product_card.compare') }}',
                'storefront::product_card.wishlist': '{{ trans('storefront::product_card.wishlist') }}',
                'storefront::product_card.available': '{{ trans('storefront::product_card.available') }}',
                'storefront::product_card.sold': '{{ trans('storefront::product_card.sold') }}',
                'storefront::product_card.days': '{{ trans('storefront::product_card.days') }}',
                'storefront::product_card.hours': '{{ trans('storefront::product_card.hours') }}',
                'storefront::product_card.minutes': '{{ trans('storefront::product_card.minutes') }}',
                'storefront::product_card.seconds': '{{ trans('storefront::product_card.seconds') }}',
                'storefront::blog.blog_posts.view_all': '{{ trans('storefront::blog.blog_posts.view_all') }}',
                'storefront::blog.blog_posts.read_more': '{{ trans('storefront::blog.blog_posts.read_more') }}',
                'storefront::layout.Flovers_and_sale': '{{ trans('storefront::layout.Flovers_and_sale') }}',
                'storefront::layout.Flovers_and_sale_hint': '{{ trans('storefront::layout.Flovers_and_sale_hint') }}',
                'storefront::layout.delivery_gratis': '{{ trans('storefront::layout.delivery_gratis') }}',
                'storefront::review.home_section_title': '{{ trans('storefront::review.home_section_title') }}',
                'storefront::review.reviews_title': '{{ trans('storefront::review.reviews_title') }}',
                'storefront::review.total_reviews_total_title': '{{ trans('storefront::review.total_reviews_total_title') }}',
                'storefront::review.total_raitings_title': '{{ trans('storefront::review.total_raitings_title') }}',
                'storefront::review.total_orders_title': '{{ trans('storefront::review.total_orders_title') }}',
                'storefront::review.Leave_Review_button': '{{ trans('storefront::review.Leave_Review_button') }}',
                'storefront::review.stars_stats_list': '{{ trans('storefront::review.stars_stats_list') }}',
                'storefront::review.photo_on_site': '{{ trans('storefront::review.photo_on_site') }}',
                'storefront::storefront.clear_filter_button': '{{ trans('storefront::storefront.clear_filter_button') }}',
                'storefront::storefront.in_cart': '{{ trans('storefront::storefront.in_cart') }}',
                'review::sidebar.reviews': '{{ trans('review::sidebar.reviews') }}',
                'faq::public.home_block_title': '{{ trans('faq::public.home_block_title') }}',

                'storefront::account.pages.my_profile': '{{ trans('storefront::account.pages.my_profile') }}',
                'storefront::account.pages.my_orders': '{{ trans('storefront::account.pages.my_orders') }}',
                'storefront::account.pages.logout': '{{ trans('storefront::account.pages.logout') }}',
                'storefront::layout.login': '{{ trans('storefront::layout.login') }}',
                'order::delivery.delivery_sity': '{{trans("order::delivery.delivery_sity") }}',
                'order::delivery.default_sity': '{{trans("order::delivery.default_sity") }}',

                'user::auth.email': '{{ trans('user::auth.email') }}',
                'user::auth.enter_your_email': '{{ trans('user::auth.enter_your_email') }}',
                'user::auth.password': '{{ trans('user::auth.password') }}',
        },
        };
    </script>

    {!! $schemaMarkup->toScript() !!}




    @stack('globals')

    @routes
</head>

<body
    dir="{{ is_rtl() ? 'rtl' : 'ltr' }}"
    class="page-template {{ is_rtl() ? 'rtl' : 'ltr' }} page_{{ $page }}"
    data-theme-color="{{ $themeColor->toHexString() }}"
    style="
        --color-primary: {{ tinycolor($themeColor->toString())->toHexString() }};
        --color-primary-hover: {{ tinycolor($themeColor->toString())->darken(8)->toString() }};
        --color-primary-transparent: {{ tinycolor($themeColor->toString())->setAlpha(0.8)->toString() }};
        --color-primary-transparent-lite: {{ tinycolor($themeColor->toString())->setAlpha(0.3)->toString() }};
        --color-primary-transparent-lite-2: {{ tinycolor($themeColor->toString())->setAlpha(0.12)->toString() }};
    "
>
    <div class="wrapper flex-column" id="app">

        @include('storefront::public.layout.header')
        @include('storefront::public.layout.breadcrumb')

        @yield('content')

        @include('storefront::public.layout.footer')

        <div class="overlay"></div>
        <div class="hidding_overlay"></div>
        @include('storefront::public.layout.localization')

        @if (!request()->routeIs('checkout.create'))
            @include('storefront::public.layout.sidebar_cart')
        @endif

        @include('storefront::public.layout.alert')
        @include('storefront::public.layout.newsletter_popup')
        @include('storefront::public.layout.cookie_bar')
    </div>

    @stack('pre-scripts')
    @stack('scripts')

    {!! setting('custom_footer_assets') !!}
</body>

</html>
