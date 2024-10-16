@extends('storefront::public.layout')

@section('title', trans('storefront::cart.cart'))

@section('breadcrumb')
    <li class="active">{{ trans('storefront::cart.cart') }}</li>
@endsection

@section('content')
    <cart-index inline-template
                :accessoriilist="{{ json_encode($accessorii)  ?? json_encode(new stdClass) }}"
    >
        <div>
            <section class="shopping-cart-wrap">
                <div class="sectionWrap">
                    <template v-if="cartIsNotEmpty">
{{--                        @include('storefront::public.cart.index.steps')--}}

                        <div class="shopping-cart">
                            <div class="shopping-cart-inner white_box">
                                @include('storefront::public.cart.index.cart_items_new')
                                @if(!empty($accessorii))
                                    <div class="accessoriiProducts sliderCartProductBlock  flex-column" >
                                        <div class="title sliderProductTitle font-20-26-500">{{ trans('cart::messages.additional_block_title') }}</div>
                                        <div class="accessoriiBlock">
                                            <accesorii-cart-products :accessorii="accessoriilist"></accesorii-cart-products>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @include('storefront::public.cart.index.order_summary')
                        </div>

                    </template>

                    @include('storefront::public.cart.index.empty_cart')
                </div>
            </section>



            <landscape-products title="{{ trans('storefront::product.you_might_also_like') }}" v-if="hasAnyCrossSellProduct"
                :products="crossSellProducts">
            </landscape-products>
        </div>
    </cart-index>
@endsection
