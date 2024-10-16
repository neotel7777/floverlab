<template>
    <div class="product-card">
        <div class="product-card-top">
            <div class="mediaWrapper" v-if="isOneMedia">
                <a :href="productUrl" class="product-image">
                    <img
                        :src="baseImage"
                        :class="{ 'image-placeholder': !hasBaseImage }"
                        :alt="product.name"
                    />
                </a>
            </div>
            <div class="mediaWrapper" v-else>
                <div class="image-slider" :class="getcardimageref">
                    <a :href="productUrl" class="product-image" v-for="image in getMedia">
                        <img
                            :src="image.path"
                            :class="{ 'image-placeholder': !hasBaseImage }"
                            :alt="product.name"
                        />
                    </a>
                </div>
            </div>

            <div class="product-card-actions">
                <button
                    class="btn-wishlist-new"
                    :class="{ added: inWishlist }"
                    :title="$trans('storefront::product_card.wishlist')"
                    @click="syncWishlist"
                >

                    <svg  v-if="inWishlist" width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z"
                              fill="#499777"></path>
                    </svg>
                    <svg v-else width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z"
                        fill="black"></path>
                    </svg>
                </button>
            </div>

            <ul class="list-inline product-badge">
                <li class="badge badge-danger" v-if="item.is_out_of_stock">
                    {{ $trans("storefront::product_card.out_of_stock") }}
                </li>

                <li class="badge badge-primary" v-else-if="product.is_new">
                    {{ $trans("storefront::product_card.new") }}
                </li>

                <li
                    class="badge badge-success"
                    v-if="item.has_percentage_special_price"
                >
                    -{{ item.special_price_percent }}%
                </li>
            </ul>
        </div>

        <div class="product-card-middle">
            <product-rating
                :ratingPercent="review_percent"
                :reviewCount="product.reviews_count"
            >
            </product-rating>

            <a :href="productUrl" class="product-name">
                <h6>{{ product.name }}</h6>
            </a>

            <div class="product-prices" v-if="hasSpecialPrice">
                <div class="product-card_old-price_block flex-row " >
                    <div class="prices_block flex-row-start-center">
                        <div class="product-card-price font-24-26-normal color-orange" v-html="special_price_formated"></div>
                        <div class="product-card-old-price font-14-16-normal color-ligth-grey" v-html="price_formated"></div>
                    </div>
                    <div class="product-card-mini__badge-discount font-14-16-normal color-white bk-color-orange" v-html="percent"></div>
                </div>
            </div>
            <div  class="product-prices" v-else>
                <div class="product-card-price font-24-26-normal color-black " v-html="price_formated">
                </div>
            </div>
        </div>

        <div class="product-card-bottoms flex-row-center-center gap-10">

            <button
                v-if="hasNoOption || item.is_out_of_stock"
                class="btn btn-primary btn-add-to-cart"
                :class="{ 'btn-loading': addingToCart }"
                :class="inCart ? 'inCart' : ''"
                :disabled="item.is_out_of_stock"
                @click="addToCart"
            >
                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C7.92893 0.5 6.25 2.17893 6.25 4.25V5H2.42366L0.611403 18.0885C0.361723 19.8918 1.76261 21.5 3.58305 21.5H16.417C18.2375 21.5 19.6384 19.8918 19.3887 18.0885L17.5764 5H13.75V4.25C13.75 2.17893 12.0711 0.5 10 0.5ZM12.25 5V4.25C12.25 3.00736 11.2426 2 10 2C8.75736 2 7.75 3.00736 7.75 4.25V5H12.25ZM2.09723 18.2943L3.73028 6.5H16.2698L17.9029 18.2943C18.0277 19.1959 17.3273 20 16.417 20H3.58305C2.67283 20 1.97239 19.1959 2.09723 18.2943Z" fill="black">
                    </path>
                </svg>
                <span v-if="inCart">{{ $trans('storefront::storefront.in_cart') }}</span>
                <span v-else>{{ $trans('storefront::product_card.add_to_cart') }}</span>
            </button>

            <a
                v-else
                :href="productUrl"
                class="btn btn-primary btn-add-to-cart"
            >
                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C7.92893 0.5 6.25 2.17893 6.25 4.25V5H2.42366L0.611403 18.0885C0.361723 19.8918 1.76261 21.5 3.58305 21.5H16.417C18.2375 21.5 19.6384 19.8918 19.3887 18.0885L17.5764 5H13.75V4.25C13.75 2.17893 12.0711 0.5 10 0.5ZM12.25 5V4.25C12.25 3.00736 11.2426 2 10 2C8.75736 2 7.75 3.00736 7.75 4.25V5H12.25ZM2.09723 18.2943L3.73028 6.5H16.2698L17.9029 18.2943C18.0277 19.1959 17.3273 20 16.417 20H3.58305C2.67283 20 1.97239 19.1959 2.09723 18.2943Z" fill="black"></path></svg>
                {{ $trans("storefront::product_card.view_options") }}
            </a>
        </div>
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
        getcardimageref(){
            return "image-slider_" + this.product.category + "_" + this.product.id;
        },
        review_percent(){
            return (this.product.rating_percents) ? this.product.rating_percent : this.product.rating_percent;
        },
    },
    mounted() {

        $(".image-slider:not(.slick-initialized)").slick( {
            rows: 0,
            dots: true,
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: window.FleetCart.rtl,
            });
    },
};
</script>
