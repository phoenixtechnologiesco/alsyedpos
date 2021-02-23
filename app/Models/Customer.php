<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Database\Eloquent\SoftDeletes;
// use Spatie\Permission\Traits\HasRoles;
use DB;

class Customer extends Model
{
    use Notifiable;
    // use SoftDeletes;
    // use HasRoles;
    
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_ref_no', 'customer_type', 'customer_name', 'customer_shop_name', 'customer_shop_info', 'customer_email', 'customer_alternate_email', 'customer_cnic_number', 'customer_town', 'customer_area', 'customer_shop_address', 'customer_resident_address', 'customer_zipcode', 'customer_phone_number', 'customer_office_number', 'customer_alternate_number', 'customer_total_balance', 'customer_balance_paid', 'customer_balance_dues', 'customer_credit_duration', 'customer_credit_type', 'customer_credit_limit', 'customer_sale_rate', 'status_id', 'created_by',
    ];

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

    // public function updateCustomer($customer_id, $customer_edits){
    //     DB::table('customers')->where('customer_id', '=', $customer_id)->update($customer_edits);
    // }
}
