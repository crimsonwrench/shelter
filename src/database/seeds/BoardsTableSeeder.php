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
            'name' => 'Бред',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'pr',
            'name' => 'Программирование',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'po',
            'name' => 'Политика',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'gd',
            'name' => 'Gamedev',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'mu',
            'name' => 'Музыка',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'sp',
            'name' => 'Спорт',
        ]);
        DB::table('boards')->insert([
            'name_short' => 'un',
            'name' => 'Образование',
        ]);
    }
}
