<div class="delivery_information-wrapper">
    <h4 class="section-title">{{ trans('order::orders.delivery_information') }}</h4>

    <div class="row">
        <div class="delivery_information">
            <div class="col-sm-12">
                <div>
                    <span>
                       {{ trans('order::orders.delivery_time') }}
                    </span>
                    <label>
                       {{ $order->delivery_date }} {{ trans('storefront::checkout.from') }} {{ $order->delivery_time_from }} {{ trans('storefront::checkout.to') }} {{ $order->delivery_time_to }}
                    </label>
                </div>
                <div>
                    <span>
                       {{ trans('order::orders.action_on_delivery') }}
                    </span>
                    <label>
                        {{ setting('checkout_data_variants_title'.$order->delivery_action) }}
                    </label>
                </div>
                <div>
                    <span>
                       {{ trans('order::orders.action_on_change_order') }}
                    </span>
                    <label>
                        {{ setting('checkout_data_actions_title'.$order->delivery_action) }}
                    </label>
                </div>
                <div>
                    <span>
                       {{ trans('storefront::checkout.take_photo_on_delivery') }}?
                    </span>
                    <label>
                        {{ ($order->take_photo_on_delivery) ? trans('attribute::admin.table.yes') : trans('attribute::admin.table.no') }}
                    </label>
                </div>
                <div>
                    <span>
                       {{ trans('storefront::checkout.take_photo_before_delivery') }}?
                    </span>
                    <label>
                        {{ ($order->send_me_photo_before_delivery) ? trans('attribute::admin.table.yes') : trans('attribute::admin.table.no') }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
