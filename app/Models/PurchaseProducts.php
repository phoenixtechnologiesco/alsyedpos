<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProducts extends Model
{
    public $table = "purchase_products";
    // public $fillable = ['purchase_id', 'product_id'];

    public function purchases()
    {
        return $this->belongsTo(Purchase::class, 'product_id', 'purchase_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
