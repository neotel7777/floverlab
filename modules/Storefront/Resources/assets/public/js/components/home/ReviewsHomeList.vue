
<template>
<div class="reviewsWrap" v-if="hasReviews">
    <div class="sectionWrap flex-column">
        <div class="reviewsTitle font-28-34-500 color-black">
            {{ $trans("storefront::review.home_section_title") }}
        </div>
        <div class="reviewsWrapper">
            <ul class="nav nav-tabs tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <div href="#" data-bs-toggle="tab" class="nav-link font-20-26-normal color-grey" aria-selected="true" role="tab"
                            :class="openedtab=='reviews' ? 'active' : ''"
                            @click="openedtab='reviews'">
                        {{ $trans("storefront::review.reviews_title") }}
                    </div>
                </li>
                <li class="nav-item" role="presentation">
                    <div href="#" data-bs-toggle="tab" class="nav-link  font-20-26-normal color-grey" aria-selected="false" tabindex="-1" role="tab"
                       :class="openedtab=='google' ? 'active' : ''"
                       @click="openedtab='google'">
                    Google
                    </div>
                </li>
            </ul>
            <div class="tab-content">
                <div id="reviews" class="tab-pane description" role="tabpanel"
                     :class="openedtab=='reviews' ? 'active' : ''">
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
                           <div class="button">
                               <a :href='route("reviews.index")' class="color-white bk-color-green font-12-14-500">
                                   {{ $trans('storefront::review.Leave_Review_button') }}
                               </a>
                           </div>
                       </div>
                       <div class="reviewsSlider" ref="reviewsSlider">
                           <reviews-home-list-slider
                                v-for="(review, index) in reviewsList"
                                :key="index"
                                :review="review"
                           >

                           </reviews-home-list-slider>
                       </div>
                    </div>
                </div>
                <div id="google" class="tab-pane description" role="tabpanel"
                     :class="openedtab=='google' ? 'active' : ''">
                    <div class="content less-content">
                        google
                    </div>
                </div>
            </div>
            <div class="reviewsWrapper Empty" >

            </div>
        </div>
    </div>
</div>
</template>
<style>
.nav-link{
    cursor:pointer;
}
</style>

<script>
import {trans} from "../../functions";
import productRating from "../ProductRating.vue";
import ReviewsHomeListSlider from "./ReviewsHomeListSlider.vue";
export default {
    components: { productRating,ReviewsHomeListSlider },

    props: ["reviewsitems"],

    data(){
        return{
            openedtab: 'reviews',
        }
    },

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
        reviewsList(){
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
                slidesToShow: 3,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
                responsive: [

                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 1051,
                        settings: {
                            slidesToShow: 3,
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
            };
        },
    },
    mounted() {
        $(this.$refs.reviewsSlider).slick(
            this.slickOptions
        );
    },

}
</script>
