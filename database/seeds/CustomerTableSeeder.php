<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\Customer;
use App\Models\RoleHierarchy;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'customer_id' 			        => 1,
            'customer_ref_no' 			    => 'Ev1232',
            'customer_type'                 => 'general',
            'customer_name' 			    => 'Walk-in Customer',
            // 'customer_shop_name' 		=> '',
            // 'customer_shop_info' 		=> '',
            // 'customer_email' 			=> '',
            // 'customer_alternate_email' 	=> '',
            // 'customer_cnic_number' 		=> '',
            // 'customer_town' 			    => '',
            // 'customer_area' 			    => '',
            // 'customer_shop_address' 	    => '',
            // 'customer_resident_address'  => '',
            // 'customer_zipcode' 			=> '',
            // 'customer_phone_number' 	    => '',
            // 'customer_office_number' 	=> '',
            // 'customer_alternate_number'  => '',
            'customer_total_balance' 	    => '0.00',
            'customer_balance_paid' 	    => '0.00',
            'customer_balance_dues' 	    => '0.00',
            // 'customer_credit_duration' 	=> '',
            // 'customer_credit_type' 	    => '',
            // 'customer_credit_limit'  	=> '',
            'customer_sale_rate' 	        => 'cash',
            'status_id' 	                => 1,
            'created_by' 	                => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('customers')->insert([
            'customer_id' 			        => 2,
            'customer_ref_no' 			    => 'L738G1',
            'customer_type'                 => 'general',
            'customer_name' 			    => 'Safdar Ali',
            'customer_shop_name' 		    => 'Super Mart',
            'customer_shop_info' 		    => 'A Super Store',
            'customer_email' 			    => 'safdar@example.com',
            'customer_alternate_email' 	    => 'supermart@example.com',
            'customer_cnic_number' 		    => '45801-2342361-9',
            'customer_town' 			    => 'Al-Abbas Town',
            'customer_area' 			    => 'Gulshan Iqbal, Karachi',
            'customer_shop_address' 	    => 'Shahrah-e-Faisal, Sector 5c/4, Karachi Sindh, 75850 Pakistan',
            'customer_resident_address'     => 'Shahrah-e-Pakistan, Sector 4c/8, Karachi Sindh, 75850 Pakistan',
            'customer_zipcode' 			    => '75850',
            'customer_phone_number' 	    => '0333-4582794',
            'customer_office_number' 	    => '0331-4733529',
            'customer_alternate_number'     => '0332-6092431',
            'customer_total_balance' 	    => 0.00,
            'customer_balance_paid' 	    => 0.00,
            'customer_balance_dues' 	    => 0.00,
            'customer_credit_duration' 	    => '30',
            'customer_credit_type' 	        => 'days',
            'customer_credit_limit'  	    => '30000',
            'customer_sale_rate' 	        => 'credit',
            'status_id' 	                => 1,
            'created_by' 	                => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
