@if (setting('reviews_enabled'))
{{--  @if ($product->purchasedByUser())--}}
        <div class="review-form-wrap">

            <form @submit.prevent="addNewReview" @input="errors.clear($event.target.name)">
                <div class="review-form">
                    <h4>{{ trans('storefront::product.add_a_review') }}</h4>

                    @honeypot

                    <div class="row">
                        <div class="col-md-18">
                            <div class="form-group">
                                <label>{{ trans('storefront::product.review_form.your_rating') }}<span>*</span></label>

                                <div class="rating-input">
                                    <input type="radio" name="rating" v-model="reviewForm.rating" id="star-5" value="5">
                                    <label for="star-5" title="5 star">
                                        <i class="las la-star"></i>
                                    </label>

                                    <input type="radio" name="rating" v-model="reviewForm.rating" id="star-4" value="4">
                                    <label for="star-4" title="4 star">
                                        <i class="las la-star"></i>
                                    </label>

                                    <input type="radio" name="rating" v-model="reviewForm.rating" id="star-3" value="3">
                                    <label for="star-3" title="3 star">
                                        <i class="las la-star"></i>
                                    </label>

                                    <input type="radio" name="rating" v-model="reviewForm.rating" id="star-2" value="2">
                                    <label for="star-2" title="2 star">
                                        <i class="las la-star"></i>
                                    </label>

                                    <input type="radio" name="rating" v-model="reviewForm.rating" id="star-1" value="1">
                                    <label for="star-1" title="1 star">
                                        <i class="las la-star"></i>
                                    </label>
                                </div>

                                <span class="error-message" v-if="errors.has('rating')" v-text="errors.get('rating')"></span>
                            </div>

                            <div class="form-group">
                                <label for="name">{{ trans('storefront::product.review_form.name') }}<span>*</span></label>
                                <input type="text" name="reviewer_name" v-model="reviewForm.reviewer_name" id="name" class="form-control">
                                <span class="error-message" v-if="errors.has('reviewer_name')" v-text="errors.get('reviewer_name')"></span>
                            </div>

                            <div class="form-group">
                                <label for="comment">{{ trans('storefront::product.review_form.comment') }}<span>*</span></label>
                                <textarea rows="5" name="comment" v-model="reviewForm.comment" id="comment" class="form-control"></textarea>
                                <span class="error-message" v-if="errors.has('comment')" v-text="errors.get('comment')"></span>
                            </div>

                            @if (setting('google_recaptcha_enabled'))
                                <div class="form-group p-t-5 captcha-field">
                                    <div class="g-recaptcha" data-sitekey="{{ setting('google_recaptcha_site_key') }}"></div>

                                    <span class="error-message" v-if="errors.has('g-recaptcha-response')" v-text="errors.get('g-recaptcha-response')"></span>
                                </div>
                            @endif
                            <div class="flex-row flex-row-between-center">
                            <button
                                type="submit"
                                class="btn btn-primary btn-submit"
                                :class="{ 'btn-loading': addingNewReview }"
                            >
                                {{ trans('storefront::product.review_form.submit') }}
                            </button>
                            <button
                                type="button"
                                class="btn btn-primary btn-submit"
                                @click="showReviewForm = (showReviewForm) ? false : true"
                            >
                                {{ trans('storefront::product.hide_review_form') }}
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
{{--    @endif--}}

@endif
@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
