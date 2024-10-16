<template>
    <div class="header-search-wrap-parent">
        <div
            class="header-search-wrap-overlay"
            :class="{ active: showSuggestions }"
        ></div>

        <div
            class="header-search-wrap"
            :class="{ 'header-search-wrap-radius': hasAnySuggestion}"
            v-click-outside="hideSuggestions"
        >
            <div class="header-search">
                <form class="search-form" @submit.prevent="search">
                    <div
                        class="header-search-lg"
                        :class="{'header-search-lg-background': showSuggestions }"
                    >
                        <button
                            type="submit"
                            class="btn-search"
                        >
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2337 13.0292C11.0577 14.0247 9.53646 14.625 7.875 14.625C4.14708 14.625 1.125 11.6029 1.125 7.875C1.125 4.14708 4.14708 1.125 7.875 1.125C11.6029 1.125 14.625 4.14708 14.625 7.875C14.625 9.53646 14.0247 11.0577 13.0292 12.2337L16.7102 15.9148C16.9299 16.1344 16.9299 16.4906 16.7102 16.7102C16.4906 16.9299 16.1344 16.9299 15.9148 16.7102L12.2337 13.0292ZM13.5 7.875C13.5 10.9816 10.9816 13.5 7.875 13.5C4.7684 13.5 2.25 10.9816 2.25 7.875C2.25 4.7684 4.7684 2.25 7.875 2.25C10.9816 2.25 13.5 4.7684 13.5 7.875Z" fill="#8E979C"/>
                            </svg>
                        </button>
                        <input
                            type="text"
                            name="query"
                            class="form-control search-input"
                            :class="{ focused: showSuggestions }"
                            autocomplete="off"
                            v-model="form.query"
                            :placeholder="
                                $trans('storefront::layout.search_for_products')
                            "
                            @focus="showExistingSuggestions"
                            @keydown.esc="hideSuggestions"
                            @keydown.down="nextSuggestion"
                            @keydown.up="prevSuggestion"
                        />

                        <div
                            class="header-search-right"
                            :class="{
                                'header-search-right-background':
                                    showSuggestions,
                            }"
                        >

                        </div>
                    </div>

                    <div class="header-search-sm">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M22 22L20 20"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>
                </form>
            </div>

            <div class="header-search-sm-form">
                <form class="search-form" @submit.prevent="search">
                    <div class="btn-close" @click="hideSuggestions">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                d="M9.57 5.93005L3.5 12.0001L9.57 18.0701"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M20.4999 12H3.66992"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </div>

                    <!-- Cannot use v-model due to a bug. See https://github.com/vuejs/vue/issues/8231 -->
                    <input
                        type="text"
                        name="query"
                        class="form-control search-input-sm"
                        autocomplete="off"
                        :placeholder="
                            $trans('storefront::layout.search_for_products')
                        "
                        :value="form.query"
                        @input="form.query = $event.target.value"
                        @focus="showExistingSuggestions"
                        @keydown.esc="hideSuggestions"
                        @keydown.down="nextSuggestion"
                        @keydown.up="prevSuggestion"
                    />

                    <button type="submit" class="btn btn-search">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                        >
                            <path
                                d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M22 22L20 20"
                                stroke="#292D32"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                    </button>
                </form>
            </div>

            <Transition>
                <div
                    class="search-suggestions overflow-hidden"
                    v-if="shouldShowSuggestions"
                >
                    <div
                        class="search-suggestions-inner"
                        ref="searchSuggestionsInner"
                    >

                        <div class="product-suggestion">

                            <ul class="list-inline product-suggestion-list">
                                <li
                                    v-for="product in suggestions.products"
                                    :key="product.slug"
                                    class="list-item"
                                    :class="{
                                        active: isActiveSuggestion(product),
                                    }"
                                    :ref="product.slug"
                                    @mouseover="changeActiveSuggestion(product)"
                                    @mouseleave="clearActiveSuggestion"
                                >
                                    <a
                                        :href="product.url"
                                        class="single-item flex-row-start-center font-16-20-normal"
                                        @click="hideSuggestions"
                                    >
                                        <div class="product-image">
                                            <img
                                                :src="baseImage(product)"
                                                :class="{
                                                    'image-placeholder':
                                                        !hasBaseImage(product),
                                                }"
                                                :alt="product.name"
                                            />
                                        </div>
                                        <div class="product-info">
                                            <div class="product-info-top">
                                                <h6
                                                    class="product-name"
                                                    v-html="product.name"
                                                ></h6>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <a
                        v-if="suggestions.remaining !== 0"
                        :href="moreResultsUrl"
                        @click="hideSuggestions"
                        class="more-results"
                    >
                        {{
                            $trans("storefront::layout.more_results", {
                                count: this.suggestions.remaining,
                            })
                        }}
                    </a>
                </div>
            </Transition>
        </div>

        <div
            v-if="
                Boolean(isMostSearchedKeywordsEnabled) &&
                mostSearchedKeywords.length !== 0
            "
            class="searched-keywords"
        >
            <label>
                {{ $trans("storefront::layout.most_searched") }}
            </label>

            <ul class="list-inline searched-keywords-list">
                <li
                    v-for="(mostSearchedKeyword, index) in mostSearchedKeywords"
                    :key="index"
                >
                    <a
                        :href="
                            route('products.index', {
                                query: mostSearchedKeyword,
                            })
                        "
                    >
                        {{ mostSearchedKeyword }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import { throttle } from "lodash";

export default {
    props: [

        "mostSearchedKeywords",
        "isMostSearchedKeywordsEnabled",
        "initialQuery",
        "initialCategory",
    ],

    data() {
        return {
            activeSuggestion: null,
            showSuggestions: false,
            form: {
                query: this.initialQuery,
            },
            suggestions: {
                products: [],
                remaining: 0,
            },
        };
    },

    computed: {
        initialCategoryIsNotInCategoryList() {
            return !this.categories.includes(this.initialCategory);
        },

        shouldShowSuggestions() {
            if (!this.showSuggestions) {
                return false;
            }

            return this.hasAnySuggestion;
        },

        moreResultsUrl() {
            if (this.form.category) {
                return route("categories.products.index", this.form);
            }

            return route("products.index", { query: this.form.query });
        },

        hasAnySuggestion() {
            return this.suggestions.products.length !== 0;
        },

        allSuggestions() {
            return [
                ...this.suggestions.categories,
                ...this.suggestions.products,
            ];
        },

        firstSuggestion() {
            return this.allSuggestions[0];
        },

        lastSuggestion() {
            return this.allSuggestions[this.allSuggestions.length - 1];
        },
    },

    created() {
        this.fetchSuggestions();
    },

    watch: {
        "form.query": throttle(function (newQuery) {
            if (newQuery === "") {
                this.clearSuggestions();
            } else {
                this.showSuggestions = true;

                this.fetchSuggestions();
            }
        }, 600),
    },

    methods: {
        changeCategory(category) {
            this.form.category = category;

            this.fetchSuggestions();
        },

        async fetchSuggestions() {
            if (this.form.query === "") return;

            const { data } = await axios.get(
                route("suggestions.index", this.form)
            );

            this.suggestions.categories = data.categories;
            this.suggestions.products = data.products;
            this.suggestions.remaining = data.remaining;

            this.clearActiveSuggestion();
            this.resetSuggestionScrollBar();
        },

        search() {
            if (!this.form.query) {
                return;
            }

            if (this.activeSuggestion) {
                window.location.href = this.activeSuggestion.url;

                this.hideSuggestions();

                return;
            }

            if (this.form.category) {
                window.location.href = route(
                    "categories.products.index",
                    this.form
                );

                return;
            }

            window.location.href = route("products.index", {
                query: this.form.query,
            });
        },

        showExistingSuggestions() {
            this.showSuggestions = true;
        },

        clearSuggestions() {
            this.suggestions.categories = [];
            this.suggestions.products = [];
        },

        hideSuggestions() {
            this.showSuggestions = false;

            this.clearActiveSuggestion();
        },

        isActiveSuggestion(suggestion) {
            if (!this.activeSuggestion) {
                return false;
            }

            return this.activeSuggestion.slug === suggestion.slug;
        },

        changeActiveSuggestion(suggestion) {
            this.activeSuggestion = suggestion;
        },

        clearActiveSuggestion() {
            this.activeSuggestion = null;
        },

        nextSuggestion() {
            if (!this.hasAnySuggestion) {
                return;
            }

            this.activeSuggestion =
                this.allSuggestions[this.nextSuggestionIndex()];

            if (!this.activeSuggestion) {
                this.activeSuggestion = this.firstSuggestion;
            }

            this.adjustSuggestionScrollBar();
        },

        prevSuggestion() {
            if (!this.hasAnySuggestion) {
                return;
            }

            if (this.prevSuggestionIndex() === -1) {
                this.clearActiveSuggestion();

                return;
            }

            this.activeSuggestion =
                this.allSuggestions[this.prevSuggestionIndex()];

            if (!this.activeSuggestion) {
                this.activeSuggestion = this.lastSuggestion;
            }

            this.adjustSuggestionScrollBar();
        },

        nextSuggestionIndex() {
            return this.currentSuggestionIndex() + 1;
        },

        prevSuggestionIndex() {
            return this.currentSuggestionIndex() - 1;
        },

        currentSuggestionIndex() {
            return this.allSuggestions.indexOf(this.activeSuggestion);
        },

        adjustSuggestionScrollBar() {
            this.$refs.searchSuggestionsInner.scrollTop =
                this.$refs[this.activeSuggestion.slug][0].offsetTop - 200;
        },

        resetSuggestionScrollBar() {
            if (this.$refs.searchSuggestionsInner !== undefined) {
                this.$refs.searchSuggestionsInner.scrollTop = 0;
            }
        },

        productUrl(product) {
            return route("products.show", product.slug);
        },

        hasBaseImage(product) {
            return product.base_image.length !== 0;
        },

        baseImage(product) {
            if (this.hasBaseImage(product)) {
                return product.base_image.path;
            }

            return `${window.FleetCart.baseUrl}/build/assets/image-placeholder.png`;
        },
    },
};
</script>
