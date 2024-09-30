<div class="product-details-info position-relative flex-grow-1">
    <div class="details-info-top flex-column-center-start gap-20">
        @if ($product->variant)
            <div class="product-variants">
                @include('storefront::public.products.show.variations')
            </div>
        @endif
        @if ($product->variant)
            <div v-if="isActiveItem" class="product-price  font-30-36-normal color-black" v-html="item.formatted_price">
                {!! $item->is_active ? $item->formatted_price : '' !!}
            </div>
        @else
            <div class="product-price  font-30-36-normal color-black" v-html="item.formatted_price">
                {!! $item->formatted_price !!}
            </div>
        @endif

         <div class="delivery_free flex-row-start-center gap-10">
             <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M15 8V11H15.5V12H13.4823C13.494 12.0817 13.5 12.1651 13.5 12.25C13.5 13.2165 12.7165 14 11.75 14C10.7835 14 10 13.2165 10 12.25C10 12.1651 10.006 12.0817 10.0177 12H5.98228C5.99396 12.0817 6 12.1651 6 12.25C6 13.2165 5.2165 14 4.25 14C3.2835 14 2.5 13.2165 2.5 12.25C2.5 12.1651 2.50604 12.0817 2.51772 12H0.5V11H1V4C1 3.44772 1.44772 3 2 3H10C10.5523 3 11 3.44772 11 4V6H13C13.1326 6 13.2598 6.05268 13.3536 6.14645L14.8536 7.64645C14.9473 7.74021 15 7.86739 15 8ZM11 10.6684V7H12.7929L14 8.20711V11H12.9747C12.6591 10.6907 12.2268 10.5 11.75 10.5C11.4816 10.5 11.2273 10.5604 11 10.6684ZM10 11H5.47475C5.15911 10.6907 4.72683 10.5 4.25 10.5C3.77317 10.5 3.34089 10.6907 3.02525 11H2V4H10V11ZM4.25 11.5C3.83579 11.5 3.5 11.8358 3.5 12.25C3.5 12.6642 3.83579 13 4.25 13C4.66421 13 5 12.6642 5 12.25C5 11.8358 4.66421 11.5 4.25 11.5ZM11 12.25C11 11.8358 11.3358 11.5 11.75 11.5C12.1642 11.5 12.5 11.8358 12.5 12.25C12.5 12.6642 12.1642 13 11.75 13C11.3358 13 11 12.6642 11 12.25Z" fill="#59666E"></path></svg>
             <div class="delivery_desc font-16-20-normal color-neutral_grey">
                 {{ trans('storefront::product.delivery_free_title') }}
             </div>
         </div>
         <div class="details-info-top-actions flex-row-start-center gap-10">

             <button
                 type="button"
                 v-if="isActiveItem"
                 class="btn btn-primary btn-add-to-cart gap-10 font-16-20-normal"
                 :class="inCart ? 'inCart' :'' "
                 :disabled="isAddToCartDisabled"
                 @click="addToCart"
             >
                 <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.5C7.92893 0.5 6.25 2.17893 6.25 4.25V5H2.42366L0.611403 18.0885C0.361723 19.8918 1.76261 21.5 3.58305 21.5H16.417C18.2375 21.5 19.6384 19.8918 19.3887 18.0885L17.5764 5H13.75V4.25C13.75 2.17893 12.0711 0.5 10 0.5ZM12.25 5V4.25C12.25 3.00736 11.2426 2 10 2C8.75736 2 7.75 3.00736 7.75 4.25V5H12.25ZM2.09723 18.2943L3.73028 6.5H16.2698L17.9029 18.2943C18.0277 19.1959 17.3273 20 16.417 20H3.58305C2.67283 20 1.97239 19.1959 2.09723 18.2943Z" fill="black"></path></svg>

                 <span v-if="inCart">{{ trans('storefront::storefront.in_cart') }}</span>
                 <span  v-else>{{ trans('storefront::product_card.add_to_cart') }}</span>
             </button>
             <div class="btn btn-primary btn-add-to-cart InActive gap-10 font-16-20-normal"
                    v-else>
                 {{ trans('storefront::product.unavailable') }}

             </div>
            <button
                class="btn btn-wishlist"
                :class="inWishlist ? 'added' : ''"
                @click="syncWishlist"
            >
                <svg v-if="inWishlist" width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z"
                          fill="#499777"></path>
                </svg>
                <svg v-else width="22" height="21" viewBox="0 0 22 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11 3.69286L9.85542 2.8941C7.90677 1.5342 5.20284 1.72609 3.46447 3.46447C1.51184 5.41709 1.51184 8.58291 3.46447 10.5355L11 18.0711L18.5355 10.5355C20.4882 8.58291 20.4882 5.41709 18.5355 3.46447C16.7972 1.72609 14.0932 1.5342 12.1446 2.8941L11 3.69286ZM11 1.25399C8.27033 -0.650958 4.48604 -0.385537 2.05025 2.05025C-0.683417 4.78392 -0.683417 9.21608 2.05025 11.9497L10.2929 20.1924C10.6834 20.5829 11.3166 20.5829 11.7071 20.1924L19.9497 11.9497C22.6834 9.21608 22.6834 4.78392 19.9497 2.05025C17.514 -0.385537 13.7297 -0.650958 11 1.25399Z"
                          fill="black"></path>
                </svg>

            </button>
         </div>
         <div class="tabsList flex-column-start-start">
             <div class="tabWrap">
                 <div class="tabHeader font-18-24-500 color-black"
                      :class="tabs.Delivery ? 'active' : ''"
                      @click="tabClick('Delivery')">
                     {{ trans('storefront::product.tabsTitles.Delivery') }}
                 </div>
                 <div class="tabContent"
                      :class="tabs.Delivery ? 'active' : ''">
                     {{ trans('storefront::product.tabsTitles.Delivery') }}
                 </div>
             </div>
             <div class="tabWrap">
                 <div class="tabHeader font-18-24-500 color-black"
                      :class="tabs.Reviews ? 'active' : ''"
                      @click="tabClick('Reviews')"  >
                     {{ trans('storefront::product.tabsTitles.Reviews') }}
                 </div>
                 <div class="tabContent"
                      :class="tabs.Reviews ? 'active' : ''"
                        >
                     <div class="user-review-wrap" :class="{ loading: fetchingReviews }">
                         <div class="empty-message" v-if="emptyReviews && !hideEmptyBlock">
                             <svg xmlns="http://www.w3.org/2000/svg"
                                  viewBox="0 0 500 500"
                                  preserveAspectRatio="xMidYMid meet">
                                 <path d="M226.53,300a10.1,10.1,0,1,0,3,7.14,10.15,10.15,0,0,0-3-7.14Zm0,0"/>
                                 <path d="M219.32,280.5a10,10,0,0,1-3.19-.43c-4.41-1.4-5-5.74-5.3-9.09v-.11c-2.54-28.07-4.18-56.14-6.71-84.21-.18-2-.34-4.12.73-5.94a10.13,10.13,0,0,1,3.83-4c3.16-1.9,6.65-3.83,10.59-3.84s7.25,1.8,10.35,3.61a10.13,10.13,0,0,1,4.6,4.89,9.21,9.21,0,0,1,.37,4.66c-2.56,28.56-4.24,57.11-6.8,85.66a11.09,11.09,0,0,1-1.53,5.57C224.87,279.27,222.1,280.42,219.32,280.5Z"/>
                                 <path d="M382.92,118.81l-168.17,0q-60.94,0-121.87,0-10.23,0-20.48,0h-24c-22.18,0-41.58,19-41.62,40.93q-.15,88.1,0,176.18c0,20.66,16.7,39.23,37.25,40.86,11.79.94,23.71.41,35.56.53,1.71,0,3.42,0,5.47,0v69l1.16.58c1.06-1.22,2-2.53,3.2-3.68,20.6-20.7,41.27-41.35,61.8-62.13l.16-.16a14.24,14.24,0,0,1,2.42-2,11.17,11.17,0,0,1,6.3-1.67q111.21.15,222.44.06c27.06,0,45.13-18.1,45.13-45.19v-41q0-63.81,0-127.63C427.66,137.19,409.34,118.81,382.92,118.81Zm24.23,213c0,16-9,25-25.1,25q-103.18,0-206.35-.06-12,0-24.06,0c-.32,0-.62,0-.93,0a11.18,11.18,0,0,0-8,3.7c-12,12.26-24.24,24.34-37.23,37.34V357.08c-1.8-.08-3.36-.21-4.93-.21q-24.69,0-49.37,0c-14.85,0-24-9.28-24-24.18q0-84.72,0-169.46c0-14.62,9.25-23.93,23.81-23.93H383.26c14.44,0,23.88,9.48,23.89,24Z"/>
                                 <path d="M493.34,97.83c0-26.34-18.3-44.72-44.72-44.72l-168.17,0q-83.2,0-166.39,0c-22.17,0-41.58,19-41.62,40.93,0,8.25,0,16.5,0,24.76q0,10.23,0,20.46h20.5V97.52c0-14.62,9.25-23.93,23.81-23.93H449c14.44,0,23.88,9.48,23.89,24V266.14c0,16-9,25-25.1,25h-40.6v20.48h41c27.06,0,45.13-18.1,45.13-45.19Q493.32,182.14,493.34,97.83ZM153.75,379c.43-.49.86-1,1.32-1.44q10.31-10.36,20.63-20.71-12,0-24.06,0c-.32,0-.62,0-.93,0v23.81l.62.31Z"/>
                             </svg>

                             <h4>{{ trans('storefront::product.be_the_first_one_to_review_this_product') }}</h4>
                        </div>
                         <div class="reveiwsSliderProd"
                         :class="emptyReviews ? 'hidden':''">
                             <div class="reviewsProdWrap">
                                    <reviews-product-list v-for="(reviewsitems,index) in reviewsList"
                                               :key='index'
                                               :reviewsitems="reviewsitems"></reviews-product-list>

                             </div>
                         </div>
                          <div class="reviewAddBlock">
                              <button class="addReview"
                                      :class="showReviewForm ? 'active' :''"
                                      @click="showReviewForm = (showReviewForm) ? false : true">
                                  {{ trans('storefront::product.add_a_review') }}
                              </button>
                              <div class="reviewForm"
                                   :class="showReviewForm ? 'active' :''" >
                                  @include('storefront::public.products.show.form_reviews')
                              </div>
                          </div>
                        </div>
                 </div>
             </div>
             <div class="tabWrap">
                 <div class="tabHeader font-18-24-500 color-black"
                      :class="tabs.ComponentsList ? 'active' : ''"
                      @click="tabClick('ComponentsList')">
                     {{ trans('storefront::product.tabsTitles.Components') }}
                 </div>
                 <div class="tabContent"
                      :class="tabs.ComponentsList ? 'active' : ''">
                     ComponentsListF
                 </div>
             </div>
             <div class="tabWrap">
                 <div class="tabHeader font-18-24-500 color-black"
                      :class="tabs.PayPolicy ? 'active' : ''"
                      @click="tabClick('PayPolicy')">
                     {{ trans('storefront::product.tabsTitles.Pay') }}
                 </div>
                 <div class="tabContent"
                      :class="tabs.PayPolicy ? 'active' : ''">
                     {{ trans('storefront::product.tabsTitles.Pay') }}
                 </div>
             </div>
             <div class="tabWrap">
                 <div class="tabHeader font-18-24-500 color-black"
                      :class="tabs.ReturnPolicy ? 'active' : ''"
                      @click="tabClick('ReturnPolicy')">
                     {{ trans('storefront::product.tabsTitles.Return') }}
                 </div>
                 <div class="tabContent"
                      :class="tabs.ReturnPolicy ? 'active' : ''">
                     {{ trans('storefront::product.tabsTitles.Return') }}
                 </div>
             </div>
         </div>
    </div>
</div>
