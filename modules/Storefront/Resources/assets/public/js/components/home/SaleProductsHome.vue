<template>
        <div class="vertical-products flex-column">
            <div class="sale_block flex-row-start-center">
                {{ $trans('storefront::layout.Flovers_and_sale') }}
                <div class="sale_day_tooltip">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.3333 7.5C11.1827 7.5 10.25 8.43274 10.25 9.58333V9.75H8.75V9.58333C8.75 7.60431 10.3543 6 12.3333 6H13.25C15.114 6 16.625 7.51104 16.625 9.375C16.625 11.239 15.114 12.75 13.25 12.75V15H11.75V11.25H13.25C14.2855 11.25 15.125 10.4105 15.125 9.375C15.125 8.33947 14.2855 7.5 13.25 7.5H12.3333Z" fill="#8E979C"/>
                        <path d="M12.5 18.75C13.1213 18.75 13.625 18.2463 13.625 17.625C13.625 17.0037 13.1213 16.5 12.5 16.5C11.8787 16.5 11.375 17.0037 11.375 17.625C11.375 18.2463 11.8787 18.75 12.5 18.75Z" fill="#8E979C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.20101 6.70101 1.5 12.5 1.5C18.299 1.5 23 6.20101 23 12C23 17.799 18.299 22.5 12.5 22.5C6.70101 22.5 2 17.799 2 12ZM12.5 3C7.52944 3 3.5 7.02944 3.5 12C3.5 16.9706 7.52944 21 12.5 21C17.4706 21 21.5 16.9706 21.5 12C21.5 7.02944 17.4706 3 12.5 3Z" fill="#8E979C"/>
                    </svg>
                    <div class="tooltip_text">{{ $trans('storefront::layout.Flovers_and_sale_hint') }}</div>
                </div>
            </div>

            <div class="sale-products-slider" ref="productsPlaceholder">
                    <SaleCard
                        v-for="product in saleproducts"
                        :key="product.id"
                        :product="product"
                    />
            </div>
        </div>
</template>

<script>
import SaleCard from "../SaleCard.vue";
import {slickNextArrow, slickPrevArrow} from "@modules/Storefront/Resources/assets/public/js/functions";

export default {
    components: { SaleCard },

    props: ["saleproducts"],


    mounted() {
        $(this.$refs.productsPlaceholder).slick({
            rows: 2,
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: window.FleetCart.rtl,
            responsive: [

                {
                    breakpoint: 1301,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        row: 1
                    },
                },
                {
                    breakpoint: 1051,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        row: 1
                    },
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        row: 1
                    },
                },
                {
                    breakpoint: 881,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        row: 1
                    },
                },
                {
                    breakpoint: 768,
                    settings: {
                        dots: true,
                        arrows: false,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        row: 1
                    },
                },
                {
                    breakpoint: 641,
                    settings: {
                        dots: true,
                        arrows: false,
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        row: 1
                    },
                },
            ],
        });
    },
};
</script>
