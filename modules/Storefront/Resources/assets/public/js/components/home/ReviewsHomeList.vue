
<template>
<div class="sectionWrap reviewsWrap flex-column">
    <div class="reviewsTitle">
        {{ $trans("storefront::review.home_section_title") }}
    </div>
    <div class="reviewsWrapper">
        <ul class="nav nav-tabs tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#reviews" data-bs-toggle="tab" class="nav-link active" aria-selected="true" role="tab">
                    {{ $trans("storefront::review.reviews_title") }}
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#google" data-bs-toggle="tab" class="nav-link" aria-selected="false" tabindex="-1" role="tab">
                Google
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="reviews" class="tab-pane description active" role="tabpanel">
                <div class="content less-content">
                   <div class="stateBar flex-row">
                       <div class="statesReviews flex-row-start-center">
                            <div class="averageRaiting font-48-54-500 color-green" v-html="averageRaiting"></div>
                            <div class="flex-column">
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
                           <a href="#" class="color-white bk-color-green font-12-14-500">
                               {{ $trans('storefront::review.Leave_Review_button') }}
                           </a>
                       </div>
                   </div>
                   <div class="reviewsSlider">
                       <reviews-home-list-slider
                            v-for="(review, index) in reviewsList)"
                            :key="index"
                            :review="review"
                       >

                       </reviews-home-list-slider>
                   </div>
                </div>
            </div>
            <div id="google" class="tab-pane description" role="tabpanel">
                <div class="content less-content">
                    google
                </div>
            </div>
    </div>
    <div class="reviewsWrapper Empty" >

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
        reviewsList(){
            return this.reviewsitems.reviews;
        }
    }

}
</script>
