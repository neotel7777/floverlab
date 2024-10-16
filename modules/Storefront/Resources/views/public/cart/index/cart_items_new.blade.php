<div class=" cartWrap flex-column-start-start">
    <div class="cart-item flex-row-start-start" v-for="cartItem in cart.items"
         :key="cartItem.id"
         :item="cartItem"
    >
           <div class="image-block">
               <a :href="productUrl(cartItem)" class="product-image">
                   <img
                       :src="baseImage(cartItem)"
                       :class="{ 'image-placeholder': !hasBaseImage(cartItem) }"
                       :alt="cartItem.product.name"
                   >
               </a>
           </div>
            <div class="infoBlock flex-column-start-start">
                <a
                    :href="productUrl(cartItem)"
                    class="product-name font-20-26-normal color-black"
                    v-text="cartItem.product.name"
                >
                </a>
                <div class="variant-custom-selection">
                    <ul v-cloak v-if="Object.values(cartItem.all_variants).length !== 0" class="list-inline product-options">
                        <li class="cart_item_variation flex-row-center-center"
                            :class="(variation.id == cartItem.item.id) ? 'active' : ''"
                            v-for="(variation, key, index) in cartItem.all_variants"
                            :key="index"
                            @click="updateVariant(cartItem, variation.id)"
                        >
                            <label class="fon">@{{ variation.name }}</label>

                        </li>
                    </ul>
                </div>
                <div class="quantity_price">
                    <div class="qtyBlock">
                        <div class="number-picker">
                            <div class="input-group-quantity">
                                <button
                                    type="button"
                                    class="btn btn-number btn-minus"
                                    :disabled="cartItem.qty <= 1"
                                    @click="updateQuantity(cartItem, cartItem.qty - 1)"
                                >
                                    -
                                </button>

                                <input
                                    type="text"
                                    :value="cartItem.qty"
                                    min="1"
                                    :max="maxQuantity(cartItem)"
                                    class="form-control input-number input-quantity"
                                    @focus="$event.target.select()"
                                    @input="changeQuantity(cartItem, Number($event.target.value))"
                                    @keydown.up="updateQuantity(cartItem, cartItem.qty + 1)"
                                    @keydown.down="updateQuantity(cartItem, cartItem.qty - 1)"
                                >

                                <button
                                    type="button"
                                    class="btn btn-number btn-plus"
                                    :disabled="isQtyIncreaseDisabled(cartItem)"
                                    @click="updateQuantity(cartItem, cartItem.qty + 1)"
                                >
                                    +
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="priceBlock">
                        <span class="product-price" v-html="priceTotalFormatted(cartItem)" v-if="!hasSpecialPrice(cartItem)"></span>
                        <div class="hasSpecialPriceBlock flex-row-start-end" v-else >
                            <div class="percentBlock color-white font-14-16-normal bk-color-orange" v-html="percentFormatted(cartItem)"></div>
                            <div class="priceWrap flex-column-end-end">
                                <span class='previous-price color-ligth-grey font-14-16-normal' v-html="oldTotalFormatted(cartItem)"></span>
                                <span class='special-price color-orange font-24-26-normal' v-html="priceTotalFormatted(cartItem)"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn-remove" @click="removeCartItem(cartItem)">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 6C7 5.72386 6.77614 5.5 6.5 5.5C6.22386 5.5 6 5.72386 6 6V11C6 11.2761 6.22386 11.5 6.5 11.5C6.77614 11.5 7 11.2761 7 11V6Z" fill="#8E979C"/>
                        <path d="M9.5 5.5C9.77614 5.5 10 5.72386 10 6V11C10 11.2761 9.77614 11.5 9.5 11.5C9.22386 11.5 9 11.2761 9 11V6C9 5.72386 9.22386 5.5 9.5 5.5Z" fill="#8E979C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5 1V2L1.5 2C1.22386 2 1 2.22386 1 2.5C1 2.77614 1.22386 3 1.5 3H2.02902L2.60587 12.6492C2.68481 13.9696 3.77865 15 5.10142 15H10.8986C12.2214 15 13.3152 13.9696 13.3942 12.6492L13.971 3H14.5C14.7761 3 15 2.77614 15 2.5C15 2.22386 14.7761 2 14.5 2H10.5V1H5.5ZM12.9692 3H3.03081L3.60409 12.5895C3.65145 13.3818 4.30776 14 5.10142 14H10.8986C11.6923 14 12.3486 13.3818 12.396 12.5895L12.9692 3Z" fill="#8E979C"/>
                    </svg>
                </button>
            </div>
    </div>
</div>



