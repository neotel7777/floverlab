<template>
    <div class="faq-item-wrapper flex-column-start-start gap-10">
        <div class="faq-item-header font-20-26-500 color-black"
            :class="isActive ? 'active' : ''"
             @click="isActive = !isActive"
             v-html="title">

        </div>
        <div class="faq-item-answer font-16-20-normal color-black"
             :class="isActive ? 'active' : ''"
             v-html="description"></div>
    </div>
</template>

<script>

export default {
    props: ['faqitem','isActive'],

    computed: {

        title() {
            return this.faqitem.title;
        },

        description(){
            return this.faqitem.descriptions;
        }


    },

}
</script>

