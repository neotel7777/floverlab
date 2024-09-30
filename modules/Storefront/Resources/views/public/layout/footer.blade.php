<footer class="footer-wrap bk-color-dark">
    <div class="sectionWrap">
        <div class="footer">
            <div class="footer-top">
                <div class="row">
                    <div class="col-lg-5 col-md-8">
                        <div class="contact-us">
                            <div class="footer_logo">
                                <img src="{{ $footer_logo }}" >
                            </div>

                            <ul class="list-inline contact-info flex-column-start-start gap-5">
                                    <li class="flex-row-start-center gap-10">
                                        <img src="{{ asset('storage')."/media/footer-adress-icon.svg" }}">
                                        <span class="color-white font-16-20-normal">
                                            {{setting('store_address_1')}}, {{$shop_country}} {{$shop_city}}
                                        </span>
                                    </li>
                                @if (setting('store_phone') && ! setting('store_phone_hide'))
                                    <li class="flex-row-start-center gap-10">
                                        <img src="{{ asset('storage')."/media/phone-footer-icon.svg" }}">

                                        <div class="contactBlock flex-column-start-start">
                                            <span class="font-16-20-normal color-neutral_grey">{{ trans('storefront::storefront.footer_contacts.phone_title') }}</span>
                                            <a  href="tel:{{clearPhone(setting('store_phone')) }}" class="font-16-20-normal color-white">
                                                <span>{{ substr(setting('store_phone'), 0 , strlen(setting('store_phone')) / 2) }}</span>
                                                <span class="d-none">JUNK LOAD</span>
                                                <span>{{ substr(setting('store_phone'), strlen(setting('store_phone')) / 2) }}</span>
                                            </a>
                                        </div>
                                    </li>
                                @endif

                                @if (setting('store_email') && ! setting('store_email_hide'))
                                    <li class="flex-row-start-center gap-10">
                                        <img src="{{ asset('storage')."/media/email-footer-icon.svg" }}">
                                        <div class="contactBlock flex-column-start-start">
                                            <span class="font-16-20-normal color-neutral_grey">{{ trans('storefront::storefront.footer_contacts.email_title') }}</span>
                                            <a href="mailto:user@email.com" class="font-16-20-normal color-white">
                                                <span>{{ substr(setting('store_email'), 0 , strlen(setting('store_email')) / 2) }}</span>
                                                <span class="d-none">JUNK LOAD</span>
                                                <span>{{ substr(setting('store_email'), strlen(setting('store_email')) / 2) }}</span>
                                            </a>
                                        </div>
                                    </li>
                                @endif

                                @if (setting('storefront_address'))
                                    <li>
                                        <i class="las la-map"></i>

                                        <span>
                                            <pre>{{ setting('storefront_address') }}</pre>
                                        </span>
                                    </li>
                                @endif
                                    <li class="flex-row-start-center gap-10">
                                        @if(setting('storefront_facebook_link')!='')
                                            <a href="{{setting('storefront_facebook_link')}}">
                                                <img src="{{ asset('storage')."/media/fb-footer-icon.svg" }}">
                                            </a>
                                        @endif
                                        @if(setting('storefront_facebook_link')!='')
                                            <a href="{{setting('storefront_facebook_link')}}">
                                                <img src="{{ asset('storage')."/media/social_network_instagram-icon.svg" }}">
                                            </a>
                                        @endif
                                    </li>
                            </ul>
                        </div>
                    </div>

{{--                    <div class="col-lg-3 col-md-5">--}}
{{--                        <div class="footer-links">--}}
{{--                            <h4 class="title">{{ trans('storefront::layout.my_account') }}</h4>--}}

