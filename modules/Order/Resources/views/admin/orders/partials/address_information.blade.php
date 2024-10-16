<div class="address-information-wrapper">
    <h4 class="section-title">{{ trans('order::orders.address_information') }}</h4>

    <div class="row">
         <div class="col-md-12">
            <div class="shipping-address">
                <h5 class="pull-left">{{ trans('order::orders.shipping_address') }}</h5>

                <span>
                    {{ $order->shipping_full_name }}
                    <br>
                    {{ $order->billing_city }}, {{ $order->shipping_address_1 }}
                    <br>
                </span>
            </div>
        </div>
    </div>
</div>

