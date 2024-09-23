<template>
        <div class="home-category-wrap flex-column-start-start" v-if="category.products.length > 0">
            <div class="home-categories-header flex-row-start-end">
                <h5 class="section-title font-28-34-500 color-black" v-html="title"></h5>

                <a :href="route('categories.products.index', slug)" class="view-all font-16-20-normal color-green">
                    {{ $trans("storefront::blog.blog_posts.view_all") }}
                </a>
            </div>

            <div class="products-list flex-row">
                <product-card
                    v-for="(product, index) in category.products"
                    :key="index"
                    :product="product"
                ></product-card>
            </div>
            <div class="bottom buttons flex-row-center-center">
                <a :href="route('categories.products.index', slug)" class="view-all-buttom font-16-20-normal color-green">
                    {{ $trans("storefront::blog.blog_posts.view_all") }}
                </a>
            </div>
        </div>
</template>

<script>
import ProductCard from "../ProductCard.vue";

export default {

    components: {
        ProductCard,
    },
    props: ['category'],

    computed: {
        products(){
            return this.category.products
        },
        title() {
            return this.category.name;
        },
        slug() {
            return this.category.slug;
        },
     }

};
</script>
