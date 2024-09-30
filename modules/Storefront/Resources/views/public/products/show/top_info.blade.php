<h1 class="product-name">{{ $product->name }}</h1>

@if (setting('reviews_enabled'))
    <product-rating
        :rating-percent="ratingPercent"
        :review-count="totalReviews"
        :is-show-description="true"
    >
    </product-rating>
@endif

