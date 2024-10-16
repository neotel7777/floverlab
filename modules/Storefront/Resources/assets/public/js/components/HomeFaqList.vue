<template>
    <div class="faqWrap flex-column-start-start" v-if="isNotEmpty">
        <div class="blog-posts-header flex-row-start-start">
            <h5 class="reviewsTitle font-30-36-500 color-black">{{ $trans('faq::public.home_block_title') }}</h5>
        </div>
        <div class="faq-lists flex-column-start-start">
            <home-faq-item
                v-for="(faqitem, index) in faqsdata.data"
                :key="index"
                :faqitem="faqitem"
                :isActive="false"
            ></home-faq-item>
        </div>
    </div>
</template>

<script>
import HomeFaqItem from "./HomeFaqItem.vue";

export default ({
    components: {HomeFaqItem},
    props: {
        faqsdata: {
            required: !0,
            type: Object
        }
    },


    computed: {
        isNotEmpty(){
            return this.faqsdata.data.length !== 0;
        }
    }
})
</script>
