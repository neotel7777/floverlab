<template>
    <section class="home-categories-wrap">
        <div class="container">
           <div class="homeCategoryWrapper flex-column-start-start gap-20">
                <home-categories
                    v-for="(category, index) in categorieshome"
                    :key="index"
                    :category="category"
                ></home-categories>
            </div>
        </div>
    </section>
</template>

<script>

import HomeCategories from "./HomeCategories.vue";

export default {
    components: {
        HomeCategories,
    },
    props: ['categorieshome'],

    data() {
        return {
            categorieshome: [],
        };
    },

};
</script>
