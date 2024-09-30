<?php

namespace Modules\Review\Entities;

use Illuminate\Http\Request;
use Modules\Order\Entities\Order;
use Modules\User\Entities\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Modules\Support\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Review\Admin\ReviewTable;

class Review extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['rating_percent', 'status', 'created_at_formatted'];


    public static function countAndAvgRating(Product $product)
    {
        return self::select(DB::raw('count(*) as count, avg(rating) as avg_rating'))
            ->where('product_id', $product->id)
            ->first();
    }


    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('approved', function ($query) {
            $query->where('is_approved', true);
        });
    }

    public static function getHomeReviews()
    {
        $reviews = self::with(['product','reviewer'])->where('is_approved', true)
            ->orderBy("id","Desc")
            ->limit(20)->get();

        $percent = intval((self::select(DB::raw('avg(rating) as avg_rating'))->first()->avg_rating / 5) * 100);
        $statuses = explode(",",trans('storefront::review.stars_stats_list'));
        $locale = locale();

        foreach($reviews as &$review){
            $review->statusRating = trim($statuses[$review->rating-1]);
            setlocale(LC_TIME,$locale);
            $review->data = strftime('%B %G');
            $review->percent = ($review->rating / 5) * 100;
        }

        return [[
            'allReviews' => count(self::where('is_approved',1)->get()),
            'avgRaitind' =>number_format(self::select(DB::raw('avg(rating) as avg_rating'))->first()->avg_rating,1,".",""),
            'orders'    => count(Order::all()),
            'avgPercent' => $percent,
            'reviews'   => $reviews,
            'isReviews' => count($reviews) >0,
        ]];
    }
    public static function getCategoryReviews($productids=[])
    {
        if(!empty($productids)){
            $reviews = self::with(['product', 'reviewer'])->where('is_approved', true)
                ->whereIn('product_id',$productids)
                ->limit(20)->get();
        } else {
            $reviews = self::with(['product', 'reviewer'])->where('is_approved', true)->limit(20)->get();
        }

        $percent = intval((self::select(DB::raw('avg(rating) as avg_rating'))->first()->avg_rating / 5) * 100);
        $statuses = explode(",",trans('storefront::review.stars_stats_list'));
        $locale = locale();

        foreach($reviews as &$review){
            $review->statusRating = trim($statuses[$review->rating-1]);
            setlocale(LC_TIME,$locale);
            $review->data = strftime('%B %G');
            $review->percent = ($review->rating / 5) * 100;
        }

        return [[
            'allReviews' => count(self::where('is_approved',1)->get()),
            'avgRaitind' =>number_format(self::select(DB::raw('avg(rating) as avg_rating'))->first()->avg_rating,1,".",""),
            'orders'    => count(Order::all()),
            'avgPercent' => $percent,
            'reviews'   => $reviews,
            'isReviews' => count($reviews) >0,
        ]];
    }

    public static function getProductReviews($product_id)
    {

        $reviews = self::with(['product', 'reviewer'])->where('is_approved', true)
                ->where('product_id',$product_id)
                ->orderBy('id','desc')
                ->limit(20)->get();
        $allreviews = self::with(['product', 'reviewer'])->where('is_approved', true)
            ->where('product_id',$product_id)
            ->get();

        $rating = self::select(DB::raw('avg(rating) as avg_rating'))
            ->where('is_approved', true)
            ->where('product_id',$product_id)
            ->first()->avg_rating;
        $percent = intval(($rating / 5) * 100);
        $statuses = explode(",",trans('storefront::review.stars_stats_list'));
        $locale = locale();

        foreach($reviews as &$review){
            $review->statusRating = trim($statuses[$review->rating-1]);
            setlocale(LC_TIME,$locale);
            $review->data = strftime('%B %G');
            $review->percent = ($review->rating / 5) * 100;
        }

        return [[
            'allReviews' => count($allreviews),
            'avgRaitind' =>number_format($rating,1,".",""),
            'orders'    => count(Order::all()),
            'avgPercent' => $percent,
            'reviews'   => $reviews,
            'isReviews' => count($reviews) >0,
        ]];
    }

    public function getAvgRatingAttribute($avgRating)
    {
        return $avgRating ?: 0;
    }


    public function getRatingPercentAttribute()
    {
        return ($this->rating / 5) * 100;
    }


    public function getStatusAttribute()
    {
        return $this->status();
    }


    public function status()
    {
        if ($this->is_approved) {
            return trans('review::statuses.approved');
        }

        return trans('review::statuses.unapproved');
    }


    public function getCreatedAtFormattedAttribute()
    {

        return ($this->created_at)?$this->created_at->toFormattedDateString():'';
    }


    public function product()
    {
        return $this->belongsTo(Product::class)->with('files')->withTrashed();
    }


    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }


    /**
     * Get table data for the resource
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function table(Request $request)
    {
        $query = static::withoutGlobalScope('approved')
            ->with(['product' => function ($query) {
                $query->withoutGlobalScope('active');
            }])
            ->when($request->productId, function ($query) use ($request) {
                return $query->where('product_id', $request->productId);
            });

        return new ReviewTable($query);
    }
}
