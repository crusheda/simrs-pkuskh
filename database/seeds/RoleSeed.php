<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'administrator']);
        $role1->givePermissionTo('users_manage');

        $role2 = Role::create(['name' => 'it']);
        $role2->givePermissionTo('pengadaan');
        $role2->givePermissionTo('imut_it');
        $role2->givePermissionTo('penyimpanan_file');
        
        $role3 = Role::create(['name' => 'kantor']);
        $role3->givePermissionTo('pengadaan');
        $role3->givePermissionTo('penyimpanan_file');
        $role3->givePermissionTo('berkas_rapat');
        
        $role4 = Role::create(['name' => 'kabag-keperawatan']);
        $role4->givePermissionTo('penyimpanan_file');
        $role4->givePermissionTo('log_perawat');
        $role4->givePermissionTo('pengadaan');
        
        $role5 = Role::create(['name' => 'ibs']);
        $role5->givePermissionTo('pengadaan');
        $role5->givePermissionTo('log_perawat');
        $role5->givePermissionTo('penyimpanan_file');
        
        // $role6 = Role::create(['name' => '']);
        // $role6->givePermissionTo('');
    }
}
