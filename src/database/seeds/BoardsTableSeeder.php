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
        DB::table('boards')->insert([
            'name_short' => 'b',
            'name' => 'Random',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'pr',
            'name' => 'Programming',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'pol',
            'name' => 'Politics',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'gd',
            'name' => 'Gamedev',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'mu',
            'name' => 'Music',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'sp',
            'name' => 'Sports',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'vg',
            'name' => 'Videogames',
        ]);
    }
}
