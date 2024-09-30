
<template>
<div class="reviewsProdWrap" v-if="hasReviews">
    <div class="sectionWrap flex-column">
        <div class="reviewsProductWrapper">
            <div class="tab-content">
                <div class="content less-content">
                       <div class="stateBar flex-row">
                           <div class="statesReviews flex-row-start-center">
                                <div class="averageRaiting font-48-54-500 color-green" v-html="averageRaiting"></div>
                                <div class="flex-column ">
                                    <div class="stars">
                                        <product-rating
                                            :ratingPercent="averagePercent"
                                            :reviewCount="allreviews"
                                        >
                                        </product-rating>
                                    </div>
                                    <div class="stateline flex-row-start-center">
                                        <div class="stateitem flex-row font-16-20-normal color-grey">
                                            <span v-html="allreviews"></span>
                                            {{ $trans('storefront::review.reviews_title') }}
                                        </div>
                                        <div class="divider"></div>
                                        <div class="stateitem flex-row font-16-20-normal color-grey">
                                            <span v-html="allreviews"></span>
                                            {{ $trans('storefront::review.reviews_title') }}
                                        </div>
                                        <div class="divider"></div>
                                        <div class="stateitem flex-row font-16-20-normal color-grey">
                                            <span v-html="allorders"></span>
                                            {{ $trans('storefront::review.total_orders_title') }}
                                        </div>
                                    </div>
                                </div>
                           </div>
                       </div>
                       <div class="reviewsSlider"  ref="reviewsProdSlider">
                           <reviews-home-list-slider
                                v-for="(review, index) in reviewsProductList"
                                :key="index"
                                :review="review"
                           >

                           </reviews-home-list-slider>
                       </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {trans} from "../../functions";
import productRating from "../ProductRating.vue";
import ReviewsHomeListSlider from "./ReviewsHomeListSlider.vue";
export default {
    components: { productRating,ReviewsHomeListSlider },

    props: ["reviewsitems"],

    computed:{
        averageRaiting(){
            return this.reviewsitems.avgRaitind;
        },
        averagePercent(){
            return this.reviewsitems.avgPercent;
        },
        allreviews() {
           return this.reviewsitems.allReviews;
        },
        allorders(){
            return this.reviewsitems.orders;
        },
        reviewsProductList(){
            return this.reviewsitems.reviews;
        },
        hasReviews(){
            return this.reviewsitems.isReviews;
        },
        slickOptions() {
            return  {
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,

            };
        },
    },
    mounted() {
        // $(this.$refs.reveiwsSliderProd).find(".reviewsSlider").slick(
        //     this.slickOptions
        // );
    },

}
</script>