{{--                            <ul class="list-inline">--}}
{{--                                <li>--}}
{{--                                    <a href="{{ route('account.dashboard.index') }}">--}}
{{--                                        {{ trans('storefront::account.pages.dashboard') }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <a href="{{ route('account.orders.index') }}">--}}
{{--                                        {{ trans('storefront::account.pages.my_orders') }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <a href="{{ route('account.reviews.index') }}">--}}
{{--                                        {{ trans('storefront::account.pages.my_reviews') }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                                <li>--}}
{{--                                    <a href="{{ route('account.profile.edit') }}">--}}
{{--                                        {{ trans('storefront::account.pages.my_profile') }}--}}
{{--                                    </a>--}}
{{--                                </li>--}}

{{--                                @auth--}}
{{--                                    <li>--}}
{{--                                        <a href="{{ route('logout') }}">--}}
{{--                                            {{ trans('storefront::account.pages.logout') }}--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                @endauth--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    @if ($footerMenuOne->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title font-18-20-normal color-neutral_grey">{{ setting('storefront_footer_menu_one_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuOne as $menuItem)
                                        <li>
                                            <a class="font-16-24-normal color-white" href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($footerMenuTwo->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title font-18-20-normal color-neutral_grey">{{ setting('storefront_footer_menu_two_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuTwo as $menuItem)
                                        <li>
                                            <a class="font-16-24-normal color-white" href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    @if ($footerMenuTree->isNotEmpty())
                        <div class="col-lg-3 col-md-5">
                            <div class="footer-links">
                                <h4 class="title font-18-20-normal color-neutral_grey">{{ setting('storefront_footer_menu_tree_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuTree as $menuItem)
                                        <li>
                                            <a class="font-16-24-normal color-white" href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

{{--                    @if ($footerTags->isNotEmpty())--}}
{{--                        <div class="col-lg-4 col-md-7">--}}
{{--                            <div class="footer-links footer-tags">--}}
{{--                                <h4 class="title font-18-20-normal color-neutral_grey">{{ trans('storefront::layout.tags') }}</h4>--}}

{{--                                <ul class="list-inline">--}}
{{--                                    @foreach ($footerTags as $footerTag)--}}
{{--                                        <li>--}}
{{--                                            <a href="{{ $footerTag->url() }}">--}}
{{--                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                    <path d="M4.16989 15.3L8.69989 19.83C10.5599 21.69 13.5799 21.69 15.4499 19.83L19.8399 15.44C21.6999 13.58 21.6999 10.56 19.8399 8.69005L15.2999 4.17005C14.3499 3.22005 13.0399 2.71005 11.6999 2.78005L6.69989 3.02005C4.69989 3.11005 3.10989 4.70005 3.00989 6.69005L2.76989 11.69C2.70989 13.04 3.21989 14.35 4.16989 15.3Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                                                    <path d="M9.5 12C10.8807 12 12 10.8807 12 9.5C12 8.11929 10.8807 7 9.5 7C8.11929 7 7 8.11929 7 9.5C7 10.8807 8.11929 12 9.5 12Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round"/>--}}
{{--                                                </svg>--}}

{{--                                                {{ $footerTag->name }}--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </div>
            </div>

            <div class="footer-bottom flex-column-start-start gap-10">
                @if(!empty($locales))
                    <div class="flex-column-start-start gap-5">
                        <div class="font-16-20-normal color-neutral_grey">{{ trans('storefront::storefront.footer_locales_title') }}</div>
                        <div class="flex-row-start-start gap-10">
                            @foreach($locales as $locale => $language)
                                <a href="{{ localized_url($locale) }}">
                                    <img src="{{ $language['icon'] }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <div class="row align-items-center">
                    <div class="footer-text color-white font-14-16-normal">
                        {!! $copyrightText !!}
                    </div>

               </div>
            </div>
        </div>
    </div>
</footer>


@push('scripts')
    <script type="module">
        $('.store-phone').attr('href', `tel:{{ setting('store_phone') }}`);
        $('.store-email').attr('href', `mailto:{{ setting('store_email') }}`);
    </script>
@endpush
