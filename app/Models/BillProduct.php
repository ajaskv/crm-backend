<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductService;

class BillProduct extends Model
{
    protected $fillable = [
        'product_id',
        'bill_id',
        'quantity',
        'tax',
        'discount',
        'total',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\ProductService', 'id', 'product_id')->first();
    }
    /**
     * Get the pro that owns the BillProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function pro()
    {
        return $this->belongsTo('App\Models\ProductService',  'product_id');
    }
   
}
