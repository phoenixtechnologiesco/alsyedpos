<?php


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class MenusTableSeeder extends Seeder
{
    private $menuId = null;
    private $dropdownId = array();
    private $dropdown = false;
    private $sequence = 1;
    private $joinData = array();
    private $superAdminRole = null;
    private $adminRole = null;
    private $userRole = null;
    private $subFolder = '';

    public function join($roles, $menusId){
        $roles = explode(',', $roles);
        foreach($roles as $role){
            array_push($this->joinData, array('role_name' => $role, 'menus_id' => $menusId));
        }
    }

    /*
        Function assigns menu elements to roles
        Must by use on end of this seeder
    */
    public function joinAllByTransaction(){
        DB::beginTransaction();
        foreach($this->joinData as $data){
            DB::table('menu_role')->insert([
                'role_name' => $data['role_name'],
                'menus_id' => $data['menus_id'],
            ]);
        }
        DB::commit();
    }

    public function insertLink($roles, $name, $href, $icon = null){
        $href = $this->subFolder . $href;
        if($this->dropdown === false){
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'sequence' => $this->sequence
            ]);
        }else{
            DB::table('menus')->insert([
                'slug' => 'link',
                'name' => $name,
                'icon' => $icon,
                'href' => $href,
                'menu_id' => $this->menuId,
                'parent_id' => $this->dropdownId[count($this->dropdownId) - 1],
                'sequence' => $this->sequence
            ]);
        }
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        $permission = Permission::where('name', '=', $name)->get();
        if(empty($permission)){
            $permission = Permission::create(['name' => 'visit ' . $name]);
        }
        $roles = explode(',', $roles);
        if(in_array('user', $roles)){
            $this->userRole->givePermissionTo($permission);
        }
        if(in_array('admin', $roles)){
            $this->adminRole->givePermissionTo($permission);
        }
        if(in_array('superadmin', $roles)){
            $this->superAdminRole->givePermissionTo($permission);
        }
        return $lastId;
    }

    public function insertTitle($roles, $name){
        DB::table('menus')->insert([
            'slug' => 'title',
            'name' => $name,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence
        ]);
        $this->sequence++;
        $lastId = DB::getPdo()->lastInsertId();
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function beginDropdown($roles, $name, $icon = ''){
        if(count($this->dropdownId)){
            $parentId = $this->dropdownId[count($this->dropdownId) - 1];
        }else{
            $parentId = null;
        }
        DB::table('menus')->insert([
            'slug' => 'dropdown',
            'name' => $name,
            'icon' => $icon,
            'menu_id' => $this->menuId,
            'sequence' => $this->sequence,
            'parent_id' => $parentId
        ]);
        $lastId = DB::getPdo()->lastInsertId();
        array_push($this->dropdownId, $lastId);
        $this->dropdown = true;
        $this->sequence++;
        $this->join($roles, $lastId);
        return $lastId;
    }

    public function endDropdown(){
        $this->dropdown = false;
        array_pop( $this->dropdownId );
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
        /* Get roles */
        $this->superAdminRole = Role::where('name' , '=' , 'superadmin' )->first();
        $this->adminRole = Role::where('name' , '=' , 'admin' )->first();
        $this->userRole = Role::where('name', '=', 'user' )->first();
        /* Create Sidebar menu */
        DB::table('menulist')->insert([
            'name' => 'sidebar menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        $this->insertLink('guest,user,admin,superadmin', 'Dashboard', '/', 'cil-speedometer');
        $this->beginDropdown('admin,superadmin', 'Settings', 'cil-settings');
            // $this->insertLink('admin,superadmin', 'Notes',                   '/notes');
            $this->insertLink('admin,superadmin', 'Users',                   '/users');
            $this->insertLink('superadmin', 'Edit menu',               '/menu/menu');
            $this->insertLink('superadmin', 'Edit menu elements',      '/menu/element');
            $this->insertLink('superadmin', 'Edit roles',              '/roles');
            // $this->insertLink('admin,superadmin', 'Media',                   '/media');
            // $this->insertLink('admin,superadmin', 'BREAD',                   '/bread');
        $this->endDropdown();
        $this->insertLink('guest', 'Login', '/login', 'cil-account-logout');
        $this->beginDropdown('user,admin,superadmin', 'Buisness Contacts', 'cil-address-book');
            $this->insertLink('user,admin,superadmin', 'Customers List',    '/customer');
            $this->insertLink('user,admin,superadmin', 'Add Customer',         '/customer/create');
            $this->insertLink('admin,superadmin', 'Suppliers List',      '/supplier');
            $this->insertLink('admin,superadmin', 'Add Supplier',      '/supplier/create');
        $this->endDropdown();
        $this->beginDropdown('user,admin,superadmin', 'Product Management', 'cil-storage');
            $this->insertLink('user,admin,superadmin', 'Products List',    '/product');
            $this->insertLink('user,admin,superadmin', 'Add Product',         '/product/create');
            $this->insertLink('admin,superadmin',      'Companies List',      '/company');
            $this->insertLink('admin,superadmin',      'Add Company',      '/company/create');
            $this->insertLink('admin,superadmin',      'Brands List',         '/brand');
            $this->insertLink('admin,superadmin',      'Add Brand',     '/brand/create');
        $this->endDropdown();
        $this->beginDropdown('user,admin,superadmin', 'Sale/Party Section', 'cil-cart');
            $this->insertLink('user,admin,superadmin', 'Sale Counter',  '/sale/pos');
            $this->insertLink('user,admin,superadmin', 'Sales List',  '/sale');
            $this->insertLink('user,admin,superadmin', 'Add Sale',  '/sale/create');
            $this->insertLink('admin,superadmin', 'Payment List',  '/sale/payment');
            $this->insertLink('admin,superadmin', 'Add Payment',  '/sale/payment/create');
            $this->insertLink('admin,superadmin', 'Financial',  '/sale/financial');
            $this->insertLink('user,admin,superadmin', 'Sale Return List',  '/sale/return');
        $this->endDropdown();
        $this->beginDropdown('user,admin,superadmin', 'Purchase Section', 'cil-money');
            $this->insertLink('admin,superadmin', 'Purchases List',  '/purchase');
            $this->insertLink('admin,superadmin', 'Add Purchase',  '/purchase/create');
            $this->insertLink('admin,superadmin', 'Payment List',  '/purchase/payment');
            $this->insertLink('admin,superadmin', 'Add Payment',  '/purchase/payment/create');
            $this->insertLink('admin,superadmin', 'Ledger',  '/purchase/ledger');
            $this->insertLink('admin,superadmin', 'Purchase Return List',  '/purchase/return');
            $this->insertLink('admin,superadmin', 'Stock',  '/purchase/stock');
            $this->insertLink('user,admin,superadmin', 'Available Stock',  '/purchase/available');
            $this->insertLink('user,admin,superadmin', 'Damage Stock',  '/purchase/damage');
            $this->insertLink('user,admin,superadmin', 'Minimum Stock',  '/purchase/minimum');
        $this->endDropdown();
        $this->beginDropdown('admin,superadmin', 'Sale Report', 'cil-library');
            $this->insertLink('admin,superadmin', 'Date Wise', '/report/date');
            $this->insertLink('admin,superadmin', 'Cash/Credit Wise', '/report/cashcredit');
            $this->insertLink('admin,superadmin', 'Customer Wise', '/report/customer');
            $this->insertLink('admin,superadmin', 'Brand Wise',  '/report/brand');
            $this->insertLink('admin,superadmin', 'Company Wise', '/report/company');
        $this->endDropdown();
        $this->beginDropdown('admin,superadmin', 'Balance Sheet', 'cil-spreadsheet');
            $this->insertLink('admin,superadmin', 'Customer Wise', '/balance/customer');
            $this->insertLink('admin,superadmin', 'Sale Wise', '/balance/sale');
            $this->insertLink('admin,superadmin', 'Purchase Wise', '/balance/purchase');
            $this->insertLink('admin,superadmin', 'CreditDuration Wise', '/balance/creditduration');
        $this->endDropdown();
        // $this->beginDropdown('user,admin,superadmin', 'Pages', 'cil-star');
        //     $this->insertLink('user,admin,superadmin', 'Login',         '/login');
        //     $this->insertLink('user,admin,superadmin', 'Register',      '/register');
        //     $this->insertLink('user,admin,superadmin', 'Error 404',     '/404');
        //     $this->insertLink('user,admin,superadmin', 'Error 500',     '/500');
        // $this->endDropdown();

        /* Create top menu */
        DB::table('menulist')->insert([
            'name' => 'top menu'
        ]);
        $this->menuId = DB::getPdo()->lastInsertId();  //set menuId
        // $this->beginDropdown('guest,user,admin,superadmin', 'Pages');
        //     $id = $this->insertLink('guest,user,admin,superadmin', 'Dashboard',    '/');
        //     $id = $this->insertLink('user,admin,superadmin', 'Notes',              '/notes');
        //     $id = $this->insertLink('admin,superadmin', 'Users',                   '/users');
        // $this->endDropdown();
        // $id = $this->beginDropdown('admin,superadmin', 'Settings');
        // $id = $this->insertLink('admin,superadmin', 'Users',                   '/users');
        // $id = $this->insertLink('admin,superadmin', 'Edit menu',               '/menu/menu');
        // $id = $this->insertLink('admin,superadmin', 'Edit menu elements',      '/menu/element');
        // $id = $this->insertLink('admin,superadmin', 'Edit roles',              '/roles');
        // $id = $this->insertLink('admin,superadmin', 'Media',                   '/media');
        // $id = $this->insertLink('admin,superadmin', 'BREAD',                   '/bread');
        $this->endDropdown();

        $this->joinAllByTransaction(); ///   <===== Must by use on end of this seeder
    }
}
