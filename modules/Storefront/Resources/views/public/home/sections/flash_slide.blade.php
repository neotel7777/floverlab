<div class="flash_sale_slade_block flex-column-start-start">
    <div class="sale_block flex-row-start-center">
        {{trans('storefront::layout.Flovers_and_sale')}}
        <div class="sale_day_tooltip js_tooltip" >
            <img src="/storage/media/tooltip_icon.svg"><div class="tooltip_text">{{trans('storefront::layout.Flovers_and_sale_hint')}}</div>
        </div>
    </div>
    <div class="flash_product_slider"
         data-speed="1000"
         data-autoplay="false"
         data-autoplay-speed="3000"
         data-fade="false"
         data-dots="false"
         data-arrows="true">
        @foreach($data['flashSaleProducts'] as $product)
            @include('storefront::public.home.sections.product',['product'=>$product])
        @endforeach
    </div>
</div>
