<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Permission\Traits\HasRoles;
use DB;

class Supplier extends Model
{
    use Notifiable;
    // use SoftDeletes;
    // use HasRoles;
    
    protected $table = 'suppliers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'supplier_ref_no', 'supplier_type', 'supplier_name', 'supplier_shop_name', 'supplier_shop_info', 'supplier_email', 'supplier_alternate_email', 'supplier_cnic_number', 'supplier_town', 'supplier_area', 'supplier_shop_address', 'supplier_resident_address', 'supplier_zipcode', 'supplier_phone_number', 'supplier_office_number', 'supplier_alternate_number', 'supplier_total_balance', 'supplier_balance_paid', 'supplier_balance_dues', 'status_id', 'created_by',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'created_at' => 'datetime',
    // ];

    // protected $dates = [
    //     'deleted_at'
    // ];

    // protected $attributes = [ 
    //     'menuroles' => 'user',
    // ];
}
