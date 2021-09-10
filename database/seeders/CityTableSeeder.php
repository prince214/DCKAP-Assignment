<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['country_id' => '1','city_name' => 'Chennai'],
            ['country_id' => '1','city_name' => 'Hyderabad'],
            ['country_id' => '1','city_name' => 'Bangalore'],
            ['country_id' => '1','city_name' => 'Bhopal'],
            ['country_id' => '1','city_name' => 'Indore'],
            ['country_id' => '2','city_name' => 'New York'],
            ['country_id' => '2','city_name' => 'Chicago'],
            ['country_id' => '2','city_name' => 'Denmark'],
            ['country_id' => '3','city_name' => 'Sydney'],
            ['country_id' => '3','city_name' => 'Brisbane'],
        ];
        DB::table('cities')->insert($data);
    }
}
