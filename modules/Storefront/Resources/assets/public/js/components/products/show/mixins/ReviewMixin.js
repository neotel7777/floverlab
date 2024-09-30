export default {
    data() {
        return {
            reviewsList:  [],
        }
    },
    computed: {
        totalReviews() {
            if (this.reviewsList.length !== 0) {
                return this.reviewsList[0].allReviews;
            }

            return 0;
        },

        ratingPercent() {
            return (this.reviewsList.length !== 0) ? this.reviewsList[0].avgPercent : 0 ;
        },

        emptyReviews() {
            return this.totalReviews === 0;
        },

        totalReviewPage() {
            return Math.ceil(this.reviews.total / 5);
        },

    },

    created() {
        this.fetchReviews();
    },

    methods: {
        async fetchReviews() {
            this.fetchingReviews = true;

            try {
                const response = await axios.get(
                    route("products.reviews.items", {
                        productId: this.product.id,
                        page: this.currentReviewPage,
                    })
                );


                this.reviewsList = response.data;
                this.hideEmptyBlock = (response.data[0].reviews.length > 0) ? true : false;

            } catch (error) {
                this.$notify(error.response.data.message);
            } finally {
                this.fetchingReviews = false;

            }
        },
        slickRewOptions() {
            return  {
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                rtl: window.FleetCart.rtl,

            };
        },
        addNewReview() {
            this.addingNewReview = true;

            axios
                .post(
                    route("products.reviews.store", {
                        productId: this.product.id,
                    }),
                    {
                        ...this.reviewForm,
                        "g-recaptcha-response": grecaptcha.getResponse(),
                    }
                )
                .then((response) => {
                    this.reviewForm = {};
                    //this.reviews.total++;
                    this.showReviewForm = false;
                    $('.reviewsSlider').slick('unslick');
                    this.reviews.data  = response.data[0].reviews;
                    this.reviews.total = response.data[0].allReviews;
                    this.reviewCount = response.data[0].allReviews;
                    this.ratindPercent = response.data[0].avgPercent;
                    this.avgRating = response.data[0].avgPercent;
                    this.hideEmptyBlock = response.data[0].reviews.length > 0;
                    this.reviewsList = response.data;
                    this.totalReviews = response.data[0].allReviews;
                    this.$nextTick((e)=>{
                       // $(".reviewsSlider").slick('reinit');
                        $(".reviewsSlider:not(.slick-initialized)").slick(
                            this.slickRewOptions()
                        );
                    })
                    this.errors.reset();
                })
                .catch(({ response }) => {
                    if (response.status === 422) {
                        this.errors.record(response.data.errors);

                        return;
                    }

                    this.$notify(response.data.message);
                })
                .finally(() => {
                    this.addingNewReview = false;

                    grecaptcha.reset();
                });
        },

        changeReviewPage(page) {
            this.currentReviewPage = page;

            this.fetchReviews();
        },
    },
};
