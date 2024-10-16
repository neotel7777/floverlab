@extends('storefront::public.layout')

@section('title', trans('storefront::checkout.checkout'))

@section('breadcrumb')
    <li>
        <a href="{{ route('cart.index') }}">{{ trans('storefront::cart.cart') }}</a>
    </li>
    <li class="active">{{ trans('storefront::cart.checkout') }}</li>
@endsection

@section('content')
    <checkout-create
        customer-email="{{ auth()->user()->email ?? null }}"
        customer-phone="{{ auth()->user()->phone ?? null }}"
        :addresses="{{ $addresses }}"
        :default-address="{{ $defaultAddress }}"
        :gateways="{{ $gateways }}"
        :countries="{{ json_encode($countries) }}"
        :variants="{{ json_encode($variants) }}"
        :actions="{{ json_encode($actions) }}"
        :from="'{{ trans('storefront::checkout.from') }}'"
        :to="'{{ trans('storefront::checkout.to') }}'"
        :locale="'{{ locale() }}'"
        :shipping_default="'free_shipping'"
        inline-template
    >
        <section class="checkout-wrap">
            <div class="sectionWrap">
                <h3 class="checkout-title font-28-34-500 color-black">{{ trans('storefront::cart.checkout') }}</h3>
                <template v-if="cartIsNotEmpty">

                    <form class="checkout-form" @input="errors.clear($event.target.name)">
                        <div class="checkout-inner flex-column-start-start">
                            @include('storefront::public.checkout.create.new_checkout.who_send')
                            @include('storefront::public.checkout.create.new_checkout.time_send')
                            @include('storefront::public.checkout.create.new_checkout.change_actions')
{{--                                @include('storefront::public.checkout.create.form.billing_details')--}}
{{--                                @include('storefront::public.checkout.create.form.shipping_details')--}}
{{--                                @include('storefront::public.checkout.create.form.order_note')--}}
{{--                                @include('storefront::public.checkout.create.payment')--}}
{{--                                @include('storefront::public.checkout.create.shipping')--}}
                        </div>

                        @include('storefront::public.checkout.create.order_summary')
                    </form>

                    @if (setting('authorizenet_enabled'))
                        <form ref="authorizeNetForm" method="post"
                            action="{{ setting('authorizenet_test_mode') ? 'https://test.authorize.net/payment/payment' : 'https://accept.authorize.net/payment/payment' }}"
                            v-if="authorizeNetToken">
                            <input type="hidden" name="token" :value="authorizeNetToken" />
                            <button type="submit"></button>
                        </form>
                    @endif

                    @if (setting('payfast_enabled'))
                        <form ref="payFastForm" action="https://sandbox.payfast.co.za/eng/process" method="post">
                            <div v-for="(value, name, index) in payFastFormFields" :key="index">
                                <input :name="name" type="hidden" :value="value" />
                            </div>
                        </form>
                    @endif
                </template>

                @include('storefront::public.cart.index.empty_cart')
            </div>
        </section>
    </checkout-create>
@endsection

@push('pre-scripts')

@endpush
