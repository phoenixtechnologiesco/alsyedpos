<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnProducts extends Model
{
    public $table = "purchasereturn_products";
    // public $fillable = ['purchase_id', 'product_id'];

    public function purchasereturns()
    {
        return $this->belongsTo(PurchaseReturn::class, 'product_id', 'purchase_return_id');
        // ->wherePivot('approved', 1);
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
