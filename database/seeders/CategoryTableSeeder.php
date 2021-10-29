<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->insert([
            'name' => 'NFT',
        ]);

        \DB::table('categories')->insert([
            'name' => 'Finance',
        ]);

        \DB::table('categories')->insert([
            'name' => 'P2P Trading',
        ]);

        \DB::table('categories')->insert([
            'name' => 'Dash',
        ]);
    }
}
