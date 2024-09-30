<template>
    <section class="blog-posts-wrap">
            <div class="blog-posts-header">
                <h5 class="reviewsTitle font-28-34-500 color-black">{{ data.title }}</h5>
            </div>
            <div class="blog-posts">
                <blog-post-card
                    v-for="(blogPost, index) in data.blogPosts"
                    :key="index"
                    :blog-post="blogPost"
                ></blog-post-card>
            </div>
            <div class="buttons">
                <a :href="route('blog_posts.index')" class="view-all color-white font-14-16-normal bk-color-dark-green">
                    {{ $trans("storefront::blog.blog_posts.view_all") }}
                </a>
            </div>
    </section>
</template>

<script>
import { slickPrevArrow, slickNextArrow } from "../../functions";
import BlogPostCard from "../BlogPostCard.vue";

export default {
    components: {
        BlogPostCard,
    },

    props: ['data'],

    mounted() {
        this.initSlickSlider();
    },

    methods: {
        initSlickSlider() {
            $(".blog-posts").slick({
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
                responsive: [
                    {
                        breakpoint: 1700,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 921,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });
        },
    },
};
</script>
