<?php

namespace Modules\FlashSale\Entities;

use Modules\Product\Entities\Product;
use Modules\Support\Money;
use Modules\Order\Entities\Order;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FlashSaleProduct extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flash_sale_products';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'end_date' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['sold'];


    public function getSoldAttribute()
    {
        return $this->orders()->sum('qty');
    }


    public function orders()
    {
        return $this->belongsToMany(Order::class, 'flash_sale_product_orders', 'flash_sale_product_id')
            ->withPivot('qty');
    }


    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }


}
