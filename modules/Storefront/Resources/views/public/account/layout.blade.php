@extends('storefront::public.layout')

@section('breadcrumb')
    @if (request()->routeIs('account.dashboard.index'))
        <li class="active">{{ trans('storefront::account.pages.my_account') }}</li>
    @else
        <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.pages.my_account') }}</a></li>
    @endif

    @yield('account_breadcrumb')
@endsection

@section('content')
    <section class="account-wrap">
        <div class="sectionWrap">
            <div class="account-wrap-inner">
                <div class="account-left">
                    <ul class="list-inline account-sidebar flex-column-start-start">
                        <li class="{{ request()->routeIs('account.dashboard.index') ? 'active' : '' }}">
                            <a href="{{ route('account.dashboard.index') }}">
                                <i class="las la-tachometer-alt"></i>
                                {{ trans('storefront::account.pages.dashboard') }}
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('account.profile.edit') ? 'active' : '' }}">
                            <a href="{{ route('account.profile.edit') }}">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 4C11 5.65685 9.65685 7 8 7C6.34315 7 5 5.65685 5 4C5 2.34315 6.34315 1 8 1C9.65685 1 11 2.34315 11 4Z" fill="#499777"/>
                                    <path d="M1 15H15C15 11.134 11.866 8 8 8C4.13401 8 1 11.134 1 15Z" fill="#499777"/>
                                </svg>
                                {{ trans('storefront::account.pages.my_profile') }}
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('account.orders.index') ? 'active' : '' }}">
                            <a href="{{ route('account.orders.index') }}">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.00098 1C6.62026 1 5.50098 2.11929 5.50098 3.5V4H2.95008L1.74191 12.7257C1.57546 13.9279 2.50938 15 3.72301 15H12.279C13.4926 15 14.4266 13.9279 14.2601 12.7257L13.0519 4H10.501V3.5C10.501 2.11929 9.38169 1 8.00098 1ZM9.50098 4V3.5C9.50098 2.67157 8.8294 2 8.00098 2C7.17255 2 6.50098 2.67157 6.50098 3.5V4H9.50098Z" fill="#8E979C"/>
                                </svg>
                                {{ trans('storefront::account.pages.my_orders') }}
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('account.wishlist.index') ? 'active' : '' }}">
                            <a href="{{ route('account.wishlist.index') }}">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8 2.31001C6.26294 1.07951 3.85475 1.25096 2.30471 2.82436C0.565098 4.59017 0.565098 7.45311 2.30471 9.21892L7.64381 14.6384C7.83966 14.8372 8.16034 14.8372 8.35619 14.6384L13.6953 9.21892C15.4349 7.45311 15.4349 4.59017 13.6953 2.82436C12.1452 1.25096 9.73706 1.07951 8 2.31001Z" fill="#8E979C"/>
                                </svg>
                                {{ trans('storefront::account.pages.my_wishlist') }}
                                <span class="count" v-text="wishlistCount"></span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('account.reviews.index') ? 'active' : '' }}">
                            <a href="{{ route('account.reviews.index') }}">
                                <i class="las la-comment"></i>
                                {{ trans('storefront::account.pages.my_reviews') }}
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('account.addresses.index') ? 'active' : '' }}">
                            <a href="{{ route('account.addresses.index') }}">
                                <i class="las la-address-book"></i>
                                {{ trans('storefront::account.pages.my_addresses') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                <i class="las la-sign-out-alt"></i>
                                {{ trans('storefront::account.pages.logout') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="account-right">
                    <div class="panel-wrap">
                        @yield('panel')
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
