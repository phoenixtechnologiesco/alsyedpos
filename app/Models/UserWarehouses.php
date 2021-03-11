<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWarehouses extends Model
{
    public $table = "user_warehouses";
    // public $fillable = ['user_id', 'warehouse_id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'warehouse_id', 'user_id');
        // ->wherePivot('approved', 1);
        //  ->withTimestamps();
    }
    
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'user_id', 'warehouse_id');
    }
}
