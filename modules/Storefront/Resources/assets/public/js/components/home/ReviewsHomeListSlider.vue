<template>
    <div class="sliderItem flex-column" >
        <div class="reviewInfo gap-5 flex-column-start-start">
            <div class="raiting flex-row gap-5">
                <product-rating
                    :ratingPercent="percent"
                >
                </product-rating>
                <div class="status color-green font-16-20-normal" v-html="status"></div>
            </div>
            <div class="userInfo font-16-20-normal color-ligth-grey" v-html="userinfo">
            </div>
            <div class="message font-16-20-normal color-black" v-html="message">
            </div>
        </div>
        <div class="reviewMedia" v-if="hasMedia">
            <div class="mediafooter flex-row-center-center" :class="!hasMedia2 ? 'mediaOne':''">
                <div class="media1"
                    :class="!hasMedia2 ? 'flex-row-center-center' : 'flex-row-start-center'">
                    <img :src="media1" >
                    <div class="caption " >
                        {{ $trans('storefront::review.photo_on_site') }}
                    </div>
                </div>
                <div class="media1  flex-row-start-center" v-if="hasMedia2">
                    <img :src="media2" >
                    <div class="caption" >
                        {{ $trans('storefront::review.photo_on_site') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import productRating from "../ProductRating.vue";
export default {
    components: { productRating },
    props: ['review'],
    computed: {
        percent(){
          return this.review.percent;
        },
        username() {
            return this.review.reviewer_name;
        },
        status(){
            return this.review.statusRating;
        },
        message(){
            return this.review.comment;
        },
        data() {
            return this.review.data;
        },
        userinfo(){
            return  this.review.reviewer_name + ", " + this.review.data;
        },
        hasMedia(){
            return this.review.product.files.length !==0
        },
        hasMedia2(){
            return this.review.product.files[1] !== undefined;
        },
        hasMedia1(){
            return this.review.product.files[0] !== undefined;
        },
        media2() {
            return this.hasMedia2
                ? this.review.product.files[1].path
                : `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        },
        media1() {
            return this.hasMedia1
                ? this.review.product.files[0].path
                : `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        }
    }
}

</script>
