<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
        $user1->assignRole('administrator');

        $user2 = User::create([
            'name' => 'it',
            'email' => 'it@pkuskh.com',
            'password' => bcrypt('sunaryo37')
        ]);
        $user2->assignRole('it');

        // $user3 = User::create([
        //     'name' => '',
        //     'email' => '@pkuskh.com',
        //     'password' => bcrypt('')
        // ]);
        // $user3->assignRole('');

    }
}
