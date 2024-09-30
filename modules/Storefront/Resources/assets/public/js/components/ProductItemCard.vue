<template>
    <div class="product-card">
        <div class="product-card-top">
            <div class="mediaWrapper">
                <a :href="productUrl_" class="product-image">
                    <img
                        :src="baseImage_"
                        :class="{ 'image-placeholder': !hasBaseImage_ }"
                        :alt="productitem.name"
                    />
                </a>
            </div>
            <div class="product-card-middle">
                <a :href="productUrl_" class="product-name">
                    <h6>{{ productitem.name }}</h6>
                </a>
            </div>
            <ul class="list-inline product-badge">
                <li class="badge badge-danger" v-if="item_.is_out_of_stock">
                    {{ $trans("storefront::product_card.out_of_stock") }}
                </li>

                <li class="badge badge-primary" v-else-if="productitem.is_new">
                    {{ $trans("storefront::product_card.new") }}
                </li>

                <li
                    class="badge badge-success"
                    v-if="item_.has_percentage_special_price"
                >
                    -{{ item_.special_price_percent }}%
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {

    props: ["productitem",'refname'],


    computed: {

        item_() {
            return {
                ...(this.productitem.variant ? this.productitem.variant : this.productitem),
            };
        },

        productUrl_() {
            return route("products.show", {
                slug: this.productitem.slug,
                ...(this.hasAnyVariant_ && {
                    variant: this.productitem.uid,
                }),
            });
        },
        hasAnyVariant_() {
            return this.productitem.variant !== null;
        },
        baseImage_() {
            return this.hasBaseImage_
                ?  this.productitem.base_image.path
                : `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        },
        hasBaseImage_() {
            if (this.hasAnyVariant) {
                return this.item.base_image.length !== 0 ||
                this.productitem.base_image.length !== 0
                    ? true
                    : false;
            }

            return this.productitem.base_image.length !== 0;
        },
    },
    mounted() {
        if(!$(this.$el).closest("."+this.refname).hasClass('slick-slider')) {
            $($(this.$el).closest("."+this.refname)).slick({
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
                responsive: [

                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 1051,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 881,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                ]
            });
        }
    }
};
</script>
