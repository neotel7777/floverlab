<template>
    <div class="blog-post-card">
        <div class="blog-post">
            <a
                :href="route('blog_posts.show', blogPost.slug)"
                class="blog-post-featured-image overflow-hidden"
            >
                <div
                    class="image-placeholder"
                    v-if="blogPost.featured_image.length === 0"
                >
                    <img
                        :src="`${baseUrl}/build/assets/image-placeholder.png`"
                        alt="Blog featured image"
                    />
                </div>

                <img
                    :src="blogPost.featured_image.path"
                    alt="Blog featured image"
                    v-else
                />
            </a>

            <div class="blog-post-body gap-10 flex-column-start-start">
                <ul class="list-inline blog-post-meta">
                    <blog-post-tags
                        v-for="tag in blogPost.tags "
                        :key="tag.id"
                        :tag="tag">
                    </blog-post-tags>

                </ul>

                <h3 class="blog-post-title">
                    <a class="font-20-26-normal color-black" :href="route('blog_posts.show', blogPost.slug)">
                        {{ blogPost.title }}
                    </a>
                </h3>

                <a href="route('blog_category.blog_posts.index',blogPost.category.slug)" class="blog-post-short-description font-14-16-normal color-black">
                    {{ blogPost.category.translations[0].name }}
                </a>

                <div class="blog_data font-13-16-normal color-neutral_grey ">
                    {{ blogPost.data }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import BlogPostTags from "./BlogPostTags.vue";

import dateFormat from "dateFormat";

Vue.prototype.dateFormat = dateFormat;

export default {
    components: {
        BlogPostTags
    },
    props: {
        blogPost: {
            required: true,
            type: Object,
        },
    },

    computed: {
        baseUrl() {
            return window.FleetCart.baseUrl;
        },
    },
};
</script>
