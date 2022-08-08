<?php

namespace App\Models;

use App\Models\ProductServiceUnit;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'type',
        'created_by',
    ];

    public $customField;

    public function unit()
    {
        return $this->hasOne('App\Models\ProductServiceUnit', 'id', 'unit_id')->first();
    }
    
}
