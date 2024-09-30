<template>
    <div class="product-rating">
        <div class="back-stars">
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>
            <i class="las la-star"></i>

            <div class="front-stars" :style="{ width: ratingPercent + '%' }">
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
                <i class="las la-star"></i>
            </div>
        </div>

        <span class="rating-count" v-if="hasReviewCount && !isDescription">({{ this.reviewCount }})</span>
        <span class="rating_description" v-if="isDescription">
           {{ this.reviewCount }} {{ $trans('review::sidebar.reviews') }}
        </span>
    </div>
</template>

<script>
    export default {
        props: ['ratingPercent', 'reviewCount','isShowDescription'],

        computed: {
            hasReviewCount() {
                return this.reviewCount !== undefined;
            },
            isDescription(){
                return this.isShowDescription;
            }
        },
    };
</script>
