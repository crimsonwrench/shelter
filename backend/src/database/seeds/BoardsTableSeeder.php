<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Board', 10)->create();
    }
}
