<?php

use Illuminate\Database\Seeder;
use App\Models\Users;
use Hash as encrypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Users::create([
        	'username' => 'superadmin',
        	'name' => 'bagas superadmin',
        	'email' => 'superadmin@web.test',
        	'password' =>  encrypt::make('123456')
        ]);

        $superadmin->assignRole(['superadmin']);

        $admin = Users::create([
        	'username' => 'admin',
        	'name' => 'bagas admin',
        	'email' => 'admin@web.test',
        	'password' =>  encrypt::make('123456')
        ]);

        $admin->assignRole('admin');

        $bidang = Users::create([
            'username' => 'bidang',
            'name' => 'bagas bidang',
            'email' => 'bidang@web.test',
            'password' =>  encrypt::make('123456')
        ]);

        $bidang = Users::create([
            'username' => 'bpsb',
            'name' => 'bagas bpsb',
            'email' => 'bpsb@web.test',
            'password' =>  encrypt::make('123456')
        ]);

        $bidang->assignRole('bidang');
    }
}
