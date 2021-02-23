<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchProducts extends Model
{
    public $table = "batch_products";
    // public $fillable = ['product_id', 'product_barcodes'];

    public function purchases()
    {
        return $this->belongsTo(Purchase::class, 'id', 'purchase_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
