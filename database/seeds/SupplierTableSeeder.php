<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\Supplier;
use App\Models\RoleHierarchy;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'supplier_id' 			        => 1,
            'supplier_ref_no' 			    => 'R8Y543',
            'supplier_type'                 => 'general',
            'supplier_name' 			    => 'Asif Ghafoor',
            'supplier_shop_name' 		    => 'Shop 101',
            'supplier_shop_info' 		    => 'A Wholeseller Store',
            'supplier_email' 			    => 'asif@example.com',
            'supplier_alternate_email' 	    => 'shop101@example.com',
            'supplier_cnic_number' 		    => '45801-2394261-9',
            'supplier_town' 			    => 'Lee Market',
            'supplier_area' 			    => 'Lyari, Karachi',
            'supplier_shop_address' 	    => 'Lyari, Sector 5c/4, Karachi Sindh, 76750 Pakistan',
            // 'supplier_resident_address'     => '',
            'supplier_zipcode' 			    => '76750',
            'supplier_phone_number' 	    => '0333-4942794',
            'supplier_office_number' 	    => '0331-4732629',
            'supplier_alternate_number'     => '0332-1892431',
            'supplier_total_balance' 	    => 0.00,
            'supplier_balance_paid' 	    => 0.00,
            'supplier_balance_dues' 	    => 0.00,
            'status_id' 	                => 1,
            'created_by' 	                => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
