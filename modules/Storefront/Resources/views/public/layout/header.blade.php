<section class="sectionWrap header header-wrap">
    <div class="logoWrap flex-row-between-center">
        <div class="Logo">
        <a href="{{ route('home') }}" class="header-logo">

            @if (is_null($logo))
                <h3>{{ setting('store_name') }}</h3>
            @else
                <img src="{{ $logo }}" alt="Logo">
            @endif
        </a>
        </div>
        <div class="menuWrap">
            @include('storefront::public.layout.navigation.top_menu', ['menus'=>$primaryMenu,'type' => 'primary_menu'])
        </div>
        <ul class="serviceWrap flex-row-between-center">
                <li>
                    <i class="locale_flag"><img src="{{ $current_locale['icon'] }}"></i>

                    <select class="custom-select-option arrow-black" onchange="location = this.value">
                        @foreach ($locales as $locale => $language)
                            <option data-icon="{{ $language['icon'] }}" value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                {{ $language['name'] }}
                            </option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <div class="stateWrap">
                        <img src="/storage/media/clock-icon.png">
                        <span class="title font-14-16-normal color-black">{{trans('order::orders.order_status')}}</span>
                    </div>
                </li>

            <user-login :is-auth="{{ (auth()->id()) ? 1 : 0  }}"
                            :user="{{ (auth()->check()) ? auth()->user() : json_encode([]) }}"></user-login>
        </ul>
    </div>
