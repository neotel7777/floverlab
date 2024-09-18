<template>
    <div class="product-card products-day__slide flex-row-start-center" >
        <a class="product-card_imageWrap flex-row-center-center" :href="productUrl">
            <img class="product-card_image" :src="baseImage"
                 :alt="name">
        </a>
        <div class="product-card_description flex-column-start-start">
            <a class="product-card__name " :href="productUrl" v-html="name"></a>
            <div class="product-card__delivery flex-row-start-center" >
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 8V11H15.5V12H13.4823C13.494 12.0817 13.5 12.1651 13.5 12.25C13.5 13.2165 12.7165 14 11.75 14C10.7835 14 10 13.2165 10 12.25C10 12.1651 10.006 12.0817 10.0177 12H5.98228C5.99396 12.0817 6 12.1651 6 12.25C6 13.2165 5.2165 14 4.25 14C3.2835 14 2.5 13.2165 2.5 12.25C2.5 12.1651 2.50604 12.0817 2.51772 12H0.5V11H1V4C1 3.44772 1.44772 3 2 3H10C10.5523 3 11 3.44772 11 4V6H13C13.1326 6 13.2598 6.05268 13.3536 6.14645L14.8536 7.64645C14.9473 7.74021 15 7.86739 15 8ZM11 10.6684V7H12.7929L14 8.20711V11H12.9747C12.6591 10.6907 12.2268 10.5 11.75 10.5C11.4816 10.5 11.2273 10.5604 11 10.6684ZM10 11H5.47475C5.15911 10.6907 4.72683 10.5 4.25 10.5C3.77317 10.5 3.34089 10.6907 3.02525 11H2V4H10V11ZM4.25 11.5C3.83579 11.5 3.5 11.8358 3.5 12.25C3.5 12.6642 3.83579 13 4.25 13C4.66421 13 5 12.6642 5 12.25C5 11.8358 4.66421 11.5 4.25 11.5ZM11 12.25C11 11.8358 11.3358 11.5 11.75 11.5C12.1642 11.5 12.5 11.8358 12.5 12.25C12.5 12.6642 12.1642 13 11.75 13C11.3358 13 11 12.6642 11 12.25Z" fill="#59666E"/>
                </svg>
                {{ $trans('storefront::layout.delivery_gratis') }}
            </div>
            <div class="product-card_price flex-column-start-start">
                <div class="product-card_old-price_block flex-row-start-end gap-10">
                    <div class="product-card-mini__old-price" v-html="special_price_formated"></div>
                    <div class="product-card-mini__badge-discount" v-html="percent"></div>
                </div>
                <span v-html="price_formated">
                </span>
            </div>
        </div>
        <button type="button" class="product-card__favorite"
                :class="{ added: inWishlist }"
                @click="syncWishlist">
            <svg width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z" fill="black"/>
            </svg>
        </button>
        <button type="button" class="product-card__buy btn-add-to-cart"
                v-if="hasNoOption || item.is_out_of_stock"
                :class="{ 'btn-loading': addingToCart }"
                :disabled="item.is_out_of_stock"
                @click="addToCart">
            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C7.92893 0.5 6.25 2.17893 6.25 4.25V5H2.42366L0.611403 18.0885C0.361723 19.8918 1.76261 21.5 3.58305 21.5H16.417C18.2375 21.5 19.6384 19.8918 19.3887 18.0885L17.5764 5H13.75V4.25C13.75 2.17893 12.0711 0.5 10 0.5ZM12.25 5V4.25C12.25 3.00736 11.2426 2 10 2C8.75736 2 7.75 3.00736 7.75 4.25V5H12.25ZM2.09723 18.2943L3.73028 6.5H16.2698L17.9029 18.2943C18.0277 19.1959 17.3273 20 16.417 20H3.58305C2.67283 20 1.97239 19.1959 2.09723 18.2943Z" fill="black"/>
            </svg>
        </button>
    </div>
</template>

<script>
import ProductCardMixin from "../mixins/ProductCardMixin";

export default {
    mixins: [ProductCardMixin],

    props: ["product"],

    computed: {
        item() {
            return {
                ...(this.product.variant ? this.product.variant : this.product),
            };
        },
    },

};
</script>
