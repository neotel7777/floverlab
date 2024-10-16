@extends('storefront::public.layout')
@section('breadcrumb')
    <li class="active">{{ trans('storefront::cart.order_complete') }}</li>
@endsection
@section('content')
    <section class="order-complete-wrap">
        <div class="sectionWrap">
            <div class="order-complete-wrap-inner flex-row-start-start">
                <div class="order-complete">
                    <h2 class="font-28-34-500">{{ trans('storefront::order_complete.order_placed') }}</h2>
                    <span class="font-18-20-normal color-neutral_grey">
                        {!! trans('storefront::order_complete.your_order_has_been_placed', ['id' => $order->id,'total'=>$order->total." MDL"]) !!}
                    </span>
                </div>
                <div class="blocksWrap">
                    @if(!empty($blocks))
                        @foreach($blocks as $ind=>$item)
                            <div class="block_wrapper white_box flex-column-start-start">
                                <div class="block_title font-20-26-500 color-black">
                                    {{ $item['title'] }}
                                </div>
                                <div class="block_description font-18-20-normal color-neutral_grey">
                                    {{ $item['description'] }}
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
