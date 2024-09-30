import store from "../store";
import {formatNumber} from "chart.js/helpers";

export default {
    data() {
        return {
            addingToCart: false,
        };
    },

    computed: {
        productUrl() {
            return route("products.show", {
                slug: this.product.slug,
                ...(this.hasAnyVariant && {
                    variant: this.item.uid,
                }),
            });
        },

        hasAnyVariant() {
            return this.product.variant !== null;
        },

        hasAnyOption() {
            return this.product.options_count > 0;
        },

        hasNoOption() {
            return !this.hasAnyOption;
        },

        hasAnyMedia() {
            return this.product.medias!==undefined && this.product.medias.length !== 0;
        },

        isOneMedia() {
            return this.hasAnyMedia && this.product.medias.length === 1;
        },
        hasSpecialPrice(){
           return  (this.product.special_price !== null && (this.product.special_price.amount !==0
               && this.product.special_price.amount !== this.product.price.amount))
        },

        getMedia(){
          return this.product.medias ;
        },

        hasBaseImage() {
            if (this.hasAnyVariant) {
                return this.item.base_image.length !== 0 ||
                    this.product.base_image.length !== 0
                    ? true
                    : false;
            }

            return this.item.base_image.length !== 0;
        },

        baseImage() {
            return this.hasBaseImage
                ? this.item.base_image.path || this.product.base_image.path
                : `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        },

        inWishlist() {
            return store.inWishlist(this.product.id);
        },

        inCompareList() {
            return store.inCompareList(this.item.id);
        },
        inCart() {
            return store.inCart(this.item.id);
        },
        id(){
            return this.item.id;
        },
        name() {
          return this.item.title;
        },
        price() {
            return this.item.price;
        },
        price_formated() {
            return store.round(this.item.price.amount) + " " + this.item.price.currency;
        },
        percent() {
            if(this.product.special_price!==null) {
                return store.round(((this.item.price.amount - this.item.special_price.amount) / this.item.special_price.amount) * 100) + "%";
            } else {
                return '';
            }
        },
        special_price_formated(){
            if(this.product.special_price!==null) {
                return store.round(this.item.special_price.amount) + " " + this.item.special_price.currency;
            } else {
                return '';
            }
        }
    },

    methods: {
        syncWishlist() {
            store.syncWishlist(this.product.id);
        },

        syncCompareList() {
            store.syncCompareList(this.product.id);
        },
        round(num){
            store.round(num);
        },

        addToCart() {
            this.addingToCart = true;

            axios
                .post(
                    route("cart.items.store", {
                        product_id: this.product.id,
                        qty: 1,
                        ...(this.hasAnyVariant && {
                            variant_id: this.item.id,
                        }),
                    })
                )
                .then((response) => {
                    store.updateCart(response.data);

                    if (document.location.href !== route("cart.index")) {
                        $(".header-cart").trigger("click");
                    }
                })
                .catch((error) => {
                    this.$notify(error.response.data.message);
                })
                .finally(() => {
                    this.addingToCart = false;
                });
        },
    },
};