</section>
<section class="sectionWrap headerSearch bk-color-dark-green">
    <div class="searchWrap flex-row-between-center ">
        <div class="catalogMenu bk-color-white">
            <div class="catalog_button flex-row-start-center" data-state="closed">
                <div class="burger hor ">
                    <p class="bk-color-dark-green burger_hor"></p>
                    <p class="bk-color-dark-green burger_hor"></p>
                    <p class="bk-color-dark-green burger_hor"></p>
                </div>
                <div class="burger Active  ">
                    <p class="bk-color-dark-green burger_degl"></p>
                    <p class="bk-color-dark-green burger_degr"></p>
                </div>
                <div class="catalogTitle font-12-14-500 color-black">
                    {{trans("category::categories.catalog")}}
                </div>
            </div>
        </div>
        <div class="DeliveryCity ">
            <localites_delivery :data='@json($cities)'>

            </localites_delivery>
        </div>
        <header-search-new
            :categories="{{ $categories }}"
            :most-searched-keywords="{{ $mostSearchedKeywords }}"
            is-most-searched-keywords-enabled="{{ setting('storefront_most_searched_keywords_enabled') }}"
            initial-query="{{ request('query') }}"
            initial-category="{{ request('category') }}"
        >
        </header-search-new>
        <div class="connectWrap">
            <div class="connectPhone  flex-row-start-end">
                <div class="infoWrapPhone flex-column-start-start">
                    <div class="title font-14-16-normal color-neutral-500">
                        {{trans('storefront::contact.call_us')}}
                    </div>
                    <div class="phone  font-16-20-normal color-white" >{{setting('store_phone')}}</div>
                </div>
                <img src="/storage/media/drop_down.png">
            </div>
            <div class="popupContact bk-color-white">
                <div class="popwrap flex-column-start-start">
                    <div class="phoneblock flex-column-start-start">
                        <div class="title font-14-16-normal color-neutral">{{trans('storefront::contact.call_us')}}</div>
                        <a class="data font-16-20-500 color-black" href="tel:{{clearPhone(setting('store_phone'))}}">{{setting('store_phone')}}</a>
                    </div>
                    <div class="subtitle font-16-20-normal color-ligth-grey">{{trans('storefront::layout.Write_at_chat')}}</div>
                    @if(setting('storefront_whatsapp_link')!='')
                    <div class="socialBlock flex-row-start-center">
                        <img src="/storage/media/whatsapp-icon.svg">
                        <div class="socialInfo flex-column-start-start">
                            <div class="title font-14-16-normal color-grey">
                                {{trans('storefront::layout.whatsapp')}}
                            </div>
                            <a class="data font-16-20-normal color-black" href="{{setting('storefront_whatsapp_link')}}">
                                {{setting('store_phone')}}
                            </a>
                        </div>
                    </div>
                    @endif
                    @if(setting('storefront_viber_link')!='')
                    <div class="socialBlock flex-row-start-center">
                        <img src="/storage/media/viber-icon.svg">
                        <div class="socialInfo flex-column-start-start">
                            <div class="title font-14-16-normal color-grey">
                                {{trans('storefront::layout.viber')}}
                            </div>
                            <a class="data font-16-20-normal color-black" href="{{setting('storefront_viber_link')}}">
                                {{setting('store_phone')}}
                            </a>

                        </div>
                    </div>
                    @endif
                    @if(setting('storefront_telegram_link')!='')
                    <div class="socialBlock flex-row-start-center">
                        <img src="/storage/media/telegram-icon.svg">
                        <div class="socialInfo flex-column-start-start">
                            <div class="title font-14-16-normal color-grey">
                                {{trans('storefront::layout.telegram')}}
                            </div>
                            <a class="data font-16-20-normal color-black" href="tg://resolve?domain={{setting('storefront_telegram_link')}}">
                                {{setting('storefront_telegram_link')}}
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="socialBlock flex-row-start-center">
                        <img src="/storage/media/call-icon.svg">
                        <div class="socialInfo flex-column-start-start">
                            <div class="bigtitle font-16-20-500 color-black">
                                {{trans('storefront::attributes.storefront_call_back')}}
                            </div>
                        </div>
                    </div>
                    <div class="subtitle  font-16-20-normal color-ligth-grey">{{trans('storefront::layout.adress')}}</div>
                    <div class="adressBlock font-16-20-500 color-black">{{setting('store_address_1')}}, {{$shop_country}} {{$shop_city}}</div>
                </div>
            </div>
        </div>
        <div class="infoWrap flex-row-between-center">
            <a href="{{ route('account.wishlist.index') }}" class="header-column-right-item header-wishlist">
                <div class="icon-wrap">
                    <img src="/storage/media/heart-icon.png">
                    <div class="count bk-color-green color-white flex-column-center-center font-12-11-normal" v-text="wishlistCount">{{ count($wishlist) }}</div>
                </div>

            </a>
            <div class="header-column-right-item header-cart">
                <div class="icon-wrap">
                    <img src="/storage/media/cart-icon.png">
                    <div class="count  bk-color-green color-white flex-column-center-center font-12-11-normal" v-text="cart.quantity">{{ $cart->toArray()['quantity'] }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="overlay burgerOverlay" style="display: none"></div>
<div class="burgerCatalogMenu bk-color-light" style="display: none">
    <div class="sectionWrap flex-row-start-start  bk-color-white">
        <div class="mainCatalogMenu bk-color-light">
            <ul class="mainMenu flex-column">
                @foreach($burger_menu as $category)
                <li class="menu-item flex-row-start-center" data-group="{{$category->slug}}_{{$category->id}}">
                    <a class="color-menu font-18-24-normal" href="{{ route("categories.products.index",$category->slug) }}">{{getTranslation($category,'name',$locale)}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="submenuWrap bk-color-white">
            @foreach($burger_menu as $category)
                @if(count($category->items) > 0)
                    <ul class="subMenu" id="{{$category->slug}}_{{$category->id}}">

                            <li class="submenu-item flex-row-start-center">
                                <a class="color-menu font-20-26-500" href="{{ route("categories.products.index",$category->slug) }}">{{getTranslation($category,'name',$locale)}}</a>
                            </li>

                        @foreach($category->items as $subcategory)
                            <li class="submenu-item flex-row-start-center">
                                <a class="color-menu font-18-24-normal" href="{{ route("categories.products.index",$subcategory->slug) }}">{{getTranslation($subcategory,'name',$locale)}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
</div>
