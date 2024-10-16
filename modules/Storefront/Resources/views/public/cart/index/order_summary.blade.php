
<aside class="order-summary-wrap" v-if="cartIsNotEmpty">
    <div class="order-summary white_box">
        <div class="order-summary-top">
            <h3 class="order-title color-black" >{{ trans('storefront::cart.your_order') }}</h3>
        </div>

        <div class="order-summary-middle" :class="{ loading: loadingOrderSummary }">
            <ul class="list-inline order-summary-list">
                <li>
                    <label v-html="getCountProductsTitle('{{trans('storefront::cart.price_items')}}')"></label>

                    <span v-text="cart.subTotal.inCurrentCurrency.formatted"></span>
                </li>
                <li>
                    <label>{{ trans('storefront::cart.delivery') }}</label>
                    <span v-text="'{{ trans('storefront::cart.free') }}'"></span>
                </li>
            </ul>

            <div class="order-summary-total">
                <label>{{ trans('storefront::cart.total') }}</label>
                <span class="total-price" v-html="cart.total.inCurrentCurrency.formatted"></span>
            </div>
        </div>

        <div class="order-summary-bottom">
            <div
                class="btn btn-primary btn-proceed-to-checkout"
                @click="verifyCheckboxex('{{ route('checkout.create') }}')"
            >
                {{ trans('storefront::cart.proceed_to_checkout') }}
            </div>
            <label class="form-check">
                <input id="agri1" type="checkbox" class="hidden">
                <label for="agri1" @click="click_accord_processing">
                    {{ trans('storefront::cart.agri_personal_1') }}
                    <a class="rb-form-check__label-link" href="{{ getPageUrl(setting('storefront_personal_data_page')) }}" target="_blank">
                        {{ trans('storefront::cart.agri_personal_2') }}
                    </a>
                </label>
            </label>
            <label class="form-check">
                <input id="agri2" type="checkbox" class="hidden">
                <label for="agri2"  @click="click_accord_data">
                    {{ trans('storefront::cart.accord_1') }}
                    <a class="rb-form-check__label-link" href="{{ getPageUrl(setting('storefront_personal_data_page')) }}" target="_blank">
                        {{ trans('storefront::cart.accord_2') }}
                    </a>
                    <a class="rb-form-check__label-link" href="{{ getPageUrl(setting('storefront_terms_page')) }}" target="_blank">
                        {{ trans('storefront::cart.accord_2') }}
                    </a>
                    <a class="rb-form-check__label-link" href="{{ getPageUrl(setting('storefront_privacy_page')) }}" target="_blank">
                        {{ trans('storefront::cart.accord_3') }}
                    </a>
                </label>
            </label>

        </div>
    </div>
    <div class="popup_error_agry_personal"
        :class="show_processing_popup ? 'active' : ''"
        @click="show_processing_popup = false">
        <div class="content_popup white_box">
            {{ trans('storefront::cart.error_agri_personal') }}
        </div>
    </div>
    <div class="popup_error_agry_data"
         :class="show_data_popup ? 'active' : ''"
         @click="show_data_popup = false">
        <div class="content_popup white_box">
            {{ trans('storefront::cart.error_agry_data') }}
        </div>
    </div>
</aside>
