<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    protected $table = 'sale_returns';

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'warehouse_id', 'warehouse_id');
    }

    public function cashier()
    {
        return $this->hasOne(User::class, 'id', 'sale_return_returned_by');
    }
}
