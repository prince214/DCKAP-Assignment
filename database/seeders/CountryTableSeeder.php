<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['country_name' => 'India'],
            ['country_name' => 'America'],
            ['country_name' => 'Australia']
        ];
        DB::table('countries')->insert($data);
    }
}
