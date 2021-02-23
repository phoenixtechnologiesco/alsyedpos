<?php

use Illuminate\Database\Seeder;
//use database\seeds\UsersAndNotesSeeder;
//use database\seeds\MenusTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
        $this->call('UsersAndNotesSeeder');
        $this->call('MenusTableSeeder');
        $this->call('FolderTableSeeder');
        $this->call('BREADSeeder');
        */

        $this->call([
            UsersAndNotesSeeder::class,
            MenusTableSeeder::class,
            FolderTableSeeder::class,
            BREADSeeder::class,
            CustomerTableSeeder::class,
            SupplierTableSeeder::class,
            ProductTableSeeder::class,
        ]);
    }
}
