<div class="white_box_checkout">
    <div class="senderWrap flex-column-start-start">
        <div class="order-form-title flex-row-start-center gap-20">
            <span class="order-form-title_span">{{ trans('storefront::checkout.who_send.sender') }}</span>
            <label class="form-check">
                <input id="myself" type="checkbox" class="myselsf hidden"
                @click="hideRecipientblock"
                >
                <label for="myself" class="form-check__label">{{ trans('storefront::checkout.who_send.sender_checkbox') }}</label>
            </label>
        </div>
        <div class="form_wrapper flex-row-start-start">
            <div class="form-input-wrap">
                <input id="billing_name"  placeholder="{{ trans('storefront::checkout.who_send.name') }} *" class="rb-form-field"
                       :class="hasbillingNameError ? 'haserrors' : ''"
                       @keyup="changeBillingName">
                <div class="errors"
                :class="hasbillingNameError ? 'active' : ''"
                v-if="hasbillingNameError" v-html="getbillingNameError"></div>
            </div>
            <div class="form-input-wrap">
                <input id="billing_phone" type="tel" placeholder="{{ trans('storefront::checkout.who_send.phone_number') }} *" class="rb-form-field"
                       :class="hasbillingPhoneError ? 'haserrors' : ''"
                       @keyup="changeBillingPhone"
                >
                <div class="errors"
                     :class="hasbillingPhoneError ? 'active' : ''"
                     v-if="hasbillingPhoneError" v-html="getbillingPhoneError"></div>
            </div>
            <div class="form-input-wrap">
                <input id="billing_email" type="email" placeholder="{{ trans('storefront::checkout.who_send.email') }} *" class="rb-form-field"
                       :class="hasbillingEmailError ? 'haserrors' : ''"
                       @keyup="changeBillingEmail"
                >
                <div class="errors"
                     :class="hasbillingEmailError ? 'active' : ''"
                     v-if="hasbillingEmailError" v-html="getBillingEmailError"></div>
                <small class="font-12-14-normal color-neutral_grey">{{ trans('storefront::checkout.who_send.email_hint') }}</small>
            </div>
        </div>
    </div>
    <div class="recipientWrap"
        :class="showRecipientblock ? 'active' : ''"
    >
        <div class="order-form-title flex-row">
            <span class="order-form-title_span">
                {{ trans('storefront::checkout.who_send.recipient') }}
            </span>
        </div>
        <div class="form_wrapper  flex-row-start-start">
            <div class="form-input-wrap">
                <input id="shipping_name" placeholder="{{ trans('storefront::checkout.who_send.name') }} *" required="required" class="rb-form-field"
                       :class="hasshippingNameError ? 'haserrors' : ''"
                       @keyup="changeShippingName"
                >
                <div class="errors"
                     :class="hasshippingNameError ? 'active' : ''"
                     v-if="hasshippingNameError" v-html="getshippingNameError"></div>
            </div>
            <div class="form-input-wrap">
                <input id="shipping_phone" placeholder="{{ trans('storefront::checkout.who_send.phone_number') }}" required="required" class="rb-form-field"
                       :class="hasshippingPhoneError ? 'haserrors' : ''"
                       @keyup="changeShippingPhone"
                >
                <div class="errors"
                     :class="hasshippingPhoneError ? 'active' : ''"
                     v-if="hasshippingPhoneError" v-html="getshippingPhoneError"></div>
            </div>
            <div class="hint-wrap flex-column-start-start">
                <div class="block_data select-custom flex-row-start-center">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.9669 15.8731L20.0154 20.0074C19.88 20.5898 19.3673 21 18.7644 21C8.4163 21 0 12.5837 0 2.23559C0 1.63267 0.410151 1.11998 0.992566 0.984627L5.12689 0.0330767C5.72981 -0.106375 6.34504 0.20534 6.59523 0.77545L8.50243 5.22559C8.72391 5.75058 8.57626 6.36171 8.1333 6.71854L5.92668 8.49039C7.3212 11.3286 9.63035 13.6378 12.4686 15.0323L14.2774 12.8257C14.6342 12.3827 15.2494 12.231 15.7744 12.4566L20.2246 14.3638C20.7577 14.6509 21.1064 15.2743 20.9669 15.8731Z" fill="#8E979C"/>
                    </svg>
                    <div class="data-box flex-column-start-start">
                        <label class="select-custom__placeholder color-neutral_grey font-14-16-normal">
                            {{ trans('storefront::checkout.who_send.check_title') }}
                        </label>
                        <input placeholder="" readonly="readonly" required="required" class="select_variant autocomlete_input" autocomplete="delusion"
                        @click="showHint" refs="autocomlete_input">
                    </div>
                    <div class="autocomplete-suggestions"
                        :class="showHintStatus ? 'active' : ''">

                        <div class="autocomplete-suggestion" v-for="(item,key,index) in variants"
                             :class="choosenVariant === key ? 'active' : ''"
                             :key="key"
                             :index="index"
                             :keyindex="key"
                             v-html="item.title"
                            @click="checkVariant(key)">

                        </div>
                    </div>
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="showHintStatus">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5001 8.13204L4.90977 14.7223L3.9375 13.75L11.5001 6.1875L19.0625 13.7498L18.0902 14.7221L11.5001 8.13204Z" fill="#8E979C"/>
                    </svg>
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" v-else>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5001 13.868L4.90977 7.27775L3.9375 8.25002L11.5001 15.8125L19.0625 8.25019L18.0902 7.27792L11.5001 13.868Z" fill="#8E979C"/>
                    </svg>
                </div>
                <div class="block_data order-alert">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 12C1.5 6.20101 6.20101 1.5 12 1.5C17.799 1.5 22.5 6.20101 22.5 12C22.5 17.799 17.799 22.5 12 22.5C6.20101 22.5 1.5 17.799 1.5 12ZM12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3Z" fill="#499777"/>
                        <path d="M13.125 16.125C13.125 16.7463 12.6213 17.25 12 17.25C11.3787 17.25 10.875 16.7463 10.875 16.125C10.875 15.5037 11.3787 15 12 15C12.6213 15 13.125 15.5037 13.125 16.125Z" fill="#499777"/>
                        <path d="M11.25 13.5V6H12.75V13.5H11.25Z" fill="#499777"/>
                    </svg>
                    <div class="showhint" refs="showhintblock"></div>
                </div>
            </div>
        </div>
    </div>
</div>
