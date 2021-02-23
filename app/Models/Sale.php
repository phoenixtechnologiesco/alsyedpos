<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function products()
    {
         return $this->hasMany('Product', 'sale_products', 'sale_id', 'product_id');
        //  ->withPivot('invoice_id');
        //  ->withTimestamps();
    }
}
