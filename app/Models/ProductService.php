<?php

namespace App\Models;

use App\Models\Tax;
use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'sale_price',
        'purchase_price',
        'tax_id',
        'category_id',
        'unit_id',
        'type',
        'created_by',
    ];

    public function taxes()
    {
        return $this->hasOne('App\Models\Tax', 'id', 'tax_id')->first();
    }

    public function unit()
    {
        return $this->hasOne('App\Models\ProductServiceUnit', 'id', 'unit_id')->first();
    }

    public function category()
    {
        return $this->hasOne('App\Models\ProductServiceCategory', 'id', 'category_id');
    }

    public function tax($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes = [];
        foreach ($taxArr as $tax) {
            $taxes[] = Tax::find($tax);
        }

        return $taxes;
    }

    public function taxRate($taxes)
    {
        $taxArr = explode(',', $taxes);
        $taxRate = 0;
        foreach ($taxArr as $tax) {
            $tax = Tax::find($tax);
            $taxRate += $tax->rate;
        }

        return $taxRate;
    }

    public static function taxData($taxes)
    {
        $taxArr = explode(',', $taxes);

        $taxes = [];
        foreach ($taxArr as $tax) {
            $taxesData = Tax::find($tax);
            $taxes[] = !empty($taxesData) ? $taxesData->name : '';
        }

        return implode(',', $taxes);
    }
    public static function getUnit($product_id)
    {
        $product = ProductService::select('unit_id')->find($product_id);
        if ($product) {
            $unit = ProductServiceUnit::select('name')->find($product->unit_id);
            $data = $unit->name;
        } else {
            $data = "undefined";
        }
        return $data;
    }
}
