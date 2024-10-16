<template>
<div class="accesoriiMain flex-column">
    <div class="sub-category-list flex-row-start-center" v-if="noEmptySubCategorii" >
        <sub-categories v-for="(sub,index) in categories"
                        :key="index"
                        :item="sub"
                        :index="index"
                        @get-products-by-cat-id="fetchProducts"></sub-categories>

    </div>
    <div class="productsList flex-row-start-start" v-if="noEmptyProducts">
        <product-card v-for="(product,item) in products"
                      :key="index"
                      :product="product"></product-card>
    </div>
</div>
</template>
<script>
import ProductCard from './ProductCard.vue';
import SubCategories from "./SubCategories.vue";
export default {
    components: { ProductCard, SubCategories },
    props: ['accessorii'],
    data() {
      return {
          'products': [],
      }
    },
    created() {
      this.products =  this.accessorii.products;
    },
    computed: {
        categories(){
            return this.accessorii.data;
        },
        noEmptySubCategorii(){
            return this.accessorii.data.length > 1;
        },

        noEmptyProducts(){
            return this.accessorii.products.length !==0;
        },
        slickOptions(){
            return {
                rows: 0,
                dots: false,
                arrows: true,
                infinite: true,
                slidesToShow: 4,
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
            }
        }

    },
    methods:{
        fetchProducts(id) {
            let products = this.accessorii.data[id].products;
            if (products.length > 0) {
                $(".accesoriiMain .productsList").slick('unslick');
                this.products = products;
                this.$nextTick(()=>{
                    $(".accesoriiMain .productsList").slick(this.slickOptions);
                })

            }
        }
    },
    mounted() {
        if(!$(".accesoriiMain .productsList").hasClass('slick-slider')) {
            $(".accesoriiMain .productsList").slick(this.slickOptions);
        }
    }
}
</script>

