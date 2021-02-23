<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class SaleProducts extends Pivot
{
    public $table = "sale_products";
    // public $fillable = ['sale_id', 'product_id'];

    public function sales()
    {
        return $this->belongsTo(Sale::class, 'product_id', 'sale_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
