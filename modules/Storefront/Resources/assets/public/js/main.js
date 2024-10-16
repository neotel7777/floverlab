import "./axios";
import "./storefront";

import Vue from "vue";
import store from "./store";
import { notify, trans, chunk } from "./functions";
import VueToast from "vue-toast-notification";
import vClickOutside from "v-click-outside";
import HeaderSearch from "./components/layout/HeaderSearch.vue";
import HomeCategoriesList from "./components/home/HomeCategoriesList.vue";
import HomeCategories from "./components/home/HomeCategories.vue";
import ProductRating from "./components/ProductRating.vue";
import LandscapeProducts from "./components/LandscapeProducts.vue";
import DynamicTab from "./components/home/DynamicTab";
import HomeFeatures from "./components/home/HomeFeatures.vue";
import FeaturedCategories from "./components/home/FeaturedCategories.vue";
import BannerThreeColumnFullWidth from "./components/home/BannerThreeColumnFullWidth.vue";
import ProductTabsOne from "./components/home/ProductTabsOne.vue";
import TopBrands from "./components/home/TopBrands.vue";
import BannerTwoColumn from "./components/home/BannerTwoColumn.vue";
import ProductGrid from "./components/home/ProductGrid.vue";
import BannerThreeColumn from "./components/home/BannerThreeColumn.vue";
import ProductTabsTwo from "./components/home/ProductTabsTwo.vue";
import BannerOneColumn from "./components/home/BannerOneColumn.vue";
import BlogPosts from "./components/home/BlogPosts.vue";
import NewsletterSubscription from "./components/layout/NewsletterSubscription";
import ProductIndex from "./components/products/Index";
import ProductCardGridView from "./components/products/index/ProductCardGridView.vue";
import ProductCardListView from "./components/products/index/ProductCardListView.vue";
import ProductCardVertical from "./components/ProductCardVertical.vue";
import ProductShow from "./components/products/Show";
import CartIndex from "./components/cart/Index";
import CheckoutCreate from "./components/checkout/Create";
import CompareIndex from "./components/compare/Index";
import MyWishlist from "./components/account/wishlist/Index";
import MyReviews from "./components/account/reviews/Index";
import MyAddresses from "./components/account/addresses/Index";
import SaleCard from "./components/SaleCard.vue";
import SaleProductsHome from "./components/home/SaleProductsHome.vue";
import ReviewsHomeList from "./components/home/ReviewsHomeList.vue";
import ReviewsProductList from "./components/home/ReviewsProductList.vue";
import BlogPostTags from "./components/BlogPostTags.vue";
import ProductItemCard from "./components/ProductItemCard.vue";
import HeaderSearchNew from "./components/layout/HeaderSearchNew.vue";
import HomeFaqList from  "./components/HomeFaqList.vue";
import HomeFaqItem from "./components/HomeFaqItem.vue";
import AccessoriiProduct from "./components/AccessoriiProduct.vue";
import SubCategories from "./components/SubCategories.vue";
import UserLogin from "./components/layout/UserLogin.vue";
import AccessoriiCartProduct from "./components/AccessoriiCartProduct.vue";
import localitesDelivery from "./components/LocalitesDelivery.vue";
import LocalitesDelivery from "@modules/Storefront/Resources/assets/public/js/components/LocalitesDelivery.vue";

window.Vue = Vue;

Vue.prototype.route = route;
Vue.prototype.$notify = notify;
Vue.prototype.$trans = trans;
Vue.prototype.$chunk = chunk;

Vue.use(VueToast);
Vue.use(vClickOutside);

Vue.component("header-search", HeaderSearch);
Vue.component("product-rating", ProductRating);
Vue.component("sidebar-cart", () => import("./components/layout/SidebarCart"));
Vue.component("newsletter-popup", () =>
    import("./components/layout/NewsletterPopup")
);
Vue.component("newsletter-subscription", NewsletterSubscription);
Vue.component("reviews-home-list", ReviewsHomeList);
Vue.component("reviews-product-list", ReviewsProductList);
Vue.component("cookie-bar", () => import("./components/layout/CookieBar"));
Vue.component('home-categories',HomeCategories);
Vue.component("home-categories-list",HomeCategoriesList);
Vue.component("landscape-products", LandscapeProducts);
Vue.component("dynamic-tab", DynamicTab);
Vue.component("home-features", HomeFeatures);
Vue.component("featured-categories", FeaturedCategories);
Vue.component("banner-three-column-full-width", BannerThreeColumnFullWidth);
Vue.component("product-tabs-one", ProductTabsOne);
Vue.component("top-brands", TopBrands);
Vue.component("flash-sale-and-vertical-products", () =>
    import("./components/home/FlashSaleAndVerticalProducts.vue")
);
Vue.component("sale-card",SaleCard);
Vue.component("sale-products-home",SaleProductsHome);
Vue.component("banner-two-column", BannerTwoColumn);
Vue.component("product-grid", ProductGrid);
Vue.component("banner-three-column", BannerThreeColumn);
Vue.component("product-tabs-two", ProductTabsTwo);
Vue.component("banner-one-column", BannerOneColumn);
Vue.component("blog-posts", BlogPosts);
Vue.component('blog-post-tags',BlogPostTags);
Vue.component("product-index", ProductIndex);
Vue.component("product-card-grid-view", ProductCardGridView);
Vue.component("product-card-list-view", ProductCardListView);
Vue.component("product-card-vertical", ProductCardVertical);
Vue.component("product-show", ProductShow);
Vue.component("cart-index", CartIndex);
Vue.component("checkout-create", CheckoutCreate);
Vue.component("compare-index", CompareIndex);
Vue.component("my-wishlist", MyWishlist);
Vue.component("my-reviews", MyReviews);
Vue.component("my-addresses", MyAddresses);
Vue.component('product-item-card',ProductItemCard);
Vue.component('header-search-new',HeaderSearchNew);
Vue.component('home-faq-list',HomeFaqList);
Vue.component('home-faq-item',HomeFaqItem);
Vue.component('accessorii-product',AccessoriiProduct);
Vue.component('sub-categories',SubCategories);
Vue.component('user-login',UserLogin);
Vue.component('accesorii-cart-products',AccessoriiCartProduct);
Vue.component('localites_delivery',LocalitesDelivery);

new Vue({
    el: "#app",

    computed: {
        compareCount() {
            return store.compareCount();
        },

        wishlistCount() {
            return store.wishlistCount();
        },

        cart() {
            return store.state.cart;
        },
    },

    mounted() {
        this.initEventListeners();
    },

    methods: {
        initEventListeners() {
            $(".header-cart").on("click", (e) => {
                e.stopPropagation();

                if (route().current("checkout.create")) {
                    window.location.href = route("cart.index");

                    return;
                }

                $(".overlay").addClass("active");
                $(".sidebar-cart-wrap").addClass("active");
            });
        },
    },
});
