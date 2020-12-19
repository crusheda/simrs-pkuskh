<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('cache:clear');
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create(['name' => 'users_manage']);
        Permission::create(['name' => 'pengadaan']);
        Permission::create(['name' => 'penyimpanan_file']);
        Permission::create(['name' => 'berkas_rapat']);
        Permission::create(['name' => 'imut_it']);
        Permission::create(['name' => 'log_it']);
        Permission::create(['name' => 'log_perawat']);
        Permission::create(['name' => 'skl']);
    }
}
