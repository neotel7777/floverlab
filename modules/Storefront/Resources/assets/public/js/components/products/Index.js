import { trans } from "../../functions";
import noUiSlider from "nouislider";

export default {
    components: { VPagination: () => import("../VPagination.vue") },

    props: [
        "initialQuery",
        "initialBrandName",
        "initialBrandBanner",
        "initialBrandSlug",
        "initialCategoryName",
        "initialCategoryBanner",
        "initialCategorySlug",
        "initialTagName",
        "initialTagSlug",
        "initialAttribute",
        "minPrice",
        "maxPrice",
        "initialSort",
        "initialPerPage",
        "initialPage",
        "initialViewMode",
    ],

    data() {
        return {
            isActiveFilter: [],
            reviewsList:[],
            blogPostsList:[],
            filterOpen: true,
            fetchingProducts: false,
            viewAll: true,
            products: { data: [] },
            categories_home: [],
            attributeFilters: [],
            brandBanner: this.initialBrandBanner,
            categoryName: this.initialCategoryName,
            categoryBanner: this.initialCategoryBanner,
            viewMode: this.initialViewMode,
            queryParams: {
                query: this.initialQuery,
                brand: this.initialBrandSlug,
                category: this.initialCategorySlug,
                tag: this.initialTagSlug,
                attribute: this.initialAttribute,
                fromPrice: 0,
                toPrice: this.maxPrice,
                sort: this.initialSort,
                perPage: this.initialPerPage,
                page: this.initialPage,
            },
        };
    },

    computed: {
        emptyProducts() {
            return this.products.data.length === 0;
        },
        emptyReviews() {
            return this.reviewsList.length === 0;
        },
        emptyBlogPosts() {
            return this.blogPostsList.length === 0;
        },
        totalPage() {
            return Math.ceil(this.products.total / this.queryParams.perPage);
        },

        showingResults() {
            if (this.emptyProducts) {
                return;
            }

            return trans("storefront::products.showing_results", {
                from: this.products.from,
                to: this.products.to,
                total: this.products.total,
            });
        },
        slickReviewOptions() {
            return  {
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
                responsive: [

                    {
                        breakpoint: 1301,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 1051,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 881,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                    {
                        breakpoint: 641,
                        settings: {
                            dots: true,
                            arrows: false,
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            row: 1
                        },
                    },
                ]
            };
        },
    },

    mounted() {
        this.addEventListeners();
        this.initPriceFilter();
        this.fetchProducts();
        this.initLatestProductsSlider();
    },

    methods: {
        addEventListeners() {
            $(this.$refs.sortSelect).on("change", (e) => {
                this.queryParams.sort = e.currentTarget.value;

                this.fetchProducts();
            });

            $(this.$refs.perPageSelect).on("change", (e) => {
                this.queryParams.perPage = e.currentTarget.value;
                this.fetchProducts();
            });
            $(this.$refs.clearFilter).on('click',(e) => {

                this.queryParams.attribute = {};
                this.updatePriceRange(this.minPrice,this.maxPrice);
            });
            $(this.$refs.viewAllProducts).on('click',(e) => {
                this.queryParams.perPage = this.products.total;
                this.viewAll = false;
                this.fetchProducts();

            });
        },

        initPriceFilter() {
            noUiSlider.create(this.$refs.priceRange, {
                connect: true,
                direction: window.FleetCart.rtl ? "rtl" : "ltr",
                start: [this.minPrice, this.maxPrice],
                step: 1,
                range: {
                    min: [this.minPrice],
                    max: [this.maxPrice],
                },
            });

            this.$refs.priceRange.noUiSlider.on("update", (values, handle) => {
                let value = Math.round(values[handle]);

                if (handle === 0) {
                    this.queryParams.fromPrice = value;
                } else {
                    this.queryParams.toPrice = value;
                }
            });

            this.$refs.priceRange.noUiSlider.on("change", this.fetchProducts);
        },

        updatePriceRange(fromPrice, toPrice) {
            this.$refs.priceRange.noUiSlider.set([fromPrice, toPrice]);

            this.fetchProducts();
        },

        toggleAttributeFilter(slug, value) {
            if (!this.queryParams.attribute.hasOwnProperty(slug)) {
                this.queryParams.attribute[slug] = [];
            }

            if (this.queryParams.attribute[slug].includes(value)) {
                this.queryParams.attribute[slug].splice(
                    this.queryParams.attribute[slug].indexOf(value),
                    1
                );
            } else {
                this.queryParams.attribute[slug].push(value);
            }

            this.fetchProducts({ updateAttributeFilters: false });
        },

        isFilteredByAttribute(slug, value) {
            if (!this.queryParams.attribute.hasOwnProperty(slug)) {
                return false;
            }

            return this.queryParams.attribute[slug].includes(value);
        },

        changeCategory(category) {
            this.categoryName = category.name;
            this.categoryBanner = category.banner.path;
            this.queryParams.query = null;
            this.queryParams.category = category.slug;
            this.queryParams.attribute = {};
            this.queryParams.page = 1;

            this.fetchProducts();
        },

        changePage(page) {
            this.queryParams.page = page;

            this.fetchProducts();
        },
        showOverlay(){
          $(".hidding_overlay").show();
        },
        hideOverlay(){
            $(".hidding_overlay").hide();
        },
        goToProductsList(){
            $('html, body').stop().animate({
                scrollTop: $(".topContent").offset().top - 40
            }, 300);
        },
        async fetchProducts(options = { updateAttributeFilters: true }) {
            this.fetchingProducts = true;
            this.showOverlay();
            try {
                const response = await axios.get(
                    route("products.index", this.queryParams)
                );

                this.products = response.data.products;
                this.categories_home = response.data.categories_home;
                this.blogPostsList = response.data.blogPostsList;
                $(".reviewsSlider").slick('unslick');
                this.reviewsList = response.data.reviewsList;
                $(".image-slider").slick('unslick');

                this.$nextTick((e)=> {

                    $(".reviewsSlider:not(.slick-initialized)").slick(
                        this.slickReviewOptions
                    );
                    $(".image-slider:not(.slick-initialized)").slick( {
                        rows: 0,
                        dots: true,
                        arrows: false,
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        rtl: window.FleetCart.rtl,
                    });
                    setTimeout(function (e){
                        $(".hidding_overlay").hide();
                    },500);



                });
                if (options.updateAttributeFilters) {
                    this.attributeFilters = response.data.attributes;
                }

                this.goToProductsList();

            } catch (error) {
                this.hideOverlay();
                this.$notify(error.response.data.message);
            } finally {
                this.fetchingProducts = false;

            }
        },

        initLatestProductsSlider() {
            $(this.$refs.latestProducts).slick({
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,
            });
        },
    },
};
