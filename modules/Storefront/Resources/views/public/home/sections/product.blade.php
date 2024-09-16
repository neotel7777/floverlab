<div class="product-card products-day__slide" data-id="{{$product->id}}" data-price="{{$product->price}}">
    <a class="product-card_imageWrap" href="{{ route('products.show',$product->slug) }}">
        <img class="product-card_image" src="{{asset($product->media[0]->path)}}" data-src="{{asset($product->media[0]->path)}}" alt="{{$product->translations[0]->name}}">
    </a>
    <div class="product-card_description">
        <a class="product-card__name " href="{{ route('products.show',$product->slug) }}">{{$product->translations[0]->name}}</a>
        <div class="product-card__delivery" >
            <img src="/build/images/item_delivery.svg">
            {{ trans('storefront::layout.delivery_gratis') }}
        </div>
        <div class="product-card_price ">
            <div class="product-card_old-price_block">
                <div class="product-card-mini__old-price">{{price_format(($product->special_price->amount()))}} MDL</div>
                <div class="product-card-mini__badge-discount">{{ intval((($product->price->amount() - $product->special_price->amount())/$product->price->amount())*100) }}%</div>
            </div>
            {{price_format(($product->price->amount()))}} MDL
        </div>
    </div>
    <button type="button" class="product-card__favorite" aria-label="{{ trans('storefront::layout.add_in_favorites') }}"
            data-id="{{$product->id}}">
        <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z" fill="black"/>
        </svg>
    </button>
    <button type="button" class="product-card__buy btn-add-to-cart"
            data-id="{{$product->id}}"
            aria-label="{{trans('storefront::product_card.add_to_cart')}}">
        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C7.92893 0.5 6.25 2.17893 6.25 4.25V5H2.42366L0.611403 18.0885C0.361723 19.8918 1.76261 21.5 3.58305 21.5H16.417C18.2375 21.5 19.6384 19.8918 19.3887 18.0885L17.5764 5H13.75V4.25C13.75 2.17893 12.0711 0.5 10 0.5ZM12.25 5V4.25C12.25 3.00736 11.2426 2 10 2C8.75736 2 7.75 3.00736 7.75 4.25V5H12.25ZM2.09723 18.2943L3.73028 6.5H16.2698L17.9029 18.2943C18.0277 19.1959 17.3273 20 16.417 20H3.58305C2.67283 20 1.97239 19.1959 2.09723 18.2943Z" fill="black"/>
        </svg>
    </button>
</div>
