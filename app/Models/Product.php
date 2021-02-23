<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = "products";
    // public $fillable = ['product_id', 'product_barcode'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_products', 'product_id', 'sale_id');
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }

    public function barcodes()
    {
        return $this->HasMany(ProductBarcodes::class, 'product_id', 'product_id');
        // ->wherePivot('product_barcodes');
        //  ->withPivot('product_barcodes');
        //  ->withTimestamps();
    }
}
