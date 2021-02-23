<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBarcodes extends Model
{
    public $table = "product_barcodes";
    public $fillable = ['product_id', 'product_barcodes'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'id', 'product_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
