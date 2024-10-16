<div class="white_box_checkout">
    <div class="blockWrap">
        <div class="order-form-title flex-row-start-center gap-20">
            <span class="order-form-title_span">{{ trans('storefront::checkout.date_and_time') }}</span>
        </div>
        <div class="form_wrapper flex-row-start-start">
            <div class="form-input-wrap date-picker-wrap full_row">
                <input id="delivery_date"   class="rb-form-field datetime-picker" @change="changedata('delivery_date')"
                       :class="hasDeliveryDateError ? 'haserrors' : ''">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_353_13812)">
                        <rect width="24" height="24" fill="#F3F4F4"/>
                        <path d="M20 2H19V1C19 0.734784 18.8946 0.48043 18.7071 0.292893C18.5196 0.105357 18.2652 0 18 0C17.7348 0 17.4804 0.105357 17.2929 0.292893C17.1054 0.48043 17 0.734784 17 1V2H7V1C7 0.734784 6.89464 0.48043 6.70711 0.292893C6.51957 0.105357 6.26522 0 6 0C5.73478 0 5.48043 0.105357 5.29289 0.292893C5.10536 0.48043 5 0.734784 5 1V2H4C2.93913 2 1.92172 2.42143 1.17157 3.17157C0.421427 3.92172 0 4.93913 0 6L0 20C0 21.0609 0.421427 22.0783 1.17157 22.8284C1.92172 23.5786 2.93913 24 4 24H20C21.0609 24 22.0783 23.5786 22.8284 22.8284C23.5786 22.0783 24 21.0609 24 20V6C24 4.93913 23.5786 3.92172 22.8284 3.17157C22.0783 2.42143 21.0609 2 20 2ZM22 20C22 20.5304 21.7893 21.0391 21.4142 21.4142C21.0391 21.7893 20.5304 22 20 22H4C3.46957 22 2.96086 21.7893 2.58579 21.4142C2.21071 21.0391 2 20.5304 2 20V6C2 5.46957 2.21071 4.96086 2.58579 4.58579C2.96086 4.21071 3.46957 4 4 4H5V5C5 5.26522 5.10536 5.51957 5.29289 5.70711C5.48043 5.89464 5.73478 6 6 6C6.26522 6 6.51957 5.89464 6.70711 5.70711C6.89464 5.51957 7 5.26522 7 5V4H17V5C17 5.26522 17.1054 5.51957 17.2929 5.70711C17.4804 5.89464 17.7348 6 18 6C18.2652 6 18.5196 5.89464 18.7071 5.70711C18.8946 5.51957 19 5.26522 19 5V4H20C20.5304 4 21.0391 4.21071 21.4142 4.58579C21.7893 4.96086 22 5.46957 22 6V20Z" fill="#B8BDC0"/>
                        <path d="M19 7H5C4.73478 7 4.48043 7.10536 4.29289 7.29289C4.10536 7.48043 4 7.73478 4 8C4 8.26522 4.10536 8.51957 4.29289 8.70711C4.48043 8.89464 4.73478 9 5 9H19C19.2652 9 19.5196 8.89464 19.7071 8.70711C19.8946 8.51957 20 8.26522 20 8C20 7.73478 19.8946 7.48043 19.7071 7.29289C19.5196 7.10536 19.2652 7 19 7Z" fill="#B8BDC0"/>
                        <path d="M7 12H5C4.73478 12 4.48043 12.1054 4.29289 12.2929C4.10536 12.4804 4 12.7348 4 13C4 13.2652 4.10536 13.5196 4.29289 13.7071C4.48043 13.8946 4.73478 14 5 14H7C7.26522 14 7.51957 13.8946 7.70711 13.7071C7.89464 13.5196 8 13.2652 8 13C8 12.7348 7.89464 12.4804 7.70711 12.2929C7.51957 12.1054 7.26522 12 7 12Z" fill="#B8BDC0"/>
                        <path d="M7 17H5C4.73478 17 4.48043 17.1054 4.29289 17.2929C4.10536 17.4804 4 17.7348 4 18C4 18.2652 4.10536 18.5196 4.29289 18.7071C4.48043 18.8946 4.73478 19 5 19H7C7.26522 19 7.51957 18.8946 7.70711 18.7071C7.89464 18.5196 8 18.2652 8 18C8 17.7348 7.89464 17.4804 7.70711 17.2929C7.51957 17.1054 7.26522 17 7 17Z" fill="#B8BDC0"/>
                        <path d="M13 12H11C10.7348 12 10.4804 12.1054 10.2929 12.2929C10.1054 12.4804 10 12.7348 10 13C10 13.2652 10.1054 13.5196 10.2929 13.7071C10.4804 13.8946 10.7348 14 11 14H13C13.2652 14 13.5196 13.8946 13.7071 13.7071C13.8946 13.5196 14 13.2652 14 13C14 12.7348 13.8946 12.4804 13.7071 12.2929C13.5196 12.1054 13.2652 12 13 12Z" fill="#B8BDC0"/>
                        <path d="M13 17H11C10.7348 17 10.4804 17.1054 10.2929 17.2929C10.1054 17.4804 10 17.7348 10 18C10 18.2652 10.1054 18.5196 10.2929 18.7071C10.4804 18.8946 10.7348 19 11 19H13C13.2652 19 13.5196 18.8946 13.7071 18.7071C13.8946 18.5196 14 18.2652 14 18C14 17.7348 13.8946 17.4804 13.7071 17.2929C13.5196 17.1054 13.2652 17 13 17Z" fill="#B8BDC0"/>
                        <path d="M19 12H17C16.7348 12 16.4804 12.1054 16.2929 12.2929C16.1054 12.4804 16 12.7348 16 13C16 13.2652 16.1054 13.5196 16.2929 13.7071C16.4804 13.8946 16.7348 14 17 14H19C19.2652 14 19.5196 13.8946 19.7071 13.7071C19.8946 13.5196 20 13.2652 20 13C20 12.7348 19.8946 12.4804 19.7071 12.2929C19.5196 12.1054 19.2652 12 19 12Z" fill="#B8BDC0"/>
                        <path d="M19 17H17C16.7348 17 16.4804 17.1054 16.2929 17.2929C16.1054 17.4804 16 17.7348 16 18C16 18.2652 16.1054 18.5196 16.2929 18.7071C16.4804 18.8946 16.7348 19 17 19H19C19.2652 19 19.5196 18.8946 19.7071 18.7071C19.8946 18.5196 20 18.2652 20 18C20 17.7348 19.8946 17.4804 19.7071 17.2929C19.5196 17.1054 19.2652 17 19 17Z" fill="#B8BDC0"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_353_13812">
                            <rect width="24" height="24" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
                <div class="errors"
                           :class="hasDeliveryDateError ? 'active' : ''"
                           v-if="hasDeliveryDateError" v-html="getDeliveryDateError"></div>
            </div>
            <div class="form-input-wrap">
                <input name="delivery_time_from"  class="rb-form-field time-from time_fields"

                       type="text"
                       id="time-from"
                       :value="showTimeFrom"
                       @change="updateTimeRange($event.target.value, null)"
                       ref="timeFrom">
                <div class="fakeTimeinput" v-html="from + ' ' + showTimeFrom"></div>
            </div>
            <div class="form-input-wrap">
                <input name="delivery_time_to"  class="rb-form-field time-to  time_fields"
                       type="text"
                       id="time-to"
                       :value="showTimeTo"
                       @change="updateTimeRange(null,$event.target.value)"
                       ref="timeTo">
                <div class="fakeTimeinput" v-html="to + ' ' + showTimeTo"></div>
            </div>
            <div class="timeRanger" ref="timeRanger"></div>
        </div>
    </div>
    <div class="blockWrap">
        <div class="order-form-title flex-row-start-center gap-20">
            <span class="order-form-title_span">{{ trans('storefront::checkout.address') }}</span>
        </div>
        <div class="form_wrapper flex-row-start-start">
            <div class="form-input-wrap full_row_input">
                <input id="address_1" class="rb-form-field"
                       :class="hasBillindAdressError ? 'haserrors' : ''"
                       placeholder="{{ trans('storefront::checkout.address_placeholder') }}"
                       v-html="form.delivery_adress" @keyup="changebilling('address_1')">
                <div class="errors"
                :class="hasBillindAdressError ? 'active' : ''"
                v-if="hasBillindAdressError" v-html="getBillingAdressError"></div>
            </div>
            <div class="form-input-wrap full_row_textarea">
                <textarea rows="6" id="delivery_comment" class="rb-form-field"
                          placeholder="{{ trans('storefront::checkout.comment_placeholder') }}"
                       v-html="form.delivery_comment" @keyup="changedata('delivery_comment')"></textarea>
            </div>
            <div class="form-input-wrap full_row_input flex-row-start-center">
                <label class="form-check">
                    <input id="takePhotoOnDelivery" type="checkbox" class="myselsf hidden"
                           @click="changeCheckbox('takePhotoOnDelivery')"
                    >
                    <label for="takePhotoOnDelivery" class="form-check__label">{{ trans('storefront::checkout.take_photo_on_delivery') }}</label>
                </label>
            </div>
        </div>
    </div>
</div>
