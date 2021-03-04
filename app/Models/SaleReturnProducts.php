<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleReturnProducts extends Model
{
    public $table = "salereturn_products";
    // public $fillable = ['sale_id', 'product_id'];

    public function salereturns()
    {
        return $this->belongsTo(SaleReturn::class, 'product_id', 'sale_return_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
