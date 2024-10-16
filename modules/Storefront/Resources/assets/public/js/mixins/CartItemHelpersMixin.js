export default {
    props: ['accessoriilist'],
    data() {
        return {
            accord_processing: false,
            show_processing_popup: false,
            accord_data: false,
            show_data_popup: false
        }
    },

    methods: {
        productUrl({ product, variant }) {
            return route("products.show", {
                slug: product.slug,
                ...(variant !== null && {
                    variant: variant.uid,
                }),
            });
        },
        priceTotalFormatted(cartItem){
            return (cartItem.item.price.inCurrentCurrency.amount * cartItem.qty).toLocaleString('hi-IN',{ minimumFractionDigits: 0 }) + " " + cartItem.item.price.inCurrentCurrency.currency;
        },
        hasSpecialPrice(cartItem){
            return cartItem.item.special_price != null && cartItem.item.special_price.amount > 0 && (cartItem.item.special_price.amount < cartItem.item.price.amount);
        },
        oldTotalFormatted(cartItem){
            return (cartItem.item.price.inCurrentCurrency.amount * cartItem.qty).toLocaleString('hi-IN',{ minimumFractionDigits: 0 })  + " " + cartItem.item.price.inCurrentCurrency.currency;
        },
        percentFormatted(cartItem){
            return parseInt((1 - cartItem.item.special_price.amount/cartItem.item.price.inCurrentCurrency.amount) * 100) + "%";
        },
        getCountProductsTitle(title){
          return title.replace("[num]",this.cart.quantity);
        },
        click_accord_processing(){
            this.accord_processing = !this.accord_processing;
        },
        verifyCheckboxex(url){
            if(this.accord_processing && this.accord_data) {
                this.show_processing_popup = false;
                this.show_data_popup = false;
                window.location.href = url;
            } else {
                if(!this.accord_processing){
                    this.show_processing_popup = true;
                } else {
                    this.show_data_popup = true;
                }
            }
        },
        click_accord_data(){
            this.accord_data = !this.accord_data;
        },
        hasBaseImage({ item }) {
            return item.base_image.length !== 0;
        },

        baseImage(cartItem) {
            if (this.hasBaseImage(cartItem)) {
                return cartItem.item.base_image.path;
            }

            return `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        },

        optionValues(option) {
            let values = [];

            for (let value of option.values) {
                values.push(value.label);
            }

            return values.join(", ");
        },

        maxQuantity({ item }) {
            return item.is_in_stock && item.does_manage_stock ? item.qty : null;
        },

        exceedsMaxStock({ item, qty }) {
            return item.does_manage_stock && item.qty < qty;
        },

        isQtyIncreaseDisabled(cartItem) {
            return (
                this.maxQuantity(cartItem) !== null &&
                cartItem.qty >= cartItem.item.qty
            );
        },

        changeQuantity(cartItem, qty) {
            if (isNaN(qty) || qty < 1) {
                qty = 1;

                this.updateCart(cartItem, qty);

                return;
            }

            cartItem.qty = qty;

            if (this.exceedsMaxStock(cartItem)) {
                qty = cartItem.item.qty;

                this.updateCart(cartItem, qty);

                return;
            }

            this.updateCart(cartItem, qty);
        },

        updateQuantity(cartItem, qty) {
            if (isNaN(qty) || qty < 1) {
                qty = 1;
                cartItem.qty = 1;

                return;
            }

            cartItem.qty = qty;

            if (this.exceedsMaxStock(cartItem)) {
                cartItem.qty = cartItem.item.qty;

                this.updateCart(cartItem, cartItem.qty);

                return;
            }

            this.updateCart(cartItem, qty);
        },
    },
};
