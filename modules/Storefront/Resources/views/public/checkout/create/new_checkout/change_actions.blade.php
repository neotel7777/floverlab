<div class="white_box_checkout">
    <div class="blockWrap">
        <div class="order-form-title flex-row">
            <span class="order-form-title_span">
                {{ setting('checkout_actions_block_title') }}
                @if(!empty(setting('checkout_actions_block_title_hint')))
                <div class="div_tooltip">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3333 7.5C11.1827 7.5 10.25 8.43274 10.25 9.58333V9.75H8.75V9.58333C8.75 7.60431 10.3543 6 12.3333 6H13.25C15.114 6 16.625 7.51104 16.625 9.375C16.625 11.239 15.114 12.75 13.25 12.75V15H11.75V11.25H13.25C14.2855 11.25 15.125 10.4105 15.125 9.375C15.125 8.33947 14.2855 7.5 13.25 7.5H12.3333Z" fill="#8E979C"/>
                        <path d="M12.5 18.75C13.1213 18.75 13.625 18.2463 13.625 17.625C13.625 17.0037 13.1213 16.5 12.5 16.5C11.8787 16.5 11.375 17.0037 11.375 17.625C11.375 18.2463 11.8787 18.75 12.5 18.75Z" fill="#8E979C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.20101 6.70101 1.5 12.5 1.5C18.299 1.5 23 6.20101 23 12C23 17.799 18.299 22.5 12.5 22.5C6.70101 22.5 2 17.799 2 12ZM12.5 3C7.52944 3 3.5 7.02944 3.5 12C3.5 16.9706 7.52944 21 12.5 21C17.4706 21 21.5 16.9706 21.5 12C21.5 7.02944 17.4706 3 12.5 3Z" fill="#8E979C"/>
                    </svg>
                    <div class="tooltip_text">{{ setting('checkout_actions_block_title_hint') }}</div>
                </div>
                @endif
            </span>
        </div>
        <div class="form_wrapper  flex-row-start-start">

            <div class="hint-wrap flex-column-start-start">
                <div class="block_data select-custom flex-row-start-center">
                    <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.9669 15.8731L20.0154 20.0074C19.88 20.5898 19.3673 21 18.7644 21C8.4163 21 0 12.5837 0 2.23559C0 1.63267 0.410151 1.11998 0.992566 0.984627L5.12689 0.0330767C5.72981 -0.106375 6.34504 0.20534 6.59523 0.77545L8.50243 5.22559C8.72391 5.75058 8.57626 6.36171 8.1333 6.71854L5.92668 8.49039C7.3212 11.3286 9.63035 13.6378 12.4686 15.0323L14.2774 12.8257C14.6342 12.3827 15.2494 12.231 15.7744 12.4566L20.2246 14.3638C20.7577 14.6509 21.1064 15.2743 20.9669 15.8731Z" fill="#8E979C"/>
                    </svg>
                    <div class="data-box flex-column-start-start">
                        <label class="select-custom__placeholder color-neutral_grey font-14-16-normal">
                            {{ setting('checkout_actions_selector_title')  }}
                        </label>
                        <input placeholder="" readonly="readonly" required="required" class="select_variant autocomlete_input_action" autocomplete="delusion"
                               @click="showAction" refs="autocomlete_input">
                    </div>
                    <div class="autocomplete-suggestions"
                         :class="showActionsStatus ? 'active' : ''">

                        <div class="autocomplete-suggestion" v-for="(item,key,index) in actions"
                             :class="choosenAction === key ? 'active' : ''"
                             :key="key"
                             :index="index"
                             v-html="item.title"
                             @click="checkAction(key)">

                        </div>
                    </div>
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" v-if="showHintStatus">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5001 8.13204L4.90977 14.7223L3.9375 13.75L11.5001 6.1875L19.0625 13.7498L18.0902 14.7221L11.5001 8.13204Z" fill="#8E979C"/>
                    </svg>
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg" v-else>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.5001 13.868L4.90977 7.27775L3.9375 8.25002L11.5001 15.8125L19.0625 8.25019L18.0902 7.27792L11.5001 13.868Z" fill="#8E979C"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="form-input-wrap full_row_input flex-row-start-center">
            <label class="form-check">
                <input id="sendMePhotoBeforeDelivery" type="checkbox" class="hidden"
                       @click="changeCheckbox('sendMePhotoBeforeDelivery')"
                >
                <label for="sendMePhotoBeforeDelivery" class="form-check__label">{{ trans('storefront::checkout.take_photo_before_delivery') }}</label>
            </label>
        </div>
    </div>
</div>
