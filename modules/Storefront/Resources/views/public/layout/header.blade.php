<section class="sectionWrap header header-wrap">
    <div class="logoWrap">
        <div class="Logo">
        <a href="{{ route('home') }}" class="header-logo">

            @if (is_null($data['logo']))
                <h3>{{ setting('store_name') }}</h3>
            @else
                <img src="{{ $data['logo'] }}" alt="Logo">
            @endif
        </a>
        </div>
        <div class="menuWrap">
            @include('storefront::public.layout.navigation.top_menu', ['menus'=>$data['menu'],'type' => 'primary_menu'])
        </div>
        <ul class="serviceWrap">
                <li>
                    <i class="locale_flag"><img src="{{ $data['current_locale']['icon'] }}"></i>

                    <select class="custom-select-option arrow-black" onchange="location = this.value">
                        @foreach ($data['locales'] as $locale => $language)
                            <option data-icon="{{ $language['icon'] }}" value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                {{ $language['name'] }}
                            </option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <div class="stateWrap">
                        <img src="/storage/media/clock-icon.png">
                        <span class="title">{{trans('order::orders.order_status')}}</span>
                    </div>
                </li>
                @auth
                    <li class="top-nav-account">
                        <a href="{{ route('account.dashboard.index') }}">
                            <i class="las la-user"></i>
                            {{ trans('storefront::layout.account') }}
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="las la-sign-in-alt"></i>
                            {{ trans('storefront::layout.login') }}
                        </a>
                    </li>
                @endauth
        </ul>
    </div>
</section>
<section class="sectionWrap headerSearch">
    <div class="searchWrap">
        <div class="catalogMenu">
            <div class="catalog_button" data-state="closed">
                <div class="burger">
                    <p></p>
                    <p></p>
                    <p></p>
                </div>
                <div class="burger Active">
                    <p></p>
                    <p></p>
                </div>
                <div class="catalogTitle">
                    {{trans("category::categories.catalog")}}
                </div>
            </div>
        </div>
        <div class="DeliveryCity">
            <div class="devWrapper">
                <img src="/storage/media/SityDeliverIcon.png">
                <div class="devDescription">
                    <div class="title">{{trans("order::delivery.delivery_sity")}}</div>
                    <div class="city">{{trans("order::delivery.default_sity")}}</div>
                </div>
            </div>
        </div>
        <div class="searchingWrap">
                <form class="searchBlock">
                    <button type="submit">
                        <img src="/storage/media/search.png">
                    </button>
                    <input name="search" type="text" value="{{ $data['search'] }}" placeholder="{{trans("storefront::products.search_results_for")}}">
                </form>
        </div>
        <div class="connectWrap">
            <div class="connectPhone">
                <div class="infoWrapPhone">
                    <div class="title">
                        {{trans('storefront::contact.call_us')}}
                    </div>
                    <div class="phone" >{{setting('store_phone')}}</div>
                </div>
                <img src="/storage/media/drop_down.png">
            </div>
            <div class="popupContact">
                <div class="popwrap">
                    <div class="phoneblock">
                        <div class="title">{{trans('storefront::contact.call_us')}}</div>
                        <a class="data" href="tel:{{clearPhone(setting('store_phone'))}}">{{setting('store_phone')}}</a>
                    </div>
                    <div class="subtitle">{{trans('storefront::layout.Write_at_chat')}}</div>
                    @if(setting('storefront_whatsapp_link')!='')
                    <div class="socialBlock">
                        <img src="/storage/media/whatsapp-icon.svg">
                        <div class="socialInfo">
                            <div class="title">
                                {{trans('storefront::layout.whatsapp')}}
                            </div>
                            <a class="data" href="{{setting('storefront_whatsapp_link')}}">
                                {{setting('store_phone')}}
                            </a>
                        </div>
                    </div>
                    @endif
                    @if(setting('storefront_viber_link')!='')
                    <div class="socialBlock">
                        <img src="/storage/media/viber-icon.svg">
                        <div class="socialInfo">
                            <div class="title">
                                {{trans('storefront::layout.viber')}}
                            </div>
                            <a class="data" href="{{setting('storefront_viber_link')}}">
                                {{setting('store_phone')}}
                            </a>

                        </div>
                    </div>
                    @endif
                    @if(setting('storefront_telegram_link')!='')
                    <div class="socialBlock">
                        <img src="/storage/media/telegram-icon.svg">
                        <div class="socialInfo">
                            <div class="title">
                                {{trans('storefront::layout.telegram')}}
                            </div>
                            <a class="data" href="tg://resolve?domain={{setting('storefront_telegram_link')}}">
                                {{setting('storefront_telegram_link')}}
                            </a>
                        </div>
                    </div>
                    @endif
                    <div class="socialBlock">
                        <img src="/storage/media/call-icon.svg">
                        <div class="socialInfo">
                            <div class="bigtitle">
                                {{trans('storefront::attributes.storefront_call_back')}}
                            </div>
                        </div>
                    </div>
                    <div class="subtitle">{{trans('storefront::layout.adress')}}</div>
                    <div class="adressBlock">{{setting('store_address_1')}}, {{$data['shop_country']}} {{$data['shop_city']}}</div>
                </div>
            </div>
        </div>
        <div class="infoWrap">
            <a href="{{ route('account.wishlist.index') }}" class="header-column-right-item header-wishlist">
                <div class="icon-wrap">
                    <img src="/storage/media/heart-icon.png">
                    <div class="count" v-text="wishlistCount">{{ count($wishlist) }}</div>
                </div>

            </a>
            <div class="header-column-right-item header-cart">
                <div class="icon-wrap">
                    <img src="/storage/media/cart-icon.png">
                    <div class="count" v-text="cart.quantity">{{ $cart->toArray()['quantity'] }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="burgerCatalogMenu" style="display: none">
    <div class="sectionWrap">
        <div class="mainCatalogMenu">
            <ul class="mainMenu">
                @foreach($data['burger_menu'] as $category)
                <li class="menu-item" data-group="{{$category->slug}}_{{$category->id}}">
                    <a href="{{ route("categories.products.index",$category->slug) }}">{{getTranslation($category,'name',$data['locale'])}}</a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="submenuWrap">
            @foreach($data['burger_menu'] as $category)
                @if(!empty($category->items))
                    <ul class="subMenu" id="{{$category->slug}}_{{$category->id}}">
                        @foreach($category->items as $subcategory)
                            <li class="submenu-item">
                                <a href="{{ route("categories.products.index",$subcategory->slug) }}">{{getTranslation($subcategory,'name',$data['locale'])}}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
</div>
