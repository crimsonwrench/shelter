<?php

use Illuminate\Database\Seeder;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'user',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'admin',
        ]);       
    }
}
